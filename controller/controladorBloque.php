<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/model/modeloBloque.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';

class ControladorBloque
{
    private $modelo;

    public function __construct($modelo)
    {
        $this->modelo = $modelo;
    }

    public function listarBloques()
    {
        return $this->modelo->obtenerBloques();
    }

    public function añadirAlumnoABloque($alumno_id, $bloque_id)
    {
        return $this->modelo->añadirAlumnoABloque($alumno_id, $bloque_id);
    }

    public function obtenerAlumnosAsignados($bloque_id)
    {
        return $this->modelo->obtenerAlumnosPorBloque($bloque_id);
    }

    public function obtenerInstructorPorBloque($bloque_id)
    {
        return $this->modelo->obtenerInstructorPorBloque($bloque_id);
    }

    public function crearNuevoAlumno($nombre, $apellido, $correo, $clave, $rol_id, $bloque_id)
    {
        return $this->modelo->crearAlumno($nombre, $apellido, $correo, $clave, $rol_id, $bloque_id);
    }

    public function obtenerAlumnos()
    {
        return $this->modelo->metodoObtenerAlumnos();
    }

    public function actualizarAlumno($id, $nombre, $apellido, $correo)
    {
        return $this->modelo->actualizarAlumno($id, $nombre, $apellido, $correo);
    }

    public function obtenerAlumnoPorId($id)
    {
        return $this->modelo->obtenerAlumnoPorId($id);
    }

    public function obtenerAlumnoPorCorreo($correo)
    {
        return $this->modelo->obtenerAlumnoPorCorreo($correo);
    }

    public function crearBloque($nombre, $profesor_id)
    {
        return $this->modelo->crearBloque($nombre, $profesor_id);
    }

    public function obtenerProfesores()
    {
        return $this->modelo->obtenerProfesores();
    }

    public function actualizarEstadoAlumno($id, $estado)
    {
        return $this->modelo->actualizarEstadoAlumno($id, $estado);
    }

}