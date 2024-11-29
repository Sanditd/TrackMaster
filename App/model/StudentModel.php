<?php
require_once __DIR__ . '/../libraries/database.php';

class StudentModel {
    private $db;

    public function __construct() {
        $this->db = new database();
    }

    // Add a new achievement
    public function addAchievement($data) {
        $this->db->query('INSERT INTO achievements (place, level, description, date) VALUES (:place, :level, :description, :date)');
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        return $this->db->execute();
    }

    // Get all achievements
    public function getAchievements() {
        $this->db->query('SELECT * FROM achievements');
        return $this->db->resultset();
    }

    // Get a single achievement by ID
    public function getAchievementById($id) {
        $this->db->query('SELECT * FROM achievements WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Update an achievement
    public function updateAchievement($data) {
        $this->db->query('UPDATE achievements SET place = :place, level = :level, description = :description, date = :date WHERE id = :id');
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    // Delete an achievement
    public function deleteAchievement($id) {
        $this->db->query('DELETE FROM achievements WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}