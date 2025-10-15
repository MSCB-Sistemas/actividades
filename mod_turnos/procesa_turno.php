<?php
include("../lib/funciones.php");

$link=conectarse();

function is_valid_email($str){
 	return (false !== strpos($str, "@") && false !== strpos($str, "."));
}



$fecha_comprobante=$_POST['txt_fecha'];

$especie=$_POST['txt_especie'];
$sexo=$_POST['txt_sexo'];
$raza=$_POST['txt_raza'];
$nombre_raza=$_POST['txt_nombre_raza'];
$edad=$_POST['txt_edad'];
$celo=$_POST['txt_celo'];
$cria=$_POST['txt_cria'];
$fecha=fecha_normal_mysql($_POST['txt_fecha']);
$horario=$_POST['combo_horario'];

$documento=$_POST['txt_documento'];
$apellido=$_POST['txt_apellido'];
$nombre=$_POST['txt_nombre'];
$telefono=$_POST['txt_telefono'];
$email=$_POST['txt_email'];

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


//ARMO MAIL PARA ENVIAR

$html = '<html>'.
	'<head><title>Comprobante de solicitud de turno</title></head>'.
	'<body><h3 style="color: #010101;">Comprobante de Turno Licencia de conducir</h3>'.
	'<li style="color: #010101;">Apellido : <strong>'.$apellido.'</strong></li><br>'.
	'<li style="color: #010101;">Nombre : <strong>'.$nombre.'</strong></li><br>'.
	'<li style="color: #010101;">DNI : <strong>'.$dni.'</strong></li><br>'.
	'<li style="color: #010101;">Fecha : <strong>'.fecha_normal_mysql($fecha).'</strong></li><br>'.
	'<li style="color: #010101;">Hora : <strong>'.$horario_comprobante.'</strong></li><br>'.
	'<hr>'.
	'</body>'.
	'</html>';

$header = "From: no-responder@bariloche.gov.ar\r\n"; 
$header.= "MIME-Version: 1.0\r\n"; 
$header.= "Content-Type: text/html; charset=UTF-8\r\n"; 
$header.= "X-Priority: 1\r\n";

//VERIFICO SI YA TIENE UN TURNO ASIGNADO
$query_asignado="select fecha,dni,b.horario as hora from turnos a,horarios b where a.horario=b.id_horario and dni='$dni' and fecha >=now() and estado='0'";
$record_asignado=mysql_query($query_asignado);
$turno_asignado=mysql_fetch_array($record_asignado);
$dia_asignado=fecha_mysql_normal($turno_asignado["fecha"]);
$horario_asignado=$turno_asignado["hora"];
$tiene_turno=mysql_num_rows($record_asignado);

//--------------------------------------

if($tiene_turno >=1){
	$mensaje="Usted ya tiene un turno asignado para el d&iacute;a ".$dia_asignado." a las ".$horario_asignado." Hs.";
	$destino="frm_turno.php";
	include("../lib/mensaje_sistema.php");
}
else
{
	$query_alta="insert into turnos 
	(especie,sexo,raza,nombre_raza,edad,celo,cria,fecha,horario,dni,apellido,nombre,telefono,email) 
	values 
	('$especie','$sexo','$raza','$nombre_raza','$edad','$celo','$cria','$fecha','$horario','$dni','$apellido','$nombre','$telefono','$email')";
			
			
		if(mysql_query($query_alta,$link)){
		
			auditar($usuario,$query_alta,$_SERVER['REMOTE_ADDR'],$link);
			
			$mensaje="El turno ha sido asignado correctamente.";
			$destino="frm_turno.php";
			//Enviar mail con comprobante
			if (!empty($email)) {
				if (is_valid_email($email)) {
					mail($email, 'Comprobante de solicitud de Turno para licencia de conducir MSCB',$html,$header);
				}
			}
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

