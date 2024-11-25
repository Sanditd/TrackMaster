<?php
    class dashboard extends Controller{
        public function __construct(){
           
        }

        public function index(){

        }

        public function dashboard(){
            $data=[];
            $this->view('/Admin/adminpanelview');
        }
    }
?>