<?php

    namespace System\Router;

    class Routing {
        private $current_route;
        private $method_field;
        private $routes;
        private $values = []; 

        public function __construct() {
            $this->current_route = explode('/',CURRENT_ROUTE);
            
            $this->method_field = $this->methodField();

            global $routes;

            $this->routes = $routes;
        }
        
        public function run() {

        }

        public function match() {

        }

        private function compare($resevedRoutUrl) {
            // PART 1
            if(trim($resevedRoutUrl,'/') === "") {
                return trim($this->current_route[0],"/") === "" ? true : false;
            }
        }

        public function error404() {
            http_response_code(404);
            include __DIR__.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.'404.php';
            exit;
        }

        public function methodField() {
            $method_field = strtolower($_SERVER['REQUEST_METHOD']);

            if($method_field === 'post') {
                if(isset($_POST['_method'])) {
                    if($_POST['_method'] == 'put') {
                        $method_field = 'put';
                    }
                }
                else if($_POST['_method'] == 'delete') {
                    $method_field = 'delete';
                }
            }
        }
    }

?>