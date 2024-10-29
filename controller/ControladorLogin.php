<?php
require_once("../../model/ModeloLogin.php");
require_once("../../config/conexion.php");

$ObjModelo = new ModeloLogin($conexion);

class ControladorLogin
{
    private $modelo;

    public function __construct($modelo)
    {
        $this->modelo = $modelo;
    }

    function Login($correo, $clave)
    {
        $data = $this->modelo->MetodoLogin($correo, $clave);
        return $data;
    }

}

$ObjControlador = new ControladorLogin($ObjModelo);