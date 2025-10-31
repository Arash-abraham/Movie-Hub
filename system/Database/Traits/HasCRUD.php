<?php

    namespace System\Database\Traits;
    use System\Database\DBConnection\DBConnection;

    trait HasCRUD {

        protected function delete($id = NULL){
            $object = $this;
            $this->resetQuery();

            if($id) {
                $object = $this->find($id);
                $this->resetQuery();
            }

            $object->setSql("DELETE FROM {$object->getTableName()}");
            $object->setWhere("AND", $this->getAttributeName($this->primaryKey)." = ?");
        
            $object->addValue($object->primaryKey , $object->{$object->primaryKey});
            
            return $object->executeQuery();
        }

        protected function all() {
            $this->setSql("SELECT * FROM {$this->getTableName()}");
            $statement = $this->executeQuery();
            $data = $statement->fetchAll();

            if($data) {
                $this->arrayToObject($data);
                return $this->collection;
            }

            return [];
        }

        protected function find($id) {
            $this->setSql("SELECT * FROM {$this->getTableName()}");
            $this->setWhere("AND", $this->getAttributeName($this->primaryKey)." = ?");

            $this->addValue($this->primaryKey);
            $statement = $this->executeQuery();
            $data = $statement->fetch();
            $this->setAllowedMethods(['update','delete','save']);
        
            if($data) {
                return $this->arrayToAttributs($data);
            }
            return NULL;
        }

        protected function where($attribute , $firstValue , $secondValue = NULL) {
            if($secondValue === NULL) {
                $condition = $this->getAttributeName($attribute) . ' = ?';
                $this->addValue($attribute, $firstValue);
            }
            else {
                $condition = $this->getAttributeName($attribute) . ' ' . $firstValue . ' ?';
                $this->addValue($attribute, $secondValue);
            }

            $operator = 'AND';
            $this->setWhere($operator,$condition);
            $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);        
            return $this;
        } 

        protected function whereOr($attribute , $firstValue , $secondValue = NULL) {
            if($secondValue === NULL) {
                $condition = $this->getAttributeName($attribute) . ' = ?';
                $this->addValue($attribute, $firstValue);
            }
            else {
                $condition = $this->getAttributeName($attribute) . ' ' . $firstValue . ' ?';
                $this->addValue($attribute, $secondValue);
            }

            $operator = 'OR';
            $this->setWhere($operator,$condition);
            $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);        
            return $this;
        } 
        
        protected function whereNull($attribute) {

            $condition = $this->getAttributeName($attribute) . ' IS NULL '; // " IS NULL " => SQL

            $operator = 'AND';
            $this->setWhere($operator,$condition);
            $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);        
            return $this;
        }

        protected function whereNotNull($attribute) {

            $condition = $this->getAttributeName($attribute) . ' IS NOT NULL '; // " IS NOT NULL " => SQL

            $operator = 'AND';
            $this->setWhere($operator,$condition);
            $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);        
            return $this;
        } 

        protected function whereIn($attribute , $values) {
            if(is_array($values)) {
                $valuesArray = [];
                foreach($values as $value) {
                    $this->addValue($attribute, $value);
                    array_push($valuesArray, '?');
                }
                $condition = $this->getAttributeName($attribute) . ' IN (' . implode(' , ', $valuesArray)  . ')';
                $operator = 'AND';
                $this->setWhere($operator,$condition);
                $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);        
                return $this;
            }
        }

        protected function orderBy($attribute , $expression) {
            $this->setOrderBy($attribute, $expression);
            $this->setAllowedMethods(['limit', 'orderBy', 'get', 'paginate']);        
            return $this;
        }

        protected function limit($from , $number) {
            $this->setLimit($from, $number);
            $this->setAllowedMethods(['limit', 'get', 'paginate']);        
            return $this;
        }

        protected function get($array = []) {
            if($this->sql = '') {
                if(empty($array)) {
                    $fields = $this->getTableName() . '*'; // * All In SQL 
                }
                else {
                    foreach($array as $key => $field) {
                        $array[$key] = $this->getAttributeName($field);
                    }

                    $fields = implode(' , ', $array); 
                }
                $this->setSql("SELECT {$fields} FROM {$this->getTableName()}");
            }
            
            $statement = $this->executeQuery();
            $data = $statement->fetchAll();
            if($data) {
                $this->arrayToObjects($data);
                return $this->collection;
            }
            return [];
        }

        protected function paginate() {
            
        }

        public function save(){
            $fillString = $this->fill();

            if(!isset($this->{$this->primaryKey})) {
                $this->setSql("INSERT INTO 
                        {$this->getTableName()} SET {$fillString} ,  
                        {$this->getAttributeName($this->createdAt)} = NOW() , 
                        {$this->getAttributeName($this->updatedAt)} = NULL
                ");
            }
            else {
                $this->setSql("UPDATE 
                    {$this->getTableName()} SET {$fillString} ,  
                    {$this->getAttributeName($this->updatedAt)} = NOW()
                ");
                $this->setWhere("AND", $this->getAttributeName($this->primaryKey)." = ?");
                $this->addValue($this->primaryKey , $this->{$this->primaryKey});
            }

            $this->executeQuery();

            $this->resetQuery();

            if(!isset($this->{$this->primaryKey})) {
                $object = $this->find(DBConnection::newInsertId());
                $defultVars = get_class_vars(get_called_class());
                $allVars = get_object_vars($object);

                $differentVars = array_diff(array_keys($allVars), $defultVars);
                
                foreach($differentVars as $attribute) {
                    $this->inCastsAttribute($attribute) == true
                        ?
                            $this->registerAttribut($this , $attribute , $this->castEncodeValue($attribute,$object->$attribute))
                        :
                        $this->registerAttribut($this , $attribute , $object->$attribute);
                    ;
                }
            }
            $this->resetQuery();
            
            $this->setAllowedMethod(['?' , '?' , '?']); // TODO

            return $this;
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
    }

    
?> 