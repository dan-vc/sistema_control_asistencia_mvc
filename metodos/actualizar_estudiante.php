<?php
require_once '../config/conexion.php';
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'], $data['name'], $data['apellido'])) {
    $id = intval($data['id']);
    $name = $data['name'];
    $apellido = $data['apellido'];

    $sql = "UPDATE estudiantes SET name = '$name', apellido = '$apellido' WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}