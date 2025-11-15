<?php

    namespace System\View\Traits;

    trait HasViewLoader {
        private $viewNameArray = [];

        private function ViewLoader($dir) {
            $dir = trim($dir," .");
            $dir = str_replace(".","/", $dir);
            if(file_exists(dirname(dirname(dirname(__DIR__))))) {
                // __DIR__ => /Avesta/system/View/Traits
                // dirname(__DIR__) => /Avesta/system/View
                // dirname(dirname(__DIR__) => /Avesta/system
                // dirname(dirname(dirname(__DIR__))) => /Avesta

            }
        }

        private function registerView($view) {
            array_push($this->viewNameArray, $view);
        }
    }

    // DEBUG
    // print dirname(dirname(dirname(__DIR__)));

?>