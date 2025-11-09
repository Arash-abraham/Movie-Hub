<?php 

    namespace System\Request\Traits;

    use System\Database\DBConnection\DBConnection;

    trait HasFileValidationRules {
        protected function fileValidation($name,$ruleArray) {
            foreach($ruleArray as $rule) {
                if($rule == 'required') {
                    $this->fileRequired($name);
                }
                else if (strpos($rule,'mimes:') === 0) {
                    $rule = str_replace('mimes:','', $rule);
                    $rule = explode(',', $rule);
                    $this->filetype($name, $rule);
                }
                elseif (strpos($rule, "max:") === 0) {
                    $rule = str_replace('max:', "", $rule);
                    $this->maxFile($name, $rule);
                } 
                elseif (strpos($rule, "min:") === 0) {
                    $rule = str_replace('min:', "", $rule);
                    $this->minFile($name, $rule);
                }
            }
        }
        protected function fileRequired($name) {
            if(!isset($this->files[$name]['name']) || empty($this->files[$name]['name']) && $this->checkFirstError($name)) {
                $this->setError($name , "$name is required");
            }
        }
        protected function fileType($name , $typesArray) {
            if($this->checkFirstError($name) && $this->checkFileExist($name)) {
                $currentFileType = explode("/", $this->file[$name]["type"][1]);
            
                if(!in_array($currentFileType, $typesArray)) {
                    $this->setError($name ,"$name type must be" . implode(",", $typesArray));
                }
            }
        }
        protected function maxFile($name , $size)

    }
?>