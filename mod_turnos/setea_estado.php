<?php 
include("../lib/sesion.php"); 
include("../lib/funciones.php");

$link=conectarse();



$turno=$_POST['hd_turno'];
$estado=$_POST['hd_estado'];
$quien=$_POST['hd_quien'];

$usuario=$_SESSION['id'];



$query="update turnos set estado='$estado' where id_turno='$turno'";
					
mysql_query($query,$link);

$ip=$_SERVER['REMOTE_ADDR'];

auditar($usuario,$query,$ip,$link);
		
if($quien==1){

	header("Location:listado_turnos.php");

}
else
{
	header("Location:listado_turnos.php");
}
?>





