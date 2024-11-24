<?php
    class login extends Controller{
        public function __construct(){
          //O $this->pagesModel=$this->model('loginPage');
        }

        public function index(){

        }

        public function login($name){
            $data=[
                'username'=>$name
            ];
            $this->view('login');
        }


    }
?>