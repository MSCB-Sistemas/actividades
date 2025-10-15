<?php
include("../lib/funciones.php");

$link=conectarse();

$motivo=$_POST['txt_motivo'];
$fecha=fecha_normal_mysql($_POST['txt_fecha']);
$fecha_comprobante=$_POST['txt_fecha'];

$horario=$_POST['combo_horario'];

//TRAIGO HORARIO PARA MOSTRAR EN EL COMPROBANTE
$query="select horario from horarios where id_horario='$horario'";
$record=mysql_query($query,$link);
$horario_comprobante=mysql_result($record,0,"horario");
//-----------------------------------------------------------------

$dni=$_POST['txt_documento'];
$apellido=$_POST['txt_apellido'];
$nombre=$_POST['txt_nombre'];
$telefono=$_POST['txt_telefono'];
$email=$_POST['txt_email'];


//VERIFICO SI YA TIENE UN TURNO ASIGNADO
$query_asignado="select fecha,dni,b.horario as hora from turnos a,horarios b where a.horario=b.id_horario and dni='$dni' and fecha >=now() and estado='0'";
$record_asignado=mysql_query($query_asignado);
$turno_asignado=mysql_fetch_array($record_asignado);
$dia_asignado=fecha_mysql_normal($turno_asignado["fecha"]);
$horario_asignado=$turno_asignado["hora"];
$tiene_turno=mysql_num_rows($record_asignado);

//--------------------------------------

if($tiene_turno >=1){
	$mensaje="Usted ya tiene un turno asignado para el día ".$dia_asignado." a las ".$horario_asignado." Hs.";
	$destino="frm_turno.php";
	include("../lib/mensaje_sistema.php");
}
else
{
	$query_alta="insert into turnos 
	(fecha,horario,dni,apellido,nombre,telefono,email,motivo) 
	values 
	('$fecha','$horario','$dni','$apellido','$nombre','$telefono','$email','$motivo')";
			
			
		if(mysql_query($query_alta,$link)){
		
			auditar($usuario,$query_alta,$_SERVER['REMOTE_ADDR'],$link);
			
			$mensaje="El turno ha sido asignado correctamente.";
			$destino="frm_turno.php";
			include("../lib/turno_ok.php");
		}
		else
		{
			$mensaje="Error al asignar el turno.".mysql_errno($link) . ": " . mysql_error($link);
			$destino="frm_turno.php";
			include("../lib/mensaje_sistema.php");
		}
}

?>





