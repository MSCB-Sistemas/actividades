<?php
include("lib/funciones.php");
include("inc/conexion.php");

$link=Conexion();

function is_valid_email($str)
{
	return (false !== strpos($str, "@") && false !== strpos($str, "."));
}

function valida_file($file)
{
	$maxSize = 2000000;
	$formatos_permitidos = ["jpg", "pdf"];

	if ($file["size"] > $maxSize) {
		echo "El archivo es demasiado grande.";
		$size_ok = 0;
	}

	$fileName = $file["name"];
	$tipoArchivo = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
	if (!in_array($tipoArchivo, $formatos_permitidos)) {
		echo "Solo se permiten archivos JPG, PNG, GIF o PDF.";
		$formato_ok = 0;
	}

	if ($size_ok == 0 or $formato_ok == 0) {
		return false;
	} else {
		return true;
	}
}

$fecha = date("d-m-Y");
$horario_comprobante = date("H:i:s");

$fecha_comprobante = $_POST['txt_fecha'];
$actividad = $_POST['txt_actividad'];
$dni = $_POST['txt_documento'];
$apellido = $_POST['txt_apellido'];
$nombre = $_POST['txt_nombre'];
$sexo = $_POST['txt_sexo'];
$fecha_nacimiento = $_POST['txt_fecha'];
$telefono = $_POST['txt_telefono'];
$email = $_POST['txt_email'];
$apellido_responsable = $_POST['txt_apellido_responsable'];
$nombre_responsable = $_POST['txt_nombre_responsable'];
$cuil_responsable = $_POST['txt_cuil'];

// Armado del mail para enviar el comprobante de inscripción
$html = 
'<html>'.
	'<head>
		<title>Comprobante</title>
	</head>'.
	'<body><h3 style="color: #010101;">Comprobante de inscripción en actividades deportivas aranceladas</h3>'.
		'<li style="color: #010101;">Apellido : <strong>'.$apellido.'</strong></li><br>'.
		'<li style="color: #010101;">Nombre : <strong>'.$nombre.'</strong></li><br>'.
		'<li style="color: #010101;">DNI : <strong>'.$dni.'</strong></li><br>'.
		'<li style="color: #010101;">Fecha : <strong>'.$fecha.'</strong></li><br>'.
		'<li style="color: #010101;">Hora : <strong>'.$horario_comprobante.'</strong></li><br>'.
		'<hr>'.
	'</body>'.
'</html>';

$header = "From: no-responder@bariloche.gov.ar\r\n"; 
$header.= "MIME-Version: 1.0\r\n"; 
$header.= "Content-Type: text/html; charset=UTF-8\r\n"; 
$header.= "X-Priority: 1\r\n";

$error=0;
//VERIFICO SI YA ESTA INSCRIPTO EN ESA ACTIVIDAD considero si esta cerrado o no para no considerar si ya estaba en la actividan en alguna inscripcion cerrada
$query_asignado="SELECT 
					dni,
					fecha_sistema 
				FROM inscripciones 
				WHERE dni = '$dni' AND actividad = '$actividad' AND cerrado = 0
				";
$record_asignado=mysqli_query($link,$query_asignado);
$turno_asignado=mysqli_fetch_array($record_asignado);
$tiene_turno=mysqli_num_rows($record_asignado);
if ($tiene_turno >= 1) {
	$error = 1;
}

switch ($error) {
    
	case 0:
		$fecha_sistema=date('Y-m-d H:i:s');

        $query_alta="INSERT INTO inscripciones (
						dni,
						apellido,
						nombre,
						sexo,
						fecha_nacimiento,
						telefono,
						email,
						actividad,
						apellido_responsable,
						nombre_responsable,
						cuil_responsable,
						fecha_sistema
					) VALUES (
						'$dni',
						UPPER('$apellido'),
						UPPER('$nombre'),
						'$sexo',
						'$fecha_nacimiento',
						'$telefono',
						'$email',
						'$actividad',
						UPPER('$apellido_responsable'),
						UPPER('$nombre_responsable'),
						'$cuil_responsable',
						'$fecha_sistema'
					)";
			
		if(mysqli_query($link,$query_alta)){

			$ultimo_id = mysqli_insert_id($link);
			
			//Proceso subida de archivos
			$directorioDestino = 'archivos/';

			//Subo DNI frente
			$nombreArchivo = $_FILES['img_documento_frente']['name'];
			
			$tmp = explode(".", $nombreArchivo);
			$extension = end($tmp);
			
			$nombreArchivo = $dni."_frente.".$extension;
    		$rutaArchivo = $directorioDestino.$nombreArchivo;

			if (move_uploaded_file($_FILES['img_documento_frente']['tmp_name'], $rutaArchivo)) {

				$query = "INSERT INTO archivos (
							inscripcion,
							archivo
						) VALUES (
							'$ultimo_id',
							'$nombreArchivo'
						)";

				mysqli_query($link, $query);
				$f1 = 1;
			} else {
				$f1 = 0;
			}

			//Subo DNI dorso
			$nombreArchivo = $_FILES['img_documento_dorso']['name'];

			$tmp = explode(".", $nombreArchivo);
			$extension = end($tmp);
			
    		$nombreArchivo = $dni."_dorso.".$extension;
    		$rutaArchivo = $directorioDestino . $nombreArchivo;
			
			if(move_uploaded_file($_FILES['img_documento_dorso']['tmp_name'], $rutaArchivo)){
				$query="insert into archivos (inscripcion,archivo) values ('$ultimo_id','$nombreArchivo')";
				mysqli_query($link,$query);
				$f2=1;
			}
			else
			{
				$f2=0;
			}

			//Subo DNI frente responsable
			$nombreArchivo = $_FILES['img_documento_frente_responsable']['name'];
			
			$tmp = explode(".", $nombreArchivo);
			$extension = end($tmp);
			
			$nombreArchivo = $dni."_frente_responsable.".$extension;
    		$rutaArchivo = $directorioDestino.$nombreArchivo;

			if(move_uploaded_file($_FILES['img_documento_frente_responsable']['tmp_name'], $rutaArchivo)){
				$query="insert into archivos (inscripcion,archivo) values ('$ultimo_id','$nombreArchivo')";
				mysqli_query($link,$query);
				$f4=1;
			}
			else
			{
				$f4=0;
			}

			//Subo DNI dorso responsable
			$nombreArchivo = $_FILES['img_documento_dorso_responsable']['name'];
			
			$tmp = explode(".", $nombreArchivo);
			$extension = end($tmp);
			
    		$nombreArchivo = $dni."_dorso_responsable.".$extension;
    		$rutaArchivo = $directorioDestino . $nombreArchivo;
			
			if(move_uploaded_file($_FILES['img_documento_dorso_responsable']['tmp_name'], $rutaArchivo)){
				$query="insert into archivos (inscripcion,archivo) values ('$ultimo_id','$nombreArchivo')";
				mysqli_query($link,$query);
				$f5=1;
			}
			else
			{
				$f5=0;
			}

			if($f1==1 and $f2==1 /*and $f3==1*/ and $f4==1 and $f5==1){
				//Fin proceso subida de archivos
				
				$mensaje="La preinscripción ha sido realizada correctamente.";
				$destino="index.php";
				
				//Enviar mail con comprobante
				if (!empty($email)) {
					if (is_valid_email($email)) {
						mail($email, 'Comprobante de inscripción en actividades deportivas aranceladas',$html,$header);
					}
				}
				
				include("lib/mensaje_sistema.php");
			}
			else
			{
				$query="delete from inscripciones where id='$ultimo_id'";
				mysqli_query($link,$query);

				$mensaje="La preinscripción NO ha sido realizada correctamente.";
				$destino="index.php";

				include("lib/mensaje_sistema.php");
			}
		}
		else
		{
			$mensaje="Error al asignar el turno.".mysql_errno($link) . ": " . mysql_error($link);
			$destino="http://www.bariloche.gov.ar/servicios.php?sector=224";
			include("lib/mensaje_sistema.php");
		}
        break;
	
	case 1:
        $mensaje="Usted ya se inscribio en esta actividad el día ".$dia_asignado;
		$destino="index.php";
		include("lib/mensaje_sistema.php");
        break;
    
	case 2:

		while ($actividades_asignadas = mysqli_fetch_array($record_actividades)) {
			$actividad_asignada = $actividad_asignada . " " . $actividades_asignadas["descripcion"] . " " . $actividades_asignadas["horario_actividad"];
		}

		$mensaje="Usted esta inscripto en 2 actividades ".$actividad_asignada;
		$destino="index.php";
		include("lib/mensaje_sistema.php");
        break;
}

?>

