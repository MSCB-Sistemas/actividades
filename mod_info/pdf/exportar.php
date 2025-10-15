
<?php
include '../lib/funciones.php';
require_once 'pdf/autoload.inc.php';
use Dompdf\Dompdf;

//if (isset($_POST['btnPDF'])) {

	$nro  = $_POST['nro'];
	$apenom  = $_POST['apenom'];
	$dni  = $_POST['dni'];
	$hora  = $_POST['hora'];
	$area  = $_POST['area'];
	$area_direccion  = $_POST['area_direccion'];
  //$fecha_normal = fecha_mysql_normal($_POST['fecha']);

$content = '

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <title>Denuncia OMIDUC</title>
  </head>
  <body>
  	<div class="container">
    	<h2>Denuncia - '.$area.'</h2>

    	<hr>
    	<ul>
  		<li>Número: <strong>'.$nro.'</strong></li>
  		<li>Apellido y nombre: <strong>'.$apenom.'</strong></li>
			<li>DNI : <strong>'.$dni.'</strong></li>
			<li>Fecha : <strong>'.$fecha_normal.'</strong></li>
			<li>Hora : <strong>'.$hora.'</strong></li>
			<li>Area : <strong>'.$area.'</strong></li>
			<li>Dirección : <strong>'.$area_direccion.'</strong></li>
    	</ul>
    	<footer class="footer">
        	<div class="container">
          	<div class="text-center">
            	<hr>
            	<span class="text-muted">Municipalidad de San Carlos de Bariloche.</span>
          	</div>
        	</div>
      	</footer>
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
