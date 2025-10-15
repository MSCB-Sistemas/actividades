<?php 
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
if ($_SESSION['permiso'] != 'autorizado' ){
	$mensaje="Usuario sin permisos";
	$destino="index.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
//--------------------------------Fin inicio de sesion------------------------


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Usuario</title>

<link href="../css/estilos.css" rel="stylesheet" type="text/css">

<script language='javascript' src="../jscripts/funciones.js"></script>
<script type="text/javascript">

//---------------------Verificar abandono de la pagina-------------------//
var bPreguntar = true;
     
    window.onbeforeunload = preguntarAntesDeSalir;
     
    function preguntarAntesDeSalir()
    {
      if (bPreguntar)
        return "";
    }
//------------------Fin verificar abandono--------------------------//

function vacio(q) {  
        for ( i = 0; i < q.length; i++ ) {  
                if ( q.charAt(i) != " " ) {  
                        return true  
                }  
        }  
        return false  
}
//-------------Validaciones del formulario---------------------------//
function validar(frm) {

   if ( document.form1.txt_clave.value != document.form1.txt_clave2.value ){
  		alert("La clave ingresada y su repetición no coinciden"); 
		document.form1.txt_clave.focus();
  		return (false); 
  	}
	
	if (vacio(document.form1.txt_clave.value)== false | document.form1.txt_clave.value.length<=3 ){
  		alert("Debe ingresar la nueva clave"); 
		document.form1.txt_clave.focus();
  		return (false); 
  	}
	
	if (vacio(document.form1.txt_clave2.value)== false | document.form1.txt_clave2.value.length<=3 ){
  		alert("Debe repetir la clave"); 
		document.form1.txt_clave2.focus();
  		return (false); 
  	}
	
		  if (!confirm('¿Confirma el registro del certificado?')){   
	   return (false); 
   }
}


</script>

<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
</head>


<body class="estilo_body">

<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#DBDBDB">
 <tr>
  <td width="770"><?php include("../lib/encabezado.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../lib/barra_menu_standard.php"); ?></td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6" class="titulos_pantalla">Cambio de clave del usuario </td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6"><table width="770" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><span class="etiquetas">Máximo 10 caracteres, hace diferencia entre mayusculas y minusculas </span></td>
      </tr>
      <tr>
        <td><form id="form1" name="form1" method="get" onsubmit="return validar(this)" action="procesa_cambio_clave.php" >
            <table width="770" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="middle" bgcolor="#D3DBE2"><table width="400" border="0" align="left" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF">
                    <tr>
                      <td width="150" align="left" valign="middle" bgcolor="#D3DBE2" class="etiquetas">Nueva clave :</td>
                      <td width="250" align="left" valign="middle" bgcolor="#D3DBE2"><input name="txt_clave" type="text" id="txt_clave" size="10" maxlength="10" onkeypress="return tabular(event,this)" /></td>
                    </tr>
                    <tr>
                      <td width="150" align="left" valign="middle" bgcolor="#D3DBE2" class="etiquetas"><label>Repetir clave: </label></td>
                      <td width="250" align="left" valign="middle" bgcolor="#D3DBE2"><input name="txt_clave2" type="text" id="txt_clave2" size="10" maxlength="10"  onkeypress="return tabular(event,this)"/></td>
                    </tr>
                    <tr>
                      <td width="150" align="left" valign="middle" bgcolor="#D3DBE2" class="etiquetas">&nbsp;</td>
                      <td width="250" align="left" valign="middle" bgcolor="#D3DBE2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150" align="left" valign="middle" bgcolor="#D3DBE2" class="etiquetas"><input type="submit" name="Submit" value="Aceptar" onclick="bPreguntar = false;" /></td>
                      <td width="250" align="left" valign="middle" bgcolor="#D3DBE2"><label></label></td>
                    </tr>
                </table></td>
              </tr>
            </table>
        </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
