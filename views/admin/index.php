<?php
require_once '../../config/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../public/img/logo-square.png" type="image/x-icon">
  <title>Administrador</title>
  <link rel="stylesheet" href="../../public/css/admin.css">
</head>

<body>
  <main>
    <div class="c-admin">
      <!-- Información del administrador -->
      <div class="admin-info">
        <div class="admin-info__inner">
          <div class="c-img-logo">
            <img src="../../public/img/logo-white.png" alt="" class="logo-img">
          </div>

          <div class="informacion-admin">
            <img src="../../public/img/profile2.png" alt="Foto de Perfil de admin">
            <p>Admin</p>
          </div>
          <div class="informacion-admin-2">
            <p><b>Clases:</b> Desarrollo de Aplicaciones Móviles</p>
            <p><b>Instructor:</b> Arturo Collado</p>
          </div>
          <div class="c-cerrar-sesion">
            <a href="../../" class="btn btn-danger">Cerrar Sesión</a>
          </div>
        </div>
      </div>

      <!-- Funciones que puede realizar el administrador -->
      <div class="c-admin-funciones">
        <?php
        $sql = "SELECT id, name, apellido FROM estudiantes";
        $resultado = $conexion->query($sql);

        /* Se mostraran los datos */
        if ($resultado->rowCount() > 0) {
          while ($fila = $resultado->fetch()) { ?>
        <div class="admin-funciones">
          <div class="info-contenedor">
            <img src="../../public/img/profile2.png" alt="Perfil">
            <div class="info-estudiante">
              <h3 class="nombre-estudiante"><?= $fila['name'] . ' ' . $fila['apellido'] ?></h3>
              <p><?= ($fila['id']) ?></p>
            </div>
          </div>

          <div class="botones">
            <button class="boton-editar" data-id="<?= $fila['id'] ?>">Editar</button>
            <form action="../../metodos/eliminar_estudiante.php" method="post" style="display:inline;">
              <input type="hidden" name="id" value="<?= $fila['id'] ?>">
              <button type="submit" class="boton-eliminar"
                onclick="return confirm('¿Estás seguro de que deseas eliminar este estudiante?');">Eliminar</button>
            </form>
          </div>

        </div>
        <?php
          }
        } else {
          echo '<p>No hay estudiantes disponibles.</p>';
        }
        ?>
        <div class="boton-añadir-container">
          <button class="boton-añadir" id="abrir-modal">+</button>
        </div>

      </div>

    </div>

    <!-- Modal de editar -->
    <div id="modal-editar" class="modal">
      <div class="modal-contenido">
        <span class="cerrar" id="cerrar-modal">&times;</span>
        <h2>Editar Estudiante</h2>
        <form id="form-editar">
          <input type="hidden" id="estudiante-id" name="id">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="name" required>
          <label for="apellido">Apellido:</label>
          <input type="text" id="apellido" name="apellido" required>
          <button type="submit">Guardar Cambios</button>
        </form>
      </div>
    </div>

    <!-- Modal de añadir nuevo estudiante -->
    <div id="modal-anadir" class="modal" style="display:none;">
      <div class="modal-contenido">
        <span class="cerrar" id="cerrar-modal">&times;</span>
        <h2>Añadir Estudiante</h2>
        <form id="form-anadir" action="../../metodos/nuevo_estudiante.php" method="post">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="name" required>
          <label for="apellido">Apellido:</label>
          <input type="text" id="apellido" name="apellido" required>
          <label for="dni">DNI:</label>
          <input type="number" id="dni" name="dni" required>
          <button type="submit">Añadir Estudiante</button>
        </form>
      </div>
    </div>


  </main>
  <script src="../../public/js/modal-editar.js"></script>
  <script src="../../public/js/modal-añadir.js"></script>
</body>

</html>