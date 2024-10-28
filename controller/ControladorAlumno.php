<?php
require_once("../../model/ModeloAlumno.php");
require_once("../../config/conexion.php");

$ObjModelo = new ModeloAlumno($conexion);

class ControladorProducto
{
    private $modelo;

    public function __construct($modelo)
    {
        $this->modelo = $modelo;
    }

    function GetStatsByID($id)
    {
        $data = $this->modelo->MetodoGetStatsByID($id);
        return $data;
    }

    function GetDetailsByID($id)
    {
        $data = $this->modelo->MetodoGetDetailsByID($id);
        return $data;
    }

    function GetInfoByID($id)
    {
        $data = $this->modelo->MetodoGetInfoByID($id);
        return $data;
    }

    function VerJustificaciones($id)
    {
        $data = $this->modelo->MetodoVerJustificaciones($id);
        return $data;
    }

}

$ObjControlador = new ControladorProducto($ObjModelo);