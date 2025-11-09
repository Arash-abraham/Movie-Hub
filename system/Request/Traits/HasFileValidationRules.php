<?php 

    namespace System\Request\Traits;

    use System\Database\DBConnection\DBConnection;

    trait HasFileValidationRules {
        protected function fileValidation($name,$ruleArray) {
            foreach($ruleArray as $rule) {
                if($rule == 'required') {
                    $this->fileRequired($name);
                }
                else if (strpos($rule,'mimes:') === 0) {
                    $rule = str_replace('mimes:','', $rule);
                    $rule = explode(',', $rule);
                    $this->filetype($name, $rule);
                }
                elseif (strpos($rule, "max:") === 0) {
                    $rule = str_replace('max:', "", $rule);
                    $this->maxFile($name, $rule);
                } 
                elseif (strpos($rule, "min:") === 0) {
                    $rule = str_replace('min:', "", $rule);
                    $this->minFile($name, $rule);
                }
            }
        }
        protected function fileRequired($name) {
            
        }
    }
?>