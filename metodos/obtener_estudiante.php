<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/controladorBloque.php'; 

header('Content-Type: application/json');

$modelo = new ModeloBloque($conexion);
$controladorBloque = new ControladorBloque($modelo);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $alumno = $controladorBloque->obtenerAlumnoPorId($id);
    
    if ($alumno) {
        echo json_encode($alumno);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Alumno no encontrado']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID no especificado']);
}

