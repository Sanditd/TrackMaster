<?php
    class userManageController extends Controller{
        public function __construct(){
          //O $this->pagesModel=$this->model('loginPage');
        }

        public function index(){

        }

        public function userManage($name){
            $data=[
                'username'=>$name
            ];
            $this->view('userManage');
        }

    }
?>