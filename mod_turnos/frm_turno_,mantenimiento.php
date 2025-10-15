<?php
header('Content-Type: text/html; charset=iso-8859-1');


include("../lib/funciones.php");

$link_mysql=conectarse();


/////Cargo Valores del contenido------------------------------------------------------


?>


<html>
  	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
	<title>Turno On-Line</title>
	<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
    
	
<style type="text/css">

@import "../css/demo_page.css";
@import "../css/demo_table.css";
@import "../css/themes/base/jquery-ui.css";
@import "../css/themes/smoothness/jquery-ui-1.7.2.custom.css";
@import "../css/jquery.dataTables.css";
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {color: #5B6946}
.Estilo1 {color: #FF0000}
-->
</style>

<script src="../jscripts/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="../jscripts/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../jscripts/js/jquery-ui.js" type="text/javascript"></script>

<script language='javascript' src="../jscripts/funciones.js"></script>
<script src="../jscripts/popcalendar.js"></script> 

  
   
<script type="text/JavaScript">
/*$(document).ready(function(){ 

	$('#horarios').load('horarios.php?'+$.param(
		{txt_fecha: document.form1.txt_fecha.value}
	));
	
	 $('#txt_fecha').on('input',function(e){
     alert('Changed!');
    });
	 
});*/

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
	
	if ( document.form1.txt_motivo.value==".." ){
  		alert("Debe ingresar el motivo"); 
		document.form1.txt_motivo.focus();
  		return (false); 
  	}
	
     if ( vacio(document.form1.txt_fecha.value)==false ){
  		alert("Debe ingresar la fecha"); 
		document.form1.txt_fecha.focus();
  		return (false); 
  	}
	
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
	
	if (!confirm('¿Confirma el registro del propietario?')){   
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
   <body>
   
   <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
       <td align="left" valign="top"><img src="../images/encabezado.jpg" width="1000" height="100" border="0" /></td>
     </tr>
     <tr>
       <td width="770" height="300" align="center" valign="middle"><table width="570" border="0" cellspacing="0" cellpadding="0">
           <tr valign="top">
           <td align="center"><form action="procesa_turno.php" method="post" name="form1" id="form1" onSubmit="return validar(this)" >
           <table width="570" border="0" align="center" cellpadding="0" cellspacing="0">
                   <tr>
                     <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                     <tr>
                         <td width="570" height="30" align="left" valign="middle" class="etiquetas"><label><span class="titulopantalla">Turno para licencia de conducir </span></label>
                           <p class="Estilo1">Moment&aacute;neamente &nbsp;fuera  de servicio por mantenimiento </p>
                           <p>&nbsp;</p></td>
                      </tr>
                     </table></td>
                   </tr>
              </table>
             </form></td>
         </tr>
         <?php if (isset($_GET['id'])){ //si se esta creando vehiculo no muestra controles ?>
       </table></td>
     </tr>
     <tr bgcolor="#5B6946">
       <td height="2" align="center" valign="top"></td>
     </tr>
     
     <?php }//fin si existe la matricula?>
   </table>

   </body>
</html>
