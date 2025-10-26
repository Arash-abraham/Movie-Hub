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
            if(!$object) {
                $className = get_called_class();
                $object = new $className;
            }
            foreach($array as $attribute => $value) {

            }
            return $object->arrayToAttribut($array);
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