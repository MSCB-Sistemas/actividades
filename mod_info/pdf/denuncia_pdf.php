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

denuncia_motivo,denuncia_texto,denuncia_pretension,fecha_sistema
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
		
		<p class="block4">
		Apellido/s y Nombre/s:'.$denuncia["representante_apellido"].
		' D.N.I.'.$denuncia["representante_dni"].
		' Matricula: '.$denuncia["representante_matricula"].
		' Abogado: '.$denuncia["representante_abogado"].
		' Patrocinante: '.$denuncia["representante_patrocinante"].
		' Apoderado: '.$denuncia["representante_apoderado"].
		' Folio: '.$denuncia["representante_folio"].
		' Domicilio: '.$denuncia["representante_domicilio"].
		' Te: '.$denuncia["representante_te"].
		' Correo: '.$denuncia["representante_correo"].'</p>';
}

if($denuncia["denunciado2_nombre"]==""){

	$bloque_denunciado2="";
}
else
{
	$bloque_denunciado2='<h3  class="block4">Datos del Denunciado 2</h3>
		
		<p class="block4">
		Apellido/s y Nombre/s: '.$denuncia["denunciado2_nombre"].
		' CUIT: '.$denuncia["denunciado2_cuit"].
		' Rubro: '.$denuncia["denunciado2_rubro"].
		' Domicilio: '.$denuncia["denunciado2_domicilio"].
		' Numero: '.$denuncia["denunciado2_numero"].
		' Piso: '.$denuncia["denunciado2_piso"].
		' C.P: '.$denuncia["denunciado2_cp"].
		' Localidad: '.$denuncia["denunciado2_localidad"].
		' Telefono: '.$denuncia["denunciado2_tel"].
		' Correo: '.$denuncia["denunciado2_correo"].'</p>';
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
	
	<style>
		**@page {
            margin-top:21% !important; 
            @top-left{
				content: element(header);

            }

            @bottom-left {
				content: element(footer);
			}
		}	
		
		div#header {
			position:fixed;
			top:0px;
			left:0px;
			width:10%;
			color:#FFFFFFF;
			padding:8px;
			text-align: center;
			background-color: #F2F2F2;
			float: right;
			
		}
            div.footer {

            position: running(footer);
            border-bottom: 2px solid black;


            }
           .pagenumber:before {
			   counter-reset: content;
				content: counter(page);
            }
            .pagecount:before {
            content: counter(pages);
            }      
	
		.centrado{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
		
		p.saltodepagina{
			page-break-after: always;
		}
		
		.mayusculas { text-transform: uppercase;}

		.body{
			margin-left: 50px;
			margin-right: 0px;
			margin-top: 0px;
			margin-bottom: 0px;
		}
	
	</style>
	
  </head>
  <body class="body">
  

		
	<p align="center"><font size="12">OFICINA MUNICIPAL DE INFORMACION DEFENSA AL USUARIO Y CONSUMIDOR</p>
		<br>
		<br>
		<br>
		<p align="center" class="mayusculas"><font size="18">EXPEDIENTE Nº '.$denuncia["id"].'-'.date("Y",strtotime($denuncia["fecha_sistema"])).'</p>
		
		<p align="center"><font size="16">Extracto</p>
		<p align="center" class="mayusculas"><font size="23">'.$denuncia["denunciante_apellido"].'</p>
		<p align="center"><font size="23">C/</p>
		<p align="center" class="mayusculas"><font size="23">'.$denuncia["denunciado1_nombre"].'</p>
		
		<p align="center"><font size="12">......................................................................................................................................</p>
		<p align="center"><font size="12">......................................................................................................................................</p>
		<p align="center"><font size="12">......................................................................................................................................</p>
		<p align="center"><font size="12">......................................................................................................................................</p>
		<p align="center"><font size="12">......................................................................................................................................</p>
		
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>

		<p class="saltodepagina"> </p>
	
		
	  
	  
  
  	<div class="container">
    	
		
		<p class="block4"><font size="23">Expediente:'.$denuncia["id"].'</font></p>

		<p><font size="14">Fecha de la denuncia: '.fecha_mysql_normal_completa($denuncia["fecha_sistema"]).'</font></p>
		
		<h3 class="block4">Datos del Denunciante</h3>
		
  		<p class="block4">
		Apellido/s y Nombre/s:'.$denuncia["denunciante_apellido"].
		' D.N.I.'.$denuncia["denunciante_dni"].
		' Genero: '.$denuncia['denunciante_genero'].
		' Domicilio: '.$denuncia['denunciante_domicilio'].
		' Barrio: '.$denuncia['denunciante_barrio'].
		' C.P: '.$denuncia['denunciante_cp'].
		' Localidad: '.$denuncia['denunciante_localidad'].
		' Tel: '.$denuncia['denunciante_tel'].
		' Correo: '.$denuncia['denunciante_correo'].
		' C.P: '.$denuncia['representante_damnificado'].
		'</p>'.
		
		$bloque_representante.
		
		'<h3  class="block4">Datos del Denunciado 1</h3>
		<p class="block4">
		Apellido/s y Nombre/s: '.$denuncia["denunciado1_nombre"].
		' CUIT: '.$denuncia["denunciado1_cuit"].
		' Rubro: '.$denuncia["denunciado1_rubro"].
		' Domicilio: '.$denuncia["denunciado1_domicilio"].
		' Numero: '.$denuncia["denunciado1_numero"].
		' Piso: '.$denuncia["denunciado1_piso"].
		' C.P: '.$denuncia["denunciado1_cp"].
		' Localidad: '.$denuncia["denunciado1_localidad"].
		' Telefono: '.$denuncia["denunciado1_tel"].
		' Correo: '.$denuncia["denunciado1_correo"].
		'</p>'.
		
		$bloque_denunciado2.'
		
		<h3  class="block4">Datos de la denuncia</h3>
		
		<p class="block4">Motivo: '.$denuncia["denuncia_motivo"].'</p>
		<p class="block4">Texto: '.$denuncia["denuncia_texto"].'</p>

		<h3  class="block4">Pretensión</h3>

		<p class="block4">'.$denuncia["denuncia_pretension"].'</p>

		
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../jscripts/jquery-3.3.1.slim.min.js"></script>

</html>

';



//$content='<html><p align="center"><font size="12">OFICINA MUNICIPAL DE INFORMACION DEFENSA AL USUARIO Y CONSUMIDOR</p></html>';


$dompdf = new Dompdf();


$dompdf->loadHtml($content);
/*
$dompdf->setPaper('A4', 'vertical'); // (Opcional) Configurar papel y orientación
$dompdf->render(); // Generar el PDF desde contenido HTML


$dompdf->stream($nombre); // Enviar el PDF generado al navegador
*/
$nombre=$id_denuncia.".pdf";

header('Content-Type: application/pdf');
$dompdf->render();
$dompdf->stream("$nombre", ['Attachment' => false]);
exit(0);


?>
