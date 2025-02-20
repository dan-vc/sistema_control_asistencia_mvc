<?php
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $apellido = $_POST['apellido'];
    $dni = intval($_POST['dni']);

    $sql = "INSERT INTO estudiantes (name, apellido, dni) VALUES ('$name', '$apellido', $dni)";

    if ($conexion->query($sql)) {
        echo "<script>alert('Estudiante añadido con éxito'); window.location.href = '../views/admin/';</script>";
    } else {
        echo "<script>alert('Error al añadir el estudiante'); window.location.href = '../views/admin/';</script>";
    }
} else {
    echo "<script>alert('Método no permitido'); window.location.href = '../views/admin/';</script>";
}