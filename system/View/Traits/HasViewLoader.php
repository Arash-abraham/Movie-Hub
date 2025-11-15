<?php

    namespace System\View\Traits;

    trait HasViewLoader {
        private $viewNameArray = [];

        private function ViewLoader($dir) {
            $dir = trim($dir," .");
            $dir = str_replace(".","/", $dir);
            $path = dirname(dirname(dirname(__DIR__)));
            if(file_exists($path."/resources/View/$dir.twig")) {
                // __DIR__ => /Avesta/system/View/Traits
                // dirname(__DIR__) => /Avesta/system/View
                // dirname(dirname(__DIR__) => /Avesta/system
                // dirname(dirname(dirname(__DIR__))) => /Avesta
                $this->registerView($dir);
                $content = file_get_contents($path."/resources/View/$dir.twig");
                return $content;
            }
            else {
                throw new \Exception("View not found");
            }
        }

        private function registerView($view) {
            array_push($this->viewNameArray, $view);
        }
    }

    // DEBUG
    // print dirname(dirname(dirname(__DIR__)));
    // if(file_exists(dirname(dirname(dirname(__DIR__)))."/resources/View/app.twig")) {
    //     print 'Ok';        
    // } else {
    //     print dirname(dirname(dirname(__DIR__)))."/resources/view/app.twig";
    // }

?>