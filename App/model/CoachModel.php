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

    public function createTeam($name, $numPlayers) {
        $query = 'INSERT INTO team (team_name, number_of_players) VALUES (:name, :numPlayers)';
        $this->db->query($query);
        $this->db->bind(':name', $name);
        $this->db->bind(':numPlayers', $numPlayers);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function filterPlayers($role = null, $gender = null) {
        $query = 'SELECT u.firstname, u.user_id, cs.role, cs.batting_avg, cs.bowling_avg, u.gender
                  FROM users u
                  JOIN user_player up ON u.user_id = up.user_id
                  JOIN cricket_stats cs ON up.player_id = cs.player_id
                  WHERE 1=1';

        // Apply role filter if provided
        if ($role) {
            $query .= ' AND cs.role = :role';
        }

        // Apply gender filter if provided
        if ($gender) {
            $query .= ' AND u.gender = :gender';
        }

        // Order by batting or bowling average depending on the role
        if ($role == 'batsman') {
            $query .= ' ORDER BY cs.batting_avg DESC';
        } elseif ($role == 'bowler') {
            $query .= ' ORDER BY cs.bowling_avg DESC';
        }

        $this->db->query($query);

        // Bind parameters dynamically
        if ($role) {
            $this->db->bind(':role', $role);
        }
        if ($gender) {
            $this->db->bind(':gender', $gender);
        }

        return $this->db->resultSet();
    }


}


    
?>