<?php

    namespace System\Request\Traits;

    trait HasRunValidation {
        protected function errorRedirect() {
            if($this->errorExist == false ) {
                return $this->request;
            }
            return back(); // Will be developed later.
        }

        private function checkFirstError($name) {
            // errorExist Will be developed later.
            if(!errorExist($name) && !in_array($name , $this->errorVariablesName)) {
                return true;
            }
            return false;
        }

        private function checkFieldExist($name) {
            return (isset($this->reqest($name)) && )
        }
    }

?>