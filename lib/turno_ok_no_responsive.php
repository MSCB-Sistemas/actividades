<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mensaje</title>
<style type="text/css">
<!--
.style5 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style17 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>


	  



<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style18 {font-size: 12px; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<body>

<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
  <td width="770"><table width="770" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><?php //include("inc/encabezado.php"); ?></td>
    </tr>
  </table></td>
  </tr>
  <tr>
    <td><table width="770" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="left" valign="middle" class="titulo_menu">Comprobante de solicitud de turno</td>
      </tr>
      <tr>
        <td height="30" align="left" valign="middle" ><table width="650" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="150" class="etiquetas">Apellido:</td>
            <td class="datos"><?php echo $apellido; ?></td>
          </tr>
          <tr>
            <td width="150" class="etiquetas">Nombre:</td>
            <td class="datos"><?php echo $nombre; ?></td>
          </tr>
          <tr>
            <td width="150" class="etiquetas">DNI:</td>
            <td class="datos"><?php echo $dni; ?></td>
          </tr>
          <tr>
            <td width="150" class="etiquetas">Fecha:</td>
            <td class="datos"><?php echo $fecha_comprobante; ?></td>
          </tr>
          <tr>
            <td width="150" class="etiquetas">Hora:</td>
            <td class="datos"><?php echo $horario_comprobante; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="30" align="left" valign="middle" ><table width="650" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><label>
              <a href="<?php echo $destino;?>"><input type="button" name="button" id="button" value="Continuar" /></a>
            </label></td>
            <td><label>
              <input type="button" name="button2" id="button2" value="Imprimir" onclick="window.print();" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
