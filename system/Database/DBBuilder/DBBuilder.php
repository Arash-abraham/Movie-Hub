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

        }

        private function getOldMigrations() {
            $data = file_get_contents(__DIR__.'/oldTables.db');
            return empty($data)
                ?
                    []
                :
                    unserialize($data);    
                ;
        }
        private function putOldMigrations($value){
            file_put_contents(__DIR__.'/oldTables.db', serialize($value));
        }

    }
?>