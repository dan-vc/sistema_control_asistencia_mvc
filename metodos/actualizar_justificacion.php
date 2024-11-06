<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/instructorControlador.php';

header('Content-Type: application/json');
$controlador = new ControladorInstructor($conexion);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $justificacion_id = $data['justificacionId'];
    $asistencia_id = $data['asistenciaId'];
    $status = $data['status'];    
    
    $actualizacionExitosa = $controlador->JustificarAsistencia($justificacion_id, $asistencia_id, $status);
    
    if ($actualizacionExitosa) {
        echo json_encode(['success' => true, 'message' => 'Asistencia justificada con éxito']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al justificar']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

