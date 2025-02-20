<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/controladorBloque.php'; 

header('Content-Type: application/json');


$modelo = new ModeloBloque($conexion);
$controladorBloque = new ControladorBloque($modelo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];

    
    $actualizacionExitosa = $controladorBloque->actualizarAlumno($id, $nombre, $apellido, $correo);

    if ($actualizacionExitosa) {
        echo json_encode(['success' => true, 'message' => 'Alumno actualizado con éxito']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
