<?php 
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="../index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
//--------------------------------Fin inicio de sesion------------------------

include_once("../lib/funciones.php");


$link=conectarse();

$clave = password_hash(utf8_decode($_GET['txt_clave']), PASSWORD_DEFAULT);
$usuario=$_SESSION['id'];




$query_actualiza_clave = "UPDATE usuarios SET pas = '$clave' WHERE id_empleado = '$usuario'";

 
if(mysql_query($query_actualiza_clave,$link)){
	$mensaje="La clave ha sido actualizada correctamente";
	$destino="../mod_principal/menu_principal.php";
	header("location:../lib/mensaje.php?mensaje=$mensaje&destino=$destino");
	}
	else
	{
	$mensaje="No se realizo el cambio de clave";
	$destino="../mod_principal/menu_principal.php";
	header("location:../lib/mensaje.php?mensaje=$mensaje&destino=$destino");
	}

?>

