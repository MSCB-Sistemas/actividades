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
  function validar(frm) {
     
    if (document.form1.txt_anio.value < document.form1.txt_anio_desde.value || document.form1.txt_anio.value > document.form1.txt_anio_hasta.value){   
        alert("El año de nacimiento no correscponde a la categoría de la actividad seleccionada"); 
       return (false); 
    }
	
    
    if (!confirm('¿Confirma la inscripción?')){   
       return (false); 
    }
    
    
  }
  //-------------Fin validaciones del formulario---------------------------//

  function MM_preloadImages() { //v3.0
    var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
      var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
      if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
          <h2 align="left">Preinscripción en actividades de verano 2025</h2> 
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
							
					
								$query_lugares="select id_lugar,nombre,direccion from lugares order by nombre";
					
							
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
                    <input class="form-control" type="number" minlength="11" id="txt_documento" name="txt_documento" placeholder="Ingrese su DNI sin guiones" autocomplete="off" required="" size="11">
                  </div>
                </div>

              <div class="form-group row">
                <label for="example-search-input" class="col-3 col-form-label">DNI Frente</label>
                  <div class="col-9">
                    <input class="form-control" type="file" minlength="11" id="img_documento_frente" name="img_documento_frente" placeholder="Ingrese imgen DNI frente" autocomplete="off" required="" size="11">
                  </div>
              </div>

              <div class="form-group row">  
                <label for="example-search-input" class="col-3 col-form-label">DNI Dorso</label>
                    <div class="col-9">
                      <input class="form-control" type="file" minlength="11" id="img_documento_dorso" name="img_documento_dorso" placeholder="Ingrese imgen DNI dorso" autocomplete="off" required="" size="11">
                </div>
              </div>

              
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
                  
                  <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Sexo</label>
                  <div class="col-9">
                    <select class="form-control" name="txt_sexo" id="txt_sexo" required="">
                      <option selected="selected"></option>
                      <option>Masculino</option>
                      <option>Femenino</option>
                      <option>Otro</option>
                    </select>
                  </div>
                </div>
                  
                  <div class="form-group row">
                  <label for="example-search-input" class="col-3 col-form-label">Fecha de nacimiento</label>
                  <div class="col-9">
                  <script src="jscripts/funciones.js"></script>
                  	<script src="jscripts/popcalendar.js"></script>
                    <input type="text" name="txt_fecha" id="txt_fecha"  class="form-control" size="10" maxlength="10" required="" autocomplete="off"  onClick="popUpCalendar(this,form1.txt_fecha,'dd-mm-yyyy');" readonly="readonly" >
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

                  <h3 align="left">Datos del responsable</h2> 
<hr>

                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Apellido del responsable:</label>
                    <div class="col-9">
                      <input class="form-control" type="text" id="txt_apellido_responsable" name="txt_apellido_responsable" size="50" maxlength="50" placeholder="Ingrese su apellido" autocomplete="off" required="" style="text-transform:uppercase;">
                    </div>              
                  </div>

                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Nombre del responsable:</label>
                    <div class="col-9">
                      <input class="form-control" type="text" id="txt_nombre_responsable" name="txt_nombre_responsable" size="50" maxlength="50" placeholder="Ingrese su apellido" autocomplete="off" required="" style="text-transform:uppercase;">
                    </div>              
                  </div>

                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">CUIL del responsable:</label>
                    <div class="col-9">
                      <input class="form-control" type="number" id="txt_cuil_responsable" name="txt_cuil_responsable" size="50" maxlength="50" placeholder="Ingrese su apellido" autocomplete="off" required="" style="text-transform:uppercase;">
                    </div>              
                  </div>

                  <div class="form-group row">
                <label for="example-search-input" class="col-3 col-form-label">Responsable DNI Frente</label>
                  <div class="col-9">
                    <input class="form-control" type="file" minlength="11" id="img_documento_frente_responsable" name="img_documento_frente_responsable" placeholder="Ingrese imgen DNI frente" autocomplete="off" required="" size="11">
                  </div>
              </div>

              <div class="form-group row">  
                <label for="example-search-input" class="col-3 col-form-label">Responsable DNI Dorso</label>
                    <div class="col-9">
                      <input class="form-control" type="file" minlength="11" id="img_documento_dorso_responsable" name="img_documento_dorso_responsable" placeholder="Ingrese imgen DNI dorso" autocomplete="off" required="" size="11">
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
          
          <div class="col-lg-6 col-md-12 col-xs-12">
                <div style="text-align: left;">
                    <p><b>INSCRIPCIONES ADAM</b> <p> 
                    <p>GIMNASIO N°1<p>
        
                    ✔️Montaña<br>
                    ✔️Tenis de Mesa <br>
                    ✔️Paseos Urbanos<br>
                    ✔️Actividades sobre Silla de ruedas<br> 
                    ✔️Natación para Personas con Artritis reumatoidea<br> 
                    ✔️Actividades Recreativas para MAYORES de 12 años<br>
                    ✔️Actividades Recreativas MENORES de 12 años<br>
                    ✔️Arqueria a evaluar con la instructora <br>

                    <b>JUEVES 2</b> de Enero de 10 a 14hs<br>
                    <b>VIERNES 3</b> de Enero de 9.30 a 11.30hs<br>
                    <b>LUNES 6</b> de Enero de 10 a 12hs<br>

                    <b>REMO</b> anual (comienza en Febrero)<br>

                    <b>MIÉRCOLES 29</b> de Enero de 12 a 15hs Gimnasio Municipal N°1<br>

                    <b>REQUISITOS</b> <br>
                      *Todos los alumnos y alumnas inscriptos en el 2024 solo deben concurrir con DNI en mano.<br> 
                      *Nuevas inscripciones concurrir con fotocopia de Dni y fotocopia de certificado de Discapacidad - CUD.<br>

                      En las Actividades de ENERO Y FEBRERO <b>NO</b> es necesario presentar <b>Apto Médico</b><br>
                </div>
                </div>

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