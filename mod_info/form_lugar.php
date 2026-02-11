<?php
include("../inc/AuthLogin.php");
require_once ('../inc/conexion.php');
?>
<html>
    <head>

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
                <td width="50" align="center" valign="middle"><img src="../images/logo_enc.png" width="200" alt="" /></td>
            </tr>
        </table>
        <div class="row mb-4">
            <div class="col-12 text-start">
                <a href="tablas_actividades_lugares.php" class="btn btn-secondary btn-sm shadow-sm">
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
                    <h5 class="mb-0">Crear nuevo lugar</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nombre_lugar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_lugar" name="nombre_lugar" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div align="left">
                        <button name="btnGenerarLugar" type="submit" id="btnGenerarLugar" class="btn btn-primary btn-sm shadow-sm">
                            <i class="fas fa-save me-2"></i>Guardar nuevo lugar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>

<?php
    if (isset($_POST['btnGenerarLugar'])) {
        $conexion = Conexion();

        $nombre_lugar = $_POST['nombre_lugar'];
        $direccion = $_POST['direccion'];

        $sql = "INSERT INTO lugares (nombre, direccion, activo) VALUES ('$nombre_lugar', '$direccion', 1)";
        mysqli_query($conexion, $sql);

        echo "<script>alert('Nuevo lugar creado: $nombre_lugar');</script>";
    }
?>