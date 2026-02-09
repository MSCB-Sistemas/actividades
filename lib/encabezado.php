<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
            <td align="right" valign="bottom">
              <span class="titulo_menu">
                <span class="style6">
                  <span class="Estilo3">Usuario: </span>
                  <?php if (isset($_SESSION['us'])) echo $_SESSION['us']; else echo "No encontrado"; ?>
                </span>
              </span>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>