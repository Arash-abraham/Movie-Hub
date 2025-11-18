<?php

    namespace System\View\Traits;

    trait HasIncludeContent {

        private function checkIncludeContent() {
            while(true) {
                $includesNameArray = $this->findIncludesNames();
                if(!empty($includesNameArray)) {
                    foreach($includesNameArray as $includeName) {
                        $this->initialIncludes($includeName);
                    }
                }
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
            $this->content = str_replace("{% include '$includeName' %}",$this->viewLoader($includeName) , $this->content);
        }
    }

    //DEBUG
    // $content1 = ' {%  extends   "base.app" %} ';
    // preg_match("/\s*{%\s+extends\s+['\"]([^'\"]+)['\"]\s+%}/", $content1, $match1);
    // var_dump($match1);
    
?>