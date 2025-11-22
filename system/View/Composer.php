<?php

    namespace System\View;

    class Composer {
        private static $instance;
        private $vars = [];
        private $viewArray;

        private function __construct() {
            
        }

        private function registerView($name , $callBack) {
            if(in_array(str_replace('.','/',$name) , $this->viewArray) or $name == '*') {
                $viewVars = $callBack();
                foreach($viewVars as $key => $value) {
                    $this->vars[$key] = $value;
                }
            }
            if(isset($this->viewArray[$name])) {
                unset($this->viewArray[$name]);
            }
        }


        private function setViewArray($viewArray) {
            $this->viewArray = $viewArray;
        }

        private function getViewVars() {
            return $this->vars;
        }

        private static function getInstance() {
            if(empty(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;

        }
    }

?>