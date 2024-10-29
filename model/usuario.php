<?php

require_once '../../config/conexion.php';

class Usuario {
    private static $pdo;

    public static function setPdo($pdoInstance) {
        self::$pdo = $pdoInstance;
    }

    public static function conectar() {
        if (self::$pdo === null) {
            self::setPdo($GLOBALS['pdo']); 
        }
        return self::$pdo;
    }

    public static function listar() {
        $conn = self::conectar(); 
        $stmt = $conn->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function crear($data) {
        $stmt = self::$pdo->prepare("INSERT INTO usuarios (nombres, apellidos, correo, clave, rol_id) VALUES (?, ?, ?, ?, ?)");
        
        $stmt->bindParam(1, $data['name']);        
        $stmt->bindParam(2, $data['apellido']);    
        $stmt->bindParam(3, $data['correo']);      
        $stmt->bindParam(4, $data['clave']);      
        $stmt->bindParam(5, $data['rol_id']);      

        if ($stmt->execute()) {
            return true;
        } else {
            error_log(print_r($stmt->errorInfo(), true)); 
            return false; 
        }
    }

    public static function actualizar($data) {
        $stmt = self::$pdo->prepare("UPDATE usuarios SET nombres = ?, apellidos = ? WHERE id = ?");
        return $stmt->execute([$data['name'], $data['apellido'], $data['id']]);
    }
    
    

    public static function eliminar($id) {
        $stmt = self::$pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function obtenerPorId($id) {
        $stmt = self::$pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
