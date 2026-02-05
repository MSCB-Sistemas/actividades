<?php
header('Content-Type: application/json; charset=utf-8');
include("../inc/conexion.php");
$link = Conexion();

$start = $_POST['start'];
$length = $_POST['length'];
$search_value = $_POST['search']['value'];

$where = " WHERE 1=1 ";

if(!empty($search_value)){
    $where .= " AND (a.actividad LIKE '%$search_value%' 
                OR a.categoria LIKE '%$search_value%' 
                OR c.nombre LIKE '%$search_value%'
                OR a.anio_desde LIKE '%$search_value%'
                OR a.anio_hasta LIKE '%$search_value%'
                OR a.grupo LIKE '%$search_value%'
                OR a.periodo LIKE '%$search_value%'
                OR a.tipo LIKE '%$search_value%'
            )";
}

$sql_count = "SELECT 
                count(*) as total 
            FROM actividades a 
            INNER JOIN lugares c ON a.lugar = c.id_lugar $where";

$count_query = mysqli_query($link, $sql_count);
$total_records = mysqli_fetch_assoc($count_query)['total'];

$sql = "SELECT 
            a.id_actividad AS id,
            a.actividad,
            a.anio_desde,
            a.anio_hasta,
            a.categoria,
            a.grupo,
            a.cupo,
            a.horarios,
            c.nombre AS nombreLugar,
            a.periodo,
            CASE WHEN a.activo = 1 THEN 'Sí' ELSE 'No' END AS activo,
            a.tipo
        FROM actividades a 
        INNER JOIN lugares c ON a.lugar = c.id_lugar 
        $where
        ORDER BY 1 ASC
        LIMIT $start, $length";

$resultado = mysqli_query($link, $sql);
$datos = [];

while($row = mysqli_fetch_array($resultado)){
    $datos[] = [
        "actividad" => $row['actividad'],
        "anio_desde" => $row['anio_desde'],
        "anio_hasta" => $row['anio_hasta'],
        "categoria" => $row['categoria'],
        "grupo" => $row['grupo'],
        "cupo" => $row['cupo'],
        "horarios" => $row['horarios'],
        "nombreLugar" => $row['nombreLugar'],
        "periodo" => $row['periodo'],
        "activo" => $row['activo'],
        "tipo" => $row['tipo'],
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