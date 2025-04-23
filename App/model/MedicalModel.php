<?php
class MedicalModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    // Get player's current medical status
    public function getCurrentMedicalStatus($playerId) {
        $this->db->query('SELECT * FROM medical_history WHERE player_id = :player_id ORDER BY date DESC LIMIT 1');
        $this->db->bind(':player_id', $playerId);
        return $this->db->single();
    }
    
    // Get player's medical history
    public function getMedicalHistory($playerId) {
        $this->db->query('SELECT * FROM medical_history WHERE player_id = :player_id ORDER BY date DESC');
        $this->db->bind(':player_id', $playerId);
        return $this->db->resultSet();
    }
    
    // Get things to consider (blood type, allergies, etc.)
    public function getThingsToConsider($playerId) {
        $this->db->query('SELECT * FROM medical_info WHERE player_id = :player_id');
        $this->db->bind(':player_id', $playerId);
        return $this->db->single();
    }
    
    // Add new medical record
    public function addMedicalRecord($data) {
        $this->db->query('INSERT INTO medical_history (player_id, date, medical_condition, medication, notes) VALUES (:player_id, :date, :condition, :medication, :notes)');
        
        // Bind values
        $this->db->bind(':player_id', $data['player_id']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':condition', $data['condition']);
        $this->db->bind(':medication', $data['medication']);
        $this->db->bind(':notes', $data['notes']);
        
        // Execute
        return $this->db->execute();
    }
    
    // Update things to consider - CORRECTED VERSION
    public function updateThingsToConsider($data) {
        // First check if record exists
        $this->db->query('SELECT COUNT(*) as count FROM medical_info WHERE player_id = :player_id');
        $this->db->bind(':player_id', $data['player_id']);
        $result = $this->db->single();
        
        if ($result && $result->count > 0) {
            // Update existing record
            $this->db->query('UPDATE medical_info SET blood_type = :blood_type, allergies = :allergies, special_notes = :special_notes, emergency_contact = :emergency_contact WHERE player_id = :player_id');
        } else {
            // Insert new record
            $this->db->query('INSERT INTO medical_info (player_id, blood_type, allergies, special_notes, emergency_contact) VALUES (:player_id, :blood_type, :allergies, :special_notes, :emergency_contact)');
        }
        
        // Bind values
        $this->db->bind(':player_id', $data['player_id']);
        $this->db->bind(':blood_type', $data['blood_type']);
        $this->db->bind(':allergies', $data['allergies']);
        $this->db->bind(':special_notes', $data['special_notes']);
        $this->db->bind(':emergency_contact', $data['emergency_contact']);
        
        // Execute
        $result = $this->db->execute();
        error_log('updateThingsToConsider result: ' . ($result ? 'success' : 'failure'));
        return $result;
    }
    
    // Get player ID by user ID
    public function getPlayerIdByUserId($userId) {
        $this->db->query('SELECT player_id FROM user_player WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        $result = $this->db->single();
        
        return $result ? $result->player_id : null;
    }
}