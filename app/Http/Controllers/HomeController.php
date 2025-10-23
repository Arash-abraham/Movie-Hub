<?php

    namespace App\Http\Controllers;

    class HomeController extends Controller {
        public function index() {
            print 'index method in HomeController';
        }

        public function create() {
            print 'create method in HomeController';
        }

        public function store() {
            print 'store method in HomeController';
        }
        
    }

?>