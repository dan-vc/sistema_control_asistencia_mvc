<?php

class ModeloLogin
{
  private $conexion;


  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }

  function MetodoLogin($correo, $clave)
  {
    $query = "SELECT * FROM usuarios WHERE correo = ? AND clave = ?";
    $stm = $this->conexion->prepare($query);
    $stm->execute([
      $correo,
      $clave
    ]);

    $data = $stm->fetch();

    return $data;
  }

}