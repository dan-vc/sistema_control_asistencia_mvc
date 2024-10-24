<?php
require_once '../config/conexion.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM estudiantes WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Estudiante eliminado con éxito'); window.location.href = '../views/admin/';</script>";
    } else {
        echo "<script>alert('Error al eliminar el estudiante'); window.location.href = '../views/admin/';</script>";
    }
} else {
    echo "<script>alert('ID no válido'); window.location.href = '../views/admin/';</script>";
}