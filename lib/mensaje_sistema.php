<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="images/escudo_ico.ico">

    <title>Actividades deportivas</title>
  </head>
  <body onLoad="horarios();">
    
    <div class="container">
      <div class="text-center"><br>
        <!--<img srcset="images/logo.png 2000w,images/encabezado.jpg 400w" class="rounded img-fluid" alt="Municipalidad San Carlos de Bariloche">-->
        <picture>
          <source media="(max-width: 600px)" srcset="images/logo.png">
          <source media="(max-width: 1600px)" srcset="images/encabezado.jpg">
          <source media="(max-width: 1920px)" srcset="images/encabezado1.jpg">
          <img src="images/encabezado.jpg" alt="Municipalidad San Carlos de Bariloche" style="width:auto;" class="img-fluid">
        </picture>
          <h2 align="left">Preinscripción en actividades deportivas aranceladas</h2> <hr>
          
          <div class="alert alert-warning" role="alert">
            <h3><?php echo $mensaje; ?></h3>
          </div>
          
          <br>
          <a href="<?php echo $destino;?>"><button type="button" class="btn btn-primary">Continuar</button></a>
            
          </div><!-- FIN TEXT-CENTER -->   
          <footer class="footer">
            <div class="container">
              <div class="text-center">
                <br><br><hr>
                <span class="text-muted">Municipalidad de San Carlos de Bariloche.</span><br>
              </div>
            </div>
          </footer>  
        </div><!-- FIN CONTAINER -->  
  </body>
</html>