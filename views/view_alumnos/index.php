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

/* Obtención de la información del alumno */
$info = $controlador->GetInfoByID($user_id);
$user_name = $info["nombres"] . ' ' . $info["apellidos"];

/* Obtención de las asistencias del usuario */
$stats = $controlador->GetStatsByID($user_id);

$asistencias = 0;
$faltas = 0;
$tardanzas = 0;
$justificaciones = 0;

foreach ($stats as $stat):
  if (strtolower($stat["estado"]) == 'presente') {
    $asistencias = $stat['total'];
  }
endforeach;
foreach ($stats as $stat):
  if (strtolower($stat["estado"]) == 'falto') {
    $faltas = $stat['total'];
  }
endforeach;
foreach ($stats as $stat):
  if (strtolower($stat["estado"]) == 'tardanza') {
    $tardanzas = $stat['total'];
  }
endforeach;
foreach ($stats as $stat):
  if (strtolower($stat["estado"]) == 'justificado') {
    $justificaciones = $stat['total'];
  }
endforeach;


$details = $controlador->GetDetailsByID($user_id);

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
        <a href="../logout.php" class="btn btn-danger">
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

        <?php
        foreach ($details as $detail):
          $fecha = date_create_from_format("Y-m-d", $detail["fecha"]); ?>

          <div class="details-row">
            <?php if ($fecha !== false): ?>
              <p class="details-row__date"><?= $fecha->format("Y-m-d"); ?></p>
            <?php else: ?>
              <p class="details-row__date">Fecha inválida</p>
            <?php endif; ?>

            <p class="details-row__status"><?= htmlspecialchars($detail["estado_asistencia"]) ?></p>

            <?php if ($detail["estado_asistencia"] === 'falto'):
              if ($detail["estado_justificacion"] === null): ?>
                <button class="btn btn-danger"
                  onclick="justificarModal('<?= htmlspecialchars($detail["id"]) ?>')">Justificar</button>
              <?php else: ?>
                <a href="justificaciones.php" class="">Ver justificacion</a>
              <?php endif; ?>
            <?php endif; ?>
          </div>

        <?php endforeach; ?>


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