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
            
            preg_match(`/\s*{% extends\s+['"]([^'"]+)['"]\s*%}/`, $this->content, $filePathArray);
            
            if(isset($filePathArray[1])) {
                return $filePathArray[1];
            }
            
            return false;
        }
    }

    //DEBUG
    $content1 = "{% extends 'base.app' %}";
    preg_match(`/\s*{% extends\s+['"]([^'"]+)['"]\s*%}/`, $this->content, $filePathArray);

?>