<?php

    namespace System\Database\Traits;

    use System\Database\DBConnection\DBConnection;

    trait HasQueryBuilder {
        private $sql = "";
        protected $where = []; 
        private $orderBy = [];
        private $limit = [];
        private $values = [];
        private $bindValues = [];

        protected function setSql($query) {
            $this->sql = $query;
        }

        protected function getSql() {
            return $this->sql;
        }

        protected function resetSql() {
            $this->sql = "";
        }

        protected function setWhere($operator , $condition) {
            $array = ["operator" => $operator, "condition"=> $condition];
            array_push($this->where, $array);
        }

        protected function resetWhere() {
            $this->where = [];
        }

    }


?>