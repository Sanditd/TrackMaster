<?php
    class student extends controller{
        public function __construct() {
        }

        public function index(){
        }

        public function about($name){
            $this-> view('v_about');
        }
    }

?>