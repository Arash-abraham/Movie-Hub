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

        private function getMigrations() {
            $data = file_get_contents(__DIR__.'/oldTables.db');
            return [];
        }

        private function getOldMigrations() {

        }
        private function putOldMigrations(){

        }

    }
?>