<?php
    namespace System\Bootstrap;
    class Autoload {
        public static function Loader() {
            spl_autoload_register(function($className) {
                $className = str_replace('\\' , DIRECTORY_SEPARATOR , $className);
                require_once $_SERVER['DOCUMENT_ROOT']. "/MVC/{$className}.php";
            });
        }
    } 
?>  
