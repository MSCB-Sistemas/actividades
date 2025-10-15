<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" href="../images/escudo_ico.ico">

    <style type="text/css">
      .btn-warning {
        color: #fff !important;
        background-color: #EE7722 !important;
        border-color: #EE7722 !important;
      }
      .linea {
        padding: 5px;
      }.btn-default{
        border-color: #EE7722 !important;
      }
    </style>

    <title>Turnos Online Licencia de conducir</title>
  </head>
  <body>
    
    <div class="container">
      <br><br>
      <div class="jumbotron">
        <h2>Comprobante de solicitud de turno</h2>
        <hr>
        <ul>
          <li>Apellido :  <strong> <?php echo $apellido; ?> </strong></li>
          <li>Nombre :  <strong> <?php echo $nombre; ?> </strong></li>
          <li>DNI :  <strong><?php echo $dni; ?> </strong></li>
          <li>Fecha :  <strong><?php echo fecha_normal_mysql($fecha); ?> </strong></li>
          <li>Hora :  <strong> <?php echo $horario_comprobante; ?> </strong></li>
        </ul>
        <div class="row">
          <div class="col-lg-4 col-md-12 col-xs-12 linea">
            <input type="button" name="button2" id="button2" class="btn btn-success col-12" value="Imprimir" onclick="window.print();" /><br>
          </div>
          <div class="col-lg-4 col-md-12 col-xs-12 linea">
            <form action="../mod_turnos/descargar.php" method="post">
              <input type="hidden" name="apellido" value="<?php echo $apellido; ?>">
              <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
              <input type="hidden" name="dni" value="<?php echo $dni; ?>">
              <input type="hidden" name="fecha" value="<?php echo fecha_normal_mysql($fecha); ?>">
              <input type="hidden" name="hora" value="<?php echo $horario_comprobante; ?>">
              <input type="submit" name="btnPDF" class="btn btn-warning col-12" value="Descargar PDF" target="_self"><br>
            </form>
          </div>     
          <div class="col-lg-4 col-md-12 col-xs-12 linea">
            <a href="<?php echo $destino;?>"><input type="button" name="" class="btn btn-default col-12" value="Continuar" target="_self"></a><br>
          </div>
        </div>
      </div>
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
    <script src="../jscrips/jquery-3.3.1.slim.min.js"></script>
  </body>
</html>