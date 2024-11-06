<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/model/instructoModelo.php';

class ControladorInstructor
{
    private $modelo;

    public function __construct($conexion)
    {
        $this->modelo = new ModeloInstructor($conexion);
    }

    public function listarInstructores() {
        return $this->modelo->listarInstructores();
    }    

    public function crearInstructor($nombre, $apellido, $correo, $clave, $rol_id) {
        return $this->modelo->crearInstructor($nombre, $apellido, $correo, $clave, $rol_id);
    }

    public function actualizarInstructor($id, $nombre, $apellido, $correo) {
        return $this->modelo->actualizarInstructor($id, $nombre, $apellido, $correo);
    }
    
    public function actualizarEstadoInstructor($id, $habilitado) {
        return $this->modelo->actualizarEstadoInstructor($id, $habilitado);
    }

    public function obtenerInstructorPorId($id) {
        return $this->modelo->obtenerInstructorPorId($id);
    }

    function VerJustificaciones($id)
    {
        $data = $this->modelo->MetodoVerJustificaciones($id);
        return $data;
    }    

    function JustificarAsistencia($justificacion_id, $asistencia_id, $status)
    {
        $data = $this->modelo->ActualizarJustificacion($justificacion_id, $status);

        if ($status == 'aceptada') {
            $data = $this->modelo->JustificarAsistencia($asistencia_id);
        }

        return $data;
    }    
    
}
