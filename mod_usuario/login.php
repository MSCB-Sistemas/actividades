<?php
include("../lib/funciones.php");
include("../inc/conexion.php");
$nombre=$_POST["usuario"];
$pass=$_POST["clave"];

echo $nombre."--".$pass;

$link=Conexion();
	
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
	echo "No ingresa";			
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