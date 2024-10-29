<?php
require_once '../../config/conexion.php';
require_once '../../controller/usuarioControllers.php';

$usuarioController = new UsuarioController();
$roles = $usuarioController->listarRoles(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioController->crear(); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Estudiante</title>
    <link rel="stylesheet" href="../../public/css/añadir.css">
</head>
<body>
    <main>
        <h2>Añadir Estudiante</h2>
        <form action="" method="post">
            <label for="nombre">Nombres:</label>
            <input type="text" id="nombre" name="name" required>
            
            <label for="apellido">Apellidos:</label>
            <input type="text" id="apellido" name="apellido" required>
            
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>
            
            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required>
            
            <label for="rol">Rol:</label>
            <input type="hidden" id="rol" name="rol_id" value="3">
            <p>Rol: <?= htmlspecialchars($roles[2]['nombre']) ?></p>
            
            <button type="submit">Añadir Estudiante</button>
        </form>
    </main>
</body>
</html>



