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
                if($this->inHiddenAttribut($attribute)) {
                    continue;
                }
                $this->registerAttribut($object , $attribute, $value);
            }
            return $object;
        }

        protected function arrayToObject(array $array) {
            $collection = [];

            foreach($array as $value) {
                $object = $this->arrayToAttribut($value);
                array_push($collection, $object);
            }

            $this->collection = $collection;
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