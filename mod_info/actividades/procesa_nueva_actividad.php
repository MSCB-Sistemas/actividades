<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style> body { font-family: sans-serif; background-color: #f4f4f4; } </style>
</head>
<body>

<?php
include("../../inc/AuthLogin.php");
include("../../lib/funciones.php");
include("../../inc/conexion.php");

$actividad = strtoupper($_POST['txt_actividad']);
$anio_desde = $_POST['txt_anio_desde'];
$anio_hasta = $_POST['txt_anio_hasta'];
$periodo = strtoupper($_POST['txt_periodo']);
$horarios = strtoupper($_POST['txt_horarios']);
$cupo = $_POST['txt_cupo'];
$tipo = $_POST['txt_tipo'];
$grupo = strtoupper($_POST['txt_grupo']);
$lugar = $_POST['txt_lugar'];

$link_deportes = Conexion();
$siguiente_id = $link_deportes->query("SELECT max(id_actividad) + 1 FROM actividades")->fetch_row()[0];
$stmt = $link_deportes->prepare("INSERT INTO actividades (id_actividad, actividad, anio_desde, anio_hasta, periodo, horarios, cupo, tipo, grupo, lugar, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
$stmt->bind_param('isiississi',$siguiente_id, $actividad, $anio_desde, $anio_hasta, $periodo, $horarios, $cupo, $tipo, $grupo, $lugar);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Guardado!',
                text: 'La actividad se registró correctamente.',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../tablas_actividades_lugares.php'; 
                }
            });
          </script>";
} else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo guardar la actividad.',
                confirmButtonText: 'Intentar de nuevo'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
          </script>";
}

$stmt->close();
?>

</body>
</html>