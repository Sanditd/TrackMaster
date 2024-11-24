<?php
require_once __DIR__ . '/../libraries/database.php';

class CoachModel{
    private $db;

    public function __construct() {
        $this->db = new database();
    }

    // Fetch all teams
    public function getTeams() {
        $this->db->query('SELECT team_id, name FROM teams');
        return $this->db->resultSet();
    }

    // Fetch players for a specific team
    public function getPlayersByTeamId($team_id) {
        $this->db->query('
            SELECT p.player_id, p.name, p.photo, p.contact_info, p.role 
            FROM team_players tp 
            JOIN players p ON tp.player_id = p.player_id 
            WHERE tp.team_id = :id
        ');
        $this->db->bind(':id', $team_id);
        return $this->db->resultSet();
    }
    

    public function getFilteredPlayers($role, $gender) {
        $query = 'SELECT * FROM players WHERE 1=1';
    
        if (!empty($role)) {
            $query .= ' AND role = :role';
        }
    
        if (!empty($gender)) {
            $query .= ' AND gender = :gender';
        }

        if ($role === 'batsman' || $role === 'wicketkeeper') {
            $query .= ' ORDER BY batting_avg DESC';
        } elseif ($role === 'bowler') {
            $query .= ' ORDER BY bowling_avg DESC';
        }
    
        $this->db->query($query);
    
        if (!empty($role)) {
            $this->db->bind(':role', $role);
        }
    
        if (!empty($gender)) {
            $this->db->bind(':gender', $gender);
        }
    
        return $this->db->resultSet();
    }
    
    public function getPlayersByName($names) {
        $inQuery = implode(',', array_fill(0, count($names), '?'));
        $query = "SELECT * FROM players WHERE name IN ($inQuery)";
        $this->db->query($query);

        foreach ($names as $index => $name) {
            $this->db->bind($index + 1, $name);
        }
        return $this->db->resultSet();
    }
    
    
        public function createTeam($name, $numPlayers) {
            $query = 'INSERT INTO teams (name, num_of_players) VALUES (:name, :numPlayers)';
            $this->db->query($query);
            $this->db->bind(':name', $name);
            $this->db->bind(':numPlayers', $numPlayers);
            $this->db->execute();
            return $this->db->lastInsertId();
            
        }


    public function addPlayerToTeam($teamId, $playerId) {
        $query = 'INSERT INTO team_players (team_id, player_id) VALUES (:teamId, :playerId)';   
        $this->db->query($query);
        $this->db->bind(':teamId', $teamId);
        $this->db->bind(':playerId', $playerId);
        return $this->db->execute();
    }
}


    
?>