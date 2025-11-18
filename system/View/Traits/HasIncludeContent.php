<?php

    namespace System\View\Traits;

    trait HasIncludeContent {

        private function checkIncludeContent() {
        }

        private function findExtend() {
            $filePathArray = [];
            
            preg_match("/\s*{%\s+extends\s+['\"]([^'\"]+)['\"]\s+%}/", $this->content, $filePathArray); //$this->content  error?
            
            if(isset($filePathArray[1])) {
                return $filePathArray[1];
            }
            
            return false;
        }

        private function findBlocksNames() {
            $blocksNamesArray = [];
            
            preg_match_all("/\s*{%\s+extends\s+['\"]([^'\"]+)['\"]\s+%}/", $this->extendContent, $blocksNamesArray , PREG_UNMATCHED_AS_NULL);
            
            if(isset($blocksNamesArray[1])) {
                return $blocksNamesArray[1];
            }
            
            return false;
        }

        private function initialBlocks($blockName) {
            $string = $this->content;
            $startWord = "{% block ".$blockName." %}";
            $endWord = "{% endblock %}";

            $startPos = strpos($string, $startWord);

            if($startPos === false) {
                return $this->extendContent = str_replace("{% bloack $blockName %}{% endblock %}" , "" , $this->extendContent);
            }

            $startPos += strlen($startWord);
            $endPos = strpos($string, $endWord, $startPos);

            if($startPos === false) {
                return $this->extendContent = str_replace("{% bloack $blockName %}{% endblock %}" , "" , $this->extendContent);
            }
            
            $length = $endPos - $startPos;

            $blockContent = substr($string, $startPos, $length);
            return $this->extendContent = str_replace("{% bloack $blockName %}{% endblock %}" , $blockContent , $this->extendContent);
        
        }
    }

    //DEBUG
    // $content1 = ' {%  extends   "base.app" %} ';
    // preg_match("/\s*{%\s+extends\s+['\"]([^'\"]+)['\"]\s+%}/", $content1, $match1);
    // var_dump($match1);
    
?>