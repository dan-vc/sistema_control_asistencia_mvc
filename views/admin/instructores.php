<?php
/* Verificacion de Autorizacion*/
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != 1) {
    header('Location: ../../');
    exit;
}
$user_id = $_SESSION['user_id'];

require_once '../../config/conexion.php';
require_once '../../controller/instructorControlador.php';

$ControladorInstructor = new ControladorInstructor($conexion);

$instructores = $ControladorInstructor->listarInstructores();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="../../public/css/usuarios_bloques.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <main>
        <div class="c-admin">

            <!-- Esto se trabajará con el login, el inicio de sesión  -->
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
                            <a href="instructores.php" class="nav-link active">
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

                <div class="usuarios">
                    <h3>Instructores</h3>
                    <?php foreach ($instructores as $instructor): ?>
                        <div class="alumno-item" id="instructor-<?php echo $instructor['id']; ?>">
                            <?php echo ($instructor['nombres'] . ' ' . $instructor['apellidos']); ?> -
                            <?php echo ($instructor['correo']); ?>
                            <div class="botones-acciones">
                                <button class="boton-editar"
                                    onclick="openEditModal('<?php echo $instructor['id']; ?>', '<?php echo $instructor['nombres']; ?>', '<?php echo $instructor['apellidos']; ?>', '<?php echo $instructor['correo']; ?>')">Editar</button>
                                <button class="toggle-button" id="button-disable-<?php echo $instructor['id']; ?>"
                                    onclick="toggleInstructor(<?php echo $instructor['id']; ?>)"
                                    style="<?php echo !$instructor['habilitado'] ? 'display: none;' : ''; ?>">Deshabilitar</button>
                                <button class="toggle-button" id="button-enable-<?php echo $instructor['id']; ?>"
                                    onclick="toggleInstructor(<?php echo $instructor['id']; ?>)"
                                    style="<?php echo $instructor['habilitado'] ? 'display: none;' : ''; ?>">Habilitar</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="c-boton-">
                        <button class="openModal" id="openInstructorModalButton">Añadir Instructor</button>
                    </div>
                </div>



                <!-- Modal para añadir instructores -->
                <div id="addInstructorModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="closeInstructorModalButton">&times;</span>
                        <h2>Añadir Nuevo Instructor</h2>
                        <form id="addInstructorForm">
                            <label for="instructorName">Nombre del Instructor:</label>
                            <input type="text" id="instructorName" required>

                            <label for="instructorSurname">Apellido del Instructor:</label>
                            <input type="text" id="instructorSurname" required>

                            <label for="instructorEmail">Correo del Instructor:</label>
                            <input type="email" id="instructorEmail" required>

                            <label for="instructorPassword">Clave del Instructor:</label>
                            <input type="password" id="instructorPassword" required>

                            <input type="hidden" id="instructorRole" value="2"> <!-- rol_id 2 por defecto -->

                            <button type="submit">Añadir Instructor</button>
                        </form>
                    </div>
                </div>

                <div id="editInstructorModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="closeEditModalButton">&times;</span>
                        <h2>Editar Instructor</h2>
                        <form id="editInstructorForm">
                            <input type="hidden" id="editInstructorId">
                            <label for="editInstructorName">Nombre:</label>
                            <input type="text" id="editInstructorName" required>

                            <label for="editInstructorSurname">Apellido:</label>
                            <input type="text" id="editInstructorSurname" required>

                            <label for="editInstructorEmail">Correo:</label>
                            <input type="email" id="editInstructorEmail" required>

                            <button type="submit">Actualizar Instructor</button>
                        </form>
                    </div>
                </div>

            </div>
    </main>
    <script src="../../public/js/modal-instructores.js"></script>
    <script src="../../public/js/modal-editar-instructor.js"></script>
    <script src="../../public/js/desabilitar-instructores.js"></script>
</body>

</html>