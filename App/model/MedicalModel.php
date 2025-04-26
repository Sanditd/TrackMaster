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
        return [
            'currentStatus' => $this->getCurrentMedicalStatus($user_id),
            'medicalHistory' => $this->getMedicalHistory($user_id),
            'thingsToConsider' => $this->getThingsToConsider($user_id),
            'user_id' => $user_id
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
    
   

    public function addMedicalRecord($data) {
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if (!$player_id) return false;
    
        $this->db->query('
            INSERT INTO medical_history 
            (player_id, date, medical_condition, medication, notes, created_at) 
            VALUES 
            (:player_id, :date, :condition, :medication, :notes, NOW())
        ');
        
        // Bind values
        $this->db->bind(':player_id', $player_id);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':condition', $data['condition']);
        $this->db->bind(':medication', $data['medication']);
        $this->db->bind(':notes', $data['notes']);
    
        // Execute
        return $this->db->execute();
    }

    public function updateThingsToConsider($data) {
        // First check if a record already exists
        $this->db->query("SELECT id FROM things_to_consider WHERE user_id = :user_id");
        $this->db->bind(':user_id', $data['user_id']);
        $row = $this->db->single(); // fetch record
        
        if ($row) {
            // Record exists, perform UPDATE
            $this->db->query("UPDATE things_to_consider 
                              SET blood_type = :blood_type, allergies = :allergies, 
                                  special_notes = :special_notes, emergency_contact = :emergency_contact 
                              WHERE user_id = :user_id");
        } else {
            // No record exists, perform INSERT
            $this->db->query("INSERT INTO things_to_consider (user_id, blood_type, allergies, special_notes, emergency_contact) 
                              VALUES (:user_id, :blood_type, :allergies, :special_notes, :emergency_contact)");
        }
    
        // Bind parameters
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':blood_type', $data['blood_type']);
        $this->db->bind(':allergies', $data['allergies']);
        $this->db->bind(':special_notes', $data['special_notes']);
        $this->db->bind(':emergency_contact', $data['emergency_contact']);
    
        return $this->db->execute();
    }

    public function getThingsToConsider($userId) {
        $this->db->query('SELECT * FROM things_to_consider WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }
    

}