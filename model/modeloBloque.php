<?php

class ModeloBloque
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerBloques()
    {
        $sql = "SELECT * FROM bloques";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function añadirAlumnoABloque($alumno_id, $bloque_id)
    {
        try {
            // Intenta insertar el registro
            $sql = "INSERT INTO alumno_bloque (alumno_id, bloque_id) VALUES (:alumno_id, :bloque_id)";
            $stmt = $this->conexion->prepare($sql);
            
            return $stmt->execute([':alumno_id' => $alumno_id, ':bloque_id' => $bloque_id]);
        } catch (Exception $e) {
            return;
        }
    }

    public function obtenerTodosLosAlumnos()
    {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerAlumnosPorBloque($bloque_id)
    {
        $sql = "SELECT u.id, u.nombres, u.apellidos, u.habilitado FROM alumno_bloque ab
                JOIN usuarios u ON ab.alumno_id = u.id
                WHERE ab.bloque_id = :bloque_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':bloque_id' => $bloque_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerInstructorPorBloque($bloque_id)
    {
        $sql =
            "SELECT p.nombres, p.apellidos
        FROM bloques AS b 
        INNER JOIN usuarios AS p
        ON b.profesor_id = p.id
        WHERE b.id = :bloque_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':bloque_id' => $bloque_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearAlumno($nombre, $apellido, $correo, $clave, $rol_id, $bloque_id)
    {
        $sql = "INSERT INTO usuarios (nombres, apellidos, correo, clave, rol_id) VALUES (:nombre, :apellido, :correo, :clave, :rol_id)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':nombre' => $nombre, ':apellido' => $apellido, ':correo' => $correo, ':clave' => $clave, ':rol_id' => $rol_id]);

        $alumno_id = $this->conexion->lastInsertId();

        $this->añadirAlumnoABloque($alumno_id, $bloque_id);
    }

    public function obtenerAlumnoPorId($id)
    {
        $sql = "SELECT *, habilitado FROM usuarios WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerAlumnoPorCorreo($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE rol_id = 3 AND correo = :correo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':correo' => $correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function metodoObtenerAlumnos()
    {
        $sql = "SELECT * FROM usuarios WHERE rol_id = 3";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarAlumno($id, $nombre, $apellido, $correo)
    {
        $sql = "UPDATE usuarios SET nombres = :nombre, apellidos = :apellido, correo = :correo WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':id' => $id, ':nombre' => $nombre, ':apellido' => $apellido, ':correo' => $correo]);
    }

    public function crearBloque($nombre, $profesor_id)
    {
        $sql = "INSERT INTO bloques(nombre, profesor_id) VALUES (:nombre, :profesor_id)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':nombre' => $nombre, ':profesor_id' => $profesor_id]);
    }

    public function obtenerProfesores()
    {
        $sql = "SELECT * FROM usuarios WHERE rol_id = :rol_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':rol_id' => 2]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarInstructores()
    {
        $sql = "SELECT * FROM usuarios WHERE rol_id = 2";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearInstructor($nombre, $apellido, $correo, $clave, $rol_id)
    {
        $sql = "INSERT INTO usuarios (nombres, apellidos, correo, clave, rol_id) VALUES (:nombre, :apellido, :correo, :clave, :rol_id)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':nombre' => $nombre, ':apellido' => $apellido, ':correo' => $correo, ':clave' => $clave, ':rol_id' => $rol_id]);
    }

    public function actualizarEstadoAlumno($id, $estado)
    {
        $sql = "UPDATE usuarios SET habilitado = :estado WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':estado' => $estado, ':id' => $id]);
    }

}
