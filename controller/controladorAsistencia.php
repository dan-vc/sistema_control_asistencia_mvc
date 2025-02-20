<?php

date_default_timezone_set('America/Lima');

require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/config/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SistemaControlAsistencia/model/modeloAsistencia.php';

class ControladorAsistencia
{
    private $modelo;

    public function __construct($conexion)
    {
        $this->modelo = new AsistenciaModelo($conexion);
    }

    /* Obtener estudiantes por rol */
    public function obtenerEstudiantesPorRol($rol_id)
    {
        return $this->modelo->obtenerEstudiantesPorRol($rol_id);
    }

    public function registrarAsistencia($alumno_id, $bloque_id, $estado)
    {
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        if ($this->modelo->asistenciaExistente($alumno_id, $fecha)) {
            return $this->modelo->actualizarAsistencia($alumno_id, $fecha, $hora, $estado);
        } else {
            return $this->modelo->insertarAsistencia($alumno_id, $bloque_id, $fecha, $hora, $estado);
        }
    }

    public function obtenerAsistenciasExistentes($bloque_id, $fecha)
    {
        return $this->modelo->asistenciasExistentes($bloque_id, $fecha);
    }

    public function obtenerBloquesPorProfesor($profesor_id)
    {
        return $this->modelo->obtenerBloquesPorProfesor($profesor_id);
    }

    public function obtenerEstudiantesPorBloque($bloque_id)
    {
        return $this->modelo->obtenerEstudiantesPorBloque($bloque_id);
    }

    public function obtenerAsistenciaDelDia($alumno_id)
    {
        $fecha = date('Y-m-d');
        $asistencia = $this->modelo->obtenerAsistenciaPorAlumnoYFecha($alumno_id, $fecha);
    
        return $asistencia;  // Esto devuelve los datos de asistencia de ese alumno para el día
    }
    

    public function obtenerAsistenciaDelDiaPorBloque($bloque_id)
    {
        $fecha = date('Y-m-d');
        return $this->modelo->obtenerAsistenciaPorBloqueYFecha($bloque_id, $fecha);
    }
}

