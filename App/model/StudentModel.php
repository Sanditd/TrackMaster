<?php
require_once __DIR__ . '/../libraries/Database.php';

class StudentModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserDetails($userId) {
        $this->db->query("SELECT * FROM users WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);
        try {
            return $this->db->single();
        } catch (Exception $e) {
            error_log('Error fetching user details: ' . $e->getMessage());
            return false;
        }
    }

    public function getPlayerRole($userId) {
        $this->db->query("SELECT role FROM user_player WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);
        try {
            $result = $this->db->single();
            return $result ? $result->role : 'Not specified';
        } catch (Exception $e) {
            error_log('Error fetching player role: ' . $e->getMessage());
            return 'Not specified';
        }
    }
    
    public function updateUserProfile($data, $profilePicturePath = null) {
        // Log the data being updated
        error_log('updateUserProfile called with data: ' . print_r($data, true));
        if ($profilePicturePath) {
            error_log('Profile picture path: ' . $profilePicturePath);
        }

        $query = 'UPDATE users SET 
            firstname = :firstname,
            lname = :lname,
            email = :email,
            phonenumber = :phonenumber,
            gender = :gender,
            dob = :dob,
            bio = :bio' . ($profilePicturePath ? ', photo = :photo' : '') . '
            WHERE user_id = :user_id';

        $this->db->query($query);
    
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lname', $data['lname'] ?: null); // Allow NULL for lname
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phonenumber', $data['phonenumber']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':dob', $data['dob']); // Already set to NULL if empty
        $this->db->bind(':bio', $data['bio'] ?: null); // Allow NULL for bio
        $this->db->bind(':user_id', $data['user_id']);
        if ($profilePicturePath) {
            $this->db->bind(':photo', basename($profilePicturePath));
        }
    
        try {
            $result = $this->db->execute();
            if (!$result) {
                error_log('Database update failed: No rows affected or query error.');
            }
            return $result;
        } catch (Exception $e) {
            error_log('Database error updating user profile: ' . $e->getMessage());
            return false;
        }
    }

    public function updateTrainingStatus($data) {
        $this->db->query('SELECT id FROM training_status WHERE user_id = :user_id');
        $this->db->bind(':user_id', $data['user_id']);
        $exists = $this->db->single();

        if ($exists) {
            $this->db->query('UPDATE training_status SET status = :status, updated_at = NOW() WHERE user_id = :user_id');
        } else {
            $this->db->query('INSERT INTO training_status (user_id, status) VALUES (:user_id, :status)');
        }

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':status', $data['status']);

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error updating training status: ' . $e->getMessage());
            return false;
        }
    }

    public function getTrainingStatus($userId) {
        $this->db->query('SELECT status FROM training_status WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        try {
            $result = $this->db->single();
            return $result ? $result->status : 'Practicing';
        } catch (Exception $e) {
            error_log('Error fetching training status: ' . $e->getMessage());
            return 'Practicing';
        }
    }

    public function addCalendarNote($data) {
        $this->db->query('INSERT INTO calendar_notes (user_id, note_date, note_text) VALUES (:user_id, :note_date, :note_text)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':note_date', $data['note_date']);
        $this->db->bind(':note_text', $data['note_text']);
    
        try {
            $result = $this->db->execute();
            if (!$result) {
                error_log('Failed to execute query for calendar note. Data: ' . json_encode($data));
            }
            return $result;
        } catch (Exception $e) {
            error_log('Error adding calendar note: ' . $e->getMessage() . ' | Data: ' . json_encode($data));
            return false;
        }
    }
    
    public function getCalendarNotes($userId, $month, $year) {
        $startDate = date('Y-m-d', strtotime("$year-$month-01"));
        $endDate = date('Y-m-t', strtotime($startDate));

        $this->db->query('SELECT note_date, note_text FROM calendar_notes WHERE user_id = :user_id AND note_date BETWEEN :start_date AND :end_date');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':start_date', $startDate);
        $this->db->bind(':end_date', $endDate);

        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error fetching calendar notes: ' . $e->getMessage());
            return [];
        }
    }

    public function updateMedicalStatus($data) {
        $this->db->query('INSERT INTO medical_status (user_id, medical_condition, medication, notes, date) VALUES (:user_id, :medical_condition, :medication, :notes, :date)
                          ON DUPLICATE KEY UPDATE medical_condition = :medical_condition, medication = :medication, notes = :notes, date = :date');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':medical_condition', $data['medical_condition']);
        $this->db->bind(':medication', $data['medication']);
        $this->db->bind(':notes', $data['notes']);
        $this->db->bind(':date', $data['date']);

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error updating medical status: ' . $e->getMessage());
            return false;
        }
    }

    public function getRegisteredSports($userId) {
        $this->db->query('SELECT s.sport_name 
                          FROM sports s
                          JOIN user_player up ON s.sport_id = up.sport_id
                          WHERE up.user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        
        try {
            $result = $this->db->resultSet();
            return $result ? $result : [];
        } catch (Exception $e) {
            error_log('Error fetching registered sports: ' . $e->getMessage());
            return [];
        }
    }

    public function addAchievement($data) {
        if ($data['user_id'] != $_SESSION['user_id']) {
            return false;
        }
        
        $player_id = $this->getPlayerIdByUserId($data['user_id']);
        if (!$player_id) {
            return false;
        }

        $this->db->query(
            'INSERT INTO achievements (player_id, place, level, description, date) 
             VALUES (:player_id, :place, :level, :description, :date)'
        );
    
        $this->db->bind(':player_id', $player_id);
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
    
        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error adding achievement: ' . $e->getMessage());
            return false;
        }
    }
    
    public function getAchievements() {
        if (!isset($_SESSION['user_id'])) {
            return [];
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if (!$player_id) {
            return [];
        }
        
        $this->db->query('SELECT * FROM achievements WHERE player_id = :player_id');
        $this->db->bind(':player_id', $player_id);
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error fetching achievements: ' . $e->getMessage());
            return [];
        }
    }

    public function getAchievementById($id) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
        
        $this->db->query('SELECT * FROM achievements WHERE achievement_id = :id');
        $this->db->bind(':id', $id);
        try {
            $achievement = $this->db->single();
        } catch (Exception $e) {
            error_log('Error fetching achievement by ID: ' . $e->getMessage());
            return false;
        }
        
        if (!$achievement) {
            return false;
        }
        
        $player_id = $this->getPlayerIdByUserId($_SESSION['user_id']);
        if ($achievement->player_id != $player_id) {
            return false;
        }
        
        return $achievement;
    }

    public function updateAchievement($data) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
        
        $achievement = $this->getAchievementById($data['id']);
        if (!$achievement) {
            return false;
        }
        
        $this->db->query('UPDATE achievements SET place = :place, level = :level, description = :description, date = :date WHERE achievement_id = :id');
        $this->db->bind(':place', $data['place']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':id', $data['id']);
        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error updating achievement: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteAchievement($id) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
        
        $achievement = $this->getAchievementById($id);
        if (!$achievement) {
            return false;
        }
        
        $this->db->query('DELETE FROM achievements WHERE achievement_id = :id');
        $this->db->bind(':id', $id);
        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error deleting achievement: ' . $e->getMessage());
            return false;
        }
    }


    public function getAchievementsByUser($userId) {
        if ($_SESSION['user_id'] != $userId && $_SESSION['user_role'] != 'admin') {
            return [];
        }
        
        $player_id = $this->getPlayerIdByUserId($userId);
        if (!$player_id) {
            return [];
        }
        
        $this->db->query('SELECT * FROM achievements WHERE player_id = :player_id');
        $this->db->bind(':player_id', $player_id);
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error fetching achievements by user: ' . $e->getMessage());
            return [];
        }
    }
    
    public function addFinancialApplication($data) {
        if ($data['user_id'] != $_SESSION['user_id']) {
            return false;
        }

        $this->db->query(
            'INSERT INTO financial_applications (user_id, student_name, guardian_name, annual_income, application_date, reason, notes, financial_report_path, application_status) 
             VALUES (:user_id, :student_name, :guardian_name, :annual_income, :application_date, :reason, :notes, :financial_report_path, :application_status)'
        );

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':student_name', $data['student_name']);
        $this->db->bind(':guardian_name', $data['guardian_name']);
        $this->db->bind(':annual_income', $data['annual_income']);
        $this->db->bind(':application_date', $data['application_date']);
        $this->db->bind(':reason', $data['reason']);
        $this->db->bind(':notes', $data['notes']);
        $this->db->bind(':financial_report_path', $data['financial_report_path']);
        $this->db->bind(':application_status', 'Pending');

        try {
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error adding financial application: ' . $e->getMessage());
            return false;
        }
    }

    public function getFinancialApplications() {
        if (!isset($_SESSION['user_id'])) {
            return [];
        }

        $this->db->query('SELECT * FROM financial_applications WHERE user_id = :user_id ORDER BY application_date DESC');
        $this->db->bind(':user_id', $_SESSION['user_id']);
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error fetching financial applications: ' . $e->getMessage());
            return [];
        }
    }

    public function getFinancialApplicationById($id) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        $this->db->query('SELECT * FROM financial_applications WHERE id = :id');
        $this->db->bind(':id', $id);
        try {
            $application = $this->db->single();
        } catch (Exception $e) {
            error_log('Error fetching financial application by ID: ' . $e->getMessage());
            return false;
        }

        if (!$application) {
            return false;
        }

        if ($application->user_id != $_SESSION['user_id']) {
            return false;
        }

        return $application;
    }

    public function getCoachByPlayerId($playerId) {
        // First get the player's sport and zone
        $this->db->query("SELECT sport_id, zone FROM user_player WHERE user_id = :playerId");
        $this->db->bind(':playerId', $playerId);
        $playerInfo = $this->db->single();
        
        if (!$playerInfo || !$playerInfo->sport_id || !$playerInfo->zone) {
            return false;
        }

        // Then get the coach assigned to that sport and zone
        $this->db->query("SELECT 
                            uc.*, 
                            u.firstname, u.lname, u.email, u.phonenumber, 
                            u.address, u.gender, u.dob, u.photo,
                            s.sport_name,
                            z.zoneName
                          FROM user_coach uc
                          JOIN users u ON uc.user_id = u.user_id
                          JOIN sports s ON uc.sport_id = s.sport_id
                          JOIN zone z ON uc.zone = z.zoneId
                          WHERE uc.sport_id = :sport_id 
                          AND uc.zone = :zone");
        $this->db->bind(':sport_id', $playerInfo->sport_id);
        $this->db->bind(':zone', $playerInfo->zone);
        
        try {
            $coach = $this->db->single();
            if ($coach) {
                // Convert comma-separated strings to arrays
                $coach->educational_qualifications = !empty($coach->educational_qualifications) ? 
                    array_map('trim', explode(',', $coach->educational_qualifications)) : [];
                $coach->professional_playing_experience = !empty($coach->professional_playing_experience) ? 
                    array_map('trim', explode(',', $coach->professional_playing_experience)) : [];
                $coach->coaching_experience = !empty($coach->coaching_experience) ? 
                    array_map('trim', explode(',', $coach->coaching_experience)) : [];
                $coach->key_achievements = !empty($coach->key_achievements) ? 
                    array_map('trim', explode(',', $coach->key_achievements)) : [];
            }
            return $coach;
        } catch (Exception $e) {
            error_log('Error fetching coach details: ' . $e->getMessage());
            return false;
        }
    }

    public function getSchoolByPlayerId($playerId) {
        $this->db->query("SELECT us.*, 
                            z.zoneName,
                            u.email, u.phonenumber, u.address
                          FROM user_school us
                          JOIN user_player up ON us.school_id = up.school_id
                          LEFT JOIN zone z ON us.zone = z.zoneId
                          LEFT JOIN users u ON us.user_id = u.user_id
                          WHERE up.user_id = :playerId
                          AND us.zone = up.zone");
        $this->db->bind(':playerId', $playerId);
        
        try {
            $school = $this->db->single();
            if ($school) {
                // Decode facilities if it exists and is a valid JSON string
                if (!empty($school->facilities)) {
                    $facilities = json_decode($school->facilities, true);
                    $school->facilities = (json_last_error() === JSON_ERROR_NONE && is_array($facilities)) ? $facilities : [];
                } else {
                    $school->facilities = [];
                }
            }
            return $school;
        } catch (Exception $e) {
            error_log('Error fetching school details: ' . $e->getMessage());
            return false;
        }
    }

    public function getCricketStats($userId) {
        // First get the player_id from user_player table
        $playerId = $this->getPlayerIdByUserId($userId);
        if (!$playerId) {
            return false;
        }
    
        $this->db->query('SELECT * FROM cricket_stats WHERE player_id = :player_id');
        $this->db->bind(':player_id', $playerId);
        
        try {
            return $this->db->single();
        } catch (Exception $e) {
            error_log('Error fetching cricket stats: ' . $e->getMessage());
            return false;
        }
    }
    
    public function getRecentPerformances($userId, $limit = 5) {
        // First get the player_id from user_player table
        $playerId = $this->getPlayerIdByUserId($userId);
        if (!$playerId) {
            return [];
        }
    
        // Fetch performances directly from player_match_performance and join with matches
        $this->db->query('
            SELECT 
                p.performance_id,
                p.match_id,
                p.player_id,
                p.runs_scored,
                p.balls_faced,
                p.fours,
                p.sixes,
                p.wickets_taken,
                p.overs_bowled,
                p.runs_conceded,
                p.catches,
                p.created_at AS match_date, -- Use created_at as a fallback date
                m.opponent_team,
                m.venue,
                m.result
            FROM player_match_performance p
            LEFT JOIN matches m ON p.match_id = m.match_id
            WHERE p.player_id = :player_id
            ORDER BY p.created_at DESC
            LIMIT :limit
        ');
    
        $this->db->bind(':player_id', $playerId);
        $this->db->bind(':limit', $limit);
    
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error fetching recent performances: ' . $e->getMessage());
            return [];
        }
    }

    public function getPlayerIdByUserId($user_id) {
        $this->db->query('SELECT player_id FROM user_player WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        try {
            $this->db->execute();
            $result = $this->db->single();
            return $result ? $result->player_id : null;
        } catch (Exception $e) {
            error_log('Error fetching player ID: ' . $e->getMessage());
            return null;
        }
    }



    public function getScheduledEvents($userId) {
        // First get the coach ID for this user
            $this->db->query('SELECT coach_id FROM user_coach 
            JOIN user_player on user_coach.sport_id = user_player.sport_id 
            AND user_coach.zone = user_player.zone
            WHERE user_player.user_id = :user_id');
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

    public function getPlayerByUserId($userId) {
        $this->db->query('SELECT player_id FROM user_player WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }

    public function getEventsForDropdown($userId) {
        // First get the coach's zone from user_coach table
        $this->db->query('SELECT coach_id FROM user_coach 
        JOIN user_player on user_coach.sport_id = user_player.sport_id 
        AND user_coach.zone = user_player.zone
        WHERE user_player.user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        $coachData = $this->db->single();
    
    if (!$coachData || !isset($coachData->coach_id)) {
        return []; // Return empty array if coach not found
    }
        
        
        // Get schools in the same zone
        $this->db->query('
            SELECT event_id, event_name 
            FROM scheduled_events 
            WHERE coach_id = :coach_id
            ORDER BY event_name
        ');
        $this->db->bind(':coach_id',  $coachData->coach_id);
        return $this->db->resultSet();
    }

    public function requestSheduleChange($data){
            $this->db->query('
                INSERT INTO schedule_change_requests 
                (player_id, coach_id, event_id, reason)
                VALUES 
                (:player_id, :coach_id, :event_id, :reschedule_reason)
            ');
            
            $this->db->bind(':player_id', $data['player_id']);
            $this->db->bind(':coach_id', $data['coach_id']);
            $this->db->bind(':event_id', $data['event_id']);
            $this->db->bind(':reschedule_reason', $data['reschedule_reason']);
            
            return $this->db->execute();
        }

        public function getCoach($userId) {
            // First get the coach ID for this user
                $this->db->query('SELECT coach_id FROM user_coach 
                JOIN user_player on user_coach.sport_id = user_player.sport_id 
                AND user_coach.zone = user_player.zone
                WHERE user_player.user_id = :user_id');
                $this->db->bind(':user_id', $userId);
            
                $this->db->bind(':user_id', $userId);
                return $this->db->single();
        }
    
    }
