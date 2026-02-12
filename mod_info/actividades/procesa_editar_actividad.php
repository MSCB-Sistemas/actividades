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
include("../../lib/funciones.php");
include("../../inc/conexion.php");

$id_actividad = base64_decode($_POST['id_actividad']);
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
$stmt = $link_deportes->prepare("UPDATE actividades SET actividad = ?, anio_desde = ?, anio_hasta = ?, periodo = ?, horarios = ?, cupo = ?, tipo = ?, grupo = ?, lugar = ?, activo = 1 WHERE id_actividad = ?");
$stmt->bind_param('siississii', $actividad, $anio_desde, $anio_hasta, $periodo, $horarios, $cupo, $tipo, $grupo, $lugar, $id_actividad);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Guardado!',
                text: 'La actividad se actualizó correctamente.',
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
                text: 'No se pudo actualizar la actividad.',
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