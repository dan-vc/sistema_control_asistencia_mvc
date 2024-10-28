<?php
require_once("../../controller/ControladorAlumno.php");
$controlador = $ObjControlador;

/* Obtención de la información del alumno */
$info = $controlador->GetInfoByID(3);
$user_name = $info["nombres"] . ' ' . $info["apellidos"];

/* Obtención de las asistencias del usuario */
$stats = $controlador->GetStatsByID(1);

$asistencias = 0;
$faltas = 0;
$tardanzas = 0;
$justificaciones = 0;

foreach ($stats as $stat):
  if (strtolower($stat["estado"]) == 'asistencia') {
    $asistencias = $stat['total'];
  }
endforeach;
foreach ($stats as $stat):
  if (strtolower($stat["estado"]) == 'falta') {
    $faltas = $stat['total'];
  }
endforeach;
foreach ($stats as $stat):
  if (strtolower($stat["estado"]) == 'tardanza') {
    $tardanzas = $stat['total'];
  }
endforeach;
foreach ($stats as $stat):
  if (strtolower($stat["estado"]) == 'justificación') {
    $justificaciones = $stat['total'];
  }
endforeach;


$details = $controlador->GetDetailsByID(3);

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
              <a href="index.php" class="nav-link active">
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
              <a href="justificaciones.php" class="nav-link ">
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
      <p class="welcome-msg">Bienvenido, <?= $user_name ?></p>
      <div class="card-wrapper">
        <div class="card green">
          <p class="card-heading">asistencias</p>
          <div class="card-bottom">
            <i class="fa-solid fa-circle-check"></i>
            <span><?= $asistencias ?></span>
          </div>
        </div>
        <div class="card red">
          <p class="card-heading">faltas</p>
          <div class="card-bottom">
            <i class="fa-solid fa-circle-xmark"></i>
            <span><?= $faltas ?></span>
          </div>
        </div>
        <div class="card orange">
          <p class="card-heading">tardanzas</p>
          <div class="card-bottom">
            <i class="fa-solid fa-user-clock"></i>
            <span><?= $tardanzas ?></span>
          </div>
        </div>
        <div class="card blue">
          <p class="card-heading">justificadas</p>
          <div class="card-bottom">
            <i class="fa-solid fa-circle-info"></i>
            <span><?= $justificaciones ?></span>
          </div>
        </div>
      </div>
      <div class="details-wrapper">

        <?php foreach ($details as $detail): ?>
          <div class="details-row">
            <p class="details-row__date"><?= $detail["fecha"] ?></p>
            <p class="details-row__status"><?= $detail["estado_asistencia"] ?></p>
            <?php if ($detail["estado_asistencia"] === 'falta' && $detail["estado_justificacion"] === null): ?>
              <button class="btn btn-danger" onclick="justificarModal('<?= $detail["id"] ?>');">Justificar</button>
            <?php endif ?>
          </div>
        <?php endforeach ?>

        <!-- <div class="details-row">
          <p class="details-row__date">02/07/2024</p>
          <p class="details-row__status">Asistencia</p>
          <button class="btn btn-danger" id="abrir-modal">Justificar</button>
        </div> -->

      </div>
    </main>
  </div>

</body>

<script src="https://kit.fontawesome.com/49770ae187.js" crossorigin="anonymous"></script>
<script src="../../public/js/modal-justificar.js"></script>

</html>