<?php
require_once __DIR__ . '/../libraries/Database.php';

class FinancialStatusModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Submit a new financial aid application
    public function submitApplication($data) {
        // Make sure the user is submitting an application for their own account
        if (!isset($_SESSION['user_id']) || $data['player_id'] != $this->getPlayerIdByUserId($_SESSION['user_id'])) {
            return false; // Unauthorized access
        }
        
        $this->db->query(
            'INSERT INTO financial_status (player_id, student_name, guardian_name, annual_income, 
            application_date, reason_for_applying, additional_notes, financial_report_path) 
            VALUES (:player_id, :student_name, :guardian_name, :annual_income, 
            :application_date, :reason_for_applying, :additional_notes, :financial_report_path)'
        );
    
        // Bind all parameters
        $this->db->bind(':player_id', $data['player_id']);
        $this->db->bind(':student_name', $data['student_name']);
        $this->db->bind(':guardian_name', $data['guardian_name']);
        $this->db->bind(':annual_income', $data['annual_income']);
        $this->db->bind(':application_date', $data['application_date']);
        $this->db->bind(':reason_for_applying', $data['reason_for_applying']);
        $this->db->bind(':additional_notes', $data['additional_notes']);
        $this->db->bind(':financial_report_path', $data['financial_report_path']);
    
        // Execute the query
        return $this->db->execute();
    }
    
    // Get financial aid application for currently logged-in user
    public function getUserApplication() {
        if (!isset($_SESSION['user_id'])) {
            return false; // Return false if not logged in
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        
        if (!$player_id) {
            return false; // Return false if no player associated with user
        }
        
        $this->db->query('SELECT * FROM financial_status WHERE player_id = :player_id ORDER BY created_at DESC');
        $this->db->bind(':player_id', $player_id);
        return $this->db->resultSet();
    }

    // Get application by ID (with permission check)
    public function getApplicationById($id) {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        // First get the application
        $this->db->query('SELECT * FROM financial_status WHERE id = :id');
        $this->db->bind(':id', $id);
        $application = $this->db->single();
        
        if (!$application) {
            return false; // Application not found
        }
        
        // Check if this application belongs to the logged-in user
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if ($application->player_id != $player_id && $_SESSION['user_role'] != 'admin') {
            return false; // Unauthorized access
        }
        
        return $application;
    }

    // Get most recent application status for the logged-in user
    public function getApplicationStatus() {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        
        if (!$player_id) {
            return false; // No player associated with user
        }
        
        $this->db->query('SELECT application_status FROM financial_status WHERE player_id = :player_id ORDER BY created_at DESC LIMIT 1');
        $this->db->bind(':player_id', $player_id);
        $result = $this->db->single();
        
        return $result ? $result->application_status : 'No Application';
    }

    // Helper function to get player_id from user_id
    public function getPlayerIdByUserId($user_id) {
        $this->db->query('SELECT player_id FROM user_player WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        $result = $this->db->single(); // Fetches a single row as an object
        return $result ? $result->player_id : null; // Access the player_id property
    }
    
    // Handle file upload for financial reports
    public function uploadFinancialReport($file) {
        // Define upload directory
        $upload_dir = '../uploads/financial_reports/';
        
        // Create directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Generate unique filename
        $filename = uniqid() . '_' . basename($file['name']);
        $target_file = $upload_dir . $filename;
        
        // Move uploaded file to target directory
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    }
}