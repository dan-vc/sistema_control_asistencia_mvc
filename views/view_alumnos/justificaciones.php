<?php
require_once("../../controller/ControladorAlumno.php");
$controlador = $ObjControlador;


$user_info = $controlador->GetInfoByID(3);
$user_name = $user_info["nombres"] . ' ' . $user_info["apellidos"];

$justificaciones = $controlador->VerJustificaciones(3);

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
      <div class="details-wrapper">

        <?php foreach ($justificaciones as $justificacion): ?>
          <div class="details-row">
            <p class="details-row__id"><?= $justificacion["id"] ?></p>
            <p class="details-row__date"><?= $justificacion["fecha"] ?></p>
            <p class="details-row__status"><?= $justificacion["mensaje"] ?></p>
          </div>
        <?php endforeach ?>

      </div>
    </main>
  </div>
</body>

<script src="https://kit.fontawesome.com/49770ae187.js" crossorigin="anonymous"></script>

</html>