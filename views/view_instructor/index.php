<?php
date_default_timezone_set('America/Lima');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../public/css/instructor.css" />
  <link rel="shortcut icon" href="../../public/img/logo-square.png" type="image/x-icon">
  <title>DailyCheck - Instructor</title>
</head>

<body>
  <div class="main-container">
    <div class="left-content">
      <div class="left-content__inner">
        <div class="logo-wrapper">
          <img src="../../public/img/logo-white.png" alt="logo" class="logo-img" />
        </div>
        <div class="profile-wrapper">
          <img src="../../public/img/profile2.png" alt="Instructor" class="profile-img" />
          <p>Nombre del Instructor</p>
        </div>
        <p>Clase: seminario</p>
        <p>N° Alumnos: 30</p>
        <a href="../../" class="btn btn-danger">
          Cerrar sesión
        </a>
      </div>
    </div>


    <main class="main-content">
      <h2>Día: <?= date('d/m/Y') ?></h2>
      <table>
        <tr>
          <th>Nombre</th>
          <th>Asistencia</th>
          <th>Falta</th>
          <th>Tardanza</th>
          <th>Justificación</th>
        </tr>
        <?php
        $students = array_fill(0, 8, 'jose carlos chero');
        $statuses = ['check', 'x', 'late'];
        foreach ($students as $student) {
          $status = $statuses[array_rand($statuses)];
          echo "<tr>
                        <td>$student</td>
                        <td>" . ($status == 'check' ? '<span class="check">✓</span>' : '') . "</td>
                        <td>" . ($status == 'x' ? '<span class="x">✗</span>' : '') . "</td>
                        <td>" . ($status == 'late' ? '<span class="late">⚠</span>' : '') . "</td>
                        <td></td>
                      </tr>";
        }
        ?>
      </table>
      <button class="save-btn">GUARDAR</button>
    </main>
  </div>
</body>

</html>