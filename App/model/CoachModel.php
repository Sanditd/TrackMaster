<?php
require_once __DIR__ . '/../libraries/Database.php';

class CoachModel {
    private $db;

    public function __construct() {
        $this->db = new database();
    }

    public function getTeams() {
        $this->db->query('SELECT coach_id FROM user_coach WHERE user_id = :user_id');
        $this->db->bind(':user_id',     $_SESSION['user_id']    );
        $coachData = $this->db->single();
        
        if (!$coachData || !isset($coachData->coach_id)) {
            return []; // Return empty array if coach not found
        }
    
        $this->db->query('
            SELECT team.team_id, team.team_name AS team 
            FROM team 
            INNER JOIN user_coach ON team.zone = user_coach.zone AND team.sport_id = user_coach.sport_id 
            WHERE user_coach.coach_id = :coach_id
        ');
        $this->db->bind(':coach_id', $coachData->coach_id);
        
        return $this->db->resultSet();
    }

    public function getPlayersByTeamId($team_id) {
        $this->db->query('
            SELECT up.player_id, u.firstname AS name, u.photo, u.phonenumber, u.email, up.role AS role
            FROM cricket_team ct 
            JOIN user_player up ON ct.player_id = up.player_id 
            JOIN users u ON up.user_id = u.user_id 
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
                    cs.economy_rate,
                    up.player_id
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
            $query .= ' AND up.zone = :zone';  // 🔥 Fix here: up.zone
        }
        
        if ($role == 'batsman') {
            $query .= ' ORDER BY cs.batting_avg DESC';
        } elseif ($role == 'bowler') {
            $query .= ' ORDER BY cs.bowling_avg ASC'; // (lower bowling avg is better)
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
    
        // Get players with same sport and zone, including those without stats
        $this->db->query('
            SELECT 
                up.player_id, 
                CONCAT(u.firstname, " ", COALESCE(u.lname, "")) AS player_name,
                cs.role,
                u.user_id,
                u.firstname,
                u.lname,
                u.gender,
                up.role,
                cs.matches,
                cs.batting_avg,
                cs.strike_rate,
                cs.fifties,
                cs.hundreds,
                cs.wickets,
                cs.bowling_avg,
                cs.economy_rate
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
    

    
    public function getPlayerDetails($playerId) {
        $this->db->query('
            SELECT 
                up.player_id,
                CONCAT(u.firstname, " ", COALESCE(u.lname, "")) AS player_name,
                u.age,
                u.gender,
                u.photo,
                cs.role
            FROM user_player up
            JOIN users u ON up.user_id = u.user_id
            LEFT JOIN cricket_stats cs ON up.player_id = cs.player_id
            WHERE up.player_id = :playerId
        ');
        $this->db->bind(':playerId', $playerId);
        return $this->db->single();
    }
    
    public function getPlayerStatsById($playerId) {
        $this->db->query('
            SELECT 
                matches, innings, runs, batting_avg, strike_rate, boundaries,
                high_score, fifties, hundreds, wickets, bowling_avg,
                bowling_strike_rate, best_bowling_figures, economy_rate
            FROM cricket_stats
            WHERE player_id = :playerId
        ');
        $this->db->bind(':playerId', $playerId);
        return $this->db->single();
    }
    
    public function getPlayerRecentPerformances($playerId, $limit = 5) {
        $this->db->query('
            SELECT 
                pmp.*,
                m.match_date,
                m.opponent_team,
                m.venue,
                m.result
            FROM player_match_performance pmp
            JOIN matches m ON pmp.match_id = m.match_id
            WHERE pmp.player_id = :playerId
            ORDER BY m.match_date DESC
            LIMIT :limit
        ');
        $this->db->bind(':playerId', $playerId);
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    public function getTeamsByCoach($coachId) {
        // First get coach's sport and zone
        $this->db->query('SELECT sport_id, zone FROM user_coach WHERE user_id = :coachId');
        $this->db->bind(':coachId', $coachId);
        $coach = $this->db->single();
    
        if (!$coach) {
            throw new Exception('Coach record not found');
        }
    
        // Get teams with same sport and zone
        $this->db->query('
            SELECT 
                t.team_id, 
                t.team_name,
                t.number_of_players,
                s.sport_name
            FROM team t
            JOIN sports s ON t.sport_id = s.sport_id
            WHERE t.sport_id = :sportId AND t.zone = :zone
            ORDER BY t.team_name
        ');
        $this->db->bind(':sportId', $coach->sport_id);
        $this->db->bind(':zone', $coach->zone);
        
        return $this->db->resultSet();
    }

    public function getTeamStats($teamId) {
        $this->db->query('
            SELECT 
                COUNT(*) as total_matches,
                SUM(CASE WHEN result = "won" THEN 1 ELSE 0 END) as wins,
                SUM(CASE WHEN result = "lost" THEN 1 ELSE 0 END) as losses,
                SUM(CASE WHEN result = "tie" THEN 1 ELSE 0 END) as ties,
                SUM(CASE WHEN result = "no result" THEN 1 ELSE 0 END) as no_results,
                AVG(team_runs_scored) as avg_runs_scored,
                AVG(team_runs_conceded) as avg_runs_conceded,
                SUM(team_runs_scored) as total_runs_scored,
                SUM(team_wickets_taken) as total_wickets_taken,
                SUM(team_wickets_lost) as total_wickets_lost,
                SUM(team_catches_taken) as total_catches
            FROM matches
            WHERE team_id = :teamId
        ');
        $this->db->bind(':teamId', $teamId);
        $stats = $this->db->single();
        
        // Calculate win percentage
        if ($stats->total_matches > 0) {
            $stats->win_percentage = round(($stats->wins / $stats->total_matches) * 100, 1);
        } else {
            $stats->win_percentage = 0;
        }
        
        return $stats;
    }
    
    public function getTeamRecentMatches($teamId, $limit = 5) {
        $this->db->query('
            SELECT 
                match_id,
                opponent_team,
                match_date,
                venue,
                result,
                team_runs_scored,
                team_wickets_lost,
                team_runs_conceded,
                team_wickets_taken
            FROM matches
            WHERE team_id = :teamId
            ORDER BY match_date DESC
            LIMIT :limit
        ');
        $this->db->bind(':teamId', $teamId);
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
    
    public function getTeamMatches($teamId) {
        $this->db->query('
            SELECT 
                match_id,
                opponent_team,
                match_date,
                venue,
                result,
                team_runs_scored,
                team_wickets_lost,
                team_runs_conceded,
                team_wickets_taken
            FROM matches
            WHERE team_id = :teamId
            ORDER BY match_date DESC
        ');
        $this->db->bind(':teamId', $teamId);
        return $this->db->resultSet();
    }
    
    public function getTeamRecentForm($teamId, $limit = 5) {
        $this->db->query('
            SELECT result
            FROM matches
            WHERE team_id = :teamId
            ORDER BY match_date DESC
            LIMIT :limit
        ');
        $this->db->bind(':teamId', $teamId);
        $this->db->bind(':limit', $limit);
        $results = $this->db->resultSet();
        
        $form = [];
        foreach ($results as $match) {
            $form[] = $match->result;
        }
        
        return $form;
    }
    
    public function getTeamDetails($teamId) {
        $this->db->query('
            SELECT 
                t.team_id,
                t.team_name,
                t.number_of_players,
                s.sport_name
            FROM team t
            JOIN sports s ON t.sport_id = s.sport_id
            WHERE t.team_id = :teamId
        ');
        $this->db->bind(':teamId', $teamId);
        return $this->db->single();
    }

    public function getCoachDetails($userId) {
        // Get basic user info
        $this->db->query('
            SELECT 
                u.user_id, u.firstname, u.lname, u.phonenumber, 
                u.address, u.email, u.photo, u.age, u.dob, u.gender
            FROM users u
            WHERE u.user_id = :userId AND u.role = "coach"
        ');
        $this->db->bind(':userId', $userId);
        $coach = $this->db->single();
    
        if (!$coach) {
            throw new Exception('Coach not found');
        }
    
        // Get coach-specific info
        $this->db->query('
            SELECT 
                uc.coach_type, uc.educational_qualifications,
                uc.professional_playing_experience, uc.coaching_experience,
                uc.key_achievements, uc.bio,
                s.sport_name
            FROM user_coach uc
            LEFT JOIN sports s ON uc.sport_id = s.sport_id
            WHERE uc.user_id = :userId
        ');
        $this->db->bind(':userId', $userId);
        $coachDetails = $this->db->single();
    
        // Merge the data
        $coachData = (object) array_merge((array) $coach, (array) $coachDetails);
    
        // Format qualifications and experiences as arrays
        if (!empty($coachData->educational_qualifications)) {
            $coachData->educational_qualifications = explode(',', $coachData->educational_qualifications);
        } else {
            $coachData->educational_qualifications = [];
        }
    
        if (!empty($coachData->professional_playing_experience)) {
            $coachData->professional_playing_experience = explode(',', $coachData->professional_playing_experience);
        } else {
            $coachData->professional_playing_experience = [];
        }
    
        if (!empty($coachData->coaching_experience)) {
            $coachData->coaching_experience = explode(',', $coachData->coaching_experience);
        } else {
            $coachData->coaching_experience = [];
        }
    
        if (!empty($coachData->key_achievements)) {
            $coachData->key_achievements = explode(',', $coachData->key_achievements);
        } else {
            $coachData->key_achievements = [];
        }
    
        return $coachData;
    }

    public function updateCoachProfile($data) {
        // Start transaction
        $this->db->beginTransaction();
    
        try {
            // Update users table
            $userQuery = 'UPDATE users SET 
                          firstname = :firstname,
                          lname = :lname,
                          email = :email,
                          phonenumber = :phonenumber,
                          address = :address,
                          gender = :gender,
                          dob = :dob';
            
            // Add photo if provided
            if (!empty($data['photo'])) {
                $userQuery .= ', photo = :photo';
            }
            
            $userQuery .= ' WHERE user_id = :user_id';
            
            $this->db->query($userQuery);
            $this->db->bind(':firstname', $data['firstname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':phonenumber', $data['phonenumber']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':gender', $data['gender']);
            $this->db->bind(':dob', $data['dob']);
            $this->db->bind(':user_id', $data['user_id']);
            
            if (!empty($data['photo'])) {
                $this->db->bind(':photo', $data['photo']);
            }
            
            $this->db->execute();
    
            // Update user_coach table
            $coachQuery = 'UPDATE user_coach SET
                            bio = :bio,
                            educational_qualifications = :educational_qualifications,
                            professional_playing_experience = :professional_playing_experience,
                            coaching_experience = :coaching_experience,
                            key_achievements = :key_achievements
                          WHERE user_id = :user_id';
            
            $this->db->query($coachQuery);
            $this->db->bind(':bio', $data['bio']);
            $this->db->bind(':educational_qualifications', $data['educational_qualifications']);
            $this->db->bind(':professional_playing_experience', $data['professional_playing_experience']);
            $this->db->bind(':coaching_experience', $data['coaching_experience']);
            $this->db->bind(':key_achievements', $data['key_achievements']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->execute();
    
            // Commit transaction
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // Rollback on error
            $this->db->rollBack();
            error_log("Error updating coach profile: " . $e->getMessage());
            return false;
        }
    }
    
    public function getCoachDetais($userId) {
        // Get basic user info
        $this->db->query('
            SELECT 
                u.user_id, u.firstname, u.lname, u.phonenumber, 
                u.address, u.email, u.photo, u.age, u.dob, u.gender
            FROM users u
            WHERE u.user_id = :userId AND u.role = "coach"
        ');
        $this->db->bind(':userId', $userId);
        $coach = $this->db->single();
    
        if (!$coach) {
            throw new Exception('Coach not found');
        }
    
        // Get coach-specific info
        $this->db->query('
            SELECT 
                uc.coach_type, uc.educational_qualifications,
                uc.professional_playing_experience, uc.coaching_experience,
                uc.key_achievements, uc.bio,
                s.sport_name
            FROM user_coach uc
            LEFT JOIN sports s ON uc.sport_id = s.sport_id
            WHERE uc.user_id = :userId
        ');
        $this->db->bind(':userId', $userId);
        $coachDetails = $this->db->single();
    
        // Merge the data
        return (object) array_merge((array) $coach, (array) $coachDetails);
    }

    
    public function getSchoolsForDropdown($userId) {
        // First get the coach's zone from user_coach table
        $this->db->query('
            SELECT uc.zone 
            FROM user_coach uc
            JOIN users u ON uc.user_id = u.user_id
            WHERE u.user_id = :user_id
        ');
        $this->db->bind(':user_id', $userId);
        $coachZone = $this->db->single();
        
        if (!$coachZone || !$coachZone->zone) {
            return []; // Return empty array if coach or zone not found
        }
        
        // Get schools in the same zone
        $this->db->query('
            SELECT school_id, school_name 
            FROM user_school 
            WHERE zone = :zone
            ORDER BY school_name
        ');
        $this->db->bind(':zone', $coachZone->zone);
        return $this->db->resultSet();
    }


    public function getEventRequests($userId) {
        // First get the coach ID for this user
        $this->db->query('SELECT coach_id FROM user_coach WHERE user_id = :user_id');
        $this->db->bind(':user_id',     $userId);
        $coachData = $this->db->single();
        
        if (!$coachData || !isset($coachData->coach_id)) {
            return []; // Return empty array if coach not found
        }
        
        // Now get the event requests using the coach_id
        $this->db->query('
            SELECT er.*, us.school_name 
            FROM event_requests er
            JOIN user_school us ON er.school_id = us.school_id
            WHERE er.coach_id = :coach_id
            ORDER BY er.event_date DESC, er.time_from DESC
        ');
        $this->db->bind(':coach_id', $coachData->coach_id);
        return $this->db->resultSet();
    }   
    
    public function getScheduledEvents($userId) {
        // First get the coach ID for this user
        $this->db->query('SELECT coach_id FROM user_coach WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        $coachData = $this->db->single();
        
        if (!$coachData || !isset($coachData->coach_id)) {
            return []; // Return empty array if coach not found
        }
        
        // Now get the scheduled events using the coach_id
        $this->db->query('
            SELECT se.*, us.school_name 
            FROM scheduled_events se
            JOIN user_school us ON se.school_id = us.school_id
            WHERE se.coach_id = :coach_id
            ORDER BY se.event_date DESC, se.time_from DESC
        ');
        $this->db->bind(':coach_id', $coachData->coach_id);
        return $this->db->resultSet();
    }



public function createEventRequest($data) {
    $this->db->query('
        INSERT INTO event_requests 
        (coach_id, school_id, event_name, event_date, time_from, time_to, facilities_required)
        VALUES 
        (:coach_id, :school_id, :event_name, :event_date, :time_from, :time_to, :facilities_required)
    ');
    
    $this->db->bind(':coach_id', $data['coach_id']);
    $this->db->bind(':school_id', $data['school_id']);
    $this->db->bind(':event_name', $data['event_name']);
    $this->db->bind(':event_date', $data['event_date']);
    $this->db->bind(':time_from', $data['time_from']);
    $this->db->bind(':time_to', $data['time_to']);
    $this->db->bind(':facilities_required', $data['facilities_required']);
    
    return $this->db->execute();
}

public function deleteEventRequest($requestId) {
    $this->db->query('DELETE FROM event_requests WHERE request_id = :request_id');
    $this->db->bind(':request_id', $requestId);
    return $this->db->execute();
}

public function getEventRequestById($requestId) {
    $this->db->query('SELECT * FROM event_requests WHERE request_id = :request_id');
    $this->db->bind(':request_id', $requestId);
    return $this->db->single();
}

public function createScheduledEvent($data) {
    $this->db->query('
        INSERT INTO scheduled_events 
        (request_id, event_name, event_date, time_from, time_to, school_id, facilities_used, coach_id)
        VALUES 
        (:request_id, :event_name, :event_date, :time_from, :time_to, :school_id, :facilities_used, :coach_id)
    ');
    
    $this->db->bind(':request_id', $data['request_id']);
    $this->db->bind(':event_name', $data['event_name']);
    $this->db->bind(':event_date', $data['event_date']);
    $this->db->bind(':time_from', $data['time_from']);
    $this->db->bind(':time_to', $data['time_to']);
    $this->db->bind(':school_id', $data['school_id']);
    $this->db->bind(':facilities_used', $data['facilities_used']);
    $this->db->bind(':coach_id', $data['coach_id']);
    
    return $this->db->execute();
}

public function deleteScheduledEvent($eventId) {
    $this->db->query('DELETE FROM scheduled_events WHERE event_id = :event_id');
    $this->db->bind(':event_id', $eventId);
    return $this->db->execute();
}

public function getCoachDetailsByUserId($userId) {
    $this->db->query('SELECT * FROM user_coach WHERE user_id = :user_id');
    $this->db->bind(':user_id', $userId);
    return $this->db->single();
}

public function getCoachByUserId($userId) {
    $this->db->query('SELECT coach_id FROM user_coach WHERE user_id = :user_id');
    $this->db->bind(':user_id', $userId);
    return $this->db->single();
}

// Add these methods to your CoachModel class

public function getPlayersForAttendance($coachId, $teamId = null) {
    // First get coach's sport and zone
    $this->db->query('SELECT sport_id, zone FROM user_coach WHERE user_id = :coach_id');
    $this->db->bind(':coach_id', $coachId);
    $coach = $this->db->single();
    
    if (!$coach) {
        throw new Exception('Coach not found');
    }
    
    if ($teamId) {
        // Get players from specific team
        $this->db->query('
            SELECT 
                up.player_id, 
                u.firstname, 
                u.lname, 
                up.role,
                cs.role as player_role
            FROM user_player up
            JOIN users u ON up.user_id = u.user_id
            JOIN cricket_team ct ON up.player_id = ct.player_id
            LEFT JOIN cricket_stats cs ON up.player_id = cs.player_id
            WHERE ct.team_id = :team_id
            ORDER BY u.firstname
        ');
        $this->db->bind(':team_id', $teamId);
    } else {
        // Get all players in coach's zone and sport
        $this->db->query('
            SELECT 
                up.player_id, 
                u.firstname, 
                u.lname, 
                up.role,
                cs.role as player_role
            FROM user_player up
            JOIN users u ON up.user_id = u.user_id
            LEFT JOIN cricket_stats cs ON up.player_id = cs.player_id
            WHERE up.sport_id = :sport_id AND up.zone = :zone
            ORDER BY u.firstname
        ');
        $this->db->bind(':sport_id', $coach->sport_id);
        $this->db->bind(':zone', $coach->zone);
    }
    
    $players = $this->db->resultSet();

    error_log('Fetched players: ' . print_r($players, true));  // <- This logs into XAMPP php_error_log

    return $players;
}


public function createAttendanceSession($data) {
    $this->db->query('
    INSERT INTO attendance_sessions 
    (coach_id, team_id, session_type, session_date, start_time, end_time, location)
    VALUES 
    (:coach_id, :team_id, :session_type, :session_date, :start_time, :end_time, :location)
');

$this->db->bind(':coach_id', $data['coach_id']);
$this->db->bind(':team_id', $data['team_id']);
$this->db->bind(':session_type', $data['session_type']);
$this->db->bind(':session_date', $data['session_date']);
$this->db->bind(':start_time', $data['start_time']);
$this->db->bind(':end_time', $data['end_time']);
$this->db->bind(':location', $data['location']);

if ($this->db->execute()) {
    return $this->db->lastInsertId();
} else {
    return false;
}
}

public function recordPlayerAttendance($sessionId, $playerId, $status, $arrivalTime = null, $notes = null) {
    $this->db->query('
        INSERT INTO player_attendance 
        (session_id, player_id, status, arrival_time)
        VALUES 
        (:session_id, :player_id, :status, :arrival_time)
    ');
    
    $this->db->bind(':session_id', $sessionId);
    $this->db->bind(':player_id', $playerId);
    $this->db->bind(':status', $status);
    $this->db->bind(':arrival_time', $arrivalTime);
    
    return $this->db->execute();
}

public function searchPlayerAttendance($searchTerm, $coachId) {
    // First get coach's sport and zone to ensure we only search their players
    $this->db->query('SELECT sport_id, zone FROM user_coach WHERE user_id = :coach_id');
    $this->db->bind(':coach_id', $coachId);
    $coach = $this->db->single();
    
    if (!$coach) {
        throw new Exception('Coach not found');
    }
    
    // Search players by name or ID
    $this->db->query('
        SELECT 
            up.player_id,
            u.user_id,
            u.firstname,
            u.lname,
            up.role,
            up.school_id,
            us.school_name
        FROM user_player up
        JOIN users u ON up.user_id = u.user_id
        LEFT JOIN user_school us ON up.school_id = us.school_id
        WHERE (u.firstname LIKE :search OR u.lname LIKE :search OR up.player_id = :player_id)
        AND up.sport_id = :sport_id AND up.zone = :zone
        LIMIT 1
    ');
    
    $this->db->bind(':search', '%' . $searchTerm . '%');
    $this->db->bind(':player_id', is_numeric($searchTerm) ? $searchTerm : -1);
    $this->db->bind(':sport_id', $coach->sport_id);
    $this->db->bind(':zone', $coach->zone);
    
    $player = $this->db->single();
    
    if (!$player) {
        return null;
    }
    
    // Get attendance history
    $this->db->query('
        SELECT 
            pa.*,
            ases.session_type,
            ases.session_date,
            ases.location,
            ases.start_time,
            ases.end_time,
            t.team_name
        FROM player_attendance pa
        JOIN attendance_sessions ases ON pa.session_id = ases.session_id
        LEFT JOIN team t ON ases.team_id = t.team_id
        WHERE pa.player_id = :player_id
        ORDER BY ases.session_date DESC
        LIMIT 20
    ');
    $this->db->bind(':player_id', $player->player_id);
    $attendanceHistory = $this->db->resultSet();
    
    // Calculate stats
    $this->db->query('
        SELECT 
            COUNT(*) as total_sessions,
            SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) as present_count,
            SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) as absent_count,
            SUM(CASE WHEN status = "late" THEN 1 ELSE 0 END) as late_count
        FROM player_attendance pa
        JOIN attendance_sessions ases ON pa.session_id = ases.session_id
        WHERE pa.player_id = :player_id
    ');
    $this->db->bind(':player_id', $player->player_id);
    $stats = $this->db->single();
    
    return [
        'player' => $player,
        'history' => $attendanceHistory,
        'stats' => $stats
    ];
}

public function getTeamsBySportAndZone($sportId, $zoneId)
{
    $this->db->query('
        SELECT team_id, team_name 
        FROM team 
        WHERE sport_id = :sport_id AND zone = :zone
        ORDER BY team_name
    ');
    
    $this->db->bind(':sport_id', $sportId);
    $this->db->bind(':zone', $zoneId);
    
    return $this->db->resultSet();
}

public function getCoachSportId($user_id) {
    $this->db->query('
        SELECT sport_id 
        FROM user_coach 
        WHERE user_id = :user_id
    ');
    
    $this->db->bind(':user_id', $user_id);
    
    // Execute the query and fetch the single result
    $result = $this->db->single();
    
    // Return the sport_id if found, or null if not
    return $result ? $result->sport_id : null;
}

public function getTeamStatusCounts($coachId) {
    // First get coach's sport and zone
    $this->db->query('SELECT sport_id, zone FROM user_coach WHERE coach_id = :coach_id');
    $this->db->bind(':coach_id', $coachId);
    $coach = $this->db->single();
    
    if (!$coach) {
        return [];
    }
    
    // Get player status counts
    $this->db->query('
        SELECT 
            COUNT(*) as total_players,
            SUM(CASE WHEN up.statusus = "Practicing" THEN 1 ELSE 0 END) as practicing,
            SUM(CASE WHEN up.statusus = "In a meet" THEN 1 ELSE 0 END) as in_meet,
            SUM(CASE WHEN up.statusus = "At rest" THEN 1 ELSE 0 END) as at_rest,
            SUM(CASE WHEN up.statusus = "Injured" THEN 1 ELSE 0 END) as injured
        FROM user_player up
        WHERE up.sport_id = :sport_id AND up.zone = :zone
    ');
    $this->db->bind(':sport_id', $coach->sport_id);
    $this->db->bind(':zone', $coach->zone);
    
    return $this->db->single();
}

public function getUpcomingEvents($coachId, $days = 30) {
    $this->db->query('
        SELECT 
            se.event_id,
            se.event_name,
            se.event_date,
            se.time_from,
            se.time_to,
            "" as location, -- added dummy location
            us.school_name,
            "scheduled" as event_type
        FROM scheduled_events se
        JOIN user_school us ON se.school_id = us.school_id
        WHERE se.coach_id = :coach_id
        AND se.event_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL :days DAY)

        UNION

        SELECT 
            er.request_id as event_id,
            er.event_name,
            er.event_date,
            er.time_from,
            er.time_to,
            er.facilities_required as location,
            us.school_name,
            "request" as event_type
        FROM event_requests er
        JOIN user_school us ON er.school_id = us.school_id
        WHERE er.coach_id = :coach_id
        AND er.status = "approved"
        AND er.event_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL :days DAY)

        ORDER BY event_date, time_from
    ');
    
    $this->db->bind(':coach_id', $coachId);
    $this->db->bind(':days', $days);
    
    return $this->db->resultSet();
}


public function getSessionStats($coachId) {
    // Training sessions count
    $this->db->query('
        SELECT COUNT(*) as training_sessions
        FROM attendance_sessions
        WHERE coach_id = :coach_id
        AND session_type = "training"
    ');
    $this->db->bind(':coach_id', $coachId);
    $training = $this->db->single();
    
    // Match sessions count
    $this->db->query('
        SELECT COUNT(*) as matches_played
        FROM matches m
        JOIN team t ON m.team_id = t.team_id
        JOIN user_coach uc ON t.zone = uc.zone AND t.sport_id = uc.sport_id
        WHERE uc.coach_id = :coach_id
    ');
    $this->db->bind(':coach_id', $coachId);
    $matches = $this->db->single();
    
    return [
        'training_sessions' => $training->training_sessions,
        'matches_played' => $matches->matches_played
    ];
}

public function getRecentMedicalAlerts($coachId) {
    // First get coach's sport and zone
    $this->db->query('SELECT sport_id, zone FROM user_coach WHERE coach_id = :coach_id');
    $this->db->bind(':coach_id', $coachId);
    $coach = $this->db->single();
    
    if (!$coach) {
        return [];
    }
    
    // Get recent medical alerts (last 30 days)
    $this->db->query('
        SELECT 
            mh.id,
            mh.medical_condition,
            mh.date,
            CONCAT(u.firstname, " ", COALESCE(u.lname, "")) as player_name
        FROM medical_history mh
        JOIN user_player up ON mh.player_id = up.player_id
        JOIN users u ON up.user_id = u.user_id
        WHERE up.sport_id = :sport_id AND up.zone = :zone
        AND mh.date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        ORDER BY mh.date DESC
        LIMIT 5
    ');
    $this->db->bind(':sport_id', $coach->sport_id);
    $this->db->bind(':zone', $coach->zone);
    
    return $this->db->resultSet();
}


public function getPendingScheduleRequests($coachId) {
    $this->db->query('
        SELECT 
            scr.id,
            scr.reason,
            scr.request_date,
            CONCAT(u.firstname, " ", COALESCE(u.lname, "")) as player_name,
            se.event_name,
            se.event_date
        FROM schedule_change_requests scr
        JOIN user_player up ON scr.player_id = up.player_id
        JOIN users u ON up.user_id = u.user_id
        JOIN scheduled_events se ON scr.event_id = se.event_id
        WHERE scr.coach_id = :coach_id
        ORDER BY scr.request_date DESC
        LIMIT 5
    ');
    $this->db->bind(':coach_id', $coachId);
    
    return $this->db->resultSet();
}   

public function getPlayerAchievements($playerId) {
    $this->db->query('
        SELECT 
            achievement_id,
            place,
            level,
            description,
            date
        FROM achievements
        WHERE player_id = :player_id
        ORDER BY date DESC
    ');
    $this->db->bind(':player_id', $playerId);
    
    return $this->db->resultSet();
}

public function getAchievementById($achievementId) {
    $this->db->query('
        SELECT 
            achievement_id,
            player_id,
            place,
            level,
            description,
            date
        FROM achievements
        WHERE achievement_id = :achievement_id
    ');
    $this->db->bind(':achievement_id', $achievementId);
    
    return $this->db->single();
}

public function addAchievement($data) {
    $this->db->query('
        INSERT INTO achievements 
        (player_id, place, level, description, date)
        VALUES 
        (:player_id, :place, :level, :description, :date)
    ');
    
    $this->db->bind(':player_id', $data['player_id']);
    $this->db->bind(':place', $data['place']);
    $this->db->bind(':level', $data['level']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':date', $data['date']);
    
    return $this->db->execute();
}

public function updateAchievement($data) {
    $this->db->query('
        UPDATE achievements SET
            place = :place,
            level = :level,
            description = :description,
            date = :date
        WHERE achievement_id = :achievement_id
    ');
    
    $this->db->bind(':achievement_id', $data['achievement_id']);
    $this->db->bind(':place', $data['place']);
    $this->db->bind(':level', $data['level']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':date', $data['date']);
    
    return $this->db->execute();
}

public function deleteAchievement($achievementId) {
    $this->db->query('DELETE FROM achievements WHERE achievement_id = :achievement_id');
    $this->db->bind(':achievement_id', $achievementId);
    return $this->db->execute();
}

}

    
?>