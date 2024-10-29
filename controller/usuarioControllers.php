<?php

require_once '../../model/usuario.php';
require_once '../../model/role.php';

class UsuarioController {
    public function __construct() {
        Usuario::setPdo($GLOBALS['conexion']);
        Role::setPdo($GLOBALS['conexion']);
    }

    public function listar() {
        return Usuario::listar();
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? null,
                'apellido' => $_POST['apellido'] ?? null,
                'correo' => $_POST['correo'] ?? null,
                'clave' => $_POST['clave'] ?? null,
                'rol_id' => $_POST['rol_id'] ?? null,
            ];

            if (in_array(null, $data, true)) {
                echo 'Error: Todos los campos son requeridos.';
                return false;
            }

            if (Usuario::crear($data)) {
                header('Location: index.php');
                exit;
            } else {
                echo 'Error al añadir el estudiante.';
            }
        }
    }

    public function actualizar($data) {
        return Usuario::actualizar($data);
    }

    public function eliminar($id) {
        return Usuario::eliminar($id);
    }

    public function listarRoles() {
        return Role::listar();
    }

    public function obtenerEstudiante() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $estudiante = Usuario::obtenerPorId($id);
            if ($estudiante) {
                echo json_encode($estudiante);
            } else {
                echo json_encode(['error' => 'Estudiante no encontrado']);
            }
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
    }
}

/* Instancia el controlador */
$usuarioController = new UsuarioController();

/* Solicitud de eliminación */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'eliminar') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        if ($usuarioController->eliminar($id)) {
            header('Location: ../public/index.php');
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el estudiante.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado.']);
    }
    exit;
}


/* De actualizar */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $_POST['id'] ?? null,
        'name' => $_POST['name'] ?? null,
        'apellido' => $_POST['apellido'] ?? null,
    ];

    if (in_array(null, $data, true)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son requeridos.']);
        return;
    }

    if ($usuarioController->actualizar($data)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el estudiante.']);
    }
}