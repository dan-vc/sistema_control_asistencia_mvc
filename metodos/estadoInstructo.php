<?php
require_once '../config/conexion.php'; 
require_once '../controller/instructorControlador.php'; 

$modelo = new ModeloInstructor($conexion);
$controladorInstructor = new ControladorInstructor($modelo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $instructor = $controladorInstructor->listarInstructores(); 
    $instructor = array_filter($instructor, fn($inst) => $inst['id'] == $id); 
    $instructor = reset($instructor); 

    if ($instructor) {
        $nuevoEstado = $instructor['habilitado'] ? 0 : 1;
        $resultado = $controladorInstructor->actualizarEstadoInstructor($id, $nuevoEstado);
        
        echo json_encode(['success' => true, 'habilitado' => $nuevoEstado]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Instructor no encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Acción no válida']);
}
?>
