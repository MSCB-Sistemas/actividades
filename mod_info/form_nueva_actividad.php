<html>
    <head>
        <title>Actividades</title>
    </head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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
    </style>
<body>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex">
                    <div class="row align-items-end">
                        <a href="bandeja_entrada.php"><button class="btn btn-primary btn-sm">Inicio</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tabla_actividades" class="table table-striped table-bordered table-hover table-sm w-100">
                        <thead>
                            <tr>
                                <th class="etiquetas_tabla">ACTIVIDAD</th>
                                <th class="etiquetas_tabla">AÑO DESDE</th>
                                <th class="etiquetas_tabla">AÑO HASTA</th>
                                <th class="etiquetas_tabla">CATEGORIA</th>
                                <th class="etiquetas_tabla">GRUPO</th>
                                <th class="etiquetas_tabla">CUPO</th>
                                <th class="etiquetas_tabla">HORARIOS</th>
                                <th class="etiquetas_tabla">LUGAR</th>
                                <th class="etiquetas_tabla">PERIODO</th>
                                <th class="etiquetas_tabla">ACTIVO</th>
                                <th class="etiquetas_tabla">TIPO</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tabla_lugares" class="table table-striped table-bordered table-hover table-sm w-100">
                        <thead>
                            <tr>
                                <th class="etiquetas_tabla">ID</th>
                                <th class="etiquetas_tabla">LUGAR</th>
                                <th class="etiquetas_tabla">DIRECCIÓN</th>
                                <th class="etiquetas_tabla">ACTIVO</th>
                                <th class="etiquetas_tabla">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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

    <script type="text/javascript">
        $(document).ready(function() {
            var table = new DataTable('#tabla_actividades', {
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthMenu: false,


                ajax: {
                    url: "ajax_cargar_datos_actividades.php",
                    type: "POST",
                },

                columns: [
                    { data: 'actividad' },
                    { data: 'anio_desde' },
                    { data: 'anio_hasta' },
                    { data: 'categoria' },
                    { data: 'grupo' },
                    { data: 'cupo' },
                    { data: 'horarios' },
                    { data: 'nombreLugar' },
                    { data: 'periodo' },
                    { data: 'activo' },
                    { data: 'tipo' }
                ],

                language: {
                    url: "https://cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json"
                }
            });
            var tableLugares = new DataTable('#tabla_lugares', {
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthMenu: false,


                ajax: {
                    url: "ajax_cargar_datos_lugares.php",
                    type: "POST",
                },

                columns: [
                    { data: 'id' },
                    { data: 'nombreLugar' },
                    { data: 'direccionLugar' },
                    { data: 'activo' },
                    { 
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-sm btn-primary">Editar</button> ' +
                                   '<button class="btn btn-sm btn-danger">Eliminar</button>';
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