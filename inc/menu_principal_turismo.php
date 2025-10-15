<?php
session_start();

if($_SESSION['permiso'] != 'autorizado' or $_SESSION['tipo']!="turismo"){
	header('Location: ../mod_usuario/index.php?error=errorsesion');	
}

include("../../../inc/sql.php");


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/logo.png" sizes="16x16">
    <title>Sistema Turismo MSCB</title>

    <!-- Bootstrap -->
		<script src="../js/jquery-1.12.3.js"></script>
		<link href="../css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <br>
	<div class="container">
		<!-- Static navbar -->
		<?php include("../inc/menu_turismo.php"); ?>
		<!-- Main component for a primary marketing message or call to action -->
		  <div class="jumbotron">
  	        <h2><img src="../images/logo.png" alt="Municipalidad Bariloche" align="middle" style="margin:0px 0px 0px 0px" height="64" width="64"> Sistema Disponibilidad Hotelera - Panel secretaría de turismo</h2>
			<div class="row">
				<div class="col-lg-6">
					<p>
                    	<a class="btn btn-lg btn-direct" href="../mod_establecimientos/turismo_establecimientos.php" role="button"><img src="../images/cargar_disponibilidad.gif" alt="Municipalidad Bariloche" align="center" style="margin:0px 0px 0px 0px" >	Establecimientos</a><a class="btn btn-lg btn-direct" href="../mod_disponibilidad/turismo_disponibilidad.php" role="button"><img src="../images/disponibilidad.gif" alt="Municipalidad Bariloche" align="center" style="margin:0px 0px 0px 0px" >	Disponibilidad por fecha</a>

				    <a class="btn btn-lg btn-direct" href="../mod_disponibilidad/turismo_historico_disponibilidad.php" role="button"><img src="../images/historico_carga_disponibilidad.gif" alt="Municipalidad Bariloche" align="center" style="margin:0px 0px 0px 0px" >	Historico de carga de disponibilidad</a></p>
			  </div>
				<div class="col-lg-5">
					<p>&nbsp;</p>

			  </div>
			</div>
		  </div> <!-- /jumbotron -->

		<div class="panel-footer">
			<p class="text-center">Direccion de Sistemas - Municipalidad de Bariloche</p>
		</div>

	</div> <!-- /container -->
  </body>
</html>
