<?php

    namespace System\Database\Traits;
    use System\Database\DBConnection\DBConnection;

    trait HasCRUD {
        protected function fill() {
            $fillArray = [];
            foreach ($this->fillable as $attribute) {
                if(isset($this->$attribute)) {
                    array_push($fillArray, $this->getAttributeName($attribute) . " = ?");
                    $this->inCastsAttribute($attribute) == true
                        ?
                            $this->addValue($attribute , $this->castEncodeValue($attribute , $this->$attribute))
                        :
                            $this->addValue($attribute , $this->$attribute);
                }
            }

            $fillString = implode(", ", $fillArray);
            return $fillString;
        }
        // public function guard() {
        //     $guard = [];
        // }
    }

    
?> 