<?php
class MedicalStatus extends Controller {
    private $medicalModel;

    public function __construct() {
        // Ensure user is logged in for all controller methods
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }
        
        // Load model
        $this->medicalModel = $this->model('MedicalModel');
    }

    // Index method - Display the medical status page
    public function index() {
        // Get user ID from session
        $userId = $_SESSION['user_id'];
        
        // Get player ID for the current user
        $playerId = $this->medicalModel->getPlayerIdByUserId($userId);
        
        if (!$playerId) {
            error_log('Player ID not found for user ID: ' . $userId);
            die('Player profile not found. Please contact an administrator.');
        }
        
        // Get current medical status - explicitly retrieving for the current user
        $currentStatus = $this->medicalModel->getCurrentMedicalStatus();
        
        // Get medical history - explicitly retrieving for the current user
        $medicalHistory = $this->medicalModel->getMedicalHistory();
        
        // Get things to consider - explicitly retrieving for the current user
        $thingsToConsider = $this->medicalModel->getThingsToConsider();

        $data = [
            'currentStatus' => $currentStatus,
            'medicalHistory' => $medicalHistory,
            'thingsToConsider' => $thingsToConsider,
            'user_id' => $userId,
            'player_id' => $playerId,
            'errors' => [] // Initialize empty errors array
        ];

        $this->view('Student/medicalStatus', $data);
    }

    // Save new medical record
    public function saveMedicalStatus() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . URLROOT . '/medicalStatus');
            exit;
        }
        
        // Get user ID from session
        $userId = $_SESSION['user_id'];
        $playerId = $this->medicalModel->getPlayerIdByUserId($userId);
        
        // Sanitize POST data
        $data = [
            'date' => filter_var($_POST['date'], FILTER_SANITIZE_STRING),
            'condition' => trim($_POST['condition']),
            'medication' => trim($_POST['medication']),
            'notes' => trim($_POST['notes']),
            'errors' => []
        ];

        // Validate input
        if (empty($data['condition'])) {
            $data['errors']['condition'] = 'Please enter a medical condition';
        }

        if (empty($data['errors'])) {
            // No errors, save to database
            if ($this->medicalModel->addMedicalRecord($data)) {
                // Success - redirect back to medical status
                flash('medical_message', 'Medical record added successfully');
                header('Location: ' . URLROOT . '/medicalStatus');
                exit;
            } else {
                error_log('Failed to add medical record for user ID: ' . $userId);
                flash('medical_message', 'Something went wrong while saving the medical record', 'alert alert-danger');
                header('Location: ' . URLROOT . '/medicalStatus');
                exit;
            }
        } else {
            // Load view with errors and existing data
            $currentStatus = $this->medicalModel->getCurrentMedicalStatus();
            $medicalHistory = $this->medicalModel->getMedicalHistory();
            $thingsToConsider = $this->medicalModel->getThingsToConsider();
            
            $data['currentStatus'] = $currentStatus;
            $data['medicalHistory'] = $medicalHistory;
            $data['thingsToConsider'] = $thingsToConsider;
            $data['user_id'] = $userId;
            $data['player_id'] = $playerId;
            
            $this->view('Student/medicalStatus', $data);
        }
    }

    // Save things to consider
    public function saveThingsToConsider() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . URLROOT . '/medicalStatus');
            exit;
        }
        
        // Get user ID from session
        $userId = $_SESSION['user_id'];
        $playerId = $this->medicalModel->getPlayerIdByUserId($userId);
        
        // Sanitize POST data
        $data = [
            'blood_type' => trim($_POST['bloodType']),
            'allergies' => trim($_POST['allergies']),
            'special_notes' => trim($_POST['specialNotes']),
            'emergency_contact' => trim($_POST['emergencyContact']),
            'errors' => []
        ];
        
        // Validate input
        if (empty($data['blood_type'])) {
            $data['errors']['blood_type'] = 'Please enter a blood type';
        }

        if (empty($data['emergency_contact'])) {
            $data['errors']['emergency_contact'] = 'Please enter an emergency contact';
        }

        if (empty($data['errors'])) {
            // No errors, save to database
            $result = $this->medicalModel->updateThingsToConsider($data);
            
            if ($result) {
                // Success - redirect back to medical status
                flash('medical_message', 'Medical information updated successfully');
                header('Location: ' . URLROOT . '/medicalStatus');
                exit;
            } else {
                error_log('Failed to update things to consider for user ID: ' . $userId);
                flash('medical_message', 'Something went wrong while saving your medical information', 'alert alert-danger');
                header('Location: ' . URLROOT . '/medicalStatus');
                exit;
            }
        } else {
            // Load view with errors and existing data
            $currentStatus = $this->medicalModel->getCurrentMedicalStatus();
            $medicalHistory = $this->medicalModel->getMedicalHistory();
            $thingsToConsider = $this->medicalModel->getThingsToConsider();
            
            $data['currentStatus'] = $currentStatus;
            $data['medicalHistory'] = $medicalHistory;
            $data['thingsToConsider'] = $thingsToConsider;
            $data['user_id'] = $userId;
            $data['player_id'] = $playerId;
            
            $this->view('Student/medicalStatus', $data);
        }
    }
}