<?php

    namespace System\Database\Traits;
    use System\Database\DBConnection\DBConnection;

    trait HasCRUD {

        public function saveMethod(){

        }

        protected function fill() {
            $fillArray = [];
            
            foreach ($this->fillable as $attribute) {
                if ($this->inGuardedAttribute($attribute)) {
                    continue;
                }
                
                if(isset($this->$attribute)) {
                    array_push($fillArray, $this->getAttributeName($attribute) . " = ?");
                    $this->inCastsAttribute($attribute) == true
                        ?
                            $this->addValue($attribute, $this->castEncodeValue($attribute, $this->$attribute))
                        :
                            $this->addValue($attribute, $this->$attribute);
                }
            }
        
            $fillString = implode(", ", $fillArray);
            return $fillString;
        }
        
        private function inGuardedAttribute($attribute) {
            return !empty($this->guarded) && in_array($attribute, $this->guarded);
        }
        
        // public function guard() {
        //     $guard = [];
        // }
    }

    
?> 