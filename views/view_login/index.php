<?php

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    require_once("../../controller/ControladorLogin.php");
    $controlador = $ObjControlador;

    $correo = $_POST['email'];
    $clave = $_POST['password'];

    $user_data = $controlador->Login($correo, $clave);

    if (empty($user_data)) {
      $error_msg = 'Usuario o clave incorrectas.';
    } else {
      session_start();
      $_SESSION['user_id'] = $user_data['id'];
      $_SESSION['rol_id'] = $user_data['rol_id'];
      switch ($user_data['rol_id']) {
        case '1':
          //print_r('We have an admin, move out!');
          header('Location: ../admin');
          break;

        case '2':
          //print_r('We have an professor, get ready!');
          header('Location: ../view_instructor');
          break;

        case '3':
          //print_r('We have an student, meh!');
          header('Location: ../view_alumnos');
          break;
      }
    }
  }

  ?>

<!DOCTYPE html>
<html lang="es-pe">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../public/css/login.css" />
  <title>Login-DailyCheck</title>
  <link rel="shortcut icon" href="../../public/img/logo-square.png" type="image/x-icon">
</head>

<body>
  <div class="login-container">
    <div class="login-left">
      <img src="../../public/img/calendario-reloj.png" alt="Calendario" class="login-image" />
    </div>
    <div class="login-right">
      <div class="login-header">
        <img src="../../public/img/logo.png" alt="logo" class="login-logo" />
        <h2>Iniciar Sesión</h2>
        <p>Sistema de control de asistencia</p>
      </div>
      <form action="#" method="POST">
        <label for="email">Correo</label>
        <input type="email" id="email" name="email" required class="<?= isset($error_msg) ? 'error' : '' ?>"/>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required class="<?= isset($error_msg) ? 'error' : '' ?>"/>
        <span class="error-msg"><?= isset($error_msg) ? $error_msg : '' ?></span>
        

        <button type="submit">Acceder</button>
      </form>
    </div>
  </div>
</body>

</html>