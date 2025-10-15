<?php
include("../lib/funciones.php");

$link=conectarse();


$habilitado=$_POST['txt_habilitado'];
$fecha_limite=$_POST['txt_fecha_limite'];


$query="update calendario set fecha_limite='$fecha_limite',habilitado='$habilitado' where id='1'";
			
			
if(mysql_query($query,$link)){
		
	//auditar($usuario,$query_alta,$_SERVER['REMOTE_ADDR'],$link);
			
	$mensaje="Los datos han sido guardados correctamente.";
	$destino="administrar_calendario.php";
			
		
	include("../lib/mensaje_sistema.php");
	
}

?>

