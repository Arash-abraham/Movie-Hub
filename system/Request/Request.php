<?php 

    namespace System\Request;

    use System\Request\Traits\HasFileValidationRules;
    use System\Request\Traits\HasRunValidation;
    use System\Request\Traits\HasValidationRules;

    class Request {
        use HasFileValidationRules, HasRunValidation, HasValidationRules;

        protected $errorExist = false;
        protected $request;
        protected $files = NULL;
        protected $errorVariablesName = [];

        public function __construct() {
            if(isset($_POST)){
                $this->postAttributes();
            }
            if(!empty($_FILES)){
                $this->files = $_FILES;
            }

            $rules = $this->rules();
            if(!empty($rules)) {
                $this->run($rules);
            }
            $this->errorRedirect();
        }

        protected function run($rules) {
            foreach($rules as $att => $value) {
                $ruleArray = explode("|", $value);
                if(in_array('file' , $ruleArray)) {
                    $this->fileVaidation($att, $ruleArray);
                }
                else if(in_array('number', $ruleArray)) {
                    $this->numberValidation($att, $ruleArray);
                }
                else {
                    $this->normalValidation($att, $ruleArray);
                }
            }
        }

        protected function rules() {
            return [];
        }

        public function file($name) {
            return isset($this->files[$name])
                ? 
                    $this->files[$name]
                :
                    false;
        }

        protected function postAttributes() {
            foreach($_POST as $key => $value) {
                $this->{$key} = htmlentities($value);
                $this->request[$key] = $value;
            }
        }

        public function all() {
            return $this->request;
        }
    }
?>