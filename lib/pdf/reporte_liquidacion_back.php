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
//$azul=$_POST["azul"];






//------------------Querys------------------------------------------------------------------

$link=conectarse();

//--TRAIGO DATOS DE LA LIQIDACION--------

$query_liquidacion="select liquidacion,moneda,saldo_inicial,total_movimientos,total_liquidacion,azul from tts_liquidaciones 
where liquidacion='$id_liquidacion'";
$liqidacion=mysql_fetch_array(mysql_query($query_liquidacion,$link));
$azul=$liqidacion["azul"];


//---------------------------------------

//--Traigo persona liquidada-----------

$query_persona="select apellido,nombre,oficina from 
tts_caja inner join personas on tts_caja.asignar_a=personas.id_persona
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

if ($azul==0){
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
		}
}