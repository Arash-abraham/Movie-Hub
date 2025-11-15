<?php

    namespace System\View\Traits;

    trait HasViewLoader {
        private $viewNameArray = [];

        private function ViewLoader($dir) {
            $dir = trim($dir," .");
            $dir = str_replace(".","/", $dir);
        }

        private function registerView($view) {
            array_push($this->viewNameArray, $view);
        }
    }

?>