<?php

    namespace System\View\Traits;

    trait HasViewLoader {
        private $viewNameArray = [];

        private function ViewLoader() {
            $dir = __DIR__ ."";
        }

        private function registerView($view) {
            array_push($this->viewNameArray, $view);
        }
    }

?>