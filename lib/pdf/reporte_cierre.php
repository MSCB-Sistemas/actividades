<?php
//----------------Sesion------------------------------------------
include("../sesion.php"); 
if ($_SESSION['a_caja']=="0" ){
	$mensaje="Usuario sin permisos";
	$destino="menu_principal.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
$usuario=$_SESSION['id'];
//---------------Fin inicio Sesion-------------------------------

include("../funciones.php");
include("../sesion.php");

require_once("class.ezpdf.php");


//Configuración de página-----------------

$pdf =& new Cezpdf('a4');

$pdf->selectFont('../fonts/courier.afm');

$pdf->ezSetCmMargins(1,1,1.5,1.5);

//Fin configuración de página-----------------

$cierre=$_GET["cierre"];







//------------------Querys------------------------------------------------------------------

$link=conectarse();

$query_persona_liquidada="select id_usuario,apellido,nombre from usuarios where id_usuario='$usuario' order by apellido";
$record_persona_liquidada=mysql_query($query_persona_liquidada,$link);
$apellido_liquidada=mysql_result($record_persona_liquidada,0,"apellido");
$nombre_liquidada=mysql_result($record_persona_liquidada,0,"nombre");


$query_monedas="select id_moneda,nombre from monedas";
$record_monedas=mysql_query($query_monedas,$link);

$query_datos_cierre="select cierre,moneda,saldo_inicial,total_movimientos,total_cierre,time_real from tts_cierres
where cierre='$cierre' order by cierre desc";
		
//-----TRAIGO LOS DATOS DEL ENCABEZADO DEL CIERRE---------
$datos_cierre=mysql_fetch_array(mysql_query($query_datos_cierre,$link));
$fecha_cierre=fecha_mysql_normal_completa($datos_cierre["time_real"]);



//--------fin Querys--------------------------------------------------------------------------------------

$propietario= "CIERRE CORRESPONDIENTE A: $apellido_liquidada, $nombre_liquidada " ;
$fecha="Fecha: ".$fecha_cierre;


$pdf->ezImage("../../images/encabezado-pdf.jpg",0,200, 'none','left');


$pdf->ezText($propietario, 12);
$pdf->ezText($fecha, 12);
$pdf->ezText("__________________________________________________________________________", 12);
$pdf->ezText("\n", 12);




 //------Inicio bule para el tipo de monedas
while ($monedas=mysql_fetch_array($record_monedas)){ 
			  
			  $query_asientos="select id_caja,usuario,fecha,nro_recibo_factura,emitido_por,cuenta,
			  signo,descripcion,concepto,monto,asignar_a,usuarios.apellido as apellido_usuario,usuarios.nombre as nombre_usuario,personas.apellido as apellido_imputado,personas.nombre as nombre_imputado 		
			  from tts_caja inner join tts_cuentas on tts_caja.cuenta=tts_cuentas.id_cuenta
			  left join personas on tts_caja.asignar_a=personas.id_persona
				inner join usuarios on tts_caja.usuario=usuarios.id_usuario
				where 
				usuario='$usuario' 
				and cierre='$cierre'
				and cuenta <> '73'
				and moneda= '".$monedas["id_moneda"]."' order by signo desc, fecha";
				
				$record_asientos=mysql_query($query_asientos,$link);
				
		if(mysql_num_rows($record_asientos)>0){
			
					$data=array();	//resetea
					$ixx = 0;
					while($datatmp = mysql_fetch_assoc($record_asientos)) {
						$ixx = $ixx+1;
	 					$datatmp["fecha"]=fecha_mysql_normal($datatmp["fecha"]); 
	 	 				$datatmp["asignar_a"]=$datatmp["apellido_imputado"].", ".$datatmp["nombre_imputado"];
						if($datatmp["signo"]==1){
						$datatmp["ingreso"]=$datatmp["monto"];
						$total_ingreso=$total_ingreso+$datatmp["ingreso"];
						}else{
						$datatmp["egreso"]=$datatmp["monto"];
						$total_egreso=$total_egreso+$datatmp["egreso"];
						}
						
						$data[] = array_merge($datatmp, array('num'=>$ixx));
					}


					$titles = array(
               			'fecha'=>'<b>Fecha</b>',
						'nro_recibo_factura'=>'<b>Nro recibo/factura</b>',
              			'emitido_por'=>' <b>Persona/Empresa</b>',
						'concepto'=>' <b>Descripcion</b>',
						'asignar_a'=>' <b>Asignado a</b>',
						'ingreso'=>' <b>Ingreso</b>',
						'egreso'=>' <b>Egreso</b>',
					);


					$options = array(
                		'xOrientation'=>'center',
                		'width'=>500
					);
				// Fin armado de matrices-----------------------------------
				
				$mon=$monedas["nombre"];
				$pdf->ezText($mon, 14);
				$pdf->ezText("\n",5);
				$pdf->ezTable($data,$titles,'' , $options);
				
				/*$query_ultima_liquidacion="select cierre,moneda,saldo_inicial,total_movimientos,total_cierre,time_real from tts_cierres
				where usuario='$usuario' and moneda='".$monedas["id_moneda"]."' order by cierre desc";
		
				$record_ultima_liquidacion=mysql_query($query_ultima_liquidacion,$link);
				
				if(mysql_num_rows($record_ultima_liquidacion)>1){
					$saldo_inicial=mysql_result($record_ultima_liquidacion,0,"saldo_inicial");
					$subtotal=mysql_result($record_ultima_liquidacion,0,"total_movimientos");
					$saldo_final=mysql_result($record_ultima_liquidacion,0,"total_cierre");
				}*/
				
				$query_datos_cierre="select cierre,moneda,saldo_inicial,total_movimientos,total_cierre,time_real from tts_cierres
				where cierre='$cierre' and moneda='".$monedas["id_moneda"]."' order by cierre desc";
						
				//-----TRAIGO LOS DATOS DEL CIERRE---------
				$datos_cierre=mysql_fetch_array(mysql_query($query_datos_cierre,$link));
				$fecha_cierre=fecha_mysql_normal_completa($datos_cierre["time_real"]);
				$saldo_inicial=$datos_cierre["saldo_inicial"];
				$subtotal=$datos_cierre["total_movimientos"];
				$saldo_final=$datos_cierre["total_cierre"];
				
				$txt_saldo_inicial="Saldo inicial: ".$saldo_inicial;
				$pdf->ezText($txt_saldo_inicial, 12);
				
				
				$txt_subtotal="Sub total: ".$subtotal;
				$pdf->ezText($txt_subtotal, 12);
				
			
				$txt_saldo_final="Saldo final: ".$saldo_final;
				$pdf->ezText($txt_saldo_final, 12);
				$pdf->ezText("\n", 12);
				
				
				
		}//fin if

		
		
}//Fin bucle monedas



/*
$pdf->ezText("<b>Patagonia Real Estate</b> ", 11,array('justification'=>'center'));
$pdf->ezText("<b>Neumeyer 26 - Piso 1º - (8400) S. C Bariloche - RN</b> ", 11,array('justification'=>'center'));
$pdf->ezText("<b>Tel./ Fax.: 0294-4422277 / 4422981 / 4426741</b> ", 11,array('justification'=>'center'));
$pdf->ezText("<b>E-mail: info@patagoniarealestate.com.ar</b> ", 11,array('justification'=>'center'));
$pdf->ezText("<b>Visite: www.patagoniarealestate.com.ar</b> ", 11,array('justification'=>'center'));
*/


$pdf->ezStream();

?>