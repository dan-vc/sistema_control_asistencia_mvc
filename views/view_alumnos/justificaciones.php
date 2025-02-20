<?php
/* Verificacion de Autorizacion*/
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != 3) {
    header('Location: ../../');
    exit;
}
$user_id = $_SESSION['user_id'];

require_once("../../controller/ControladorAlumno.php");
$controlador = $ObjControlador;


$user_info = $controlador->GetInfoByID($user_id);
$user_name = $user_info["nombres"] . ' ' . $user_info["apellidos"];

$justificaciones = $controlador->VerJustificaciones($user_id);

?>

<!DOCTYPE html>
<html lang="es-pe">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../public/css/alumnos.css" />
  <link rel="shortcut icon" href="../../public/img/logo-square.png" type="image/x-icon">
  <title>DailyCheck - Alumnos</title>
</head>

<body>
  <div class="main-container">
    <div class="left-content">
      <div class="left-content__inner">
        <div class="logo-wrapper">
          <img src="../../public/img/logo-white.png" alt="logo" class="logo-img" />
        </div>
        <div class="profile-wrapper">
          <img src="../../public/img/profile.png" alt="Foto de perfil" class="profile-img" />
          <p><?= $user_name ?></p>
        </div>
        <nav class="nav-menu">
          <ul>
            <li>
              <a href="index.php" class="nav-link">
                <i class="fa-regular fa-calendar"></i>
                Asistencias
              </a>
            </li>
            <li>
              <a href="profile.php" class="nav-link">
                <i class="fa-solid fa-user"></i>
                Perfil
              </a>
            </li>
            <li>
              <a href="justificaciones.php" class="nav-link active">
                <i class="fa-solid fa-user"></i>
                Justificaciones
              </a>
            </li>
          </ul>
        </nav>
        <a href="../../" class="btn btn-danger">
          Cerrar sesión
        </a>
      </div>
    </div>
    <main>
      <div class="justificaciones-wrapper">

        <?php
        foreach ($justificaciones as $justificacion):
          $fecha = date_create_from_format("Y-m-d", $justificacion["fecha"]); ?>
          <div class="justificacion-card">
            <div class="justificacion-card__top">
              <p class="justificacion-card__id">ID: <?= $justificacion["id"] ?></p>
              <p class="justificacion-card__date"><?= $fecha->format("Y-m-d") ?></p>
            </div>
            <?php if ($justificacion["archivo"]): ?>
              <img src="<?= $justificacion['archivo'] ?>" alt="Justificación de la asistencia <?= $justificacion['id'] ?>">
            <?php endif; ?>
            <p class="justificacion-card__mensaje"><?= $justificacion["mensaje"] ?></p>

            <div class="justificacion-card__status <?= $justificacion["estado"] ?>">
              <p><?= $justificacion["estado"] ?></p>
            </div>
          </div>
        <?php endforeach ?>

      </div>
    </main>
  </div>
</body>

<script src="https://kit.fontawesome.com/49770ae187.js" crossorigin="anonymous"></script>

</html>