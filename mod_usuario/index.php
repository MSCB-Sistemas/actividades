<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Sistema Administrativo</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/estilos.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <div class="row align-items-center mb-4">
              <div class="col-12 text-center">
                <div class="d-inline-flex align-items-center">
                  <img src="../images/logo.png" alt="Logo" width="70" height="70" class="me-2">
                  <h3 class="card-title mb-0">Actividades Deportivas</h3>
                </div>
              </div>
            </div>
            <form name="form1" method="post" action="login.php">
              <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input name="usuario" type="text" class="form-control" id="usuario" maxlength="50" required>
              </div>
              <div class="mb-3">
                <label for="clave" class="form-label">Contraseña</label>
                <input name="clave" type="password" class="form-control" id="clave" maxlength="10" required>
              </div>
              <div class="d-grid gap-2 mb-2">
                <button name="btnLogin" type="submit" id="btnLogin3" class="btn btn-primary">Entrar</button>
              </div>
                <?php
                if (isset($_GET['error']) && $_GET['error'] == '1') {
                  echo '<div class="alert alert-danger text-center mt-2">Usuario o contraseña incorrectos</div>';
                }
                ?>
            </form>
          </div>
        </div>
        <div class="text-center mt-3">
          <span class="text-muted">Para un correcto funcionamiento utilizar Navegador Google Chrome </span>
          <img src="../images/logo_chrome.jpg" width="30" height="31" alt="Chrome">
        </div>
      </div>
    </div>
  </div>
</body>

</html>