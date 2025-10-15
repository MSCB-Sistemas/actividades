<?php
include("../funciones.php");
include("../sesion.php");

require_once("class.ezpdf.php");


//Configuración de página-----------------

$pdf =& new Cezpdf('a4');

$pdf->selectFont('../fonts/courier.afm');

$pdf->ezSetCmMargins(1,1,1.5,1.5);

//Fin configuración de página-----------------

$id_liquidacion=$_POST["liquidacion"];
$persona_liquidada=$_POST["persona"];
$fhasta=$_POST["txt_fecha_hasta"];
$fdesde=$_POST["txt_fecha_desde"];






//------------------Querys------------------------------------------------------------------

$link=conectarse();

//--Traigo persona liquidada-----------

$query_persona="select apellido,nombre,oficina from 
tts_caja_azul inner join personas on tts_caja_azul.asignar_a=personas.id_persona
where  
liquidado='$id_liquidacion'";
$persona=mysql_fetch_array(mysql_query($query_persona,$link));

//-------------------------------------

$query_persona_liquidada="select id_persona,apellido,nombre from personas where id_persona='$persona_liquidada' order by apellido";
$record_persona_liquidada=mysql_query($query_persona_liquidada,$link);
$apellido_liquidada=mysql_result($record_persona_liquidada,0,"apellido");
$nombre_liquidada=mysql_result($record_persona_liquidada,0,"nombre");



$query_cuentas="select id_cuenta,codigo,descripcion,signo from tts_cuentas";
$record_cuentas=mysql_query($query_cuentas,$link);


					
$query_responsables="select id_persona,apellido,nombre from personas order by apellido";
$record_responsables=mysql_query($query_responsables,$link);

$query_monedas="select id_moneda,nombre from monedas";
$record_monedas=mysql_query($query_monedas,$link);

//--------fin Querys--------------------------------------------------------------------------------------

$propietario= "LIQUIDACION CORRESPONDIENTE A: ".$persona["apellido"].", ".$persona["nombre"];
$periodo= "PERIODO LIQUIDADO:" ;
$fechas= "FECHAS COMPRENDIDAS:\n" ;



//--Traigo logo del encabezado suegun la oficina------------------
$ofi=$persona["oficina"];

switch ($ofi) {
    case "Arelauquen":
		$imagen="../../images/logo_enc_arelauquen.jpg";
        $pdf->ezImage($imagen,0,266, 'none','left');
        break;
    case "Bariloche":
		$imagen="../../images/logo_enc.jpg";
        $pdf->ezImage($imagen,0,127, 'none','left');
        break;
    case "ts_arelauquen":
		$imagen="../../images/logo_ts_arelauquen.jpg";
        $pdf->ezImage($imagen,0,500, 'none','left');
        break;
	default:
		$imagen="../../images/logo_enc.jpg";
        $pdf->ezImage($imagen,0,127, 'none','left');
}


$pdf->ezText($propietario, 13);
$pdf->ezText($periodo, 13);
$pdf->ezText($fechas, 13);



 //------Inicio bule para el tipo de monedas
while ($monedas=mysql_fetch_array($record_monedas)){ 
			  
			  $query_asientos="select id_caja,fecha,nro_recibo_factura,emitido_por,cuenta,signo,nombre,descripcion,concepto,monto,asignar_a,apellido,nombre from 
				tts_caja inner join tts_cuentas on tts_caja.cuenta=tts_cuentas.id_cuenta
				inner join personas on tts_caja.asignar_a=personas.id_persona
				where  
				liquidado='$id_liquidacion'
				and moneda= '".$monedas["id_moneda"]."' order by codigo,descripcion,fecha";
				
				
				$record_asientos=mysql_query($query_asientos,$link);
				
		if(mysql_num_rows($record_asientos)>0){
			
					$data=array();	//resetea
					$ixx = 0;
					while($datatmp = mysql_fetch_assoc($record_asientos)) {
						$ixx = $ixx+1;
	 					$datatmp["fecha"]=fecha_mysql_normal($datatmp["fecha"]); 
	 	 				$datatmp["nombre"]=$datatmp["apellido"].", ".$datatmp["nombre"];
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
						'concepto'=>' <b>Concepto</b>',
						'ingreso'=>' <b>Ingreso</b>',
						'egreso'=>' <b>Egreso</b>',
					);


					$options = array(
                		'xOrientation'=>'center',
                		'width'=>500
					);
				// Fin armado de matrices-----------------------------------
				
				$mon=$monedas["descripcion"];
				$pdf->ezText($mon, 14);
				$pdf->ezText("\n", 10);
				
				
				
				
				$query_ultima_liquidacion="select liquidacion,moneda,saldo_inicial,total_movimientos,total_liquidacion,fecha_hasta from tts_liquidaciones
				where liquidacion='$id_liquidacion' and moneda='".$monedas["id_moneda"]."' order by liquidacion desc";
				
				/*$query_ultima_liquidacion="select liquidacion,moneda,total,fecha_hasta from tts_liquidaciones where persona='$id_persona_liquidada' and moneda='".$monedas["id_moneda"]."'and liquidacion < '".$id_liquidacion."' order by liquidacion desc";*/
				
				$record_ultima_liquidacion=mysql_query($query_ultima_liquidacion,$link);
				if(mysql_num_rows($record_ultima_liquidacion)>0){
					$saldo_inicial=mysql_result($record_ultima_liquidacion,0,"saldo_inicial");
					$total_movimientos=mysql_result($record_ultima_liquidacion,0,"total_movimientos");
					$total_liquidacion=mysql_result($record_ultima_liquidacion,0,"total_liquidacion");
					
					$fecha_desde=mysql_result($record_ultima_liquidacion,0,"fecha_hasta");
				}
				
				$txt_saldo_inicial="Saldo anterior: ".number_format($saldo_inicial,2,'.','');
				$pdf->ezText($txt_saldo_inicial, 12);
				
				/*$subtotal=$total_ingreso-$total_egreso;
				$txt_subtotal="Sub total: ".$subtotal;
				$pdf->ezText($txt_subtotal, 12);*/
				
				$saldo_final=$saldo_inicial+$subtotal;
				$txt_saldo_final="Saldo final: ".number_format($total_liquidacion,2,'.','');
				$pdf->ezText($txt_saldo_final, 12);
				$pdf->ezText("\n", 10);
				
				$pdf->ezTable($data,$titles,'' , $options);
				
		}//fin if

		
		
}//Fin bucle monedas



$pdf->ezText("\n\n\n", 10);

$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Adjunto comprobantes.</b> ", 12);
$pdf->ezText("<b>De no ser impugnada esta liquidación por UD. En un plazo de 30 días a contar de la fecha de la liquidación quedara automáticamente aprobada.</b> ", 12);

$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>TOMAS SMART BIENES RAICES</b> ", 11,array('justification'=>'center'));
$pdf->ezText("<b>12 de Octubre 155 - (8400) S. C Bariloche - RN</b> ", 11,array('justification'=>'center'));
$pdf->ezText("<b>Tel./ Fax.: (02944) - 425560</b> ", 11,array('justification'=>'center'));
$pdf->ezText("<b>E-mail: bariloche@tomassmart.com</b> ", 11,array('justification'=>'center'));
$pdf->ezText("<b>Visite: www.tomassmart.com</b> ", 11,array('justification'=>'center'));



$pdf->ezStream();

?>