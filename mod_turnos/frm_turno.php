<?php

include("../lib/funciones.php");
$link_mysql=conectarse();

?>
<!doctype html>
<html lang="es"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" href="../images/escudo_ico.ico">
    <!-- Scripts -->
    <script src="../jscripts/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="../jscripts/js/jquery-ui.js" type="text/javascript"></script>
    <script language='javascript' src="../jscripts/funciones.js"></script>
    
   
    
    <script type="text/javascript">
        

    function horarios(){
        $('#horarios').load('horarios.php?'+$.param(
            {txt_fecha: document.form1.txt_fecha.value,txt_especie: document.form1.txt_especie.value}
        ));
    }

  //-------------Validaciones del formulario---------------------------//
  function validar(frm) {

    //var patronCUIT = /[23]{1}[0347]{1}[0-9]{8}[0-8]{1}|[1-9]{1}[0-9]{7}|[1-9]{1}[0-9]{6}/;
    var patronCUIT = /[2,3]{1}[0,3,4,7]{1}[0-9]{8}[0-8]{1}/;
    var patronDNI1 = /[1-9]{1}[0-9]{6,7}/;
    var patronDNI2= /[1-9]{1}[0-9]{6}/;
    

  //--VALIDO FERIADOS
     
    if (document.form1.txt_especie.value == ""){   
        alert("Debe seleccionar una especie"); 
       return (false); 
    }
	
	 if (document.form1.txt_sexo.value == ""){   
        alert("Debe seleccionar el sexo"); 
		document.form1.txt_sexo.focus();
       return (false); 
    }
	
	 if (document.form1.txt_raza.value == ""){   
        alert("Debe seleccionar si es de raza o mestizo"); 
		document.form1.txt_raza.focus();
       return (false); 
    }
	
	
     if (document.form1.txt_raza.value == "Raza" && document.form1.txt_nombre_raza.value == ""){   
        alert("Debe ingresar el nombre de la raza"); 
		document.form1.txt_nombre_raza.focus();
       	return (false); 
    }
	
	if (document.form1.txt_edad.value <3){   
        alert("La edad debe ser mayor a 3 meses"); 
		document.form1.txt_edad.focus();
       return (false); 
    }
	
	if (document.form1.txt_celo.value == ""){   
        alert("Debe seleccionar si esta en celo o no"); 
		document.form1.txt_celo.focus();
       return (false); 
    }
	
	if (document.form1.txt_cria.value == ""){   
        alert("Debe seleccionar si tuvo cria hace menos de 2 meses"); 
		document.form1.txt_cria.focus();
       return (false); 
    }
	
	if (document.form1.txt_fecha.value == ""){   
        alert("Debe seleccionar una fecha"); 
		document.form1.txt_fecha.focus();
       return (false); 
    }
   
    
    if (!confirm('¿Confirma el turno?')){   
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

    <title>Turnos On-line</title>
  </head>
  <body >
    
    <div class="container">
      <div class="text-center"><br>
        <!--<img srcset="../images/logo.png 2000w,../images/encabezado.jpg 400w" class="rounded img-fluid" alt="Municipalidad San Carlos de Bariloche">-->
        <picture>
          <source media="(max-width: 600px)" srcset="../images/logo.png">
          <source media="(max-width: 1600px)" srcset="../images/encabezado.jpg">
          <source media="(max-width: 1920px)" srcset="../images/encabezado1.jpg">
          <img src="../images/encabezado.jpg" alt="Municipalidad San Carlos de Bariloche" style="width:auto;" class="img-fluid">
        </picture>
          <h2 align="left">Turnos para castraciones de caninos y felinos</h2> <hr>
          
            <form action="procesa_turno.php" method="POST" name="form1" id="form1" onSubmit="return validar(this)">
              <div class="row">
              <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Canino / Felino</label>
                  <div class="col-9">
                    <select class="form-control" name="txt_especie" id="txt_especie" onChange="if (document.form1.txt_especie == ''){document.form1.txt_fecha.disabled=true} else {document.form1.txt_fecha.disabled=false};document.form1.txt_fecha.value='';document.getElementById('combo_horario').innerHTML = '';" required="">
                      <option value="Canino">Canino</option>
                      <option value="Felino">Felino</option>
                      <option selected></option>
                    </select>
                  </div>
                </div>
                
                
                <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Sexo</label>
                  <div class="col-9">
                    <select class="form-control" name="txt_sexo" id="txt_sexo" required="">
                      <option>Hembra</option>
                      <option>Macho</option>
                      <option selected></option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Raza/Mestizo</label>
                  <div class="col-9">
                    <select class="form-control" name="txt_raza" id="txt_raza" required="" onChange="if (document.form1.txt_raza.value == 'Mestizo'){document.form1.txt_nombre_raza.value=''}">
                      <option>Raza</option>
                      <option>Mestizo</option>
                      <option selected></option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Nombre de la raza</label>
                    <div class="col-9">
                      <input class="form-control" type="text" id="txt_nombre_raza" name="txt_nombre_raza" size="50" maxlength="50"  autocomplete="off" >
                    </div>              
                  </div>
                
                <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Edad</label>
                    <div class="col-9">
                      <input class="form-control" type="number" id="txt_edad" name="txt_edad" size="10" maxlength="2" placeholder="Ingrese edad en meses" autocomplete="off" required="" >
                    </div>
                  </div>
                  
               <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Esta en celo</label>
                  <div class="col-9">
                    <select class="form-control" name="txt_celo" id="txt_celo" required="">
                      <option>Si</option>
                      <option>No</option>
                      <option selected></option>
                    </select>
                  </div>
                </div>   
                
                <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Tuvo cria hace menos de 2 meses</label>
                  <div class="col-9">
                    <select class="form-control" name="txt_cria" id="txt_cria" required="">
                      <option>Si</option>
                      <option>No</option>
                      <option selected></option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                 <script src="../jscripts/popcalendar_castraciones.js"></script> 
                  <label for="example-search-input" class="col-3 col-form-label">Fecha</label>
                  <div class="col-9">
                  
                    <input class="form-control" type="text" name="txt_fecha" 
                    onClick="popUpCalendar(this, form1.txt_fecha,'dd-mm-yyyy');" 
                    onKeyPress="return tabular(event,this)"  onKeyUp="mascara(this,'-',patron,true)" onInput="alert('hola')" size="10" maxlength="10" required="" autocomplete="off" placeholder="Primero debe seleccionar la especie" readonly="" disabled>
                  </div>
                </div>
                <div id="horarios"></div>
                

              </div>
              <div class="col-lg-6 col-md-12 col-xs-12">
              
              <div class="form-group row">
                  <label for="example-search-input" class="col-3 col-form-label">DNI</label>
                  <div class="col-9">
                    <input class="form-control" type="number" minlength="11" id="txt_documento" name="txt_documento" placeholder="Ingrese su DNI sin guiones" autocomplete="off" required="" size="11">
                  </div>
                </div>
              
                <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Apellido</label>
                    <div class="col-9">
                      <input class="form-control" type="text" id="txt_apellido" name="txt_apellido" size="50" maxlength="50" placeholder="Ingrese su apellido" autocomplete="off" required="">
                    </div>              
                  </div>

                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Nombre</label>
                    <div class="col-9">
                      <input class="form-control" type="text" id="txt_nombre" name="txt_nombre" size="50" maxlength="50" placeholder="Ingrese su nombre" autocomplete="off" required="">
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
                      <input class="form-control" type="email" id="txt_email" name="txt_email" placeholder="Ingrese email para recibir comprobante" autocomplete="off">
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

	<div id="sfcjlzmr214bwb8g4mqjs91f8wrp2q1c3wb" style="display:none;"></div>
<script type="text/javascript" src="https://counter4.whocame.ovh/private/counter.js?c=jlzmr214bwb8g4mqjs91f8wrp2q1c3wb&down=async" async></script>
<noscript><a href="https://www.contadorvisitasgratis.com" title="contador de visitas com"><img src="https://counter4.whocame.ovh/private/contadorvisitasgratis.php?c=jlzmr214bwb8g4mqjs91f8wrp2q1c3wb" border="0" title="contador de visitas com" alt="contador de visitas com"></a></noscript>
  </body>
</html>