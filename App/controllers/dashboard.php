<?php
    class dashboard extends Controller{
        public function __construct(){
           
        }

        public function index(){

        }

        public function dashboardPage(){
            $data=[];
            $this->view('adminpanelview');
        }
    }
?>