<?php
header('Content-Type: application/json; charset=utf-8');
include("../inc/conexion.php");
$link = Conexion();

$start = intval($_POST['start']);
$length = intval($_POST['length']);
$search_value = mysqli_real_escape_string($link, $_POST['search']['value']);
$f_desde = mysqli_real_escape_string($link, $_POST['fecha_desde']);
$f_hasta = mysqli_real_escape_string($link, $_POST['fecha_hasta']);

$where = " WHERE 1=1 ";
if(!empty($f_desde)){
    $where .= " AND DATE_FORMAT(fecha_sistema,'%Y-%m-%d') >= '$f_desde'";
}

if(!empty($f_hasta)){
    $where .= " AND DATE_FORMAT(fecha_sistema,'%Y-%m-%d') <= '$f_hasta'";
}

if(!empty($search_value)){
    $where .= " AND (dni LIKE '%$search_value%' 
                    OR apellido LIKE '%$search_value%' 
                    OR a.nombre LIKE '%$search_value%'
                    OR b.actividad LIKE '%$search_value%'
                    OR c.nombre LIKE '%$search_value%'
                    OR telefono LIKE '%$search_value%'
                    OR email LIKE '%$search_value%'
                    OR a.id LIKE '%$search_value%') ";
}

$sql_count = "SELECT count(*) as total FROM inscripciones a INNER JOIN actividades b ON a.actividad = b.id_actividad INNER JOIN lugares c ON b.lugar = c.id_lugar $where";
$count_query = mysqli_query($link, $sql_count);
$total_records = mysqli_fetch_assoc($count_query)['total'];

$sql = "SELECT a.id as nroInscripcion, dni, apellido, a.nombre, fecha_nacimiento, telefono, email, b.actividad, c.nombre as nombreLugar, fecha_sistema 
        FROM inscripciones a 
        INNER JOIN actividades b ON a.actividad = b.id_actividad
        INNER JOIN lugares c ON b.lugar = c.id_lugar 
        $where 
        ORDER BY fecha_sistema DESC 
        LIMIT $start, $length";

$resultado = mysqli_query($link, $sql);
$datos = [];

while($row = mysqli_fetch_array($resultado)){
    
    // --- LÓGICA DE ARCHIVOS DESPLEGABLES ---
    $lista_archivos = "";
    $cantidad_archivos = 0;
    
    $q_files = "SELECT archivo FROM archivos WHERE inscripcion=".$row['nroInscripcion']." AND archivo LIKE '".$row['dni']."%'";
    $r_files = mysqli_query($link, $q_files);
    
    while($f = mysqli_fetch_array($r_files)){
        $cantidad_archivos++;
        $nombre_archivo_safe = htmlspecialchars($f['archivo'], ENT_QUOTES, 'UTF-8');
        $lista_archivos .= "<a href='http://www.bariloche.gov.ar/actividades/archivos/".$nombre_archivo_safe."' target='_blank' class='d-block text-decoration-none mb-1'>".$nombre_archivo_safe."</a>";
    }

    if ($cantidad_archivos > 0) {
        $collapseID = "collapseFiles_" . $row['nroInscripcion'];
        
        $archivos_html = '
            <button class="btn btn-primary btn-sm w-100" type="button" data-bs-toggle="collapse" data-bs-target="#'.$collapseID.'" aria-expanded="false" aria-controls="'.$collapseID.'">
                <i class="fa fa-folder-open"></i> Ver ('.$cantidad_archivos.')
            </button>
            
            <div class="collapse mt-2" id="'.$collapseID.'">
                <div class="card card-body p-2 bg-light border" style="font-size: 0.9em;">
                    '.$lista_archivos.'
                </div>
            </div>
        ';
    } else {
        $archivos_html = '<span class="text-muted text-center d-block">-</span>';
    }
    // ---------------------------------------

    $datos[] = [
        "dni" => $row['dni'],
        "apellido" => $row['apellido'],
        "nombre" => $row['nombre'],
        "fecha_nac" => $row['fecha_nacimiento'],
        "telefono" => $row['telefono'],
        "email" => $row['email'],
        "actividad" => $row['actividad'],
        "lugar" => $row['nombreLugar'],
        "fecha_sistema" => $row['fecha_sistema'],
        "archivos" => $archivos_html
    ];
}

$json_data = [
    "draw" => intval($_POST['draw']),
    "recordsTotal" => intval($total_records),
    "recordsFiltered" => intval($total_records),
    "data" => $datos
];

echo json_encode($json_data);
?>