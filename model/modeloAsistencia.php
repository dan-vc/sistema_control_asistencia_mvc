<?php
class AsistenciaModelo
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerEstudiantesPorRol($rol_id)
    {
        $sql = "SELECT * FROM usuarios WHERE rol_id = :rol_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':rol_id' => $rol_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarAsistencia($alumno_id, $bloque_id, $fecha, $hora, $estado)
    {
        try {
            $sql = 
            "INSERT INTO asistencias (alumno_id, bloque_id, fecha, hora, estado) 
            VALUES (:alumno_id, :bloque_id, :fecha, :hora, :estado)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':alumno_id', $alumno_id);
            $stmt->bindParam(':bloque_id', $bloque_id);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':hora', $hora);
            $stmt->bindParam(':estado', $estado);
            return $stmt->execute();
        } catch (PDOException $e) {
            file_put_contents('php://stderr', $e->getMessage());
            return false;
        }
    }

    public function actualizarAsistencia($alumno_id, $fecha, $hora, $estado)
    {
        try {
            $query = 
            "UPDATE asistencias SET estado = :estado, hora = :hora 
            WHERE alumno_id = :alumno_id AND DATE(fecha) = DATE(:fecha)";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute([
                ':estado' => $estado,
                ':hora' => $hora,
                ':alumno_id' => $alumno_id,
                ':fecha' => $fecha
            ]);
            return true; 
        } catch (PDOException $e) {
            return false; 
        }
    }

    public function asistenciaExistente($alumno_id, $fecha): bool
    {
        $sql = "SELECT COUNT(*) FROM asistencias WHERE alumno_id = :alumno_id AND DATE(fecha) = DATE(:fecha)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':alumno_id' => $alumno_id, ':fecha' => $fecha]);
        return $stmt->fetchColumn() > 0;
    }

    public function obtenerBloquesPorProfesor($profesor_id)
    {
        $sql = "SELECT * FROM bloques WHERE profesor_id = :profesor_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':profesor_id' => $profesor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEstudiantesPorBloque($bloque_id)
    {
        $sql = "
            SELECT u.* 
            FROM usuarios u 
            JOIN alumno_bloque ab ON u.id = ab.alumno_id 
            WHERE ab.bloque_id = :bloque_id AND u.habilitado = 1
        ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':bloque_id' => $bloque_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function obtenerAsistenciaPorAlumnoYFecha($alumno_id, $fecha)
    {
        try {
            $query = "SELECT * FROM asistencias WHERE alumno_id = :alumno_id AND DATE(fecha) = DATE(:fecha)";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute([
                ':alumno_id' => $alumno_id,
                ':fecha' => $fecha
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false; 
        }
    }
}
?>
