<?php
include("../inc/AuthLogin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .main-container {
            min-height: calc(100vh - 100px);
        }
    </style>
</head>
<body>

    <div class="container mt-3">
        <table width="100" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50" align="center" valign="middle"><img src="../images/logo_enc.png" width="200" alt="" /></td>
          </tr>
        </table>
        <div class="row mb-4">
            <div class="col-12 text-start">
                <a href="../mod_info/bandeja_entrada.php" class="btn btn-secondary btn-sm shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Volver a la bandeja
                </a>
            </div>
            <div>
                <hr class="mt-3 mb-0">
            </div>
        </div>

        <div class="row justify-content-center align-items-center main-container">
            <div class="col-11 col-sm-8 col-md-6 col-lg-4">
                
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Generar nuevo usuario</h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action=""> 
                            <div class="mb-3">
                                <label for="txt_usuario" class="form-label fw-bold">Nombre de Usuario</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user text-muted"></i></span>
                                    <input name="txt_usuario" type="text" class="form-control" id="txt_usuario" placeholder="Ej: admin_sistema" maxlength="50" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="txt_clave" class="form-label fw-bold">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                                    <input name="txt_clave" type="password" class="form-control" id="txt_clave" placeholder="••••••••" maxlength="15" required>
                                </div>
                                <div class="form-text text-muted">Máximo 15 caracteres.</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button name="btnGenerar" type="submit" id="btnGenerar" class="btn btn-primary btn-lg shadow-sm">
                                    <i class="fas fa-save me-2"></i>Crear usuario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
        if (isset($_POST['btnGenerar'])) {
            require_once ('generar_usuario.php');
            $usuario = $_POST['txt_usuario'];
            $contrasenia = $_POST['txt_clave'];

            if (generar_usuario($usuario, $contrasenia)) {
                echo "<script>
                    alert('Usuario generado exitosamente.');
                    window.location.href = window.location.href;
                </script>";
            } else {
                echo "<script>alert('Error al generar el usuario.');</script>";
            }
        }
    ?>

</body>
</html>