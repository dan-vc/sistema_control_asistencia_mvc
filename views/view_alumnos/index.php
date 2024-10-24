<!DOCTYPE html>
<html lang="es-pe">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../public/css/dashboard.css" />
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
          <p>Daniel Eduardo Villafranqui Colquicocha</p>
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
          </ul>
        </nav>
        <a href="../../" class="btn btn-danger">
          Cerrar sesión
        </a>
      </div>
    </div>
    <main>
      <p class="welcome-msg">Bienvenido, Daniel Eduardo Villafranqui Colquicocha</p>
      <div class="card-wrapper">
        <div class="card green">
          <p class="card-heading">asistencias</p>
          <div class="card-bottom">
            <i class="fa-solid fa-circle-check"></i>
            <span>12</span>
          </div>
        </div>
        <div class="card red">
          <p class="card-heading">faltas</p>
          <div class="card-bottom">
            <i class="fa-solid fa-circle-xmark"></i>
            <span>12</span>
          </div>
        </div>
        <div class="card orange">
          <p class="card-heading">tardanzas</p>
          <div class="card-bottom">
            <i class="fa-solid fa-user-clock"></i>
            <span>12</span>
          </div>
        </div>
        <div class="card blue">
          <p class="card-heading">justificadas</p>
          <div class="card-bottom">
            <i class="fa-solid fa-circle-info"></i>
            <span>12</span>
          </div>
        </div>
      </div>
      <div class="details-wrapper">
        <div class="details-row">
          <p class="details-row__date">02/07/2024</p>
          <p class="details-row__status">Asistencia</p>
        </div>
        <div class="details-row">
          <p class="details-row__date">02/07/2024</p>
          <p class="details-row__status">Asistencia</p>
        </div>
      </div>
    </main>
  </div>
</body>

<script src="https://kit.fontawesome.com/49770ae187.js" crossorigin="anonymous"></script>

</html>