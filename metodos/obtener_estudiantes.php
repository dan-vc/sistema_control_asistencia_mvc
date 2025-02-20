<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/controladorBloque.php';

header('Content-Type: application/json');

$modelo = new ModeloBloque($conexion);
$controladorBloque = new ControladorBloque($modelo);

$alumnos = $controladorBloque->obtenerAlumnos();

if ($alumnos) {
    echo json_encode($alumnos);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'No se encontraron alumnos']);
}


