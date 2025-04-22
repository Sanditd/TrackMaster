<?php
class MedicalModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    public function getPlayerIdByUserId($user_id) {
        $this->db->query('SELECT player_id FROM user_player WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        $result = $this->db->single();
        return $result ? $result->player_id : null;
    }
    
    // Get player's current medical status for logged-in user
    public function getCurrentMedicalStatus() {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if (!$player_id) {
            return false; // No player profile found
        }
        
        $this->db->query('SELECT * FROM medical_history WHERE player_id = :player_id ORDER BY date DESC LIMIT 1');
        $this->db->bind(':player_id', $player_id);
        $this->db->execute();
        return $this->db->single();
    }
    
    // Get player's medical history for logged-in user
    public function getMedicalHistory() {
        if (!isset($_SESSION['user_id'])) {
            return []; // Not logged in
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if (!$player_id) {
            return []; // No player profile found
        }
        
        $this->db->query('SELECT * FROM medical_history WHERE player_id = :player_id ORDER BY date DESC');
        $this->db->bind(':player_id', $player_id);
        $this->db->execute();
        return $this->db->resultSet();
    }
    
    // Get things to consider for logged-in user
    public function getThingsToConsider() {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if (!$player_id) {
            return false; // No player profile found
        }
        
        $this->db->query('SELECT * FROM medical_info WHERE player_id = :player_id');
        $this->db->bind(':player_id', $player_id);
        $this->db->execute();
        return $this->db->single();
    }
    
    // Add new medical record for logged-in user
    public function addMedicalRecord($data) {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if (!$player_id) {
            return false; // No player profile found
        }
        
        $this->db->query('INSERT INTO medical_history (player_id, date, medical_condition, medication, notes) 
                         VALUES (:player_id, :date, :condition, :medication, :notes)');
        
        // Bind values
        $this->db->bind(':player_id', $player_id);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':condition', $data['condition']);
        $this->db->bind(':medication', $data['medication']);
        $this->db->bind(':notes', $data['notes']);
        
        // Execute
        return $this->db->execute();
    }
    
    // Update things to consider for logged-in user
    public function updateThingsToConsider($data) {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if (!$player_id) {
            return false; // No player profile found
        }
        
        // First check if record exists
        $this->db->query('SELECT COUNT(*) as count FROM medical_info WHERE player_id = :player_id');
        $this->db->bind(':player_id', $player_id);
        $this->db->execute();
        $result = $this->db->single();
        
        if ($result && $result->count > 0) {
            // Update existing record
            $this->db->query('UPDATE medical_info SET blood_type = :blood_type, allergies = :allergies, 
                             special_notes = :special_notes, emergency_contact = :emergency_contact 
                             WHERE player_id = :player_id');
        } else {
            // Insert new record
            $this->db->query('INSERT INTO medical_info (player_id, blood_type, allergies, special_notes, emergency_contact) 
                             VALUES (:player_id, :blood_type, :allergies, :special_notes, :emergency_contact)');
        }
        
        // Bind values
        $this->db->bind(':player_id', $player_id);
        $this->db->bind(':blood_type', $data['blood_type']);
        $this->db->bind(':allergies', $data['allergies']);
        $this->db->bind(':special_notes', $data['special_notes']);
        $this->db->bind(':emergency_contact', $data['emergency_contact']);
        
        // Execute
        $result = $this->db->execute();
        return $result;
    }
    
    // For administrative or medical staff use only
    public function getMedicalRecordById($id) {
        if (!isset($_SESSION['user_id'])) {
            return false; // Not logged in
        }
        
        // Normal users can only access their own records
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        
        $this->db->query('SELECT * FROM medical_history WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        $record = $this->db->single();
        
        // Make sure the record belongs to the current user or user is medical staff
        if ($record && ($record->player_id == $player_id || 
                        (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'medical_staff'))) {
            return $record;
        }
        
        return false; // Not found or unauthorized
    }
}