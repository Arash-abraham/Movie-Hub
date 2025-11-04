<?php

    namespace System\Database\Traits;

    use System\Database\DBConnection\DBConnection;

    trait HasCRUD {
        // ========== CREATE ==========
        protected function createMethod($values)
        {
            $values = $this->arrayToCastEncodeValue($values);
            $this->arrayToAttributes($values, $this);
            return $this->save();
        }

        // ========== UPDATE ==========
        protected function updateMethod($values)
        {
            $values = $this->arrayToCastEncodeValue($values);
            $this->arrayToAttributes($values, $this);
            return $this->save();
        }

        // ========== DELETE (Soft Delete) ==========
        protected function deleteMethod($id = null)
        {
            $object = $this;

            if ($id) {
                $this->resetQuery();
                $object = $this->findMethod($id);
                if (!$object) return false;
            }

            if ($object->deletedAt !== null) {
                $object->resetQuery();
                $object->setSql("UPDATE {$object->getTableName()} SET " . $object->getAttributeName($object->deletedAt) . " = NOW()");
                $object->setWhere("AND", $object->getAttributeName($object->primaryKey) . " = ?");
                $object->addValue($object->primaryKey, $object->{$object->primaryKey});
                return $object->executeQuery();
            }

            return $this->forceDeleteMethod($object);
        }

        // ========== FORCE DELETE (Hard Delete) ==========
        protected function forceDeleteMethod($object = null)
        {
            $object = $object ?? $this;

            $object->resetQuery();
            $object->setSql("DELETE FROM {$object->getTableName()}");
            $object->setWhere("AND", $object->getAttributeName($object->primaryKey) . " = ?");
            $object->addValue($object->primaryKey, $object->{$object->primaryKey});
            return $object->executeQuery();
        }

        public function forceDelete()
        {
            return $this->forceDeleteMethod();
        }

        protected function allMethod()
        {
            $this->resetQuery();
            $this->setSql("SELECT * FROM {$this->getTableName()}");

            if ($this->deletedAt !== null) {
                $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL");
            }

            $statement = $this->executeQuery();
            $data = $statement->fetchAll();

            if ($data) {
                $this->arrayToObject($data);
                return $this->collection;
            }

            return [];
        }

        protected function findMethod($id)
        {
            $this->resetQuery();
            $this->setSql("SELECT * FROM {$this->getTableName()}");
            $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ?", [$id]);

            if ($this->deletedAt !== null) {
                $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL");
            }

            $statement = $this->executeQuery();
            $data = $statement->fetch();

            $this->setAllowedMethods(['update', 'delete', 'save']);

            if ($data) {
                return $this->arrayToAttributs($data);
            }

            return null;
        }

        protected function whereMethod($attribute, $firstValue, $secondValue = null)
        {
            $condition = $secondValue === null
                ? $this->getAttributeName($attribute) . ' = ?'
                : $this->getAttributeName($attribute) . ' ' . $firstValue . ' ?';

            $this->addValue($attribute, $secondValue ?? $firstValue);
            $this->setWhere('AND', $condition);
            $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);
            return $this;
        }

        protected function whereOrMethod($attribute, $firstValue, $secondValue = null)
        {
            $condition = $secondValue === null
                ? $this->getAttributeName($attribute) . ' = ?'
                : $this->getAttributeName($attribute) . ' ' . $firstValue . ' ?';

            $this->addValue($attribute, $secondValue ?? $firstValue);
            $this->setWhere('OR', $condition);
            $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);
            return $this;
        }

        protected function whereNullMethod($attribute)
        {
            $this->setWhere('AND', $this->getAttributeName($attribute) . ' IS NULL');
            $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);
            return $this;
        }

        protected function whereNotNullMethod($attribute)
        {
            $this->setWhere('AND', $this->getAttributeName($attribute) . ' IS NOT NULL');
            $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);
            return $this;
        }

        protected function whereInMethod($attribute, $values)
        {
            if (is_array($values)) {
                $placeholders = [];
                foreach ($values as $value) {
                    $this->addValue($attribute, $value);
                    $placeholders[] = '?';
                }
                $this->setWhere('AND', $this->getAttributeName($attribute) . ' IN (' . implode(', ', $placeholders) . ')');
                $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate']);
                return $this;
            }
        }

        protected function orderByMethod($attribute, $expression)
        {
            $this->setOrderBy($attribute, $expression);
            $this->setAllowedMethods(['limit', 'orderBy', 'get', 'paginate']);
            return $this;
        }

        protected function limitMethod($from, $number)
        {
            $this->setLimit($from, $number);
            $this->setAllowedMethods(['limit', 'get', 'paginate']);
            return $this;
        }

        // ========== GET ==========
        protected function getMethod($array = [])
        {
            if ($this->sql == '') {
                $fields = empty($array) ? $this->getTableName() . '.*' : implode(', ', array_map([$this, 'getAttributeName'], $array));
                $this->setSql("SELECT {$fields} FROM {$this->getTableName()}");
            }

            if ($this->deletedAt !== null) {
                $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL");
            }

            $statement = $this->executeQuery();
            $data = $statement->fetchAll();

            if ($data) {
                $this->arrayToObjects($data);
                return $this->collection;
            }

            return [];
        }

        // ========== PAGINATE ==========
        protected function paginateMethod($perPage)
        {
            $totalRows = $this->getCount();
            $currentPage = max(1, min(isset($_GET["page"]) ? (int)$_GET["page"] : 1, ceil($totalRows / $perPage)));
            $currentRow = ($currentPage - 1) * $perPage;
            $this->setLimit($currentRow, $perPage);

            if ($this->sql == '') {
                $this->setSql("SELECT {$this->getTableName()}.* FROM {$this->getTableName()}");
            }

            if ($this->deletedAt !== null) {
                $this->setWhere("AND", $this->getAttributeName($this->deletedAt) . " IS NULL");
            }

            $statement = $this->executeQuery();
            $data = $statement->fetchAll();

            if ($data) {
                $this->arrayToObjects($data);
                return $this->collection;
            }

            return [];
        }

        // ========== SAVE ==========
        public function saveMethod()
        {
            $fillString = $this->fill();

            if (!isset($this->{$this->primaryKey})) {
                $this->setSql("INSERT INTO {$this->getTableName()} SET {$fillString}, 
                    {$this->getAttributeName($this->createdAt)} = NOW(), 
                    {$this->getAttributeName($this->updatedAt)} = NOW()");
            } else {
                $this->setSql("UPDATE {$this->getTableName()} SET {$fillString}, 
                    {$this->getAttributeName($this->updatedAt)} = NOW()");
                $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ?");
                $this->addValue($this->primaryKey, $this->{$this->primaryKey});
            }

            $this->executeQuery();
            $this->resetQuery();

            if (!isset($this->{$this->primaryKey})) {
                $object = $this->findMethod(DBConnection::newInsertId());
                $this->syncWithObject($object);
            }

            $this->setAllowedMethod(['update', 'delete', 'save']);
            return $this;
        }

        private function syncWithObject($object)
        {
            $defaultVars = get_class_vars(get_called_class());
            $allVars = get_object_vars($object);
            $differentVars = array_diff(array_keys($allVars), array_keys($defaultVars));

            foreach ($differentVars as $attribute) {
                $value = $this->inCastsAttribute($attribute)
                    ? $this->castEncodeValue($attribute, $object->$attribute)
                    : $object->$attribute;
                $this->registerAttribut($this, $attribute, $value);
            }
        }

        protected function fill()
        {
            $fillArray = [];
            foreach ($this->fillable as $attribute) {
                if ($this->inGuardedAttribute($attribute)) continue;
                if (isset($this->$attribute)) {
                    $fillArray[] = $this->getAttributeName($attribute) . " = ?";
                    $value = $this->inCastsAttribute($attribute)
                        ? $this->castEncodeValue($attribute, $this->$attribute)
                        : $this->$attribute;
                    $this->addValue($attribute, $value);
                }
            }
            return implode(", ", $fillArray);
        }

        private function inGuardedAttribute($attribute)
        {
            return !empty($this->guarded) && in_array($attribute, $this->guarded);
        }
    }
?>