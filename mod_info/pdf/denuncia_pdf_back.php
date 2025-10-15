<?php
require_once 'pdf/autoload.inc.php';
use Dompdf\Dompdf;


//TRAIGO DATOS DE LA DNUNCIA------------------------------------
include("../../lib/funciones.php");
$link=conectarse();


$id_denuncia=$_GET["denuncia"];

$query="select 
id,denunciante_apellido,denunciante_dni,denunciante_genero,denunciante_domicilio,denunciante_barrio,denunciante_cp,denunciante_localidad,denunciante_tel,denunciante_correo,
	representante_damnificado,representante_apellido,representante_dni,representante_matricula,representante_abogado,representante_patrocinante,representante_apoderado,representante_folio,representante_domicilio,representante_te,representante_correo,

denunciado1_nombre,denunciado1_cuit,denunciado1_rubro,denunciado1_domicilio,denunciado1_numero,denunciado1_piso,denunciado1_cp,denunciado1_localidad,denunciado1_tel,denunciado1_correo,

denunciado2_nombre,denunciado2_cuit,denunciado2_rubro,denunciado2_domicilio,denunciado2_numero,denunciado2_piso,denunciado2_cp,denunciado2_localidad,denunciado2_tel,denunciado2_correo,

denuncia_motivo,denuncia_texto
from formulario where id='$id_denuncia'";

$denuncia=mysqli_fetch_array(mysqli_query($link,$query));

//------------------------------------

//if (isset($_POST['btnPDF'])) {

	$nro  = $_POST['nro'];
	$apenom  = $_POST['apenom'];
	$dni  = $_POST['dni'];
	$hora  = $_POST['hora'];
	$area  = $_POST['area'];
	$area_direccion  = $_POST['area_direccion'];
  //$fecha_normal = fecha_mysql_normal($_POST['fecha']);

if($denuncia["representante_apellido"]==""){

	$bloque_representante="";
}
else
{
	$bloque_representante='<h3  class="block4">Datos del Representante</h3>
		
		<p class="block4">Apellido/s y Nombre/s:'.$denuncia["representante_apellido"].'</p>
		<p class="block5">D.N.I.'.$denuncia["representante_dni"].'</p>
		<p class="block5">Matricula: '.$denuncia["representante_matricula"].'</p>
		<p class="block5">Abogado: '.$denuncia["representante_abogado"].'</p>
		<p class="block5">Patrocinante: '.$denuncia["representante_patrocinante"].'</p>
		<p class="block5">Apoderado: '.$denuncia["representante_apoderado"].'</p>
		<p class="block5">Folio: '.$denuncia["representante_folio"].'</p>
		<p class="block5">Domicilio: '.$denuncia["representante_domicilio"].'</p>
		<p class="block5">Te: '.$denuncia["representante_te"].'</p>
		<p class="block5">Correo: '.$denuncia["representante_correo"].'</p>';
}

if($denuncia["denunciado2_nombre"]==""){

	$bloque_denunciado2="";
}
else
{
	$bloque_denunciado2='<h3  class="block4">Datos del Denunciado 2</h3>
		
		<p class="block4">Apellido/s y Nombre/s: '.$denuncia["denunciado2_nombre"].'</p>
		<p class="block4">CUIT: '.$denuncia["denunciado2_cuit"].'</p>
		<p class="block4">Rubro: '.$denuncia["denunciado2_rubro"].'</p>
		<p class="block4">Domicilio: '.$denuncia["denunciado2_domicilio"].'</p>
		<p class="block4">Numero: '.$denuncia["denunciado2_numero"].'</p>
		<p class="block4">Piso: '.$denuncia["denunciado2_piso"].'</p>
		<p class="block4">C.P: '.$denuncia["denunciado2_cp"].'</p>
		<p class="block4">Localidad: '.$denuncia["denunciado2_localidad"].'</p>
		<p class="block4">Telefono: '.$denuncia["denunciado2_tel"].'</p>
		<p class="block4">Correo: '.$denuncia["denunciado2_correo"].'</p>';
}


$content = '

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <title>Turno MSCB</title>
  </head>
  <body>
  	<div class="container">
    	
		
		<p class="block4"><font size="23">Expediente:'.$denuncia["id"].'</font></p>
		
		<h3 class="block4">Datos del Denunciante</h3>
		
  		<p class="block4">Apellido/s y Nombre/s:'.$denuncia["denunciante_apellido"].'</p>

  		<p class="block5">D.N.I.'.$denuncia["denunciante_dni"].'</p>
		
		<p class="block13">Genero: '.$denuncia['denunciante_genero'].'</p>
		
		<p class="block13">Domicilio: '.$denuncia['denunciante_domicilio'].'</p>
		
		<p class="block13">Barrio: '.$denuncia['denunciante_barrio'].'</p>
		
		<p class="block13">C.P: '.$denuncia['denunciante_cp'].'</p>
		
		<p class="block13">Localidad: '.$denuncia['denunciante_localidad'].'</p>
		
		<p class="block13">Tel: '.$denuncia['denunciante_tel'].'</p>
		
		<p class="block13">Correo: '.$denuncia['denunciante_correo'].'</p>
		
		<p class="block13">C.P: '.$denuncia['representante_damnificado'].'</p>
		
		
		'.$bloque_representante.'
		
		
		<h3  class="block4">Datos del Denunciado 1</h3>
		
		<p class="block4">Apellido/s y Nombre/s: '.$denuncia["denunciado1_nombre"].'</p>
		<p class="block4">CUIT: '.$denuncia["denunciado1_cuit"].'</p>
		<p class="block4">Rubro: '.$denuncia["denunciado1_rubro"].'</p>
		<p class="block4">Domicilio: '.$denuncia["denunciado1_domicilio"].'</p>
		<p class="block4">Numero: '.$denuncia["denunciado1_numero"].'</p>
		<p class="block4">Piso: '.$denuncia["denunciado1_piso"].'</p>
		<p class="block4">C.P: '.$denuncia["denunciado1_cp"].'</p>
		<p class="block4">Localidad: '.$denuncia["denunciado1_localidad"].'</p>
		<p class="block4">Telefono: '.$denuncia["denunciado1_tel"].'</p>
		<p class="block4">Correo: '.$denuncia["denunciado1_correo"].'</p>
		
		'.$bloque_denunciado2.'
		
		<h3  class="block4">Datos de la denuncia</h3>
		
		<p class="block4">Motivo: '.$denuncia["denuncia_motivo"].'</p>
		<p class="block4">Texto: '.$denuncia["denuncia_texto"].'</p>
		
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../jscripts/jquery-3.3.1.slim.min.js"></script>

</html>

';

//echo $content; exit;


$dompdf = new Dompdf();
$dompdf->loadHtml($content);
$dompdf->setPaper('A4', 'vertical'); // (Opcional) Configurar papel y orientación
$dompdf->render(); // Generar el PDF desde contenido HTML
$pdf = $dompdf->output(); // Obtener el PDF generado
$dompdf->stream(); // Enviar el PDF generado al navegador

//}

?>
