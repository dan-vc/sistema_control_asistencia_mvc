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

$modeloBloque = new ModeloBloque($conexion);
$controladorBloque = new ControladorBloque($modeloBloque);

$bloques = $controladorBloque->listarBloques() ?? [];
$profesores = $controladorBloque->obtenerProfesores();

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
                            <a href="index.php" class="nav-link active">
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
                <h2>Lista de Bloques</h2>
                <div class="lista-bloque">
                    <?php foreach ($bloques as $bloque): ?>
                        <div class="card-bloque" onclick="location.href='usuarios.php?id=<?php echo $bloque['id']; ?>'">
                            <img src="" alt="">
                            <h3><?php echo htmlspecialchars($bloque['nombre']); ?></h3>
                        </div>
                    <?php endforeach; ?>
                    <button id="openModalButton">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

            <div id="addBlockModal" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModalButton">&times;</span>
                    <h2>Añadir Nuevo Bloque</h2>
                    <form id="addBlockForm">
                        <label for="blockName">Nombre del Bloque:</label>
                        <input type="text" id="blockName" required>

                        <label for="professorSelect">Selecciona un Profesor:</label>
                        <select id="professorSelect" required>
                            <option value="">Selecciona un profesor</option>
                            <?php foreach ($profesores as $profesor): ?>
                                <option value="<?php echo $profesor['id']; ?>">
                                    <?php echo htmlspecialchars($profesor['nombres'] . " " . $profesor['apellidos']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit">Añadir Bloque</button>
                    </form>
                </div>
            </div>

    </main>
    <script src="../../public/js/crear_bloque.js"></script>
</body>

</html>