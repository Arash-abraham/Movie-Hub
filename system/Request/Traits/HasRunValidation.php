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

        }
    }

?>