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
$estado = $_GET['estado'];
$id_actividad = base64_decode($_GET['id']);

$link_deportes = Conexion();
$stmt = $link_deportes->prepare("UPDATE actividades SET activo = ? WHERE id_actividad = ?");
$stmt->bind_param('ii', $estado, $id_actividad);
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