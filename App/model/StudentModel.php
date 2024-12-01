<?php
require_once __DIR__ . '/../libraries/database.php';

class StudentModel {
    private $db;

    public function __construct() {
        $this->db = new database();
    }

    // Add a new achievement
    public function addAchievement($data) {
        // Retrieve the player ID from the user ID
        $player_id = $this->getPlayerIdByUserId($data['user_id']);
        var_dump($player_id);
    
        // Prepare the SQL query, ensuring all placeholders are defined
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
    

    // Get all achievements
    public function getAchievements() {
        $this->db->query('SELECT * FROM achievements');
        return $this->db->resultset();
    }

    // Get a single achievement by ID
    public function getAchievementById($id) {
        $this->db->query('SELECT * FROM achievements WHERE achievement_id  = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Update an achievement
    public function updateAchievement($data) {
        $this->db->query('UPDATE achievements SET place = :place, level = :level, description = :description, date = :date WHERE 	achievement_id  = :id');
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    // Delete an achievement
    public function deleteAchievement($id) {
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
        $player_id = $this->getPlayerIdByUserId($userId);
        $this->db->query('SELECT * FROM achievements WHERE player_id = :user_id');
        $this->db->bind(':user_id', $player_id);
        return $this->db->resultSet();
    }
    
    public function getUserDetails($userId) {
        $this->db->query("SELECT * FROM users WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);
        return $this->db->single(); // Return a single record
    }
    
    
}