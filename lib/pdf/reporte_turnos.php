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
$fecha=$_POST["hd_fecha"];

			
//-----------------Listado de controles del vehiculo-----------------------------------------------------------------------
	$query_controles="select id_turno,fecha,b.horario as hora_turno,dni,apellido,nombre,telefono,email,a.especie as turno_especie,sexo,raza,nombre_raza,edad,celo,cria,estado from turnos a, horarios b
		where a.horario=b.id_horario and fecha='$fecha'
		order by b.horario";
	
	$record_controles=mysql_query($query_controles,$link);
//--------------------------------------------------------------------------------------------------------------------------

//--------------Fin querys----------------------------



//Armado de las matrices-------------------------------------
$ixx = 0;
while($datatmp = mysql_fetch_assoc($record_controles)) {
	$ixx = $ixx+1;
	//$datatmp["fecha"]=fecha_mysql_normal($datatmp["fecha"]);
    $data[] = array_merge($datatmp, array('num'=>$ixx));

}


$titles = array(

                //'num'=>'<b>Num</b>',

              	'hora_turno'=>' <b>Hora</b>',
				'dni'=>' <b>DNI</b>',
				'apellido'=>' <b>Apellido</b>',
				'nombre'=>' <b>Nombre</b>',
				'telefono'=>' <b>Telefono</b>',
				'email'=>' <b>EMail</b>',
				'turno_especie'=>' <b>Especie</b>',
				'sexo'=>' <b>Sexo</b>',
				'raza'=>' <b>Raza</b>',
				'nombre_raza'=>' <b>Nombre raza</b>',
				'edad'=>' <b>Edad</b>',
				'celo'=>' <b>Celo</b>',
				'cria'=>' <b>Cria</b>',

            );


$options = array(

              	
'fontSize' => 7,
'rowGap' => 1,
                'xOrientation'=>'center',

                'width'=>600,
				
				'cols'=>array( 
'hora_turno' => array('justification'=>'left', 'width' => '30'),
'dni' => array('justification'=>'left', 'width' => '45'),
'email' => array('justification'=>'left', 'width' => '100'),
'especie' => array('justification'=>'left', 'width' => '25'),
'sexo' => array('justification'=>'left', 'width' => '35'),
'raza' => array('justification'=>'left', 'width' => '30'),
'edad' => array('justification'=>'left', 'width' => '30'),
'celo' => array('justification'=>'left', 'width' => '30'),
'cria' => array('justification'=>'left', 'width' => '30'))

            );


// Fin armado de matrices-----------------------------------

$txttit= "Turnos para el día ".fecha_mysql_normal($fecha)."\n";


 


$pdf->ezText($txttit, 12);


$pdf->ezTable($data,$titles ,'' , $options);

$pdf->ezText("\n\n\n", 10);

$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);

$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();

?>