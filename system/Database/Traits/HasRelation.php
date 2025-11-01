<?php

    namespace System\Database\Traits;

    trait HasRelation {
        protected function hasOne($model , $foreignKey , $localKey) {
            if($this->{$this->primaryKey}) {
                $modelObject = new $model;
                return $modelObject->getHasRelation();
            }
        }

        public function getHasRelation($table , $foreignKey , $otherKey , $otherKeyValue) {

        }

    }

?>