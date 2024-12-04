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
        $query = 'SELECT 
                    u.firstname, 
                    u.user_id, 
                    u.gender, 
                    cs.role, 
                    cs.matches, 
                    cs.batting_avg, 
                    cs.strike_rate, 
                    cs.fifties, 
                    cs.hundreds, 
                    cs.wickets, 
                    cs.bowling_avg, 
                    cs.bowling_strike_rate, 
                    cs.economy_rate
                  FROM 
                    users u
                  JOIN 
                    user_player up ON u.user_id = up.user_id
                  JOIN 
                    cricket_stats cs ON up.player_id = cs.player_id
                  WHERE 
                    1=1';
    
        if ($role) {
            $query .= ' AND cs.role = :role';
        }
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

    public function getPlayerStats($playerIds) {
        $query = 'SELECT  up.player_id, u.firstname, cs.role, u.gender, cs.batting_avg, cs.bowling_avg, cs.matches, cs.strike_rate, cs.fifties, cs.hundreds, cs.wickets, cs.bowling_avg, cs.bowling_strike_rate,  cs.economy_rate
                  FROM users u
                  JOIN user_player up ON u.user_id = up.user_id
                  JOIN cricket_stats cs ON up.player_id = cs.player_id
                  WHERE u.user_id IN(' . implode(',', array_map('intval', explode(',', $playerIds))) . ')';
    
        $this->db->query($query);
        return $this->db->resultSet();
    }


    public function addPlayerToTeam($teamId, $playerId) {
        $query = 'INSERT INTO cricket_team (team_id, player_id) VALUES (:teamId, :playerId)';
        $this->db->query($query);
        $this->db->bind(':teamId', $teamId);
        $this->db->bind(':playerId', $playerId);
       
        if (!$this->db->execute()) {
            error_log("Database Error: " . $this->db->error()); // Log the database error
            return false;
        }
    
        return true;
    }
    

    public function deleteTeam($teamId) {
        try {
            $this->db->beginTransaction();
    
            // Delete associated players in the cricket_team table
            $this->db->query('DELETE FROM cricket_team WHERE team_id = :teamId');
            $this->db->bind(':teamId', $teamId);
            $this->db->execute();
    
            // Delete the team from the team table
            $this->db->query('DELETE FROM team WHERE team_id = :teamId');
            $this->db->bind(':teamId', $teamId);
            $this->db->execute();
    
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Error deleting team: " . $e->getMessage());
            return false;
        }
    }
    
    public function getTeamById($teamId) {
        $this->db->query('SELECT * FROM team WHERE team_id = :teamId');
        $this->db->bind(':teamId', $teamId);
        return $this->db->single();
    }
    
    public function updateTeam($teamId, $teamName, $numberOfPlayers) {
        $this->db->query('UPDATE team SET team_name = :teamName, number_of_players = :numberOfPlayers WHERE team_id = :teamId');
        $this->db->bind(':teamName', $teamName);
        $this->db->bind(':numberOfPlayers', $numberOfPlayers);
        $this->db->bind(':teamId', $teamId);
        return $this->db->execute();
    }
    
    public function getPlayerssByTeamId($teamId) {
        $this->db->query('
            SELECT ct.player_id, u.firstname AS name, cs.role
            FROM cricket_team ct
            JOIN user_player up ON ct.player_id = up.player_id
            JOIN users u ON up.user_id = u.user_id
            JOIN cricket_stats cs ON ct.player_id = cs.player_id
            WHERE ct.team_id = :teamId
        ');
        $this->db->bind(':teamId', $teamId);
        return $this->db->resultSet();
    }
    
    public function removePlayerFromTeam($teamId, $playerId) {
        $this->db->query('DELETE FROM cricket_team WHERE team_id = :teamId AND player_id = :playerId');
        $this->db->bind(':teamId', $teamId);
        $this->db->bind(':playerId', $playerId);
        return $this->db->execute();
    }
    
}


    
?>