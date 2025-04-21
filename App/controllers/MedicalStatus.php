<?php
class MedicalStatus extends Controller {
    private $medicalModel;

    public function __construct() {
        // Load model
        $this->medicalModel = $this->model('MedicalModel');
    }

    // Index method - Display the medical status page
    public function index() {
        $userId = $this->getUserId();
        $playerId = $this->getPlayerId($userId);

        // Get current medical status
        $currentStatus = $this->medicalModel->getCurrentMedicalStatus($playerId);

        // Get medical history
        $medicalHistory = $this->medicalModel->getMedicalHistory($playerId);

        // Get things to consider
        $thingsToConsider = $this->medicalModel->getThingsToConsider($playerId);

        $data = [
            'currentStatus' => $currentStatus,
            'medicalHistory' => $medicalHistory,
            'thingsToConsider' => $thingsToConsider,
            'user_id' => $userId,
            'player_id' => $playerId
        ];

        $this->view('Student/medicalStatus', $data);
    }

    // Save new medical record
    public function saveMedicalStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $this->getUserId();
            $playerId = $this->getPlayerId($userId);

            // Sanitize POST data
            $data = [
                'player_id' => $playerId,
                'date' => filter_var($_POST['date'], FILTER_SANITIZE_STRING),
                'condition' => trim($_POST['condition']),
                'medication' => trim($_POST['medication']),
                'notes' => trim($_POST['notes']),
                'errors' => []
            ];

            // Validate
            if (empty($data['condition'])) {
                $data['errors']['condition'] = 'Please enter a medical condition';
            }

            // If no errors, save to database
            if (empty($data['errors'])) {
                if ($this->medicalModel->addMedicalRecord($data)) {
                    // Success - redirect back to medical status
                    header('Location: ' . URLROOT . '/medicalStatus');
                    exit;
                } else {
                    error_log('Failed to add medical record for player ID: ' . $playerId);
                    die('Something went wrong while saving the medical record.');
                }
            } else {
                // Load view with errors
                $currentStatus = $this->medicalModel->getCurrentMedicalStatus($playerId);
                $medicalHistory = $this->medicalModel->getMedicalHistory($playerId);
                $thingsToConsider = $this->medicalModel->getThingsToConsider($playerId);
                
                $data['currentStatus'] = $currentStatus;
                $data['medicalHistory'] = $medicalHistory;
                $data['thingsToConsider'] = $thingsToConsider;
                $data['user_id'] = $userId;
                $data['player_id'] = $playerId;
                
                $this->view('Student/medicalStatus', $data);
            }
        } else {
            // Not a POST request, redirect
            header('Location: ' . URLROOT . '/medicalStatus');
            exit;
        }
    }

    // Save things to consider - CORRECTED VERSION
    public function saveThingsToConsider() {
        error_log('saveThingsToConsider method called');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $this->getUserId();
            $playerId = $this->getPlayerId($userId);
            
            error_log('Player ID: ' . $playerId);

            // Sanitize POST data
            $data = [
                'player_id' => $playerId,
                'blood_type' => trim($_POST['bloodType']),
                'allergies' => trim($_POST['allergies']),
                'special_notes' => trim($_POST['specialNotes']),
                'emergency_contact' => trim($_POST['emergencyContact']),
                'errors' => []
            ];
            
            error_log('Data received: ' . print_r($data, true));

            // Validate
            if (empty($data['blood_type'])) {
                $data['errors']['blood_type'] = 'Please enter a blood type';
            }

            if (empty($data['emergency_contact'])) {
                $data['errors']['emergency_contact'] = 'Please enter an emergency contact';
            }

            // If no errors, save to database
            if (empty($data['errors'])) {
                $result = $this->medicalModel->updateThingsToConsider($data);
                error_log('Update result: ' . ($result ? 'true' : 'false'));
                
                if ($result) {
                    // Success - redirect back to medical status
                    header('Location: ' . URLROOT . '/medicalStatus');
                    exit;
                } else {
                    error_log('Failed to update things to consider for player ID: ' . $playerId);
                    die('Something went wrong while saving things to consider.');
                }
            } else {
                error_log('Validation errors: ' . print_r($data['errors'], true));
                
                // Load view with errors
                $currentStatus = $this->medicalModel->getCurrentMedicalStatus($playerId);
                $medicalHistory = $this->medicalModel->getMedicalHistory($playerId);
                $thingsToConsider = $this->medicalModel->getThingsToConsider($playerId);
                
                $data['currentStatus'] = $currentStatus;
                $data['medicalHistory'] = $medicalHistory;
                $data['thingsToConsider'] = $thingsToConsider;
                $data['user_id'] = $userId;
                $data['player_id'] = $playerId;
                
                $this->view('Student/medicalStatus', $data);
            }
        } else {
            // Not a POST request, redirect
            header('Location: ' . URLROOT . '/medicalStatus');
            exit;
        }
    }

    // Helper method to get user ID
    private function getUserId() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }
        return $_SESSION['user_id'];
    }

    // Helper method to get player ID
    private function getPlayerId($userId) {
        $playerId = $this->medicalModel->getPlayerIdByUserId($userId);
        if (!$playerId) {
            error_log('Player ID not found for user ID: ' . $userId);
            die('Player not found');
        }
        return $playerId;
    }
}