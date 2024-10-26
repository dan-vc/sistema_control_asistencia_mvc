<?php

class Alumno
{
    public $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $rol;

    public function __GET($k)
    {
        return $this->$k;
    }

    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }
}

class ModeloAlumno
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    function MetodoGetStatsByID($id)
    {
        $query = 'SELECT estado, COUNT(*) AS total FROM asistencias WHERE alumno_id = ? GROUP BY estado';
        $stm = $this->conexion->prepare($query);
        $stm->execute([$id]);
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function MetodoGetDetailsByID($id)
    {
        $query = 'SELECT * FROM asistencias WHERE alumno_id = ?';
        $stm = $this->conexion->prepare($query);
        $stm->execute([$id]);
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function MetodoGetInfoByID($id)
    {
        $query =
            'SELECT u.id, 
        u.nombres, 
        u.apellidos, 
        u.correo, 
        b.id AS bloque_id, 
        b.nombre AS bloque_nombre,
        p.nombres AS profesor_nombres,
        p.apellidos AS profesor_apellidos
        FROM usuarios AS u 
        LEFT JOIN alumno_bloque AS ab ON u.id = ab.alumno_id 
        LEFT JOIN bloques AS b ON ab.bloque_id = b.id 
        LEFT JOIN usuarios AS p ON b.profesor_id = p.id 
        WHERE u.id = ?';

        $stm = $this->conexion->prepare($query);
        $stm->execute([$id]);
        $data = $stm->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function MetodoJustificar($asistencia_id, $mensaje)
    {
        $query = 'INSERT INTO justificaciones(asistencia_id, mensaje) VALUES(?, ?)';
        $stm = $this->conexion->prepare($query);

        if ($stm->execute([
            $asistencia_id,
            $mensaje
        ])) {
            $data = 'Justificación enviada con éxito.';
        } else {
            $data = 'Ocurrió un error al generar la justificación.';
        }
        return $data;
    }
}