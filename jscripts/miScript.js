

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
