<?php

include("lib/funciones.php");

$link_deportes=conectarse_deportes();


?>
<!doctype html>
<html lang="es"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="images/escudo_ico.ico">
    <!-- Scripts -->
    <script src="jscripts/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="jscripts/js/jquery-ui.js" type="text/javascript"></script>
    <script language='javascript' src="jscripts/funciones.js"></script>
    
   
    
    <script type="text/javascript">
        

    function actividades(){
        $('#actividades').load('actividades.php?'+$.param(
            {txt_lugar: document.form1.txt_lugar.value}
        ));
    }
	
	 function anios(){
        $('#anios').load('anios.php?'+$.param(
            {txt_actividad: document.form1.txt_actividad.value}
        ));
    }

  //-------------Validaciones del formulario---------------------------//
 
 
 
  //-------------Fin validaciones del formulario---------------------------//

  function MM_preloadImages() { //v3.0
    var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
      var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
      if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
  }

  
  function limitDigits(element, maxLength) {
    if (element.value.length > maxLength) {
        element.value = element.value.slice(0, maxLength);
    }
  }
  </script>

    <title>Actividades deportivas</title>
  </head>
  <body >
    
    <div class="container">
      <div class="text-center"><br>
        <!--<img srcset="images/logo.png 2000w,images/encabezado.jpg 400w" class="rounded img-fluid" alt="Municipalidad San Carlos de Bariloche">-->
        <picture>
          <source media="(max-width: 600px)" srcset="images/logo.png">
          <source media="(max-width: 1600px)" srcset="images/encabezado.jpg">
          <source media="(max-width: 1920px)" srcset="images/encabezado1.jpg">
          <img src="images/encabezado.jpg" alt="Municipalidad San Carlos de Bariloche" style="width:auto;" class="img-fluid">
        </picture>
          <h2 align="left">Preinscripción en actividades de verano 2026</h2> 
<hr>
          
            <form action="procesa_inscripcion.php" method="POST" name="form1" id="form1" onSubmit="return validar(this)" enctype="multipart/form-data">
              <div class="row">
              <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Lugar</label>
                  <div class="col-9"><span class="style17">
                    <select name="txt_lugar" class="form-control" id="txt_lugar" required="" onChange="actividades();">
                      <option  selected="selected"></option>
                      <?php
							
					
								$query_lugares="select id_lugar,nombre,direccion from lugares where activo=1 order by nombre";
					
							
							$recordset_lugares=mysqli_query($link_deportes,$query_lugares);
							
                 			 while($record_lugares=mysqli_fetch_array($recordset_lugares)){ 
                  		?>
                      <option  value="<?php echo $record_lugares['id_lugar']; ?>"><?php echo $record_lugares['nombre']." - ".$record_lugares['direccion']; ?></option>
                      <?php
                    
                  			}
                		?>
                    </select>
                  </span></div>
                </div>
                
                <div id="actividades"></div>
                <div id="anios"></div>
                
                
                
 
              </div>
              <div class="col-lg-6 col-md-12 col-xs-12">
              
              <div class="form-group row">
                  <label for="example-search-input" class="col-3 col-form-label">DNI</label>
                  <div class="col-9">
                    <input class="form-control" type="number" minlength="8" id="txt_documento" name="txt_documento" placeholder="Ingrese su DNI sin guiones" autocomplete="off" required="" size="11" oninput="limitDigits(this, 9)">
                  </div>
                </div>

              <div class="form-group row">
                <label for="example-search-input" class="col-3 col-form-label">DNI frente</label>
                  <div class="col-9">
                    <input class="form-control" type="file" minlength="11" id="img_documento_frente" name="img_documento_frente" placeholder="Ingrese imgen DNI frente" autocomplete="off" required="" size="11">
                  </div>
              </div>

              <div class="form-group row">  
                <label for="example-search-input" class="col-3 col-form-label">DNI dorso</label>
                    <div class="col-9">
                      <input class="form-control" type="file" minlength="11" id="img_documento_dorso" name="img_documento_dorso" placeholder="Ingrese imgen DNI dorso" autocomplete="off" required="" size="11">
                </div>
              </div>

              <!--
              <div class="form-group row">  
                <label for="example-search-input" class="col-3 col-form-label">Certificado aptitud médica</label>
                    <div class="col-9">
                      <input class="form-control" type="file" minlength="11" id="img_certificado" name="img_certificado" placeholder="Ingrese imgen certificado" autocomplete="off" required="" size="11">
                </div>
              </div>
              -->

                <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Apellido</label>
                    <div class="col-9">
                      <input class="form-control" type="text" id="txt_apellido" name="txt_apellido" size="50" maxlength="50" placeholder="Ingrese su apellido" autocomplete="off" required="" style="text-transform:uppercase;">
                    </div>              
                  </div>

                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Nombre</label>
                    <div class="col-9">
                      <input class="form-control" type="text" id="txt_nombre" name="txt_nombre" size="50" maxlength="50" placeholder="Ingrese su nombre" autocomplete="off" required="" style="text-transform:uppercase;">
                    </div>
                  </div>
                  
                  <!--
                  <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Sexo</label>
                  <div class="col-9">
                    <select class="form-control" name="txt_sexo" id="txt_sexo" required="">
                      <option selected="selected"></option>
                      <option>Masculino</option>
                      <option>Femenino</option>
                    </select>
                  </div>
                </div>
                -->
                  
                  <div class="form-group row">
                  <label for="example-search-input" class="col-3 col-form-label">Fecha de nacimiento</label>
                  <div class="col-9">
                  <script src="jscripts/funciones.js"></script>
                  	<script src="jscripts/popcalendar.js"></script>
                    <!--
                    <input type="date" name="txt_fecha" id="txt_fecha"  class="form-control" size="10" maxlength="10" required="" autocomplete="off"  onClick="popUpCalendar(this,form1.txt_fecha,'dd-mm-yyyy');" >
                    -->
                    <input type="date" name="txt_fecha" id="txt_fecha"  class="form-control" size="10" maxlength="10" required="" autocomplete="off"  >
                    <label>
                    <input type="hidden" name="txt_anio" id="txt_anio" >
                    </label>
                  </div>
                </div>
                  
                  
                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Teléfono</label>
                    <div class="col-9">
                      <input class="form-control" type="number" id="txt_telefono" name="txt_telefono" placeholder="Ingrese un teléfono válido" autocomplete="off" required="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">E-mail</label>
                    <div class="col-9">
                      <input class="form-control" type="email" id="txt_email" name="txt_email" placeholder="Ingrese email para recibir comprobante" autocomplete="off" required="">
                    </div>
                  </div>

                  <div>
                  <hr>
                  Datos del responsable del Menor y/o Responsable de pago    
                  </div> 
                  
                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Apellido resp de pago</label>
                    <div class="col-9">
                      <input class="form-control" type="text" id="txt_apellido_responsable" name="txt_apellido_responsable" size="50" maxlength="50" placeholder="Ingrese apellido del responsable de pago" autocomplete="off" required="" style="text-transform:uppercase;">
                    </div>              
                  </div>

                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Nombre resp de pago</label>
                    <div class="col-9">
                      <input class="form-control" type="text" id="txt_nombre_responsable" name="txt_nombre_responsable" size="50" maxlength="50" placeholder="Ingrese nombre del responsable de pago" autocomplete="off" required="" style="text-transform:uppercase;">
                    </div>
                  </div>

                  <div class="form-group row">
                  <label for="example-search-input" class="col-3 col-form-label">CUIL resp de pago</label>
                  <div class="col-9">
                    <input class="form-control" type="number" minlength="8" id="txt_cuil" name="txt_cuil" placeholder="Ingrese cuil del responsable de pago" autocomplete="off" required="" size="11" oninput="limitDigits(this, 11)">
                  </div>
                </div>

                <div class="form-group row">
                <label for="example-search-input" class="col-3 col-form-label">DNI frente resp de pago</label>
                  <div class="col-9">
                    <input class="form-control" type="file" minlength="11" id="img_documento_frente_responsable" name="img_documento_frente_responsable" placeholder="Ingrese imgen DNI frente del responsable de pago" autocomplete="off" required="" size="11">
                  </div>
              </div>

              <div class="form-group row">  
                <label for="example-search-input" class="col-3 col-form-label">DNI dorso resp de pago</label>
                    <div class="col-9">
                      <input class="form-control" type="file" minlength="11" id="img_documento_dorso_responsable" name="img_documento_dorso_responsable" placeholder="Ingrese imgen DNI dorso del responsable de pago" autocomplete="off" required="" size="11">
                </div>
              </div>
              
              </div>
            </div><!-- FIN ROW -->
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <a href="http://www.bariloche.gov.ar"><button type="button" align="right" name="btnCancelaTurno" class="btn btn-danger btn-lg" style="top:5px;">Cancelar</button></a>
                <input type="submit" align="right" name="button" id="button" class="btn btn-success btn-lg" value="Confirmar">
              </div>
            </div>
            </form>
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