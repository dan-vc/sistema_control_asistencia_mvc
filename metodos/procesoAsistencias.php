<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/controladorAsistencia.php';

header('Content-Type: application/json');

// Obtener los datos del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

// Asignar valores a las variables
$alumno_id = $data['alumno_id'] ?? null;
$bloque_id = $data['bloque_id'] ?? null;
$estado = $data['estado'] ?? null;

// Validar si los datos están presentes
if ($alumno_id && $bloque_id && $estado) {
    try {
        // Crear instancia del controlador
        $controladorAsistencia = new ControladorAsistencia($conexion);

        // Registrar o actualizar asistencia
        $resultado = $controladorAsistencia->registrarAsistencia($alumno_id, $bloque_id, $estado);

        // Verificar si la operación fue exitosa
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Asistencia registrada correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo registrar la asistencia.']);
        }
    } catch (Exception $e) {
        // Capturar cualquier excepción y mostrar un error
        echo json_encode(['success' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()]);
    }
} else {
    // Si faltan parámetros, retornar un mensaje de error específico
    echo json_encode(['success' => false, 'message' => 'Faltan datos necesarios (alumno_id, bloque_id, estado).']);
}
?>
