<?php
    class student extends controller{
        public function __construct() {
        }

        public function index(){
        }

        public function about($name,$age){
            $data = [
                'userName' => $name,
                'userAge' => $age
            ];
            $this->view('v_about', $data);
        }
    }
