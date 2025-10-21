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
    
    }

?>