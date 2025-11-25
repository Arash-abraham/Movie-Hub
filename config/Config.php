<?php

    namespace Config;
    class Config {
        private static $instance;
        private $config_nested_array = [];
        private $config_dot_array = [];

        private function __construct() {
            $this->initialConfigArrays();
        }
        
        private function initialConfigArrays() {
            $configPath = dirname(dirname(__DIR__)) . '/config/';
            foreach(glob($configPath . '*.php') as $fileName) {
                $config = require $fileName;
                $key = $fileName;
                $key = str_replace($configPath , '' , $key);
                $key = str_replace('.php' , '' , $key);
                $this->config_nested_array[$key] = $config;
            }
            $this->initialDefualtValues();
            $this->config_dot_array = $this->array_dot($this->config_nested_array);
        }

        private function initialDefualtValues() {
            // $temporary = str_replace($this->config_nested_array['app']['BASE_URL'],'',explode('?',$_SERVER['REQUEST_URI'][0])); // ERROR
            $exploded = explode('?', $_SERVER['REQUEST_URI']); // حذف [0]
            $temporary = str_replace($this->config_nested_array['app']['BASE_URL'], '', $exploded[0]); //TRUE Code

            if($temporary === '/') {
                $temporary = '';
            }
            else {
                $temporary = substr($temporary ,1);
            }

            $this->config_nested_array['app']['CURRENT_ROUTE'] = $temporary;

        }

        private function array_dot($array, $return_key = '') {
            $return_array = [];
            foreach($array as $key => $value) {
                $new_key = $return_key . $key;
                if(is_array($value)) {
                    $return_array = array_merge(
                        $return_array, 
                        $this->array_dot($value, $new_key . '.')
                    );
                } else {
                    $return_array[$new_key] = $value;
                }
            }
            return $return_array;
        }

        private static function getInstance() {
            if(empty(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public static function get($key) {
            $instance = self::getInstance();
            if(isset($instance->config_dot_array[$key])) {
                return $instance->config_dot_array[$key];
            }
            else {
                throw new \Exception('"' . $key . '" not exist in config');
            }
        }
    }

?>