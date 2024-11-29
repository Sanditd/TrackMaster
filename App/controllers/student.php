<?php
class Student extends Controller {
    private $studentModel;

    public function __construct() {
        $this->studentModel = $this->model('StudentModel');
    }

    public function dashboard() {
        $data = [];
        $this->view('Student/dashboard');
    }

    public function editStudentProfile() {
        $data = [];
        $this->view('Student/editStudentProfile');
    }

    public function saveAchievement() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $data = [
                'place' => trim($_POST['place']),
                'level' => trim($_POST['level']),
                'description' => trim($_POST['description']),
                'date' => trim($_POST['date'])
            ];

            if ($this->studentModel->addAchievement($data)) {
                header('Location: ' . URLROOT . '/Student/studentAchievements');
            } else {
                die('Something went wrong');
            }
        } else {
            // Load form
            $this->view('Student/addAchievement');
        }
    }

    public function editAchievement($id = null) {
        if ($id === null) {
            // Handle the case where ID is not provided
            header('Location: ' . URLROOT . '/Student/studentAchievements');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $data = [
                'id' => $id,
                'place' => trim($_POST['place']),
                'level' => trim($_POST['level']),
                'description' => trim($_POST['description']),
                'date' => trim($_POST['date'])
            ];

            if ($this->studentModel->updateAchievement($data)) {
                header('Location: ' . URLROOT . '/Student/studentAchievements');
            } else {
                die('Something went wrong');
            }
        } else {
            // Get existing achievement from model
            $achievement = $this->studentModel->getAchievementById($id);

            if ($achievement) {
                $data = [
                    'id' => $id,
                    'place' => $achievement->place,
                    'level' => $achievement->level,
                    'description' => $achievement->description,
                    'date' => $achievement->date
                ];

                $this->view('Student/editAchievement', $data);
            } else {
                // Handle the case where the achievement is not found
                header('Location: ' . URLROOT . '/Student/studentAchievements');
                exit();
            }
        }
    }

    public function deleteAchievement($id = null) {
        if ($id === null) {
            // Handle the case where ID is not provided
            header('Location: ' . URLROOT . '/Student/studentAchievements');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->studentModel->deleteAchievement($id)) {
                header('Location: ' . URLROOT . '/Student/studentAchievements');
            } else {
                die('Something went wrong');
            }
        } else {
            header('Location: ' . URLROOT . '/Student/studentAchievements');
        }
    }

    public function studentAchievements() {
        $achievements = $this->studentModel->getAchievements();
        $data = ['achievements' => $achievements];
        $this->view('Student/studentAchievements', $data);
    }

    public function studentprofile() {
        $data = [];
        $this->view('Student/studentprofile');
    }

    public function studentSchedule() {
        $data = [];
        $this->view('Student/studentSchedule');
    }



    public function financialStatus(){
        $data = [];
        $this->view('Student/financialStatus');
    }

    public function medicalStatus(){
        $data = [];
        $this->view('Student/medicalStatus');
    }

    public function coachProfile(){
        $data = [];
        $this->view('Student/coachProfile');
    }

    public function parentProfile(){
        $data = [];
        $this->view('Student/parentProfile');
    }

    public function schoolProfile(){
        $data = [];
        $this->view('Student/schoolProfile');
    }

    public function Playerperformance(){
        $data = [];
        $this->view('Student/Playerperformance');
    }

}

    

