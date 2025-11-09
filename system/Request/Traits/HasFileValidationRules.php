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
            }
        }
    }
?>