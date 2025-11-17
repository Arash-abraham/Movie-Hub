<?php

    namespace System\View\Traits;

    trait HasExtendContent {
        private $extendContent;

        private function checkExtendContent() {
            $layoutsFilePath = $this->findExtend();
            if ($layoutsFilePath) {
                $this->extendContent = $this->viewLoader($layoutsFilePath);
            }
        }

        private function findExtend() {
            $filePathArray = [];
            
            preg_match("/\s*{%\s+extends\s+['\"]([^'\"]+)['\"]\s+%}/", $this->content, $filePathArray);
            
            if(isset($filePathArray[1])) {
                return $filePathArray[1];
            }
            
            return false;
        }
    }

    //DEBUG
    // $content1 = ' {%  extends   "base.app" %} ';
    // preg_match("/\s*{%\s+extends\s+['\"]([^'\"]+)['\"]\s+%}/", $content1, $match1);
    // var_dump($match1);
    
?>