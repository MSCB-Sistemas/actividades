<?php
//--------------------------------Inicio de sesion------------------------
include("../sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado'){
	$mensaje="Usuario sin permisos";
	$destino="../index.php";
	header("location:../lib/mensaje.php?mensaje=$mensaje&destino=$destino");
}
//--------------------------------Fin inicio de sesion------------------------

include("../funciones.php");
require_once("class.ezpdf.php");


//Configuración de página-----------------

$pdf =& new Cezpdf('a4');

$pdf->selectFont('fonts/courier.afm');

$pdf->ezSetCmMargins(1,1,1.5,1.5);

//Fin configuración de página-----------------


//---------------Querys-----------------------------



$link=conectarse();


$usuario=$_SESSION['id'];

			
//-----------------Listado de controles del vehiculo-----------------------------------------------------------------------
	$query_controles="select id_control,matricula,area_ingreso,fecha_ingreso,hora_ingreso,kilometraje,observaciones from controles
	where matricula='$matricula'";
	
	$record_controles=mysql_query($query_controles,$link);
//--------------------------------------------------------------------------------------------------------------------------

//--------------Fin querys----------------------------



//Armado de las matrices-------------------------------------
$ixx = 0;
while($datatmp = mysql_fetch_assoc($record_controles)) {
	$ixx = $ixx+1;
	$datatmp["fecha_ingreso"]=fecha_mysql_normal($datatmp["fecha_ingreso"]);
    $data[] = array_merge($datatmp, array('num'=>$ixx));

}


$titles = array(

                //'num'=>'<b>Num</b>',

               	'fecha_ingreso'=>'<b>Fecha ingreso</b>',
              	'hora_ingreso'=>' <b>Hora</b>',
				'kilometraje'=>' <b>kilometros</b>',
				'observaciones'=>' <b>Observaciones</b>',

            );


$options = array(

              	
'fontSize' => 7,
'rowGap' => 1,
                'xOrientation'=>'center',

                'width'=>600,
				
				'cols'=>array( 
'fecha_ingreso' => array('justification'=>'left', 'width' => '30'), 
'hora_ingreso' => array('justification'=>'left', 'width' => '66'), 
'kilometraje' => array('justification'=>'left', 'width' => '60'), 
'observaciones' => array('justification'=>'left', 'width' => '50'))

            );


// Fin armado de matrices-----------------------------------

$txttit= "Controles del vehículo. \n";


 


$pdf->ezText($txttit, 12);


$pdf->ezTable($data,$titles ,'' , $options);

$pdf->ezText("\n\n\n", 10);

$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);

$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();

?>