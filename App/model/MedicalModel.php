<?php
require_once __DIR__ . '/../libraries/Database.php';
class MedicalModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    private function getPlayerIdByUserId($user_id) {
        $this->db->query('SELECT player_id FROM user_player WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $result = $this->db->single();
        return $result ? $result->player_id : false; // Use -> instead of []
    }

    public function index($user_id) {
        // Fetch the latest data from the database for the given user
        return [
            'currentStatus' => $this->getCurrentMedicalStatus($user_id),
            'medicalHistory' => $this->getMedicalHistory($user_id),
            'thingsToConsider' => $this->getThingsToConsider($user_id)
        ];
    }
    
    public function getCurrentMedicalStatus($user_id) {
        $player_id = $this->getPlayerIdByUserId($user_id);
        if (!$player_id) return false;
    
        $this->db->query('
            SELECT medical_condition, medication, notes, date 
            FROM medical_history 
            WHERE player_id = :player_id 
            ORDER BY date DESC 
            LIMIT 1
        ');
        $this->db->bind(':player_id', $player_id);
        return $this->db->single();
    }
    
    public function getMedicalHistory($user_id) {
        $player_id = $this->getPlayerIdByUserId($user_id);
        if (!$player_id) return [];
    
        $this->db->query('
            SELECT * FROM medical_history 
            WHERE player_id = :player_id 
            ORDER BY date DESC
        ');
        $this->db->bind(':player_id', $player_id);
        return $this->db->resultSet();
    }
    
    public function getThingsToConsider($user_id) {
        $player_id = $this->getPlayerIdByUserId($user_id);
        if (!$player_id) return false;
    
        $this->db->query('
            SELECT * FROM medical_info 
            WHERE player_id = :player_id
        ');
        $this->db->bind(':player_id', $player_id);
        return $this->db->single();
    }

    public function addMedicalRecord($data) {
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if (!$player_id) return false;

        $this->db->query('
            INSERT INTO medical_history (player_id, date, medical_condition, medication, notes, created_at) 
            VALUES (:player_id, :date, :condition, :medication, :notes, NOW())
        ');
        $this->db->bind(':player_id', $player_id);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':condition', $data['condition']);
        $this->db->bind(':medication', $data['medication']);
        $this->db->bind(':notes', $data['notes']);
        return $this->db->execute();
    }

    public function updateThingsToConsider($data) {
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if (!$player_id) return false;

        $this->db->query('
            INSERT INTO medical_info (player_id, blood_type, allergies, special_notes, emergency_contact) 
            VALUES (:player_id, :blood_type, :allergies, :special_notes, :emergency_contact)
            ON DUPLICATE KEY UPDATE 
            blood_type = :blood_type, allergies = :allergies, 
            special_notes = :special_notes, emergency_contact = :emergency_contact
        ');
        $this->db->bind(':player_id', $player_id);
        $this->db->bind(':blood_type', $data['blood_type']);
        $this->db->bind(':allergies', $data['allergies']);
        $this->db->bind(':special_notes', $data['special_notes']);
        $this->db->bind(':emergency_contact', $data['emergency_contact']);
        return $this->db->execute();
    }
}