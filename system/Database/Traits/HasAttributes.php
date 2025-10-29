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

        protected function arrayToAttributs(array $array , $object = NULL) {
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
                $object = $this->arrayToAttributs($value);
                array_push($collection, $object);
            }

            $this->collection = $collection;
        }
        
        private function inHiddenAttribut($attribute) {
            return in_array($attribute, $this->hidden);
        }

        private function inCastsAttribute($attribute) {
            return in_array($attribute , array_keys($this->casts));
        }

        private function castDecodeValue($attributeKey , $value) {
            if($this->casts[$attributeKey] == 'array' or $this->casts[$attributeKey] == 'object') {
                return unserialize($value);
            }
            return $value;
        }

        private function castEncodeValue($attributeKey , $value) {
            if($this->casts[$attributeKey] == 'array' or $this->casts[$attributeKey] == 'object') {
                return serialize($value);
            }
            return $value;
        }

        private function arrayToCastEncodeValue($values) {
            $newArray = [];

            foreach($values as $attribute => $value) {
                $this->inCastsAttribute($attribute) == true
                    ?
                        $newArray[$attribute] = $this->castEncodeValue($attribute,$value)
                    :
                        $newArray[$attribute] = $value;
            }

            return $newArray;
        }
    }

?>