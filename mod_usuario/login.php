<?php
include("../lib/funciones.php");
include("login-check.php");
$nombre=$_POST["usuario"];
$pass=$_POST["clave"];

	// echo $nombre."--".$pass;

$link=conectarse_deportes();
// $linkCheck = loginCheck();
	
$query="select us,pas from usuarios
where
us='$nombre' and pas='$pass'";			

$result=mysqli_query($link,$query); 
$filas=mysqli_num_rows($result); 

echo $filas;

if($filas>=1){
	session_start();  
	$_SESSION['permiso'] = 'autorizado';
	header("Location:../mod_info/bandeja_entrada.php");					
}
else
{
	// var_dump($link);
	$res = loginCheck($nombre, $pass, null);
	if ( $res === false ) {
		// No hay bloqueo, puede intentar login
		echo "Intento de login fallido";
		header("Location:index.php?error=1");
	} else {
		// Está bloqueado, $res tiene segundos restantes
		echo "Usuario bloqueado. Intente en $res segundos.";
		header("Location:index.php?res=$res");
	}

	
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