<?php
include("../../inc/AuthLogin.php");
require_once ('../../inc/conexion.php');
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

        <title>Actualizando estado del lugar...</title>
    </head>
    <body>
        <?php
            function desactivar_lugar($id_lugar) {
                $conexion = Conexion();
                $sql = "UPDATE lugares SET activo = 0 WHERE id_lugar = ?";
                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id_lugar);
                return mysqli_stmt_execute($stmt);
            }

            function activar_lugar($id_lugar) {
                $conexion = Conexion();
                $sql = "UPDATE lugares SET activo = 1 WHERE id_lugar = ?";
                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id_lugar);
                return mysqli_stmt_execute($stmt);
            }

            if (isset($_GET['id_lugar']) && isset($_GET['estado'])) {
                $id_lugar = base64_decode($_GET['id_lugar']);
                $estado = $_GET['estado'];

                if ($estado == '0') {
                    $query = desactivar_lugar($id_lugar);

                    if ($query) {
                        echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Desactivado!',
                                    text: 'El lugar se desactivó correctamente.',
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
                                    text: 'No se pudo desactivar el lugar.',
                                    confirmButtonText: 'Intentar de nuevo'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.history.back();
                                    }
                                });
                            </script>";
                    }
                } else if ($estado == '1') {
                    $query = activar_lugar($id_lugar);

                    if ($query) {
                        echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Activado!',
                                    text: 'El lugar se activó correctamente.',
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
                                    text: 'No se pudo activar el lugar.',
                                    confirmButtonText: 'Intentar de nuevo'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.history.back();
                                    }
                                });
                            </script>";
                    }
                } else {
                    echo "<script>alert('Estado no válido'); window.location.href='../tablas_actividades_lugares.php';</script>";
                    exit;
                }
            } else {
                echo "<script>alert('ID de lugar no proporcionado'); window.location.href='../tablas_actividades_lugares.php';</script>";
            }
        ?>
    </body>
</html>