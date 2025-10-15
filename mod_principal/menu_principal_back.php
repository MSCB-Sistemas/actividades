<?php
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 


//--------------------------------Fin inicio de sesion------------------------

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Men&uacute; pricipal</title>

<link href="../css/estilos.css" rel="stylesheet" type="text/css">


</head>

<body class="estilo_body_2" >
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="770" align="left" valign="middle"><?php include("../lib/encabezado.php"); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="titulos_pantalla">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle">
	
		<table width="100%" border="0" bgcolor="#FFFFFF">      		
<tr>
				<td><a href="../mod_usuario/frm_cambio_clave.php" class="etiquetas">Cambiar clave</a></td>
		  </tr>
			  <tr>
				<td align="left" valign="middle">&nbsp;</td>
			  </tr>
			 <tr>
				<td><table width="50%" border="0">
                
                  <tr>
                    <td align="left" valign="bottom" class="borde_menu"><a href="../mod_turnos/listado_turnos.php" class="enlace_grande">
                      <?php if ($_SESSION['tipo_usuario'] == "admin" ){ ?>
                      Turnos
                      <?php }?>
                    </a></td>
                  </tr>
               </table></td>
		  </tr>
          <tr>
				<td>
                
                <table width="50%" border="0">
                  <tr>
                    <td align="left" valign="bottom" class="borde_menu"><a href="../mod_turnos/frm_turno.php" class="enlace_grande">
                      <?php if ($_SESSION['tipo_usuario'] == "admin" ){ ?>
                      Solicitar turno
                      <?php }?>
                    </a></td>
                  </tr>
               </table>
                </td>
		  </tr>
          
          <tr>
				<td>
                
                <table width="50%" border="0">
                  <tr>
                    <td align="left" valign="bottom" class="borde_menu"><a href="../mod_administrador/administrar_calendario.php" class="enlace_grande">
                      <?php if ($_SESSION['tipo_usuario'] == "admin" ){ ?>
                      Administrar calendario
                      <?php }?>
                    </a></td>
                  </tr>
               </table>
                </td>
		  </tr>
          <tr>
				<td><table width="50%" border="0">
                  <tr>
                    <td align="left" valign="bottom" class="borde_menu">&nbsp;</td>
                  </tr>
            </table></td>
		  </tr>
		  <tr>
			<td align="left" valign="bottom"><a href="../mod_usuario/logout.php" class="etiquetas"><img src="../images/salir.gif"  border="0" title="Salir del sistema"/></a></td>
		  </tr>
		  <tr>
		    <td class="titulos_pantalla">&nbsp;</td>
		  </tr>
		</table>	</td>
  </tr>
</table>
</body>
</html>
