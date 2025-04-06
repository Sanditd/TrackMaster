<?php
require_once __DIR__ . '/../libraries/Database.php';

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

    public function getFilteredPlayers($role, $gender) {
        $query = "SELECT 
                    u.userid AS player_id, 
                    CONCAT(u.firstname, ' ', u.lname) AS name, 
                    p.zone, 
                    p.gender, 
                    a.matches, 
                    a.batting_avg, 
                    a.bowling_avg 
                  FROM 
                    user_player AS p
                  INNER JOIN 
                    users AS u ON u.userid = p.user_id
                  LEFT JOIN 
                    player_stats AS a ON a.player_id = p.player_id
                  WHERE 1 = 1";
    
        if (!empty($role)) {
            $query .= " AND a.role = :role";
        }
    
        if (!empty($gender)) {
            $query .= " AND p.gender = :gender";
        }
    
        $query .= " ORDER BY 
                    CASE 
                      WHEN :role = 'batsman' THEN a.batting_avg 
                      WHEN :role = 'bowler' THEN a.bowling_avg 
                    END DESC";
    
        $stmt = $this->db->prepare($query);
    
        if (!empty($role)) {
            $stmt->bindValue(':role', $role, PDO::PARAM_STR);
        }
        if (!empty($gender)) {
            $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
        }
    
        $stmt->bindValue(':role', $role, PDO::PARAM_STR); // For ordering
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}


    
?>