<?php 
    namespace System\Request\Traits;
    use System\Database\DBConnection\DBConnection;

    trait HasValidationRules {
        public function normalValidation($name, $ruleArray) {
            foreach ($ruleArray as $rule) {
                if ($rule == 'required') {
                    $this->required($name);
                }
                else if (strpos($rule,'max:') === 0) {
                    $rule = str_replace('max:','', $rule);
                    $this->maxStr($name, $rule);
                }
                else if (strpos($rule,'min:') === 0) {
                    $rule = str_replace('min:','', $rule);
                    $this->minStr($name, $rule);
                }
            }
        }
    }

?>