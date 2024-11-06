<?php

class ModeloInstructor
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function listarInstructores(): mixed {
        $sql = "SELECT * FROM usuarios WHERE rol_id = 2";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearInstructor($nombre, $apellido, $correo, $clave, $rol_id) {
        $sql = "INSERT INTO usuarios (nombres, apellidos, correo, clave, rol_id, habilitado) VALUES (:nombre, :apellido, :correo, :clave, :rol_id, 1)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':nombre' => $nombre, ':apellido' => $apellido, ':correo' => $correo, ':clave' => $clave, ':rol_id' => $rol_id]);
    }
    
    public function actualizarInstructor($id, $nombre, $apellido, $correo) {
        $sql = "UPDATE usuarios SET nombres = :nombre, apellidos = :apellido, correo = :correo WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':apellido', $apellido);
        $stmt->bindValue(':correo', $correo);
        $stmt->bindValue(':id', $id);

        return $stmt->execute(); 
    }
    
    public function actualizarEstadoInstructor($id, $habilitado) {
        $sql = "UPDATE usuarios SET habilitado = :habilitado WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':habilitado', $habilitado, PDO::PARAM_BOOL);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function obtenerInstructorPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id AND rol_id = 2"; 
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function MetodoVerJustificaciones($instructor_id)
    {
        $query =
        'SELECT 
        j.id,
        j.asistencia_id,
        j.mensaje, 
        j.archivo,
        j.estado,
        a.fecha,
        u.nombres,
        u.apellidos
        FROM justificaciones AS j
        INNER JOIN asistencias AS a ON j.asistencia_id = a.id
        INNER JOIN usuarios AS u ON a.alumno_id = u.id
        WHERE a.bloque_id IN(SELECT id FROM bloques WHERE profesor_id = ?)';
        $stm = $this->conexion->prepare($query);
        $stm->execute([
            $instructor_id
        ]);
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function ActualizarJustificacion($justificacion_id, $status)
    {
        $query = 'UPDATE justificaciones SET estado = ? WHERE id = ?';
        $stm = $this->conexion->prepare($query);
        $data = $stm->execute([
            $status,
            $justificacion_id
        ]);
        return $data;
    }

    public function JustificarAsistencia($asistencia_id)
    {
        $query = 'UPDATE asistencias SET estado = "justificado" WHERE id = ?';
        $stm = $this->conexion->prepare($query);
        $data = $stm->execute([
            $asistencia_id
        ]);
        return $data;
    }

}
