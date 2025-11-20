<?php

    namespace System\View;

    class Composer {
        private static $instance;
        private $vars = [];
        private $viewArray;

        private function __construct() {
            
        }

        private static function getInstance() {
            if(empty(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;

        }
    }

?>