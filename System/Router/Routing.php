<?php
    namespace System\Router;


    use ReflectionMethod;

    require_once 'System/config.php';

    class Routing {
        private $current_route;
        public function __construct() {
            global $current_route;
            $this->current_route = explode('/',$current_route);
            // Test For Debugging
            // print ucfirst($this->current_route[0]);
        }
        public function Run() {
            $path = realpath(dirname(__FILE__).'/../../Application/Controllers/'.ucfirst($this->current_route[0]).'.php');
            if (!file_exists($path)) {
                header("HTTP/1.1 404 Not Found");
                $error_message = "file_not_found";
                include 'Errors/404.php';
                print $error_message;
                exit;
            }
            require_once($path);
            if (sizeof($this->current_route) == 1) {
                $method = 'index';
            } 
            else {
                $method = $this->current_route[1];
            }
            $class = "Application\Controllers\\".ucfirst($this->current_route[0]);
            if(class_exists($class)) {
                $object = new $class();
                if(method_exists($object, $method)) {
                    $reflection = new ReflectionMethod($object, $method);
                    $parameterCount = $reflection->getNumberOfParameters();
                    if($parameterCount <= count(array_slice($this->current_route , 2))) {
                        call_user_func_array(array($object,$method),array_slice($this->current_route , 2));
                    }
                    else {
                        header("HTTP/1.1 404 Not Found");
                        $error_message = "parameter_not_found";
                        include 'Errors/404.php';
                        exit;
                    }
                }
                else {
                    header("HTTP/1.1 404 Not Found");
                    $error_message = "method_not_found";
                    include 'Errors/404.php';
                    // print $error_message;
                    exit;
                }
            }
            else {
                header("HTTP/1.1 404 Not Found");
                $error_message = "class_not_found";
                include 'Errors/404.php';
                // print $error_message;
                exit;
            }
        }

    }

    // $rout = new Routing();
    // $rout->Run();
?>
