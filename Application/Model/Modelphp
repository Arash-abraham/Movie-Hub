<?php
    namespace Application\Model;

    use PDO;
    use PDOException;
    
    class Model {
        protected $connection;
        public function __construct() {
            if(!isset($connection)) {
                global $dbHost,$dbName,$dbUsername,$dbPassword;
                $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                );
                try {
                    $this->connection = new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUsername,$dbPassword,$options);
                }
                catch(PDOException $e) {
                    print $e->getMessage();
                }
            }
        }
        protected function Query($query , $values = NULL) {
            try{
                if($values == NULL) {
                    return $this->connection->query($query);
                }
                else {
                    $stmt = $this->connection->prepare($query);
                    $stmt->execute($values);
                    return $stmt;
                }
            }
            catch(PDOException $e) {
                print $e->getMessage();
            }
        }
        protected function Execute($query , $values = NULL) {
            try{
                if($values == NULL) {
                    return $this->connection->exec($query);
                }
                else {
                    $stmt = $this->connection->prepare($query);
                    $stmt->execute($values);
                }
            }
            catch(PDOException $e) {
                print $e->getMessage();
            }
        }
        public function __destruct() {
            $this->connection = NULL;        
        }
    }
?>
