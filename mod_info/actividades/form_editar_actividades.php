<?php
include("../../inc/AuthLogin.php");
include("../../lib/funciones.php");
include("../../inc/conexion.php");
$link_deportes = Conexion();
$query_lugares = "SELECT id_lugar, nombre, direccion FROM lugares WHERE activo = 1 ORDER BY nombre";
$recordset_lugares = mysqli_query($link_deportes, $query_lugares);
$id_actividad = base64_decode($_GET['id']);
$query_actividad = "SELECT * FROM actividades WHERE id_actividad = $id_actividad";
$recordset_actividad = mysqli_query($link_deportes, $query_actividad)->fetch_assoc();
?>
<!doctype html>
<html lang="es">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editar actividad</title>
    
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    
    <style>
        body { background-color: #FFF4E5; font-size: 0.85rem; color: #333; }
        .main-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            padding: 25px;
            margin: 20px auto;
            /* max-width: 850px; */
        }
        .section-header {
            background-color: #FFF0D9;
            padding: 5px 12px;
            border-left: 4px solid #FF8C00;
            margin: 15px 0;
            font-weight: bold;
            color: #D35400;
            text-transform: uppercase;
        }
        .card-actividad{
            font-size: 0.85rem;
            background-color: #007bff;
            color: #fff;
        }
        .form-group { margin-bottom: 0.75rem; }
        label { font-weight: 600; margin-bottom: 2px; }
        .form-control-sm { height: 30px; }
        
        #actividades, #anios { display: none; }
        .show-box { display: block !important; margin-top: 10px; }
        .file-label { font-size: 0.75rem; color: #666; display: block; }
    </style>

    <script src="jscripts/js/jquery-1.4.4.min.js"></script>
</head>
<body>
    <table width="100" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="50" align="center" valign="middle"><img src="../../images/logo_enc.png" width="200" alt="" /></td>
        </tr>
    </table>
    <div class="row mb-1">
        <div class="col-12 text-start">
            <a href="../tablas_actividades_lugares.php" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Volver a la bandeja
            </a>
        </div>
    </div>
        <div>
            <hr class="mb-3">
        </div>
    <!-- <div class="container"> -->
        <div>
        <form action="procesa_editar_actividad.php" method="POST" id="form1" name="form1" enctype="multipart/form-data">       
            <input type="hidden" name="id_actividad" value="<?= $_GET['id'] ?>">
            <div class="card">
                <div class="card-header text-center mb-3 card-actividad" id="card-actividad">
                    <h6 class="mt-2 font-weight-bold">Editar actividad</h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Actividad</label>
                            <input type="text" class="form-control form-control-sm" name="txt_actividad" placeholder="Nombre de la actividad" value="<?= htmlspecialchars($recordset_actividad['actividad']) ?>" required>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Año Desde</label>
                            <input type="number" class="form-control form-control-sm" name="txt_anio_desde" value="<?= htmlspecialchars($recordset_actividad['anio_desde']) ?>" required>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Año Hasta</label>
                            <input type="number" class="form-control form-control-sm" name="txt_anio_hasta" value="<?= htmlspecialchars($recordset_actividad['anio_hasta']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Período</label>
                            <input type="text" class="form-control form-control-sm" name="txt_periodo" id="txt_periodo" value="<?= htmlspecialchars($recordset_actividad['periodo']) ?>" required>
                        </div>
                        <div class="col-md-5 form-group">
                            <label>Horarios</label>
                            <input type="text" class="form-control form-control-sm" name="txt_horarios" value="<?= htmlspecialchars($recordset_actividad['horarios']) ?>" required>
                        </div>
                        <div class="col-md-1 form-group">
                            <label>Cupo</label>
                            <input type="number" class="form-control form-control-sm" name="txt_cupo" value="<?= htmlspecialchars($recordset_actividad['cupo']) ?>" required>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Tipo</label>
                            <select class="form-control form-control-sm" name="txt_tipo" required>
                                <option value="" disabled selected>Seleccione tipo...</option>
                                <option <?= ($recordset_actividad['tipo'] == 'ARANCELADA') ? 'selected' : '' ?>>ARANCELADA</option>
                                <option <?= ($recordset_actividad['tipo'] == 'GRATUITA') ? 'selected' : '' ?>>GRATUITA</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>Grupo</label>
                            <input type="text" class="form-control form-control-sm text-uppercase" name="txt_grupo" value="<?= htmlspecialchars($recordset_actividad['grupo']) ?>" required>
                        </div>
                        <div class="col-sm-6">
                            <label>Lugar</label>
                            <select name="txt_lugar" id="txt_lugar" class="form-control form-control-sm" onchange="actividades();" required>
                                <option value="" disabled selected>Seleccione el lugar...</option>
                                <?php while ($row = mysqli_fetch_assoc($recordset_lugares)): ?>
                                    <option <?= ($recordset_actividad['lugar'] == $row['id_lugar']) ? 'selected' : '' ?> value="<?= $row['id_lugar'] ?>"><?= htmlspecialchars($row['nombre']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4 pt-2 border-top">
                        <button type="submit" class="btn btn-primary px-5 btn-sm font-weight-bold">Guardar cambios</button>
                        <div class="mt-2">
                            <a href="../tablas_actividades_lugares.php" class="text-danger small font-weight-bold">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>