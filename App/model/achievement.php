<?php
class achievement {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAchievements() {
        $this->db->query("SELECT * FROM achievement");
        return $this->db->resultSet();
    }

    public function getAchievement($id) {
        $this->db->query("SELECT * FROM achievement WHERE id = :id");
        $this->db->bind(':product_id', $product_id);
        return $this->db->single();
    }

    public function addAchievement($data) {
        $this->db->query("INSERT INTO achievement ( place, level, description, date) VALUES (:place, :level, :description, :date)");
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        return $this->db->execute();
    }

    public function updateAchievement($data) {
        $this->db->query("UPDATE achievement SET place = :place, level = :level, description = :description, date = :date WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        return $this->db->execute();
    }

    public function deleteProduct($product_id) {
        $this->db->query("DELETE FROM achievement WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

}
?>