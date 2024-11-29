<?php
class guardian extends Controller {
    public function __construct(){
        //O $this->pagesModel=$this->model('loginPage');
      }

      public function dashboard() {
        $data = [];
        $this->view('Parent/parent');
    }

    public function editParent() {
        $data = [];
        $this->view('Parent/editParent');
    }

    public function parentProfile() {
        $data = [];
        $this->view('Parent/parentProfile');
    }

    public function studentAch() {
        $data = [];
        $this->view('Parent/studentAch');
    }

    public function studentRec() {
        $data = [];
        $this->view('Parent/studentRec');
    }

    public function viewSchool() {
        $data = [];
        $this->view('Parent/viewSchool');
    }

    public function viewStudent() {
        $data = [];
        $this->view('Parent/viewStudent');
    }

    public function viewCoach() {
        $data = [];
        $this->view('Parent/viewCoach');
    }

}
?>