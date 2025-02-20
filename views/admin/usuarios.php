<?php
/* Verificacion de Autorizacion*/
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != 1) {
    header('Location: ../../');
    exit;
}
$user_id = $_SESSION['user_id'];

require_once '../../config/conexion.php';
require_once '../../controller/controladorBloque.php';

$modelo = new ModeloBloque($conexion);
$controladorBloque = new ControladorBloque($modelo);

$bloque_id = isset($_GET['id']) ? $_GET['id'] : null;

/* Para añadir/crear estudiante en el bloque */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $rol_id = $_POST['rol_id'];

    $alumnoExiste = $controladorBloque->obtenerAlumnoPorCorreo($correo);

    if ($alumnoExiste) {
        $controladorBloque->añadirAlumnoABloque($alumnoExiste['id'], $bloque_id);
    } else {
        $controladorBloque->crearNuevoAlumno($nombre, $apellido, $correo, $clave, $rol_id, $bloque_id);
    }
}

/* Obtener alumnos */
$alumnosAsignados = $controladorBloque->obtenerAlumnosAsignados($bloque_id);

// Obtener profesor del bloque
$profesor = $controladorBloque->obtenerInstructorPorBloque($bloque_id);
$profesorName = $profesor['nombres'] . " " .  $profesor['apellidos'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos en el Bloque</title>
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="../../public/css/usuarios_bloques.css">
</head>

<body>
    <div class="c-admin">        
        <div class="admin-info">
            <div class="c-img-logo">
                <img src="../../public/img/logo.png" alt="">
            </div>

            <div class="informacion-admin">
                <img src="../../public/img/profile.png" alt="Foto de Perfil de admin">
                <p>Admin</p>
            </div>

            <!-- Navegación de páginas -->
            <nav class="admin-nav">
                    <ul>
                        <li>
                            <a href="index.php" class="nav-link">
                                Bloques
                            </a>
                        </li>
                        <li>
                            <a href="instructores.php" class="nav-link">
                                Instructores
                            </a>
                        </li>
                    </ul>
                </nav>

            <div class="c-cerrar-sesion">
                <a href="../logout.php" type="button" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>

        <div class="bloques">
            <h2>Alumnos</h2>
            
            <h3 style="margin-top: 1em;">Instructor: <?= $profesorName ?></h3>
            <div class="usuarios">
                <?php foreach ($alumnosAsignados as $alumno): ?>
                    <div class="alumno-item" id="alumno-<?php echo $alumno['id']; ?>">
                        <?php echo ($alumno['nombres'] . ' ' . $alumno['apellidos']); ?>
                        <div class="botones-acciones">
                            <button class="boton-editar" data-id="<?php echo $alumno['id']; ?>">Editar</button>
                            <div class="toggle-buttons">
                                <button class="toggle-button" id="button-disable-<?php echo $alumno['id']; ?>"
                                    onclick="toggleAlumno(<?php echo $alumno['id']; ?>)"
                                    style="<?php echo !$alumno['habilitado'] ? 'display: none;' : ''; ?>">
                                    Deshabilitar
                                </button>
                                <button class="toggle-button" id="button-enable-<?php echo $alumno['id']; ?>"
                                    onclick="toggleAlumno(<?php echo $alumno['id']; ?>)"
                                    style="<?php echo $alumno['habilitado'] ? 'display: none;' : ''; ?>">
                                    Habilitar
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="c-boton-">
                    <button class="openModal" id="openModal">Añadir Estudiante</button>
                </div>
            </div>


            <a href="index.php" class="link">Regresar</a>
        </div>
    </div>


    <!-- Modal Añadir Estudiante -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Añadir Estudiante</h2>
            <form id="addStudentForm" action="usuarios.php?id=<?php echo $bloque_id; ?>" method="POST">
                <select id="selectEstudianteInput">
                    <option value="">Seleccione uno existente</option>
                </select>
                <input type="text" name="nombre" placeholder="Nombre" id="studentNombre" required>
                <input type="text" name="apellido" placeholder="Apellido" id="studentApellido" required>
                <input type="email" name="correo" placeholder="Correo" id="studentCorreo" required>
                <input type="password" name="clave" placeholder="Contraseña" id="studentClave" required>
                <input type="hidden" name="rol_id" value="3">
                <input type="hidden" name="bloque_id" value="<?php echo $bloque_id; ?>">
                <button type="submit">Añadir Estudiante</button>
            </form>
        </div>
    </div>

    <!-- Editar Editar Estudiante -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEditModal">&times;</span>
            <h2>Editar Estudiante</h2>
            <form id="editStudentForm" method="POST">
                <input type="hidden" name="id" id="editStudentId">
                <input type="text" name="nombre" id="editNombre" placeholder="Nombre" required>
                <input type="text" name="apellido" id="editApellido" placeholder="Apellido" required>
                <input type="email" name="correo" id="editCorreo" placeholder="Correo" required>
                <button type="submit">Actualizar Estudiante</button>
            </form>
        </div>
    </div>

    <script src="../../public/js/añadir-estudiante-modal.js"></script>
    <script src="../../public/js/editar-alumno.js"></script>
    <script src="../../public/js/actualizar-alumno.js"></script>
    <script src="../../public/js/desabilitar-alumno.js"></script>
</body>

</html>