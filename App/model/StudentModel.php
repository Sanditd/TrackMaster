<?php
require_once __DIR__ . '/../libraries/Database.php';

class StudentModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Training Status Methods
    public function updateTrainingStatus($data) {
        // Check if status exists for user
        $this->db->query('SELECT id FROM training_status WHERE user_id = :user_id');
        $this->db->bind(':user_id', $data['user_id']);
        $exists = $this->db->single();

        if ($exists) {
            // Update existing status
            $this->db->query('UPDATE training_status SET status = :status, updated_at = NOW() WHERE user_id = :user_id');
        } else {
            // Insert new status
            $this->db->query('INSERT INTO training_status (user_id, status) VALUES (:user_id, :status)');
        }

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':status', $data['status']);

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error updating training status: ' . $e->getMessage());
            return false;
        }
    }

    public function getTrainingStatus($userId) {
        $this->db->query('SELECT status FROM training_status WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        try {
            $result = $this->db->single();
            return $result ? $result->status : 'Practicing'; // Default status
        } catch (Exception $e) {
            error_log('Error fetching training status: ' . $e->getMessage());
            return 'Practicing';
        }
    }

    // Calendar Note Methods
    public function addCalendarNote($data) {
        $this->db->query('INSERT INTO calendar_notes (user_id, note_date, note_text) VALUES (:user_id, :note_date, :note_text)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':note_date', $data['note_date']);
        $this->db->bind(':note_text', $data['note_text']);
    
        try {
            $result = $this->db->execute();
            if (!$result) {
                error_log('Failed to execute query for calendar note. Data: ' . json_encode($data));
            }
            return $result;
        } catch (Exception $e) {
            error_log('Error adding calendar note: ' . $e->getMessage() . ' | Data: ' . json_encode($data));
            return false;
        }
    }
    

    public function getCalendarNotes($userId, $month, $year) {
        $startDate = date('Y-m-d', strtotime("$year-$month-01"));
        $endDate = date('Y-m-t', strtotime($startDate)); // Last day of the month

        $this->db->query('SELECT note_date, note_text FROM calendar_notes WHERE user_id = :user_id AND note_date BETWEEN :start_date AND :end_date');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':start_date', $startDate);
        $this->db->bind(':end_date', $endDate);

        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error fetching calendar notes: ' . $e->getMessage());
            return [];
        }
    }

    // Medical Status Methods 
    public function updateMedicalStatus($data) {

        $this->db->query('INSERT INTO medical_status (user_id, medical_condition, medication, notes, date) VALUES (:user_id, :medical_condition, :medication, :notes, :date)
                          ON DUPLICATE KEY UPDATE medical_condition = :medical_condition, medication = :medication, notes = :notes, date = :date');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':medical_condition', $data['medical_condition']);
        $this->db->bind(':medication', $data['medication']);
        $this->db->bind(':notes', $data['notes']);
        $this->db->bind(':date', $data['date']);

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error updating medical status: ' . $e->getMessage());
            return false;
        }
    }

    // Registered Sports Method
    public function getRegisteredSports($userId) {
        $this->db->query('SELECT s.sport_name 
                          FROM sports s
                          JOIN user_player up ON s.sport_id = up.sport_id
                          WHERE up.user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        
        try {
            $result = $this->db->resultSet();
            return $result ? $result : []; // Return empty array if no results
        } catch (Exception $e) {
            error_log('Error fetching registered sports: ' . $e->getMessage());
            return []; // Return empty array on error
        }
    }

    // Achievements Methods
    public function addAchievement($data) {
        if ($data['user_id'] != $_SESSION['user_id']) {
            return false; // Unauthorized access
        }
        
        $player_id = $this->getPlayerIdByUserId($data['user_id']);
        if (!$player_id) {
            return false; // No player associated with user
        }

        $this->db->query(
            'INSERT INTO achievements (player_id, place, level, description, date) 
             VALUES (:player_id, :place, :level, :description, :date)'
        );
    
        $this->db->bind(':player_id', $player_id);
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
    
        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error adding achievement: ' . $e->getMessage());
            return false;
        }
    }
    
    public function getAchievements() {
        if (!isset($_SESSION['user_id'])) {
            return [];
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        
        if (!$player_id) {
            return [];
        }
        
        $this->db->query('SELECT * FROM achievements WHERE player_id = :player_id');
        $this->db->bind(':player_id', $player_id);
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error fetching achievements: ' . $e->getMessage());
            return [];
        }
    }

    public function getAchievementById($id) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
        
        $this->db->query('SELECT * FROM achievements WHERE achievement_id = :id');
        $this->db->bind(':id', $id);
        try {
            $achievement = $this->db->single();
        } catch (Exception $e) {
            error_log('Error fetching achievement by ID: ' . $e->getMessage());
            return false;
        }
        
        if (!$achievement) {
            return false;
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if ($achievement->player_id != $player_id) {
            return false;
        }
        
        return $achievement;
    }

    public function updateAchievement($data) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
        
        $achievement = $this->getAchievementById($data['id']);
        if (!$achievement) {
            return false;
        }
        
        $this->db->query('UPDATE achievements SET place = :place, level = :level, description = :description, date = :date WHERE achievement_id = :id');
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':id', $data['id']);
        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error updating achievement: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteAchievement($id) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
        
        $achievement = $this->getAchievementById($id);
        if (!$achievement) {
            return false;
        }
        
        $this->db->query('DELETE FROM achievements WHERE achievement_id = :id');
        $this->db->bind(':id', $id);
        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error deleting achievement: ' . $e->getMessage());
            return false;
        }
    }

    public function getPlayerIdByUserId($user_id) {
        $this->db->query('SELECT player_id FROM user_player WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        try {
            $this->db->execute();
            $result = $this->db->single();
            return $result ? $result->player_id : null;
        } catch (Exception $e) {
            error_log('Error fetching player ID: ' . $e->getMessage());
            return null;
        }
    }
    
    public function getAchievementsByUser($userId) {
        if ($_SESSION['user_id'] != $userId && $_SESSION['user_role'] != 'admin') {
            return [];
        }
        
        $player_id = $this->getPlayerIdByUserId($userId);
        if (!$player_id) {
            return [];
        }
        
        $this->db->query('SELECT * FROM achievements WHERE player_id = :player_id');
        $this->db->bind(':player_id', $player_id);
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error fetching achievements by user: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getUserDetails($userId) {
        if ($_SESSION['user_id'] != $userId && $_SESSION['user_role'] != 'admin') {
            return false;
        }
        
        $this->db->query("SELECT * FROM users WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);
        try {
            return $this->db->single();
        } catch (Exception $e) {
            error_log('Error fetching user details: ' . $e->getMessage());
            return false;
        }
    }

    public function addFinancialApplication($data) {
        if ($data['user_id'] != $_SESSION['user_id']) {
            return false;
        }

        $this->db->query(
            'INSERT INTO financial_applications (user_id, student_name, guardian_name, annual_income, application_date, reason, notes, financial_report_path, application_status) 
             VALUES (:user_id, :student_name, :guardian_name, :annual_income, :application_date, :reason, :notes, :financial_report_path, :application_status)'
        );

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':student_name', $data['student_name']);
        $this->db->bind(':guardian_name', $data['guardian_name']);
        $this->db->bind(':annual_income', $data['annual_income']);
        $this->db->bind(':application_date', $data['application_date']);
        $this->db->bind(':reason', $data['reason']);
        $this->db->bind(':notes', $data['notes']);
        $this->db->bind(':financial_report_path', $data['financial_report_path']);
        $this->db->bind(':application_status', 'Pending');

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error adding financial application: ' . $e->getMessage());
            return false;
        }
    }

    public function getFinancialApplications() {
        if (!isset($_SESSION['user_id'])) {
            return [];
        }

        $this->db->query('SELECT * FROM financial_applications WHERE user_id = :user_id ORDER BY application_date DESC');
        $this->db->bind(':user_id', $_SESSION['user_id']);
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error fetching financial applications: ' . $e->getMessage());
            return [];
        }
    }

    public function getFinancialApplicationById($id) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        $this->db->query('SELECT * FROM financial_applications WHERE id = :id');
        $this->db->bind(':id', $id);
        try {
            $application = $this->db->single();
        } catch (Exception $e) {
            error_log('Error fetching financial application by ID: ' . $e->getMessage());
            return false;
        }

        if (!$application) {
            return false;
        }

        if ($application->user_id != $_SESSION['user_id']) {
            return false;
        }

        return $application;
    }
}