<?php
include("../../inc/AuthLogin.php");
require_once ('../../inc/conexion.php');

error_reporting(0);

function buscar_lugar($id_lugar) {
    $conexion = Conexion();

    $sql = "SELECT id_lugar, nombre, direccion, activo FROM lugares WHERE id_lugar = $id_lugar ORDER BY nombre";
    $result = mysqli_query($conexion, $sql);

    return $result;
}

if (isset($_GET['id_lugar'])) {
    $id_lugar = base64_decode($_GET['id_lugar']);
    $lugar = mysqli_fetch_assoc(buscar_lugar($id_lugar));
} else {
    echo "<script>alert('ID de lugar no proporcionado'); window.location.href='../tablas_actividades_lugares.php';</script>";
    exit;
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style> body { font-family: sans-serif; background-color: #f4f4f4; } </style>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <title>Formulario de Lugar</title>

        <style>
            body { padding: 20px; background-color: #f8f9fa; }
            .card { box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
            .etiquetas_tabla { font-size: 0.85em; background-color: #e9ecef !important; }

            #tabla_actividades {
                font-size: 0.85rem;
            }

            #tabla_actividades th, 
            #tabla_actividades td {
                padding-top: 5px;
                padding-bottom: 5px;
                vertical-align: middle;
            }
            
            #tabla_actividades .btn {
                padding: 2px 8px;
                font-size: 0.8rem;
            }

            #card_lugar {
                font-size: 0.85rem;
                background-color: #007bff !important;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <table width="100" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50" align="center" valign="middle"><img src="../../images/logo_enc.png" width="200" alt="" /></td>
            </tr>
        </table>
        <div class="row mb-4">
            <div class="col-12 text-start">
                <a href="../tablas_actividades_lugares.php" class="btn btn-secondary btn-sm shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Volver a la bandeja
                </a>
            </div>
            <div>
                <hr class="mt-3 mb-0">
            </div>
        </div>

        <form method="POST">
            <div class="card mb-4 col-sm-12">
                <div class="card-header" id="card_lugar">
                    <h5 class="mb-0">Editar lugar</h5>
                </div>
                <div class="card-body">
                    
                    <!-- Campo oculto para pasar la ID-->
                    <input type="hidden" class="form-control" id="id_lugar" name="id_lugar" value="<?php echo $id_lugar; ?>" readonly>
                    
                    <div class="mb-3">
                        <label for="nombre_lugar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_lugar" name="nombre_lugar" value="<?php echo $lugar['nombre']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $lugar['direccion']; ?>" required>
                    </div>
                    <div align="left">
                        <button name="btnEditarLugar" type="submit" id="btnEditarLugar" class="btn btn-primary btn-sm shadow-sm">
                            <i class="fas fa-save me-2"></i>Guardar cambios
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Procesar la actualización del lugar -->
        <?php
            if (isset($_POST['btnEditarLugar'])) {
                $conexion = Conexion();

                $nombre_lugar = $_POST['nombre_lugar'];
                $direccion = $_POST['direccion'];
                $id_lugar = $_POST['id_lugar'];

                $sql = "UPDATE lugares SET nombre=?, direccion=? WHERE id_lugar=?";

                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "ssi", $nombre_lugar, $direccion, $id_lugar);
                $query = mysqli_stmt_execute($stmt);

                if ($query) {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: '¡Actualizado!',
                                text: 'El lugar se actualizó correctamente.',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href='../tablas_actividades_lugares.php'; 
                                }
                            });
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo actualizar el lugar.',
                                confirmButtonText: 'Intentar de nuevo'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.history.back();
                                }
                            });
                          </script>";
                }
            }
        ?>
        <!-- Fin del proceso -->
    </body>
</html>