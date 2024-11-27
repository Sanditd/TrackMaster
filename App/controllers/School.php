<?php

class School extends Controller{

    public function __construct() {
        
    }


    public function Dashboard(){
        $data = [];

        $this->view('School/school');
    }

    public function EditProfile(){
        $data = [];

        $this->view('School/editSchool');
    }

    public function Profile(){
        $data = [];

        $this->view('School/schoolProfile');
    }
    public function StudentsData(){
        $data = [];
        $this->view('School/schoolStudentData');
}
public function records(){
    $data = [];
    $this->view('School/records');
}
public function requests(){
    $data = [];
    $this->view('School/event');
}

}

?>