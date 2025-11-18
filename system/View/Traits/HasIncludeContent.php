<?php

    namespace System\View\Traits;

    trait HasIncludeContent {

        private function checkIncludeContent() {
        }


        private function findBlocksNames() {
            $blocksNamesArray = [];
            
            preg_match_all("/\s*{%\s+extends\s+['\"]([^'\"]+)['\"]\s+%}/", $this->extendContent, $blocksNamesArray , PREG_UNMATCHED_AS_NULL);
            
            if(isset($blocksNamesArray[1])) {
                return $blocksNamesArray[1];
            }
            
            return false;
        }

        private function initialIncludes($includeName) {
        }
    }

    //DEBUG
    // $content1 = ' {%  extends   "base.app" %} ';
    // preg_match("/\s*{%\s+extends\s+['\"]([^'\"]+)['\"]\s+%}/", $content1, $match1);
    // var_dump($match1);
    
?>