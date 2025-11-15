<?php

    namespace System\View\Traits;

    trait HasExtendContent {
        private $extendContent;

        private function checkExtendContent() {
            $layoutsFilePath = $this->findExtend();
            if ($layoutsFilePath) {

            }
        }

        private function findExtend() {
            $filePathArray = [];
            
            preg_match("TODO", $this->content, $filePathArray);
            
            if(isset($filePathArray[1])) {
                return $filePathArray[1];
            }
            
            return false;
        }
    }


?>