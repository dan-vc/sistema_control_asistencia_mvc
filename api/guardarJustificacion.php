<?php
require_once("../model/ModeloAlumno.php");
require_once("../config/conexion.php");
$ObjModelo = new ModeloAlumno($conexion);

// Verifica que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtencion los datos enviados desde el JS
  $data = json_decode(file_get_contents('php://input'), true)['data'];

  // Llama al método del modelo
  $resultado = $ObjModelo->MetodoJustificar($data['id'], $data['justificacion']);


  /* $resultado = $data; */

  // Devuelve la respuesta como JSON
  header('Content-Type: application/json');
  echo json_encode($resultado);
}