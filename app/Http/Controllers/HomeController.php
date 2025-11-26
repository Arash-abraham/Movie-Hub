<?php

    namespace App\Http\Controllers;

    class HomeController extends Controller {
        public function index() {
            return view('app',[
                'name' => 'arash'
            ]);
        }

        public function create() {
            print 'create method in HomeController';
        }

        public function store($id) {
            print 'store method in HomeController';
        }

        public function edit($id) {
            print 'edit method in HomeController';
        }

        public function update($id) {
            print 'update method in HomeController';
        }

        public function destroy($id) {
            print 'destroy method in HomeController';
        }
    }

?>