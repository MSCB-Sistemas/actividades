<?php

include("../lib/funciones.php");
$link_mysql=conectarse();

?>

<!DOCTYPE html>
<html lang="es">
  <head>
	<meta charset="utf-8">
	
	<title>Turno On-Line Licencia de Conducir</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
	<!--<link href="../css/estilos.css" rel="stylesheet" type="text/css" />-->
    
  <script src="../jscripts/js/jquery-1.4.4.min.js" type="text/javascript"></script>
  <script src="../jscripts/js/jquery-ui.js" type="text/javascript"></script>

  <script language='javascript' src="../jscripts/funciones.js"></script>
  <script src="../jscripts/popcalendar.js"></script> 

  
   
  <script type="text/JavaScript">

    function horarios(){
    	$('#horarios').load('horarios.php?'+$.param(
    		{txt_fecha: document.form1.txt_fecha.value}
    	));
    }

  //-------------Validaciones del formulario---------------------------//
  function validar(frm) {

  	//var patronCUIT = /[23]{1}[0347]{1}[0-9]{8}[0-8]{1}|[1-9]{1}[0-9]{7}|[1-9]{1}[0-9]{6}/;
  	var patronCUIT = /[2,3]{1}[0,3,4,7]{1}[0-9]{8}[0-8]{1}/;
  	var patronDNI1 = /[1-9]{1}[0-9]{6,7}/;
  	var patronDNI2= /[1-9]{1}[0-9]{6}/;
  	

  //--VALIDO FERIADOS
     
  	if (document.form1.txt_fecha.value == '27-02-2017'){   
  		alert("Dia Feriado - Carnaval, seleccione otro dia."); 
  	   return (false); 
  	}
  	
  	if (document.form1.txt_fecha.value == '28-02-2017'){   
  		alert("Dia Feriado - Carnaval, seleccione otro dia."); 
  	   return (false); 
  	}

  	if (document.form1.txt_fecha.value == '24-03-2017'){   
  		alert("Dia Feriado - Día Nacional de la Memoria por la Verdad y la Justicia, seleccione otro dia."); 
  	   return (false); 
  	}	
  	
  	if (document.form1.txt_fecha.value == '14-04-2017'){   
  		alert("Dia Feriado - Viernes Santo, seleccione otro dia."); 
  	   return (false); 
  	}
  	
  	if (document.form1.txt_fecha.value == '01-05-2017'){   
  		alert("Dia Feriado - Día del trabajador, seleccione otro dia."); 
  	   return (false); 
  	}


  	if (document.form1.txt_fecha.value == '05-07-2017'){   
  		alert("Dia Feriado - Día de la independencia, seleccione otro dia."); 
  	   return (false); 
  	}	
  	
  	
  	if (document.form1.txt_fecha.value == '25-05-2017'){   
  		alert("Dia Feriado - Día de la Revolución de Mayo, seleccione otro dia."); 
  	   return (false); 
  	}	
  	
  	if (document.form1.txt_fecha.value == '20-06-2017'){   
  		alert("Dia Feriado - Paso a la Inmortalidad del General Manuel Belgrano, seleccione otro dia."); 
  	   return (false); 
  	}	
  	
  	
  	if (document.form1.txt_fecha.value == '20-06-2017'){   
  		alert("Dia Feriado - Paso a la Inmortalidad del General Manuel Belgrano, seleccione otro dia."); 
  	   return (false); 
  	}	
  	
  	if (document.form1.txt_fecha.value == '08-12-2017'){   
  		alert("Dia Feriado - Inmaculada Concepción de María, seleccione otro dia."); 
  	   return (false); 
  	}

  	if (document.form1.txt_fecha.value == '25-12-2017'){   
  		alert("Dia Feriado - Navidad, seleccione otro dia."); 
  	   return (false); 
  	}	
  //FIN V--VALIDO FERIADOS	
  	
  	
  	if ( vacio(document.form1.combo_horario.value)==false ){
    		alert("Debe ingresar un horario"); 
  		document.form1.combo_horario.focus();
    		return (false); 
    }
  	
  	if (isNaN(document.form1.txt_documento.value) || vacio(document.form1.txt_documento.value)==false || document.form1.txt_documento.value.length < 7) {
          alert("Debe ingresar el documento"); 
  		document.form1.txt_documento.focus();
    		return (false); 
    }
  	
    if ( vacio(document.form1.txt_apellido.value)==false ){
    		alert("Debe ingresar el apellido"); 
  		document.form1.txt_apellido.focus();
    		return (false); 
    }
     
    if ( vacio(document.form1.txt_nombre.value)==false ){
    		alert("Debe ingresar el nombre"); 
  		document.form1.txt_nombre.focus();
    		return (false); 
    }
  	
  	if ( isNaN(document.form1.txt_telefono.value) || vacio(document.form1.txt_telefono.value)==false || document.form1.txt_telefono.value.length < 7 ){
    		alert("Debe ingresar el telefono"); 
  		document.form1.txt_telefono.focus();
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

</head>
  <body onLoad="horarios();">
    <div class="container">
      <div class="text-center"><br>
        <img src="../images/encabezado.jpg" class="rounded img-fluid" alt="Municipalidad San Carlos de Bariloche">
          <h1 class="text-center">Turnos para licencia de conducir</h1> <hr>
          
            <form action="procesa_turno.php" method="POST" name="form1" id="form1" onSubmit="return validar(this)">
              <div class="row">
              <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Motivo</label>
                  <div class="col-9">
                    <select class="form-control" name="motivo" id="motivo">
                      <option>Primera vez</option>
                      <option>Renovación</option>
                      <option>Renovación con ampliación</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="example-search-input" class="col-3 col-form-label">Fecha</label>
                  <div class="col-9">
                    <input class="form-control" type="text" name="txt_fecha" onClick="popUpCalendar(this, form1.txt_fecha,'dd-mm-yyyy');" onKeyPress="return tabular(event,this)"  onKeyUp="mascara(this,'-',patron,true)" onInput="alert('hola')" size="10" maxlength="10" required="" autocomplete="off">
                  </div>
                </div>
                <div id="horarios"></div>
                <div class="form-group row">
                  <label for="example-search-input" class="col-3 col-form-label">DNI</label>
                  <div class="col-9">
                    <input class="form-control" type="number" maxlength="11" id="dni" name="dni" placeholder="Ingrese su DNI sin guiones" autocomplete="off" required="">
                  </div>
                </div>

              </div>
              <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Apellido</label>
                    <div class="col-9">
                      <input class="form-control" type="text" maxlength="11" id="apellido" name="apellido" placeholder="Ingrese su apellido" autocomplete="off" required="">
                    </div>              
                  </div>

                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Nombre</label>
                    <div class="col-9">
                      <input class="form-control" type="text" maxlength="11" id="nombre" name="nombre" placeholder="Ingrese su nombre" autocomplete="off" required="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Teléfono</label>
                    <div class="col-9">
                      <input class="form-control" type="number" id="tel" name="tel" placeholder="Ingrese un teléfono válido" autocomplete="off" required="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-search-input" class="col-3 col-form-label">Email</label>
                    <div class="col-9">
                      <input class="form-control" type="email" id="email" name="email" placeholder="Ingrese un email válido" autocomplete="off" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <input type="submit" name="" class="btn btn-success" value="Confirmar">
                    <input type="reset" name="" class="btn btn-danger" value="Borrar">
                  </div>
                  <br><br>
              </form>
              </div>
            </div><!-- FIN ROW -->
          </div><!-- FIN TEXT-CENTER -->     
        </div><!-- FIN CONTAINER -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
   </body>

</html>
