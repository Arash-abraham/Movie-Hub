<?php

    namespace System\Database\Traits;

    trait HasSoftDelete {
        protected function deleteMethod($id = NULL){
            $object = $this;

            if($id) {
                $this->resetQuery();

                $object = $this->findMethod($id);
            }

            if($object) { 
                $object->resetQuery();
                $object->setSql("UPDATE {$object->getTableName()}"."SET ".$this->getAttributeName($this->deletdAt). " = NOW()");
                $object->setWhere("AND", $this->getAttributeName($object->primaryKey)." = ?");
                $object->addValue($object->primaryKey , $object->{$object->primaryKey});
                
                return $object->executeQuery();
            }
        }
        protected function allMethod() {
            $this->setSql("SELECT ".$this->getTableName().".* FROM ".$this->getTableName());
            $this->setWhere("AND", $this->getAttributeName($this->primaryKey)." IS NULL");
        
            $statement = $this->executeQuery();
            $data = $statement->fetchAll();

            if($data) {
                $this->arrayToObject($data);
                return $this->collection;
            }

            return [];
        }

    }

?>