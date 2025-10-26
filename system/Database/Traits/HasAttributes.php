<?php

    namespace System\Database\Traits;

    trait HasAttributes {
        private function registerAttribut($object , string $attribute, $value) {
            $this->inCastsAttribute($attribute) === true 
                ? 
                    $object->$attribute = $this->castDecodeValue($attribute , $value)
                : 
                    $object->$attribute = $value;
        }

        protected function arrayToAttribut(array $array , $object = NULL) {
            
        }

        protected function arrayToObject() {
            // TODO
        }
        
        private function inHiddenAttribut() {
            // TODO
        }

        private function inCastsAttribute() {
            // TODO
        }

        private function castDecodeValue() {
            // TODO
        }

        private function castEncodeValue() {
            // TODO
        }

        private function arrayToCastEncodeValue() {
            // TODO
        }
    }

?>