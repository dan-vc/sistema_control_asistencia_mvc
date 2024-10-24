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
      <form class="" action="../view_alumnos/" method="POST">
        <label for="email">Correo</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required />

        <button type="submit">Acceder</button>
      </form>
    </div>
  </div>
</body>

</html>