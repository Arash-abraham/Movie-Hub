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
            $oldMigrationArray = $this->getOldMigrations();
            $migrationDirectory = BASE_DIR . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR;
            $allMigrationsArray = glob($migrationDirectory .'*.php');
            $newMigrationsArray = array_diff($allMigrationsArray, $oldMigrationArray);
            $this->putOldMigrations($allMigrationsArray);

            $sqlCodeArray = [];
            foreach($newMigrationsArray as $fileName) {
                $sqlCode = require $fileName;
                array_push($sqlCodeArray, $sqlCode[0]);
            }

            return $sqlCodeArray;
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