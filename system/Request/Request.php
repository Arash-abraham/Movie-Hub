<?php 

    namespace System\Request;

use Illuminate\Testing\Fluent\Concerns\Has;
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

        }
    }
?>