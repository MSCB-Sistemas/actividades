<?php
include("lib/funciones.php");
include("inc/conexion.php");
$link_deportes = Conexion();
$query_lugares = "SELECT id_lugar, nombre, direccion FROM lugares WHERE activo = 1 ORDER BY nombre";
$recordset_lugares = mysqli_query($link_deportes, $query_lugares);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inscripción - Bariloche</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
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
        .form-group { margin-bottom: 0.75rem; }
        label { font-weight: 600; margin-bottom: 2px; }
        .form-control-sm { height: 30px; }
        
        #actividades, #anios { display: none; }
        .show-box { display: block !important; margin-top: 10px; }
        .file-label { font-size: 0.75rem; color: #666; display: block; }
    </style>

    <script src="jscripts/js/jquery-1.4.4.min.js"></script>
    <script>
        function actividades() {
            var lugarId = $('#txt_lugar').val();
            if (lugarId) {
                $('#actividades').load('actividades.php?txt_lugar=' + lugarId, function() {
                    $(this).addClass('show-box');
                });
            }
        }
        function anios() {
            var actividadId = $('#txt_actividad').val();
            if (actividadId) {
                $('#anios').load('anios.php?txt_actividad=' + actividadId, function() {
                    $(this).addClass('show-box');
                });
            }
        }
        function actualizarAnio(fecha) {
            if (fecha) document.getElementById('txt_anio').value = fecha.split('-')[0];
        }
    </script>
</head>
<body>

<div class="container">
    <div class="main-card">
        <div class="text-center mb-3">
            <img src="images/encabezado.jpg" alt="Logo" class="img-fluid" style="max-height: 45px;">
            <h6 class="mt-2 font-weight-bold">Preinscripción - Gimnasio Nro 5</h6>
            <hr class="my-2">
        </div>

        <form action="procesa_inscripcion.php" method="POST" id="form1" name="form1" enctype="multipart/form-data">
            
            <div class="section-header">1. Datos del ingresante</div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>DNI</label>
                    <input type="number" class="form-control form-control-sm" name="txt_documento" placeholder="DNI sin puntos ni espacios" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Apellido</label>
                    <input type="text" class="form-control form-control-sm text-uppercase" name="txt_apellido" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control form-control-sm text-uppercase" name="txt_nombre" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Fecha Nacimiento</label>
                    <input type="date" class="form-control form-control-sm" name="txt_fecha" id="txt_fecha" onchange="actualizarAnio(this.value)" required>
                    <input type="hidden" name="txt_anio" id="txt_anio">
                </div>
                <div class="col-md-2 form-group">
                    <label>Sexo</label>
                    <select class="form-control form-control-sm" name="txt_sexo" required>
                        <option value="" disabled selected>-</option>
                        <option>Masculino</option>
                        <option>Femenino</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label>Teléfono</label>
                    <input type="tel" class="form-control form-control-sm" name="txt_telefono" required>
                </div>
                <div class="col-md-3 form-group">
                    <label>E-mail</label>
                    <input type="email" class="form-control form-control-sm" name="txt_email" required>
                </div>
            </div>

            <div class="section-header">2. Documentación ingresante</div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="file-label">DNI Frente</label>
                    <input type="file" name="img_documento_frente" class="form-control-file border p-1" required>
                </div>
                <div class="col-md-4 form-group">
                    <label class="file-label">DNI Dorso</label>
                    <input type="file" name="img_documento_dorso" class="form-control-file border p-1" required>
                </div>
                <div class="col-md-4 form-group">
                    <label class="file-label">Aptitud Médica</label>
                    <input type="file" name="img_certificado" class="form-control-file border p-1" required>
                </div>
            </div>

            <div class="section-header">3. Responsable de Pago</div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label>CUIL</label>
                    <input type="number" class="form-control form-control-sm" name="txt_cuil" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Apellido Resp.</label>
                    <input type="text" class="form-control form-control-sm text-uppercase" name="txt_apellido_responsable" required>
                </div>
                <div class="col-md-5 form-group">
                    <label>Nombre Resp.</label>
                    <input type="text" class="form-control form-control-sm text-uppercase" name="txt_nombre_responsable" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="file-label">DNI Frente Responsable</label>
                    <input type="file" name="img_documento_frente_responsable" class="form-control-file border p-1" required>
                </div>
                <div class="col-md-6 form-group">
                    <label class="file-label">DNI Dorso Responsable</label>
                    <input type="file" name="img_documento_dorso_responsable" class="form-control-file border p-1" required>
                </div>
            </div>

            <div class="section-header">4. Selección de Actividad</div>
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
            <div id="actividades"></div>
            <div id="anios"></div>

            <div class="text-center mt-4 pt-2 border-top">
                <button type="submit" class="btn btn-primary px-5 btn-sm font-weight-bold">CONFIRMAR INSCRIPCIÓN</button>
                <div class="mt-2">
                    <a href="index.php" class="text-danger small font-weight-bold">CANCELAR</a>
                </div>
            </div>

        </form>
    </div>
</div>

</body>
</html>