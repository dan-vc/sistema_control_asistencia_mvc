<?php
/* Verificación de Autorización */
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != 2) {
  header('Location: ../../');
  exit;
}

date_default_timezone_set('America/Lima');

require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/controller/controladorAsistencia.php';

$controladorAsistencia = new ControladorAsistencia($conexion);

$bloque_id = isset($_GET['bloque_id']) ? (int) $_GET['bloque_id'] : 0;
$estudiantes = $bloque_id > 0 ? $controladorAsistencia->obtenerEstudiantesPorBloque($bloque_id) : [];
$asistencias = $bloque_id > 0 ? $controladorAsistencia->obtenerAsistenciasExistentes($bloque_id, date('Y-m-d')) : [];
//print_r($asistencias);
foreach ($asistencias as $asistencia) {
  //print_r($asistencia['alumno_id']);
  //print_r($asistencia['estado']);
}
?>

<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero de Asistencia</title>
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="../../public/css/asistencia.css">
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
              <a href="index.php" class="nav-link active">
                Bloques
              </a>
            </li>
            <li>
              <a href="justificaciones.php" class="nav-link">
                Justificaciones
              </a>
            </li>
          </ul>
        </nav>
        
        <div class="c-cerrar-sesion">
          <a href="../logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
      </div>

      <div class="estudiantes">
        <h2>Tablero de Asistencia - Bloque ID: <?php echo htmlspecialchars($bloque_id); ?></h2>
        <h3 style="margin:1em 0;"><?php echo 'Fecha: ' . date('Y-m-d'); ?></h3>
        <table style="margin-bottom: 1em;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre y Apellido</th>
              <th class="td-botones">Presente</th>
              <th class="td-botones">Falta</th>
              <th class="td-botones">Tardanza</th>
              <th class="td-botones">Falta Justificada</th>
            </tr>
          </thead>
          
          <tbody>
            <?php if (!empty($estudiantes)): ?>
              <?php foreach ($estudiantes as $estudiante): ?>
                <?php
                // Obtener el estado de asistencia del estudiante
                foreach ($asistencias as $asistencia) {
                  if ($estudiante['id'] === $asistencia['alumno_id']) {
                    $estado_asistencia = $asistencia['estado'];
                  }
                }
                ?>
                <tr>
                  <td><?php echo $estudiante['id']; ?></td>
                  <td><?php echo $estudiante['nombres'] . ' ' . $estudiante['apellidos']; ?></td>
                  <td class="td-botones">
                    <button
                      class="btn-asistencia <?php echo $estado_asistencia === 'presente' ? 'selected-presente' : ''; ?>"
                      data-id="<?php echo $estudiante['id']; ?>" data-bloque-id="<?php echo $bloque_id; ?>"
                      data-value="presente">
                      Presente
                    </button>
                  </td>
                  <td class="td-botones">
                    <button class="btn-asistencia <?php echo $estado_asistencia === 'falto' ? 'selected-falto' : ''; ?>"
                      data-id="<?php echo $estudiante['id']; ?>" data-bloque-id="<?php echo $bloque_id; ?>"
                      data-value="falto">
                      Falta
                    </button>
                  </td>
                  <td class="td-botones">
                    <button
                      class="btn-asistencia <?php echo $estado_asistencia === 'tardanza' ? 'selected-tardanza' : ''; ?>"
                      data-id="<?php echo $estudiante['id']; ?>" data-bloque-id="<?php echo $bloque_id; ?>"
                      data-value="tardanza">
                      Tardanza
                    </button>
                  </td>
                  <td class="td-botones">
                    <button
                      class="btn-asistencia <?php echo $estado_asistencia === 'justificado' ? 'selected-justificado' : ''; ?>"
                      data-id="<?php echo $estudiante['id']; ?>" data-bloque-id="<?php echo $bloque_id; ?>"
                      data-value="justificado">
                      Falta Justificada
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6">No se encontraron estudiantes para el bloque ID:
                  <?php echo htmlspecialchars($bloque_id); ?>.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>

        </table>
        <a href="index.php" class="link">Regresar</a>
      </div>
    </div>
  </main>
  <script src="../../public/js/asistencia-tabla.js"></script>
  <script src="../../public/js/registrar_asistencia.js"></script>
</body>

</html>