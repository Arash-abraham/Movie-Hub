<?php

    namespace System\View\Traits;

    trait HasIncludeContent {

        private function checkIncludeContent() {
            while(true) {
                $includesNameArray = $this->findIncludesNames();
            }
        }


        private function findIncludesNames() {
            $includesNamesArray = [];
            
            preg_match_all("/\s*{%\s+include\s+['\"]([^'\"]+)['\"]\s+%}/", $this->content, $includesNameArray , PREG_UNMATCHED_AS_NULL);
            
            if(isset($includesNameArray[1])) {
                return $includesNameArray[1];
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