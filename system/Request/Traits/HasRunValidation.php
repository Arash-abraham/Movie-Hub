<?php

    namespace System\Request\Traits;

use function Laravel\Prompts\error;

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
            return (isset($this->reqest[$name]) && !empty($this->reqest[$name])) ? true : false;
        }

        private function checkFileExist($name) {
            if(isset($this->files[$name]['name'])) {
                if(!empty($this->reqest[$name]['name'])) {
                    return true;
                }
                return false;
            }
            return false;
        }

        private function setError($name , $errorMessage) {
            array_push($this->errorVariablesName , $name , $errorMessage);
            error($name , $errorMessage);
            $this->errorExist = true;
        }
    }

?>