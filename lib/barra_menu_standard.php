<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
  <div class="row mb-4">
    <div class="col-12 text-start">
      <a>
        <button class="btn btn-danger btn-sm" onclick="cerrarSesion()"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>
      </a>
      <a href="tablas_actividades_lugares.php">
        <button class="btn btn-primary btn-sm"><i class="fas fa-table"></i> Actividades/lugares</button>
      </a>
      <!-- <a href="../mod_usuario/form_generar_usuario.php">
        <button class="btn btn-primary btn-sm"><i class="fas fa-user-plus"></i> Generar nuevo usuario</button>
      </a> -->
    </div>
    <div>
      <hr class="mt-3 mb-0">
    </div>
  </div>
</body>
</html>

<script type="text/javascript">
  function cerrarSesion() {
    window.location = "../mod_usuario/logout.php";
  }
</script>