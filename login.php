<?php
include("../lib/funciones.php");
$nombre=utf8_decode($_POST["txtUser"]);
$pass=md5($_POST["txtPass"]);
	
	
	
$link=conectarse();
	
$query="select id_empleado,nombre,apellido,descripcion from usuarios p,grupos_usuarios gu 
where
p.grupo=gu.id 
and us='$nombre' and pas='$pass'";
			
	
$result=mysql_query($query, $link); 
$filas=mysql_num_rows($result); 


if ($filas==0){
	$mensaje="Usuario o contraseña no valido <br> ";
	$destino="index.php";
	include("../lib/mensaje_sistema.php");
							
}
else
{
	$id=mysql_result($result,0,"id_empleado");
	$nombre=mysql_result($result,0,"nombre");
	$apellido=mysql_result($result,0,"apellido");
	$tipo_usuario=mysql_result($result,0,"descripcion");
				
				
	// Inicializamos sesion  
	session_start();  
	// Guardamos una variable  
				
	$_SESSION['id'] =$id;
	$_SESSION['permiso'] = 'autorizado'; 
	$_SESSION['ses_nombre'] =$nombre; 
	$_SESSION['ses_apellido'] =$apellido;   
	$_SESSION['tipo_usuario'] =$tipo_usuario;
				
	header("Location:../mod_principal/menu_principal.php");
}
		
		
?>