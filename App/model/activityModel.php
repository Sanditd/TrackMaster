<?php
require_once __DIR__ . '/../libraries/Database.php';

class activityModel {
    private $db;

    public function __construct() {
        $this->db=new database();
    }

    

    // Add a new reminder to the database
    public function insertUserActivity($activity) {
        $query = "INSERT INTO activity (act_desc, user_id, date) VALUES (:act_desc, :user_id, :date)";
        $this->db->query($query);
        $this->db->bind(':act_desc', $activity['act_desc']);
        $this->db->bind(':user_id', $activity['user_id']);  
        $this->db->bind(':date', date('Y-m-d H:i:s')); // Current date and time
        $this->db->execute();
    }

    public function insertAdminActivity($activity) {
        $query = "INSERT INTO activity (act_desc, admin_id, date) VALUES (:act_desc, :admin_id, :date)";
        $this->db->query($query);
        $this->db->bind(':act_desc', $activity['act_desc']);
        $this->db->bind(':admin_id', $activity['user_id']);  
        $this->db->bind(':date', date('Y-m-d H:i:s')); // Current date and time
        $this->db->execute();
    }

    public function getUserActivityByUserId($userId) {
        $query = "SELECT * FROM activity WHERE user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getAdminActivityByUserId($userId) {
        $query = "SELECT * FROM activity WHERE admin_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getAdminActivities() {
        $query = "SELECT * FROM activity WHERE admin_id IS NOT NULL ORDER BY date DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    
    
    
}
