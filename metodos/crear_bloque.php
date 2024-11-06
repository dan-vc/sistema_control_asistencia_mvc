<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/controladorBloque.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';

header('Content-Type: application/json');
$controladorBloque = new ControladorBloque(new ModeloBloque($conexion));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($_GET['action']) && $_GET['action'] === 'crearBloque') {
        $nombre = $data['nombre'];
        $profesor_id = $data['profesorId']; 

        $resultado = $controladorBloque->crearBloque($nombre, $profesor_id); 

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo crear el bloque']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    }
}
