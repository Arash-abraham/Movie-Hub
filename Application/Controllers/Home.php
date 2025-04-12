<?php
    namespace Application\Controllers;
    class Home extends Controller{
        public function index() {
            $this->View('App.index');
        }
        public function test(){
            print 'Hello from App\Controllers\Home test';
        }
    }
?>
