<?php
class common extends Controller {
    public function __construct(){
        //O $this->pagesModel=$this->model('loginPage');
      }

      public function index(){

      }

    public function aboutUs() {
        $data = [];
        $this->view('aboutUs');
    }

    public function help() {
        $data = [];
        $this->view('help');
    }

}
?>