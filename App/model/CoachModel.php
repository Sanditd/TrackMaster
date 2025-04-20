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

    public function createTeam($name, $numPlayers, $userId) {
        // First get the coach's sport ID and zone
        $this->db->query('SELECT sport_id, zone FROM user_coach WHERE user_id = :userId');
        $this->db->bind(':userId', $userId);
        $coach = $this->db->single();
        
        if (!$coach) {
            throw new Exception('Coach record not found');
        }
        
        if (!$coach->sport_id) {
            throw new Exception('No sport assigned to this coach');
        }
    
        $sportId = $coach->sport_id;
        $zone = $coach->zone;
    
        // Check if team name already exists for this sport
        $this->db->query('SELECT team_id FROM team WHERE sport_id = :sportId AND team_name = :name');
        $this->db->bind(':sportId', $sportId);
        $this->db->bind(':name', $name);
        
        if ($this->db->single()) {
            throw new Exception('A team with this name already exists for your sport');
        }
    
        // Create the team and include the zone
        $query = 'INSERT INTO team (sport_id, team_name, number_of_players, zone) 
                  VALUES (:sportId, :name, :numPlayers, :zone)';
        
        $this->db->query($query);
        $this->db->bind(':sportId', $sportId);
        $this->db->bind(':name', $name);
        $this->db->bind(':numPlayers', $numPlayers);
        $this->db->bind(':zone', $zone);
        
        if (!$this->db->execute()) {
            throw new Exception('Database error: Failed to create team');
        }
        
        return $this->db->lastInsertId();
    }
    

 

    public function filterPlayers($role = null, $gender = null, $coachZone = null) {
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
        if ($coachZone) {
            $query .= ' AND u.zone = :zone';
        }
    
        if ($role == 'batsman') {
            $query .= ' ORDER BY cs.batting_avg DESC';
        } elseif ($role == 'bowler') {
            $query .= ' ORDER BY cs.bowling_avg DESC';
        }
    
        $this->db->query($query);
    
        if ($role) {
            $this->db->bind(':role', $role);
        }
        if ($gender) {
            $this->db->bind(':gender', $gender);
        }
        if ($coachZone) {
            $this->db->bind(':zone', $coachZone);
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

    public function getTeamsByZoneAndSport($userId) {
        $this->db->query('
            SELECT t.team_id, t.team_name 
            FROM team t
            JOIN user_coach uc ON t.sport_id = uc.sport_id AND t.zone = uc.zone
            WHERE uc.user_id = :userId
        ');
        $this->db->bind(':userId', $userId);
        return $this->db->resultSet();
    }

    public function getPlayersFromTeamId($teamId) {
        $this->db->query("
            SELECT up.player_id, CONCAT(u.firstname, ' ', COALESCE(u.lname, '')) as player_name 
            FROM cricket_team ct
            JOIN user_player up ON ct.player_id = up.player_id
            JOIN users u ON up.user_id = u.user_id
            WHERE ct.team_id = :teamId
        ");
        $this->db->bind(':teamId', $teamId);
        return $this->db->resultSet();
    }
    
    public function saveMatchData($data) {
        $this->db->query('
            INSERT INTO matches 
            (team_id, opponent_team, match_date, venue, result, 
             team_runs_scored, team_wickets_lost, team_overs_played,
             team_runs_conceded, team_wickets_taken, team_overs_bowled, team_catches_taken)
            VALUES 
            (:team_id, :opponent_team, :match_date, :venue, :result,
             :team_runs_scored, :team_wickets_lost, :team_overs_played,
             :team_runs_conceded, :team_wickets_taken, :team_overs_bowled, :team_catches_taken)
        ');
    
        // Bind values
        $this->db->bind(':team_id', $data['team_id']);
        $this->db->bind(':opponent_team', $data['opponent_team']);
        $this->db->bind(':match_date', $data['match_date']);
        $this->db->bind(':venue', $data['venue']);
        $this->db->bind(':result', $data['result']);
        $this->db->bind(':team_runs_scored', $data['team_runs_scored']);
        $this->db->bind(':team_wickets_lost', $data['team_wickets_lost']);
        $this->db->bind(':team_overs_played', $data['team_overs_played']);
        $this->db->bind(':team_runs_conceded', $data['team_runs_conceded']);
        $this->db->bind(':team_wickets_taken', $data['team_wickets_taken']);
        $this->db->bind(':team_overs_bowled', $data['team_overs_bowled']);
        $this->db->bind(':team_catches_taken', $data['team_catches_taken']);
    
        // Execute
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    public function savePlayerPerformance($matchId, $performance) {
        $this->db->query('
            INSERT INTO player_match_performance 
            (match_id, player_id, runs_scored, balls_faced, fours, sixes, 
             wickets_taken, overs_bowled, runs_conceded, catches)
            VALUES 
            (:match_id, :player_id, :runs_scored, :balls_faced, :fours, :sixes,
             :wickets_taken, :overs_bowled, :runs_conceded, :catches)
        ');
    
        // Bind values
        $this->db->bind(':match_id', $matchId);
        $this->db->bind(':player_id', $performance['player_id']);
        $this->db->bind(':runs_scored', $performance['runs'] ?? 0);
        $this->db->bind(':balls_faced', $performance['ballsFaced'] ?? 0);
        $this->db->bind(':fours', $performance['fours'] ?? 0);
        $this->db->bind(':sixes', $performance['sixes'] ?? 0);
        $this->db->bind(':wickets_taken', $performance['wickets'] ?? 0);
        $this->db->bind(':overs_bowled', $performance['oversBowled'] ?? 0.0);
        $this->db->bind(':runs_conceded', $performance['runsConceded'] ?? 0);
        $this->db->bind(':catches', $performance['catches'] ?? 0);
    
        // Execute
        return $this->db->execute();
    }
    

    public function updateCricketStats($performance) {
        $playerId = $performance['player_id'];
    
        // Check if a cricket_stats row exists
        $this->db->query("SELECT * FROM cricket_stats WHERE player_id = :player_id");
        $this->db->bind(':player_id', $playerId);
        $existing = $this->db->single();
    
        // Extract stats from performance
        $runs = $performance['runs'] ?? 0;
        $balls = $performance['ballsFaced'] ?? 0;
        $fours = $performance['fours'] ?? 0;
        $sixes = $performance['sixes'] ?? 0;
        $wickets = $performance['wickets'] ?? 0;
        $overs = $performance['oversBowled'] ?? 0.0;
        $runsConceded = $performance['runsConceded'] ?? 0;
    
        // If no existing stats, insert new
        if (!$existing) {
            $strikeRate = $balls > 0 ? ($runs / $balls) * 100 : 0.00;
            $economy = $overs > 0 ? $runsConceded / $overs : 0.00;
            $battingAverage = $runs; // 1 inning, not out handling later
            $bowlingAverage = $wickets > 0 ? $runsConceded / $wickets : 0;
            $bowlingStrikeRate = $wickets > 0 ? ($overs * 6) / $wickets : 0;
            
            $this->db->query("
                INSERT INTO cricket_stats 
                (player_id, matches, innings, runs, strike_rate, batting_avg, boundaries, high_score, fifties, hundreds, 
                 wickets, economy_rate, bowling_avg, bowling_strike_rate, best_bowling_figures)
                VALUES 
                (:player_id, 1, 1, :runs, :strike_rate, :batting_average, :boundaries, :high_score, :fifties, :hundreds, 
                 :wickets, :economy_rate, :bowling_average, :bowling_strike_rate, :bbf)
            ");
            $this->db->bind(':batting_average', $battingAverage);
            $this->db->bind(':bowling_average', $bowlingAverage);
            $this->db->bind(':bowling_strike_rate', $bowlingStrikeRate);
            $this->db->bind(':player_id', $playerId);
            $this->db->bind(':runs', $runs);
            $this->db->bind(':strike_rate', $strikeRate);
            $this->db->bind(':boundaries', $fours + $sixes);
            $this->db->bind(':high_score', $runs);
            $this->db->bind(':fifties', $runs >= 50 && $runs < 100 ? 1 : 0);
            $this->db->bind(':hundreds', $runs >= 100 ? 1 : 0);
            $this->db->bind(':wickets', $wickets);
            $this->db->bind(':economy_rate', $economy);
            $this->db->bind(':bbf', $wickets > 0 ? "$wickets/$runsConceded" : '0/0');
            $this->db->execute();
        } else {
            // Update existing stats
            $matches = $existing->matches + 1;
            $innings = $existing->innings + 1;
            $newRuns = $existing->runs + $runs;
            $totalBalls = $existing->innings * ($existing->strike_rate > 0 ? ($existing->runs / $existing->strike_rate) * 100 : 0) + $balls;
            $newSR = $totalBalls > 0 ? ($newRuns / $totalBalls) * 100 : 0.00;
    
            $totalOvers = $existing->innings * ($existing->economy_rate > 0 ? ($existing->runs / $existing->economy_rate) : 0) + $overs;
            $newEconomy = $totalOvers > 0 ? ($existing->runs + $runsConceded) / $totalOvers : 0.00;
    
            $boundaries = $existing->boundaries + $fours + $sixes;
            $highScore = max($existing->high_score, $runs);
            $fifties = $existing->fifties + (($runs >= 50 && $runs < 100) ? 1 : 0);
            $hundreds = $existing->hundreds + ($runs >= 100 ? 1 : 0);
            $totalWickets = $existing->wickets + $wickets;
    
            $bestFigures = $existing->best_bowling_figures;
            if ($wickets > 0) {
                [$prevWkts, $prevRuns] = explode('/', $existing->best_bowling_figures);
                if ($wickets > (int)$prevWkts || ($wickets == (int)$prevWkts && $runsConceded < (int)$prevRuns)) {
                    $bestFigures = "$wickets/$runsConceded";
                }
            }


    
            $totalBallsBowled = $totalOvers * 6 + ($overs * 6); // assuming 6 balls per over
            $battingAverage = $innings > 0 ? $newRuns / $innings : 0;
            $bowlingAverage = $totalWickets > 0 ? ($existing->economy_rate * $existing->innings * 6 + $runsConceded) / $totalWickets : 0;
            $bowlingStrikeRate = $totalWickets > 0 ? $totalBallsBowled / $totalWickets : 0;
            
            $this->db->query("
                UPDATE cricket_stats SET
                matches = :matches,
                innings = :innings,
                runs = :runs,
                strike_rate = :strike_rate,
                batting_avg = :batting_average,
                boundaries = :boundaries,
                high_score = :high_score,
                fifties = :fifties,
                hundreds = :hundreds,
                wickets = :wickets,
                economy_rate = :economy_rate,
                bowling_avg = :bowling_average,
                bowling_strike_rate = :bowling_strike_rate,
                best_bowling_figures = :bbf
                WHERE player_id = :player_id
            ");
            $this->db->bind(':batting_average', $battingAverage);
            $this->db->bind(':bowling_average', $bowlingAverage);
            $this->db->bind(':bowling_strike_rate', $bowlingStrikeRate);            
            $this->db->bind(':matches', $matches);
            $this->db->bind(':innings', $innings);
            $this->db->bind(':runs', $newRuns);
            $this->db->bind(':strike_rate', $newSR);
            $this->db->bind(':boundaries', $boundaries);
            $this->db->bind(':high_score', $highScore);
            $this->db->bind(':fifties', $fifties);
            $this->db->bind(':hundreds', $hundreds);
            $this->db->bind(':wickets', $totalWickets);
            $this->db->bind(':economy_rate', $newEconomy);
            $this->db->bind(':bbf', $bestFigures);
            $this->db->bind(':player_id', $playerId);
            $this->db->execute();
        }
    }
    
    public function getPlayersByCoachZone($coachId) {
        // First get coach's sport and zone
        $this->db->query('SELECT sport_id, zone FROM user_coach WHERE user_id = :coachId');
        $this->db->bind(':coachId', $coachId);
        $coach = $this->db->single();
    
        if (!$coach) {
            throw new Exception('Coach record not found');
        }
    
        // Get players with same sport and zone
        $this->db->query('
            SELECT 
                up.player_id, 
                CONCAT(u.firstname, " ", COALESCE(u.lname, "")) AS player_name,
                u.photo,
                cs.role
            FROM user_player up
            JOIN users u ON up.user_id = u.user_id
            LEFT JOIN cricket_stats cs ON up.player_id = cs.player_id
            WHERE up.sport_id = :sportId AND up.zone = :zone
            ORDER BY u.firstname
        ');
        $this->db->bind(':sportId', $coach->sport_id);
        $this->db->bind(':zone', $coach->zone);
        
        return $this->db->resultSet();
    }
    
    
}


    
?>