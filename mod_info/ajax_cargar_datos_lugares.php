<?php
header('Content-Type: application/json; charset=utf-8');
include("../inc/conexion.php");
$link = Conexion();

$start = $_POST['start'];
$length = $_POST['length'];
$search_value = $_POST['search']['value'];

$where = " WHERE 1=1 ";

if(!empty($search_value)){
    $where .= " AND (c.nombre LIKE '%$search_value%'
                OR c.direccion LIKE '%$search_value%'
            )";
}

$sql_count = "SELECT 
                count(*) as total 
            FROM lugares c $where";

$count_query = mysqli_query($link, $sql_count);
$total_records = mysqli_fetch_assoc($count_query)['total'];

$sql = "SELECT c.id_lugar AS id,
            c.nombre AS nombreLugar,
            c.direccion AS direccionLugar,
            CASE WHEN c.activo = 1 THEN 'Sí' ELSE 'No' END AS activo
        FROM lugares c
        $where
        ORDER BY 1 ASC
        LIMIT $start, $length";

$resultado = mysqli_query($link, $sql);
$datos = [];

while($row = mysqli_fetch_array($resultado)){
    $datos[] = [
        "id" => $row['id'],
        "nombreLugar" => $row['nombreLugar'],
        "direccionLugar" => $row['direccionLugar'],
        "activo" => $row['activo'],
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