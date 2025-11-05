<?php
    
    namespace System\Database\DBBuilder;
    use System\Database\DBConnection\DBConnection;
    
    class DBBuilder {
        public function __construct() {
            $this->createTables();
            die('Migrations run successfully !');
        }

        protected function createTables() {

        }
    }
?>