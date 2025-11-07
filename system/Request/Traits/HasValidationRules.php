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
        public function numberValidation($name, $ruleArray) {
            foreach ($ruleArray as $rule) {
                if ($rule == 'required') {
                    $this->required($name);
                }
                else if (strpos($rule,'max:') === 0) {
                    $rule = str_replace('max:','', $rule);
                    $this->maxNumber($name, $rule);
                }
                else if (strpos($rule,'min:') === 0) {
                    $rule = str_replace('min:','', $rule);
                    $this->minNumber($name, $rule);
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
                else if($rule == 'number') {
                    $this->number($name);
                }
            }
        }
        protected function maxStr($name, $count) {
            if($this->chechFieldExist($name)) {
                if(strlen($this->request[$name]) >= $count && $this->checkFirstError($name)) {
                    $this->setError($name,'max number equal or lower than ' . $count .' character');
                }
            }
        }
        protected function minStr($name, $count) {
            if($this->chechFieldExist($name)) {
                if(strlen($this->request[$name]) <= $count && $this->checkFirstError($name)) {
                    $this->setError($name,'min number equal or upper than ' . $count .' character');
                }
            }
        }
        protected function maxNumber($name, $count) {
            if($this->chechFieldExist($name)) {
                if($this->request[$name] <= $count && $this->checkFirstError($name)) {
                    $this->setError($name,'max number equal or lower than ' . $count .' character');
                }
            }
        }
        protected function minNumber($name, $count) {
            if($this->chechFieldExist($name)) {
                if($this->request[$name] <= $count && $this->checkFirstError($name)) {
                    $this->setError($name,'min number equal or upper than ' . $count .' character');
                }
            }
        }
        protected function required($name) {
            if((!isset($this->request[$name]) or $this->request[$name] === '' ) && $this->checkFirstError($name)) {
                $this->setError($name,"$name is required");
            }
        }
        protected function number($name) {
            if($this->chechFieldExist($name)) {
                if(!is_numeric()) {

                }
            }
        }
    }

?>