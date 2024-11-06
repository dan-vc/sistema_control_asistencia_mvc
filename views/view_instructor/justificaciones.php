<?php
/* Verificacion de Autorizacion*/
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != 2) {
  header('Location: ../../');
  exit;
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/instructorControlador.php';

$instructor_id = $_SESSION['user_id'];

$controlador = new ControladorInstructor($conexion);
$justificaciones = $controlador->VerJustificaciones($instructor_id);

?>

<!DOCTYPE html>
<html lang="es-pe">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../public/css/admin.css" />
  <link rel="stylesheet" href="../../public/css/justificaciones_instructor.css" />
  <link rel="shortcut icon" href="../../public/img/logo-square.png" type="image/x-icon">
  <title>DailyCheck - Instructor</title>
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
              <a href="index.php" class="nav-link">
                Bloques
              </a>
            </li>
            <li>
              <a href="justificaciones.php" class="nav-link active">
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
        <div class="justificaciones-wrapper">


        <!-- 
        j.id,
        j.asistencia_id,
        j.mensaje, 
        j.archivo,
        j.estado,
        a.fecha,
        u.nombres,
        u.apellidos 
        -->

          <?php
          foreach ($justificaciones as $justificacion):
            $fecha = date_create_from_format("Y-m-d", $justificacion["fecha"]);
            $alumno = $justificacion['nombres'] . " " . $justificacion['apellidos'] ?>

            <div class="justificacion-card">
              <div class="justificacion-card__top">
                <p class="justificacion-card__id">ID: <?= $justificacion["id"] ?></p>
                <p class="justificacion-card__date"><?= $fecha->format("Y-m-d") ?></p>
              </div>
              
              <!-- Nombre del alumno -->
              <p class="justificacion-card__student-name"><?= $alumno ?></p>

              <!-- Imagen de la justificación -->
              <?php if ($justificacion["archivo"]): ?>
                <img src="<?= $justificacion['archivo'] ?>"
                  alt="Justificación de la asistencia <?= $justificacion['id'] ?>">
              <?php endif; ?>

              <!-- Contenido de la justificación -->
              <p class="justificacion-card__mensaje"><?= $justificacion["mensaje"] ?></p>

              <!-- Estado de la justificación -->
              <select name="estado" id="selectJustificacionEstado"
                class="justificacion-card__status <?= $justificacion["estado"] ?>"
                data-id="<?= $justificacion['id'] ?>" data-asistencia-id="<?= $justificacion['asistencia_id'] ?>">
                <option value="pendiente" <?= $justificacion["estado"] == 'pendiente' ? 'selected' : '' ?>>PENDIENTE</option>
                <option value="aceptada" <?= $justificacion["estado"] == 'aceptada' ? 'selected' : '' ?>>ACEPTADA</option>
                <option value="rechazada" <?= $justificacion["estado"] == 'rechazada' ? 'selected' : '' ?>>RECHAZADA</option>
              </select>
            </div>
          <?php endforeach ?>

        </div>
      </div>
    </div>
  </main>
</body>

<script src="../../public/js/manejar-justificacion.js"></script>
<script src="https://kit.fontawesome.com/49770ae187.js" crossorigin="anonymous"></script>

</html>