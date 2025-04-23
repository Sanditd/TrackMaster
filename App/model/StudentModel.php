<?php
require_once __DIR__ . '/../libraries/Database.php';

class StudentModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Add a new achievement
    public function addAchievement($data) {
        // Make sure the user is adding an achievement to their own account
        if ($data['user_id'] != $_SESSION['user_id']) {
            return false; // Unauthorized access
        }
        
        $player_id = $this->getPlayerIdByUserId($data['user_id']);

        $this->db->query(
            'INSERT INTO achievements (player_id, place, level, description, date) 
             VALUES (:player_id, :place, :level, :description, :date)'
        );
    
        // Bind all parameters
        $this->db->bind(':player_id', $player_id);
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
    
        // Execute the query
        return $this->db->execute();
    }
    
    // Get achievements for currently logged-in user only
    public function getAchievements() {
        if (!isset($_SESSION['user_id'])) {
            return []; // Return empty if not logged in
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        
        if (!$player_id) {
            return []; // Return empty if no player associated with user
        }
        
        $this->db->query('SELECT * FROM achievements WHERE player_id = :player_id');
        $this->db->bind(':player_id', $player_id);
        return $this->db->resultSet();
    }

    // Get a single achievement by ID (with permission check)
    public function getAchievementById($id) {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        // First get the achievement
        $this->db->query('SELECT * FROM achievements WHERE achievement_id = :id');
        $this->db->bind(':id', $id);
        $achievement = $this->db->single();
        
        if (!$achievement) {
            return false; // Achievement not found
        }
        
        // Check if this achievement belongs to the logged-in user
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if ($achievement->player_id != $player_id) {
            return false; // Unauthorized access
        }
        
        return $achievement;
    }

    // Update an achievement (with permission check)
    public function updateAchievement($data) {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        // Verify the achievement belongs to this user
        $achievement = $this->getAchievementById($data['id']);
        if (!$achievement) {
            return false; // Either not found or not authorized
        }
        
        $this->db->query('UPDATE achievements SET place = :place, level = :level, description = :description, date = :date WHERE achievement_id = :id');
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    // Delete an achievement (with permission check)
    public function deleteAchievement($id) {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        // Verify the achievement belongs to this user
        $achievement = $this->getAchievementById($id);
        if (!$achievement) {
            return false; // Either not found or not authorized
        }
        
        $this->db->query('DELETE FROM achievements WHERE achievement_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getPlayerIdByUserId($user_id) {
        $this->db->query('SELECT player_id FROM user_player WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        $result = $this->db->single(); // Fetches a single row as an object
        return $result ? $result->player_id : null; // Access the player_id property
    }
    
    public function getAchievementsByUser($userId) {
        // Check if the current user is authorized to view this user's achievements
        if ($_SESSION['user_id'] != $userId && $_SESSION['user_role'] != 'admin') {
            return []; // Unauthorized access
        }
        
        $player_id = $this->getPlayerIdByUserId($userId);
        if (!$player_id) {
            return [];
        }
        
        $this->db->query('SELECT * FROM achievements WHERE player_id = :player_id');
        $this->db->bind(':player_id', $player_id);
        return $this->db->resultSet();
    }
    
    public function getUserDetails($userId) {
        // Check if the current user is authorized to view this user's details
        if ($_SESSION['user_id'] != $userId && $_SESSION['user_role'] != 'admin') {
            return false; // Unauthorized access
        }
        
        $this->db->query("SELECT * FROM users WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);
        return $this->db->single(); // Return a single record
    }

    
    
}