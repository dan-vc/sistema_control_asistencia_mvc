<?php
require_once '../config/conexion.php'; 
require_once '../controller/controladorBloque.php'; 

$modelo = new ModeloBloque($conexion);
$controladorBloque = new ControladorBloque($modelo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $alumno = $controladorBloque->obtenerAlumnoPorId($id);
    if ($alumno) {
        $nuevoEstado = $alumno['habilitado'] ? 0 : 1; 

        $resultado = $controladorBloque->actualizarEstadoAlumno($id, $nuevoEstado);
        
        echo json_encode(['success' => true, 'habilitado' => $nuevoEstado]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Alumno no encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Acción no válida']);
}

