<?php
session_start();
$user_id = $_SESSION['user_id'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../config/conexion.php';
require_once '../../controller/usuarioControllers.php';

$usuarioController = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action']) && $_GET['action'] === 'actualizar') {
        $usuarioController->actualizar();
        exit;
    }

    $usuarioController->crear();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'obtenerEstudiante') {
    $usuarioController->obtenerEstudiante();
    exit;
}

$estudiantes = $usuarioController->listar();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="../../public/css/admin.css">
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

                <div class="informacion-admin-2">
                    <p><b>Clases:</b> Desarrollo de Aplicaciones Móviles</p>
                    <p><b>Instructor:</b> Arturo Collado</p>
                </div>

                <div class="c-cerrar-sesion">
                    <a href="../logout.php" type="button" class="btn btn-danger">Cerrar Sesión</a>
                </div>
            </div>

            <!-- Funciones que puede realizar el administrador -->
            <div class="c-admin-funciones">
                <?php if (!empty($estudiantes)): ?>
                    <?php foreach ($estudiantes as $estudiante): ?>
                        <div class="admin-funciones">
                            <div class="info-contenedor">
                                <i class="icono-perfil fas fa-user-circle"></i>
                                <div class="info-estudiante">
                                    <h3 class="nombre-estudiante">
                                        <?= htmlspecialchars($estudiante['nombres'] . ' ' . $estudiante['apellidos']) ?></h3>
                                    <p><?= htmlspecialchars($estudiante['correo']) ?></p>
                                </div>
                            </div>
                            <div class="botones">
                                <button class="boton-editar"
                                    data-id="<?= htmlspecialchars($estudiante['id']) ?>">Editar</button>

                                <form class="form-eliminar" action="../../controller/usuarioControllers.php?action=eliminar"
                                    method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($estudiante['id']) ?>">
                                    <button type="submit" class="boton-eliminar"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este estudiante?');">Eliminar</button>
                                </form>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay estudiantes disponibles.</p>
                <?php endif; ?>

                <div class="boton-añadir-container">
                    <a href="añadir.php" class="btn btn-green boton-añadir">+</a>
                </div>

            </div>
        </div>

        <!-- Modal de editar -->
        <div id="modal-editar" class="modal">
            <div class="modal-contenido">
                <span class="cerrar" id="cerrar-modal">&times;</span>
                <h2>Editar Estudiante</h2>
                <form id="form-editar">
                    <input type="hidden" id="estudiante-id" name="id">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="name" required>
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required>
                    <button type="submit">Guardar Cambios</button>
                </form>
            </div>
        </div>



    </main>
    <script src="../../public/js/modal-editar.js"></script>
</body>

</html>