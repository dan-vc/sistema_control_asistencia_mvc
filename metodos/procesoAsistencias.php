<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/controladorAsistencia.php';

$controladorAsistencia = new ControladorAsistencia($conexion);

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['alumno_id'], $data['estado'], $data['bloque_id'])) {
    $alumno_id = $data['alumno_id'];
    $estado = $data['estado'];
    $bloque_id = $data['bloque_id'];

    $resultado = $controladorAsistencia->registrarAsistencia($alumno_id, $bloque_id, $estado);
    if ($resultado) {
        echo json_encode(['message' => 'Asistencia registrada correctamente.']);
    } else {
        echo json_encode(['message' => 'Error al registrar la asistencia.']);
    }
} else {
    echo json_encode(['message' => 'Datos incompletos.']);
}
