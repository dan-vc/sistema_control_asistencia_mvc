    <?php
    class Role {
        private static $pdo;

        public static function setPdo($pdoInstance) {
            self::$pdo = $pdoInstance;
        }

        public static function conectar() {
            return self::$pdo;
        }

        public static function listar() {
            $conn = self::conectar();
            $stmt = $conn->query("SELECT * FROM roles");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    ?>
