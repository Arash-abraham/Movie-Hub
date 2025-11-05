<?php
    
    namespace System\Database\DBBuilder;
    use System\Database\DBConnection\DBConnection;
    
    class DBBuilder {
        public function __construct() {
            $this->createTables();
            die('Migrations run successfully !');
        }

        private function createTables() {
            $migrations = $this->getMigrations();
            $pdoInstance = DBConnection::getDBConnectionInstance();
            foreach ($migrations as $migration) {
                $statement = $pdoInstance->prepare($migration);
                $statement->execute();
            }
            return true;
        }
    }
?>