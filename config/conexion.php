<?php
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$database = 'prueba-asistencia';

$conexion = new PDO("mysql:host=$host; dbname=$database;", $usuario, $contraseña);