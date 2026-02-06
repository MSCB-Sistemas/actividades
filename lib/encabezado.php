<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Untitled Document</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style type="text/css">
    <!--
    body {
      margin-left: 0px;
      margin-top: 0px;
      margin-right: 0px;
      margin-bottom: 0px;
    }
    -->
  </style>
  <link href="../css/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>

  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="440" align="left" valign="middle">
        <table width="100" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50" align="center" valign="middle"><img src="../images/logo_enc.png" width="200" alt="" /></td>
          </tr>
        </table>
      </td>
      <td valign="top" class="style2">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td align="left" valign="bottom" class="titulo_menu">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="bottom"><span class="titulo_menu"><span class="style6"><span
                    class="Estilo3">Usuario: </span><?php
                    $nom_completo = trim(utf8_encode($_SESSION['ses_apellido']) . ", " . utf8_encode($_SESSION['ses_nombre']));
                    echo ltrim($nom_completo, ", ");
                    ?></span></span></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#5B6946">
      <td height="5"></td>
      <td height="5" valign="top" class="style2"></td>
    </tr>
  </table>
</body>

</html>