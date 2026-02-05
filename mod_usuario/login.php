<?php
include_once("../lib/funciones.php");
include("../inc/conexion.php");

session_start();
include_once("../lib/funciones.php");
include("../inc/conexion.php");

$nombre = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : '';
$pass = isset($_POST["clave"]) ? $_POST["clave"] : '';


if ($nombre === '' || $pass === '') {
	header("Location: index.php?error=1");
	exit;
}

$link = Conexion();
$stmt = $link->prepare("SELECT id, us, pas FROM usuarios WHERE us = ? LIMIT 1");
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
	if (password_verify($pass, $row['pas'])) {
		$_SESSION['permiso'] = 'autorizado';
		$_SESSION['id'] = $row['id_empleado'];
		header("Location:../mod_info/bandeja_entrada.php");
		exit;

	} else {
		header("Location: index.php?error=1");
		exit;
	}
} else {
	header("Location: index.php?error=1");
	exit;
}

/*
if($filas>=1){
	header("Location:../mod_info/bandeja_entrada.php");							
}
else
{
	$mensaje="Usuario o contrase�a no valido <br> ";
	$destino="index.php";
	//include("../lib/mensaje_sistema.php");
	echo "No ingreso ".$filas;
	echo $nombre."--".$query."--".$filas;
}*/
	
?>