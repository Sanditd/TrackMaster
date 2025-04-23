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
    
            // Validate inputs
            if (empty($data['place'])) {
                $data['errors'] = 'Place is required.';
            }
    
            if (empty($data['level'])) {
                $data['errors'] = 'Level is required.';
            }
    
            if (empty($data['description'])) {
                $data['errors'] = 'Description is required.';
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
        } else {
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

    public function financialStatus() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }

        $applications = $this->studentModel->getFinancialApplications();
        $latest_application = !empty($applications) ? $applications[0] : null;

        $data = [
            'applications' => $applications,
            'status' => $latest_application ? $latest_application->application_status : 'No Application',
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('Student/financialStatus', $data);
    }

    public function submitApplication() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['message'] = 'Invalid CSRF token.';
                $_SESSION['message_type'] = 'error';
                header('Location: ' . URLROOT . '/Student/financialStatus');
                exit();
            }

            // Validate file upload
            $file_path = null;
            if (isset($_FILES['financialReports']) && $_FILES['financialReports']['error'] == UPLOAD_ERR_OK) {
                $file = $_FILES['financialReports'];
                if ($file['size'] > 5 * 1024 * 1024) {
                    $_SESSION['message'] = 'File size exceeds 5MB limit.';
                    $_SESSION['message_type'] = 'error';
                    header('Location: ' . URLROOT . '/Student/financialStatus');
                    exit();
                }
                if ($file['type'] !== 'application/pdf') {
                    $_SESSION['message'] = 'Only PDF files are allowed.';
                    $_SESSION['message_type'] = 'error';
                    header('Location: ' . URLROOT . '/Student/financialStatus');
                    exit();
                }

                $upload_dir = __DIR__ . '/../public/uploads/financial_reports/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $file_path = $upload_dir . uniqid() . '.pdf';
                move_uploaded_file($file['tmp_name'], $file_path);
            } else {
                $_SESSION['message'] = 'Financial report is required.';
                $_SESSION['message_type'] = 'error';
                header('Location: ' . URLROOT . '/Student/financialStatus');
                exit();
            }

            // Sanitize and validate form data
            $data = [
                'user_id' => $_SESSION['user_id'],
                'student_name' => trim($_POST['studentName']),
                'guardian_name' => trim($_POST['guardianName']),
                'annual_income' => trim($_POST['annualIncome']),
                'application_date' => trim($_POST['date']),
                'reason' => trim($_POST['reason']),
                'notes' => trim($_POST['notes']),
                'financial_report_path' => $file_path,
                'errors' => []
            ];

            // Validate inputs
            if (empty($data['student_name'])) {
                $data['errors'][] = 'Student name is required.';
            }
            if (empty($data['guardian_name'])) {
                $data['errors'][] = 'Guardian name is required.';
            }
            if (empty($data['annual_income']) || !is_numeric($data['annual_income']) || $data['annual_income'] <= 0) {
                $data['errors'][] = 'Valid annual income is required.';
            }
            if (empty($data['application_date'])) {
                $data['errors'][] = 'Application date is required.';
            }
            if (empty($data['reason'])) {
                $data['errors'][] = 'Reason for applying is required.';
            }

            if (!empty($data['errors'])) {
                $_SESSION['message'] = implode(' ', $data['errors']);
                $_SESSION['message_type'] = 'error';
                header('Location: ' . URLROOT . '/Student/financialStatus');
                exit();
            }

            // Save the application
            if ($this->studentModel->addFinancialApplication($data)) {
                $_SESSION['message'] = 'Application submitted successfully.';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Something went wrong while submitting the application.';
                $_SESSION['message_type'] = 'error';
            }

            header('Location: ' . URLROOT . '/Student/financialStatus');
            exit();
        } else {
            header('Location: ' . URLROOT . '/Student/financialStatus');
            exit();
        }
    }

    public function viewApplication($id) {
        $application = $this->studentModel->getFinancialApplicationById($id);
        if (!$application) {
            $_SESSION['message'] = 'Application not found or unauthorized access.';
            $_SESSION['message_type'] = 'error';
            header('Location: ' . URLROOT . '/Student/financialStatus');
            exit();
        }

        $data = [
            'application' => $application
        ];
        $this->view('Student/viewApplication', $data);
    }

    public function medicalStatus() {
        $data = [];
        $this->view('Student/medicalStatus');
    }

    public function coachProfile() {
        $data = [];
        $this->view('Student/coachProfile');
    }

    public function parentProfile() {
        $data = [];
        $this->view('Student/parentProfile');
    }

    public function schoolProfile() {
        $data = [];
        $this->view('Student/schoolProfile');
    }

    public function Playerperformance() {
        $data = [];
        $this->view('Student/Playerperformance');
    }

    private function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}