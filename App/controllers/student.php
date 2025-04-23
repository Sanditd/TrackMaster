<?php
class Student extends Controller {
    private $studentModel;

    public function __construct() {
        $this->studentModel = $this->model('StudentModel');
    }

    public function dashboard() {
        $userId = $_SESSION['user_id'];
    
        // Fetch achievements from the model
        $achievements = $this->studentModel->getAchievementsByUser($userId);
        $userDetails = $this->studentModel->getUserDetails($userId);
    
        // Check if data is returned correctly
        if (empty($achievements)) {
            $data['error']="No achivement";
            $this->view('Student/dashboard',$data);
        }
    
        // Pass the data to the view
        $data = [
            'userDetails' => $userDetails,
            'achievements' => $achievements
        ];
        $this->view('Student/dashboard',$data);
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

    //medical status
    // public function saveMedicalStatus(){
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Process form
    //         $data = [
    //             'user_id' => trim($_POST['user_id']),
    //             'date' => trim($_POST['date']),
    //             'conditions' => trim($_POST['condition']),
    //             'medications' => trim($_POST['medication']),
    //             'notes' => trim($_POST['notes'])
    //         ];

    //         if ($this->studentModel->addMedicalStatus($data)) {
    //             header('Location: ' . URLROOT . '/Student/medicalStatus');
    //         } else {
    //             die('Something went wrong');
    //         }
    //     } 
    // }












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

    public function studentDashboard() {
        // Assuming you're storing the user ID in session
        $userId = $_SESSION['user_id'];
    
        // Fetch achievements from the model
        $achievements = $this->studentModel->getAchievementsByUser($userId);
    
        // Check if data is returned correctly
        if (empty($achievements)) {
            // Handle the case where no achievements are found
            $achievements = [];  // This prevents an undefined index warning in the view
        }
    
        // Pass the data to the view
        $data = [
            'achievements' => $achievements
        ];
    
        // Load the view
        $this->view('Student/dashboard', $data);
    }


    public function getStudentStatus(){
        $userId = $_SESSION['user_id'];
        $studentStatus = $this->studentModel->getPlayerStatus($userId);
    
        $data = ['status' => $studentStatus];
        $this->view('Student/dashboard', $data);
    }
    
    

}

    

