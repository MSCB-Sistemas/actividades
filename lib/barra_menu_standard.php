<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
  <table width="100%">
    <tr class="borde_menu">
      <td height="50" width="8%">
        <button class="btn btn-danger btn-sm" onclick="cerrarSesion()">Cerrar sesión</button>
      </td>
      <td>
        <a href="form_nueva_actividad.php">
          <button class="btn btn-primary btn-sm">Actividades/lugares</button>
        </a>
      </td>
    </tr>
  </table>
</body>

</html>

<script type="text/javascript">
  function cerrarSesion() {
    window.location = "../mod_usuario/logout.php";
  }
</script>