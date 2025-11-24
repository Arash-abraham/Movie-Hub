<?php

    class Config {
        private static $instance;
        private $config_nested_array = [];
        private $config_dot_array = [];

        private function __construct() {
            $this->initialConfigArrays();
        }
        
        private function initialConfigArrays() {

        }

        private static function getInstance() {
            if(empty(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public static function get($key) {
            $instance = self::getInstance();
        }
    }

?>