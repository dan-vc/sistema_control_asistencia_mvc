<?php
require_once("../../model/ModeloAlumno.php");
require_once("../../config/conexion.php");
$ObjModelo = new ModeloAlumno($conexion);

// Verifica que la solicitud sea POST
$imagen = null; // Inicializa $imagen como nulo
if (isset($_POST['id']) && isset($_POST['justificacion'])) {
  if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] !== UPLOAD_ERR_NO_FILE) {
    // Procesar subida de archivo de justificacion
    $file = $_FILES["imagen"];
    $nombreArchivo = $_FILES["imagen"]["name"];
    $tipo = $_FILES["imagen"]["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
  
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../../public/img/";
  
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
      echo "Error, el archivo no es una imagen";
      
    } else {
      $src = $carpeta . $nombreArchivo;
      move_uploaded_file($ruta_provisional, $src);
      $imagen = "../../public/img/" . $nombreArchivo;
  
    }
  }
  
  
  $_SESSION['msg'] = $ObjModelo->MetodoJustificar($_POST['id'], $_POST['justificacion'], $imagen);
  header('Location: index.php');
}


