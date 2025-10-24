<?php 
    
    namespace System\Database\DBConnection;

    use PDO;
    use PDOException;

    class DBConnection {
        private static $dbConnectionInstance = null;

        private function __construct() {

        }

        public static function getDBConnectionInstance() {
            if (self::$dbConnectionInstance === null) {

            }
        }

    }
?>