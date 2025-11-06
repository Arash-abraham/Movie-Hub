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
                else if (strpos($rule,'exists:') === 0) {
                    $rule = str_replace('exists:','', $rule);
                    $rule = explode(',', $rule);
                    $kry = isset($rule[1]) == false
                        ? 
                            NULL
                        : 
                            $rule[1];
                    $this->existsIn($name, $rule[0], $kry);
                }
                else if($rule == 'email') {
                    $this->email($name);
                }
                else if($rule == 'date') {
                    $this->date($name);
                }
            }
        }
    }

?>