<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/instructorControlador.php';

$ControladorInstructor = new ControladorInstructor($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'message' => 'Error en los datos JSON']);
        exit;
    }

    $id = $_GET['id'] ?? null;
    $action = $_GET['action'];

    if ($action === 'crearInstructor') {
        $resultado = $ControladorInstructor->crearInstructor($data['nombre'], $data['apellido'], $data['correo'], $data['clave'], $data['rol_id']);
    } elseif ($action === 'editarInstructor' && $id) {
        $resultado = $ControladorInstructor->actualizarInstructor($id, $data['nombre'], $data['apellido'], $data['correo']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Acción no válida o ID no proporcionado']);
        exit;
    }

    echo json_encode(['success' => $resultado, 'message' => $resultado ? '' : 'Operación fallida']);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no válida']);