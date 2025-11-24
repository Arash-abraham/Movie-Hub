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
    }

?>