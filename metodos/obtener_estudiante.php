<?php
require_once '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT id, name, apellido FROM estudiantes WHERE id = $id";
    $resultado = $conexion->query($sql);

    if ($resultado && $fila = $resultado->fetch()) {
        echo json_encode($fila);
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(null);
}