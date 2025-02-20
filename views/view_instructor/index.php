<?php
/* Verificacion de Autorizacion*/
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != 2) {
    header('Location: ../../');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/controladorAsistencia.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/instructorControlador.php';

$instructor_id = $_SESSION['user_id'];

/* Obtenemos los Bloques del profesor */
$controladorAsistencia = new ControladorAsistencia($conexion);
$bloques = $controladorAsistencia->obtenerBloquesPorProfesor($instructor_id);

/* Obtenemos las justificaciones */
$controladorInstructor = new ControladorInstructor($conexion);
$justificaciones = $controladorInstructor->VerJustificaciones($instructor_id);
/* Guardamos el numero de justificaciones */
$justificaciones = count($justificaciones)
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero de Asistencia</title>
    <link rel="stylesheet" href="../../public/css/admin.css">
    <script src="../../public/js/notificaciones.js"></script>
</head>

<body>
    <main>
        <div class="c-admin">
            <div class="admin-info">
                <div class="c-img-logo">
                    <img src="../../public/img/logo.png" alt="Logo">
                </div>
                <div class="informacion-admin">
                    <img src="../../public/img/profile.png" alt="Foto de Perfil de admin">
                    <p>Instructor</p>
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
                            <a href="justificaciones.php" class="nav-link">
                                Justificaciones
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="c-cerrar-sesion">
                    <a href="../logout.php" class="btn btn-danger">Cerrar Sesión</a>
                </div>
            </div>

            <div class="bloques">
                <h2>Lista de Bloques</h2>
                <div class="lista-bloque">
                    <?php if (empty($bloques)): ?>
                        <p>No hay bloques asignados.</p>
                    <?php else: ?>
                        <?php foreach ($bloques as $bloque): ?>
                            <div class="card-bloque"
                                onclick="location.href='asistencia.php?bloque_id=<?php echo $bloque['id']; ?>'">
                                <h3><?php echo htmlspecialchars($bloque['nombre']); ?></h3>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>

<script>
    showNotification('Hola', 'Tiene <?= $justificaciones ?> justificaciones pendientes.')
</script>

</html>