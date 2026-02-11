<?php  
session_start();  
if ($_SESSION['permiso']!="autorizado" ) { 
 	header("location:../mod_usuario");
}
?>