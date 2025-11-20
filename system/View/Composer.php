<?php

    namespace System\View;

    class Composer {
        private static $instance;
        private $vars = [];
        private $viewArray;

        private function __construct() {
            
        }

        private function registerView($name , $callBack) {
            
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