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

        public static function __callStatic($name, $arguments) {
            $instance = self::getInstance();
            switch($name) {
                case 'view':
                    return call_user_func(array($instance,'registerView'),$arguments);
                break;
                case 'setViews':
                    return call_user_func(array($instance,'setViewArray'),$arguments);
                break;
                case 'getVars':
                    return call_user_func(array($instance,'getViewVars'),$arguments);
                break;
            }
        }

        private static function getInstance() {
            if(empty(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;

        }
    }

?>