<?php
require_once __DIR__ . '/../libraries/database.php';

class CoachModel {
    private $db;

    public function __construct() {
        $this->db = new database();
    }

    public function getTeams() {
        $this->db->query('SELECT team_id, team_name AS team FROM team');
        return $this->db->resultSet();
    }

    public function getPlayersByTeamId($team_id) {
        $this->db->query('
            SELECT up.player_id, u.firstname AS name, u.photo, u.phonenumber, u.email, cs.role AS role
            FROM cricket_team ct 
            JOIN user_player up ON ct.player_id = up.player_id 
            JOIN users u ON up.user_id = u.user_id 
            JOIN cricket_stats cs ON ct.player_id = cs.player_id
            WHERE ct.team_id = :id
        ');
        $this->db->bind(':id', $team_id);
        return $this->db->resultSet();
    }

    public function getFilteredPlayers($role = '') {
        $query = 'SELECT up.player_id, u.firstname AS name, s.matches, s.batting_avg, s.strike_rate,
                         s.fifties, s.hundreds, s.wickets, s.bowling_avg, s.bowling_strike_rate, s.economy_rate
                  FROM user_player up
                  JOIN users u ON up.user_id = u.userid
                  JOIN stats s ON up.player_id = s.player_id
                  WHERE 1=1';
    
        if (!empty($role)) {
            $query .= ' AND up.zone = :role';
        }
    
            
        $this->db->query($query);
    
        if (!empty($role)) {
            $this->db->bind(':role', $role);
        }
    
       
    
        return $this->db->resultSet();
    }
    

    public function getPlayersByName($names) {
        $inQuery = implode(',', array_fill(0, count($names), '?'));
        $query = "SELECT up.player_id, u.firstname AS name, u.photo, u.contact_info, up.zone AS role
                  FROM user_player up
                  JOIN users u ON up.user_id = u.user_id 
                  WHERE u.firstname IN ($inQuery)";
        $this->db->query($query);

        foreach ($names as $index => $name) {
            $this->db->bind($index + 1, $name);
        }

        return $this->db->resultSet();
    }

    public function createTeam($name, $numPlayers) {
        $query = 'INSERT INTO team (team_name, number_of_players) VALUES (:name, :numPlayers)';
        $this->db->query($query);
        $this->db->bind(':name', $name);
        $this->db->bind(':numPlayers', $numPlayers);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function addPlayerToTeam($teamId, $playerId) {
        $query = 'INSERT INTO cricket_team (team_id, player_id) VALUES (:teamId, :playerId)';
        $this->db->query($query);
        $this->db->bind(':teamId', $teamId);
        $this->db->bind(':playerId', $playerId);
        return $this->db->execute();
    }
}
