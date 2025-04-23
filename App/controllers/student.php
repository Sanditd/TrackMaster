<?php
class Student extends Controller {
    private $studentModel;

    public function __construct() {
        $this->studentModel = $this->model('StudentModel');
    }

    public function index() {
        // Redirect to the student dashboard
        header('Location: ' . URLROOT . '/Student/studentDashboard');
        exit();
    }
    public function studentDashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }
    
        $userId = $_SESSION['user_id'];
    
        $medicalModel = $this->model('MedicalModel');
        $data = $medicalModel->index($userId);
    
        $this->view('Student/dashboard', $data);
    }

    public function editStudentProfile() {
        $data = [];
        $this->view('Student/editStudentProfile');
    }

    public function saveAchievement() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $data = [
                'user_id' => trim($_POST['user_id']),
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
    public function editAchievement($achievement_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and process the POST data
            $data = [
                'id' => $achievement_id,
                'place' => trim($_POST['place']),
                'level' => trim($_POST['level']),
                'description' => trim($_POST['description']),
                'date' => trim($_POST['date']),
                'errors' => []
            ];
    
            // Validate inputs (add validations as needed)
            if (empty($data['place'])) {
                $data['errors'] = 'Place is required.';
            }
    
            if (empty($data['level'])) {
                $data['errors'] = 'Level is required.';
            }
    
            if (empty($data['description'])) {
                $data['errors']= 'Description is required.';
            }
    
            if (empty($data['date'])) {
                $data['errors'] = 'Date is required.';
            }
    
            if (empty($data['errors'])) {
                // Call the model to update the achievement
                if ($this->studentModel->updateAchievement($data)) {
                    header('Location: ' . URLROOT . '/Student/studentAchievements');
                    exit();
                } else {
                    $data['errors'] = 'Something went wrong while updating the achievement.';
                    $this->view('Student/editAchievement', $data);
                }
            } else {
                // Reload the form with error messages
                $this->view('Student/editAchievement', $data);
            }
        }else {
            $achievement = $this->studentModel->getAchievementById($achievement_id);
        
            if (empty($achievement)) {
                $data = [
                    'error' => "Achievement is empty"
                ];
                $this->view('Student/editAchievement', $data);
            } else {
                // Prepare data for the view
                $data = [
                    'achievement' => $achievement
                ];
                $this->view('Student/editAchievement', $data);
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

    



    

