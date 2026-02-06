<?php
error_reporting(0);
//--------------------------------Inicio de sesion------------------------
include("../lib/sesion.php"); 
//--------------------------------Fin inicio de sesion------------------------

include("../lib/funciones.php");
include("../inc/conexion.php");

$link = Conexion();
mysqli_set_charset($link, "utf8")
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandeja de entrada</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="../css/estilos.css" rel="stylesheet" type="text/css">

    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .etiquetas_tabla {
            font-size: 0.85em;
            background-color: #e9ecef !important;
        }

        #tabla_expedientes {
            font-size: 0.85rem;
        }

        #tabla_expedientes th,
        #tabla_expedientes td {
            padding-top: 5px;
            padding-bottom: 5px;
            vertical-align: middle;
        }

        #tabla_expedientes .btn {
            padding: 2px 8px;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>

    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-12">
                <?php include("../lib/encabezado.php"); ?>
                <?php include("../lib/barra_menu_standard.php"); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mb-3">Bandeja de entrada</h3>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="bandeja_entrada.php" method="post" name="form1" id="form1">
                            <div class="row align-items-end">
                                <div class="col-md-3">
                                    <label for="txt_fecha_desde" class="form-label">Fecha desde:</label>
                                    <input name="txt_fecha_desde" type="date" class="form-control" id="txt_fecha_desde"
                                        value="<?php echo isset($_POST['txt_fecha_desde']) ? $_POST['txt_fecha_desde'] : ''; ?>">
                                </div>

                                <div class="col-md-3">
                                    <label for="txt_fecha_hasta" class="form-label">Fecha hasta:</label>
                                    <input name="txt_fecha_hasta" type="date" class="form-control" id="txt_fecha_hasta"
                                        value="<?php echo isset($_POST['txt_fecha_hasta']) ? $_POST['txt_fecha_hasta'] : ''; ?>">
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" name="button" id="button3" class="btn btn-primary w-100">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>

                                <div class="col-md-2">
                                    <a href="bandeja_entrada_excel.php?txt_fecha_desde=<?php echo $fecha_desde ?>&txt_fecha_hasta=<?php echo $fecha_hasta ?>"
                                        class="btn btn-success w-100">
                                        <i class="fa fa-file-excel"></i> Exportar Excel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="tabla_expedientes"
                            class="table table-striped table-bordered table-hover table-sm w-100">
                            <thead>
                                <tr>
                                    <th class="etiquetas_tabla">DNI</th>
                                    <th class="etiquetas_tabla">APELLIDO</th>
                                    <th class="etiquetas_tabla">NOMBRE</th>
                                    <th class="etiquetas_tabla">FEC NAC</th>
                                    <th class="etiquetas_tabla">TELEFONO</th>
                                    <th class="etiquetas_tabla">EMAIL</th>
                                    <th class="etiquetas_tabla">ACTIVIDAD</th>
                                    <th class="etiquetas_tabla">LUGAR</th>
                                    <th class="etiquetas_tabla">FECHA</th>
                                    <th class="etiquetas_tabla">ARCHIVOS</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.min.js"></script>

    <script language='javascript' src="../jscripts/funciones.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var table = new DataTable('#tabla_expedientes', {
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 50,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],


                ajax: {
                    url: "ajax_cargar_datos.php",
                    type: "POST",
                    data: function (d) {
                        d.fecha_desde = "<?php echo isset($_POST['txt_fecha_desde']) ? $_POST['txt_fecha_desde'] : ''; ?>";
                        d.fecha_hasta = "<?php echo isset($_POST['txt_fecha_hasta']) ? $_POST['txt_fecha_hasta'] : ''; ?>";
                    }
                },

                columns: [
                    { data: 'dni' },
                    { data: 'apellido' },
                    { data: 'nombre' },
                    { data: 'fecha_nac' },
                    { data: 'telefono' },
                    { data: 'email' },
                    { data: 'actividad' },
                    { data: 'lugar' },
                    { data: 'fecha_sistema' },
                    {
                        data: 'archivos',
                        orderable: false,
                        render: function (data, type, row) {
                            return '<div class="d-grid gap-2">' + data + '</div>';
                        }
                    }
                ],

                language: {
                    url: "https://cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json"
                }
            });
        });
    </script>
</body>

</html>