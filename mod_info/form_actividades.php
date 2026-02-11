<?php
include("../lib/funciones.php");
include("../inc/conexion.php");
$link_deportes = Conexion();
$query_lugares = "SELECT id_lugar, nombre, direccion FROM lugares WHERE activo = 1 ORDER BY nombre";
$recordset_lugares = mysqli_query($link_deportes, $query_lugares);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crear nueva actividad</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <style>
        body { background-color: #FFF4E5; font-size: 0.85rem; color: #333; }
        .main-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            padding: 25px;
            margin: 20px auto;
            max-width: 850px;
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
    <div class="container">
        <div class="card">
            <div class="card-header text-center mb-3 card-actividad" id="card-actividad">
                <h6 class="mt-2 font-weight-bold">Crear nueva actividad</h6>
            </div>
            <div class="card-body">

                <form action="procesa_nueva_actividad.php" method="POST" id="form1" name="form1" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Actividad</label>
                            <input type="text" class="form-control form-control-sm" name="txt_actividad" placeholder="Nombre de la actividad" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Año Desde</label>
                            <input type="number" class="form-control form-control-sm" name="txt_anio_desde" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Año Hasta</label>
                            <input type="number" class="form-control form-control-sm" name="txt_anio_hasta" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Período</label>
                            <input type="text" class="form-control form-control-sm" name="txt_periodo" id="txt_periodo" required>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Horarios</label>
                            <input type="text" class="form-control form-control-sm" name="txt_horarios" required>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Cupo</label>
                            <input type="number" class="form-control form-control-sm" name="txt_cupo" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label>Tipo</label>
                            <select class="form-control form-control-sm" name="txt_tipo" required>
                                <option value="" disabled selected>-</option>
                                <option>ARANCELADA</option>
                                <option>GRATUITA</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Grupo</label>
                            <input type="text" class="form-control form-control-sm text-uppercase" name="txt_grupo" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Lugar:</label>
                        <div class="col-sm-10">
                            <select name="txt_lugar" id="txt_lugar" class="form-control form-control-sm" onchange="actividades();" required>
                                <option value="" disabled selected>Seleccione el lugar...</option>
                                <?php while ($row = mysqli_fetch_assoc($recordset_lugares)): ?>
                                    <option value="<?= $row['id_lugar'] ?>"><?= htmlspecialchars($row['nombre']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4 pt-2 border-top">
                        <button type="submit" class="btn btn-primary px-5 btn-sm font-weight-bold">Crear Actividad</button>
                        <div class="mt-2">
                            <a href="https://www.bariloche.gov.ar/" class="text-danger small font-weight-bold">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>