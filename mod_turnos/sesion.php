<?php  
// Inicializamos sesion  
session_start();  
// Comprovamos si existe la variable 
if ($_SESSION['permiso']!="autorizado" ) { 
	$mensaje="Error al asignar el turno.".mysql_errno($link) . ": " . mysql_error($link);
	$destino="../mod_usuario/index.php";
	include("../lib/mensaje_sistema.php");
}

?>