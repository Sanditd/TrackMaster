<?php

class Student extends Controller{
    private $studentModel;

    public function __construct() {
        $this->studentModel = $this->model('StudentModel');
    }


    public function dashboard(){
        $data = [];

        $this->view('Student/dashboard');

    }

    public function editStudentProfile(){
        $data = [];

        $this->view('Student/editStudentProfile');

    }

    public function editAchievement(){
        $data = [];

        $this->view('Student/editAchievement');

    }

    public function financialStatus(){
        $data = [];

        $this->view('Student/financialStatus');

    }

    public function medicalStatus(){
        $data = [];

        $this->view('Student/medicalStatus');

    }

    public function studentAchievements(){
        $data = [];

        $this->view('Student/studentAchievements');

    }

    public function studentprofile(){
        $data = [];

        $this->view('Student/studentprofile');

    }

    public function studentSchedule(){
        $data = [];

        $this->view('Student/studentSchedule');

    }  
    
    
}