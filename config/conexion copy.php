<?php
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$database = 'asistencia';

try {
    // Relizamos la conexion con PDO
    $conexion = new PDO("mysql:host=$host; dbname=$database;", $usuario, $contraseña);

} catch (PDOException $e) {
    // Si la conexion falla obtenemos el error
    die('Conection Failed: ' . $e->getMessage());

}