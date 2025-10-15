<?php
include("../lib/funciones.php");
include("../lib/sesion.php");

$link_mysql=conectarse();


/////Cargo Valores del contenido------------------------------------------------------


?>


<html>
  	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
	<title>Personas</title>
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


</script>

</head>
   <body>
   
   <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
       <td width="770"><?php include("../lib/encabezado.php"); ?></td>
     </tr>
     <tr>
       <td></td>
     </tr>
     <tr>
       <td>	          </td>
     </tr>
     <tr>
       <td align="left"><span class="titulos_pantalla">
         <?php include("../lib/barra_menu_standard.php"); ?>
       </span></td>
     </tr>
     <tr>
       <td class="titulopantalla">Turno</td>
     </tr>
     <tr align="left" valign="middle" bgcolor="#FFFFFF">
       <td class="etiquetas">&nbsp;</td>
     </tr>
     <tr>
       <td align="left" valign="top"><table width="770" border="0" cellspacing="0" cellpadding="0">
           <tr valign="top">
           <td align="center"><form action="procesa_turno_sis.php" method="post" name="form1" id="form1" onSubmit="return validar(this)" >
        <table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
                   <tr>
                     <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                     
                     <tr>
                           <td width="70" align="left" valign="middle" class="etiquetas"><span class="style17 style1">Motivo:</span></td>
                           <td width="770" align="left" valign="middle"><label>
                             <select name="txt_motivo" id="txt_motivo">
                               <option value="..">..</option>
                               <option>Primera vez</option>
                               <option>Renovaci&oacute;n</option>
                               <option>Renovaci&oacute;n con ampliaci&oacute;n</option>
                             </select>
                           </label></td>
                       </tr>
                       <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas"><span class="style17">Fecha:</span></td>
                         <td width="550" align="left" valign="middle"><span class="style17">
                           <input name="txt_fecha" type="text" class="datos" id="txt_fecha" tabindex="3" onClick="popUpCalendar(this, form1.txt_fecha,'dd-mm-yyyy');" onKeyPress="return tabular(event,this)"  onKeyUp="mascara(this,'-',patron,true)" onInput="alert('hola')" size="10" maxlength="10"  readonly />
                          
                           <label></label>
                         </span></td>
                       </tr>
                       <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">Horario:</td>
                      <td width="550" align="left" valign="middle">
                      <div id="horarios">          </div>                      </td>
                       </tr>
                         <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">DNI :</td>
                           <td width="550" align="left" valign="middle"><input name="txt_documento" type="text" class="datos" id="txt_documento" tabindex="2" onKeyPress="return tabular(event,this)" size="15" maxlength="11"  /></td>
                       </tr>
                       <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">Apellido:</td>
                           <td width="550" align="left" valign="middle"><span class="style17">
                             <input name="txt_apellido" type="text" class="datos" id="txt_apellido" tabindex="3" onKeyPress="return tabular(event,this)"   size="50" maxlength="50" />
                           </span></td>
                       </tr>
                         <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">Nombre:</td>
                         <td width="550" align="left" valign="middle"><input name="txt_nombre" type="text" class="datos" id="txt_nombre" tabindex="2" onKeyPress="return tabular(event,this)" size="50" maxlength="50" /></td>
                       </tr>
                         <tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">Telefono:</td>
                           <td width="550" align="left" valign="middle"><span class="style17">
                             <input name="txt_telefono" type="text" class="datos" id="txt_telefono" tabindex="3" onKeyPress="return tabular(event,this)"   size="50" maxlength="50" />
                           </span></td>
                       </tr><tr>
                           <td width="190" align="left" valign="middle" class="etiquetas">E-Mail:</td>
                      <td width="550" align="left" valign="middle"><span class="style17">
                        <input name="txt_email" type="text" class="datos" id="txt_email" tabindex="3" onKeyPress="return tabular(event,this)"   size="50" maxlength="50" />
                        <label></label>
                      </span></td>
                       </tr>
                       <tr>
                         <td align="left" valign="middle" class="etiquetas">&nbsp;</td>
                         <td align="left" valign="middle"><label>
                           <input type="submit" name="button" id="button" value="Confirmar">
                         </label></td>
                       </tr>
                     </table></td>
                   </tr>
                 </table>
             </form></td>
         </tr>
         <?php if (isset($_GET['id'])){ //si se esta creando vehiculo no muestra controles ?>
           
     <tr align="left" valign="middle">
       <td height="50" class="sub_titulopantalla" >&nbsp;</td>
     </tr>
       </table></td>
     </tr>
     <?php }//fin si existe la matricula?>
   </table>
</body>
</html>
