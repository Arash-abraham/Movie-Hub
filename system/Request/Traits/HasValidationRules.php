<?php 
    namespace System\Request\Traits;
    use System\Database\DBConnection\DBConnection;

    trait HasValidationRules {
        public function normalValidation($name, $ruleArray) {
            foreach ($ruleArray as $rule) {
                if (is_array($rule)) {
                    
                }
            }
        }
    }

?>