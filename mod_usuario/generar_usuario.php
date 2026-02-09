<?php
require_once ('../inc/conexion.php');

function generar_usuario($usuario, $contrasenia) {
    $conexion = Conexion();
    $hash = md5($contrasenia);

    $sql = "INSERT INTO usuarios (us, pas) VALUES ('$usuario', '$hash')";

    $query = mysqli_query($conexion, $sql);

    if ($query) {
        return true; 
    } else {
        return false; 
    }
}
?>