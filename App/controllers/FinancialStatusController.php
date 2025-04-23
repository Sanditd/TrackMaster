<?php
require_once '../models/FinancialStatusModel.php';

class FinancialStatusController {
    private $financialModel;
    
    public function __construct() {
        $this->financialModel = new FinancialStatusModel();
    }
    
    // Display the financial status form page
    public function index() {
        // Get current application status for the logged-in user
        $applicationStatus = $this->financialModel->getApplicationStatus();
        $previousApplications = $this->financialModel->getUserApplication();
        
        // Load view with data
        $data = [
            'status' => $applicationStatus,
            'applications' => $previousApplications
        ];
        
        require_once '../views/students/financial_status.php';
    }
    
    // Handle the submission of a new financial aid application
    public function submitApplication() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form data
            $player_id = $this->financialModel->getPlayerIdByUserId($_SESSION['user_id']);
            
            // Handle file upload
            $file_path = '';
            if (!empty($_FILES['financialReports']['name'])) {
                $file_path = $this->financialModel->uploadFinancialReport($_FILES['financialReports']);
                
                if (!$file_path) {
                    // Redirect with error message if file upload fails
                    $_SESSION['message'] = 'File upload failed!';
                    $_SESSION['message_type'] = 'error';
                    header('Location: /TrackMaster/Student/financialStatus');
                    exit;
                }
            }
            
            // Prepare data for database insertion
            $data = [
                'player_id' => $player_id,
                'student_name' => trim($_POST['studentName']),
                'guardian_name' => trim($_POST['guardianName']),
                'annual_income' => (float)$_POST['annualIncome'],
                'application_date' => $_POST['date'],
                'reason_for_applying' => trim($_POST['reason']),
                'additional_notes' => trim($_POST['notes']),
                'financial_report_path' => $file_path
            ];
            
            // Submit application
            if ($this->financialModel->submitApplication($data)) {
                $_SESSION['message'] = 'Application submitted successfully!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Failed to submit application!';
                $_SESSION['message_type'] = 'error';
            }
            
            // Redirect back to financial status page
            header('Location: /TrackMaster/Student/financialStatus');
            exit;
        }
    }
    
    // View a specific application
    public function viewApplication($id) {
        // Get application details
        $application = $this->financialModel->getApplicationById($id);
        
        if (!$application) {
            $_SESSION['message'] = 'Application not found or access denied!';
            $_SESSION['message_type'] = 'error';
            header('Location: /TrackMaster/Student/financialStatus');
            exit;
        }
        
        // Load view with application data
        $data = [
            'application' => $application
        ];
        
        require_once '../views/students/view_application.php';
    }
}