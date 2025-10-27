<?php

    namespace System\Database\Traits;
    use System\Database\DBConnection\DBConnection;

    trait HasCRUD {
        protected function fill() {
            $fillArray = [];
            foreach ($this->fillable as $attribute) {
                if(isset($this->$attribute)) {
                    
                }
            }
        }
    }

    
?> 