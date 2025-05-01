<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Coach extends Controller {
    private $activityModel;
    private $notificationModel;
    private $coachModel;

    public function __construct() {
        $this->coachModel = $this->model('CoachModel');
        $this->activityModel =$this->model('activityModel');
        $this->notificationModel =$this->model('Notification');    }

    
    public function index() {
        $this->Dashboard();
    }

    public function Dashboard() {
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        }
        // Get coach ID
        $coach = $this->coachModel->getCoachDetailsByUserId($_SESSION['user_id']);
        
        if (!$coach) {
            flash('dashboard_error', 'Coach record not found');
            $this->view('Coach/Dashboard');
            return;
        }
    
      
        $teamStatus = $this->coachModel->getTeamStatusCounts($coach->coach_id);
        
        
        $upcomingEvents = $this->coachModel->getUpcomingEvents($coach->coach_id);
        
       
        $sessionStats = $this->coachModel->getSessionStats($coach->coach_id);
        
        
        $medicalAlerts = $this->coachModel->getRecentMedicalAlerts($coach->coach_id);
        
      
        $scheduleRequests = $this->coachModel->getPendingScheduleRequests($coach->coach_id);
        
        $data = [
            'teamStatus' => $teamStatus,
            'upcomingEvents' => $upcomingEvents,
            'sessionStats' => $sessionStats,
            'medicalAlerts' => $medicalAlerts,
            'scheduleRequests' => $scheduleRequests,
            'currentMonth' => date('F Y')
        ];
        
        $this->view('Coach/Dashboard', $data);
    }

    public function attendance() 
{
   
    $coach = $this->coachModel->getCoachDetailsByUserId($_SESSION['user_id']);
    
    if (!$coach) {

    }

   
    $teams = $this->coachModel->getTeamsBySportAndZone($coach->sport_id, $coach->zone);

    $data = [
        'teams' => $teams
    ];

    $this->view('coach/attendance', $data);
}

    public function profilemanagement() {
        $data = [];
        $this->view('Coach/ProfileManagement');
    }

    public function viewProfile() {
       
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        }
    
        try {
          
            $coach = $this->coachModel->getCoachDetails($_SESSION['user_id']);
            
            $data = [
                'coach' => $coach
            ];
            
            $this->view('Coach/ViewProfile', $data);
        } catch (Exception $e) {
            flash('profile_error', $e->getMessage());
            $this->view('Coach/ViewProfile');
        }
    }


    public function performanceTracking() {
   
        $sportId = $this->coachModel->getCoachSportId($_SESSION['user_id']);
        
        if ($sportId === 36) { 
            $this->view('Coach/PerformanceTracking');
        } else { 
            $this->view('Coach/A_PerformanceTracking');
        }
    }
    


    public function editProfile() {
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        }
    
        $coach = $this->coachModel->getCoachDetais($_SESSION['user_id']);
    
        $data = [
            'coach' => $coach
        ];
    
        $this->view('Coach/EditProfile', $data);
    }
    
    public function updateProfile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars(trim($value));
            }
    
            $data = [
                'user_id' => $_SESSION['user_id'],
                'firstname' => $_POST['first_name'] ?? '',
                'lname' => $_POST['last_name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phonenumber' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['birthday'] ?? '',
                'bio' => $_POST['description'] ?? '',
                'educational_qualifications' => $_POST['educational_qualifications'] ?? '',
                'professional_playing_experience' => $_POST['playing_experience'] ?? '',
                'coaching_experience' => $_POST['coaching_experience'] ?? '',
                'key_achievements' => $_POST['key_achievements'] ?? '',
                'photo' => null,
                'firstname_err' => '',
                'email_err' => ''
            ];
    
            if (empty($data['firstname'])) {
                $data['firstname_err'] = 'Please enter first name';
            }
    
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter a valid email';
            }
    
            
            if (!empty($_FILES['profile_image']['name'])) {
              
                $file_info = getimagesize($_FILES['profile_image']['tmp_name']);
                if ($file_info !== false) {
                  
                    $photo = file_get_contents($_FILES['profile_image']['tmp_name']);
                    $data['photo'] = $photo;
                } else {
                  
                    $_SESSION['profile_error'] = 'Please upload a valid image file';
                    header('Location: ' . URLROOT . '/coach/editProfile');
                    exit();
                }
            }
    
        
            if (empty($data['firstname_err']) && empty($data['email_err'])) {
           
                if ($this->coachModel->updateCoachProfile($data)) {
                    $_SESSION['profile_message'] = 'Profile updated successfully';
                    header('Location: ' . URLROOT . '/coach/viewProfile');
                    exit();
                } else {
                    die('Something went wrong');
                }
            } else {
             
                $this->view('Coach/EditProfile', $data);
            }
        } else {
            header('Location: ' . URLROOT . '/coach/editProfile');
            exit();
        }
    }

    public function creataddplayers(){
        $data = [];

        $this->view('Coach/CreateTeam');

    }


    public function teamManagement() {
        $teams = $this->coachModel->getTeams();
        $data = ['teams' => $teams];

        if (!empty($teams)) {
            foreach ($teams as $team) {
                $team->players = $this->coachModel->getPlayersByTeamId($team->team_id);
            }
        }

        $this->view('Coach/TeamManagement', $data);
    }
        
        
    public function createTeam() {
      
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }
    
        $teamName = $_POST['teamName'] ?? '';
        $numPlayers = $_POST['numPlayers'] ?? 0;
        
      
        if (empty($teamName) || $numPlayers <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            return;
        }
    
        try {
            $teamId = $this->coachModel->createTeam($teamName, $numPlayers, $_SESSION['user_id']);
            
            if ($teamId) {
                echo json_encode([
                    'status' => 'success', 
                    'teamId' => $teamId,
                    'message' => 'Team created successfully'
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create team']);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function filterPlayers() {
        $role = $_POST['role'] ?? null;
        $gender = $_POST['gender'] ?? null;
        
        try {
            if (!$role || !$gender) {
                throw new Exception('Both role and gender filters are required');
            }
            
            error_log('CoachZone: ' . ($coachZone ?? 'NULL'));

            $coach = $this->coachModel->getCoachDetailsByUserId($_SESSION['user_id']);
            if (!$coach) {
                throw new Exception('Coach details not found.');
            }
            $coachZone = $coach->zone ?? null;
            error_log('CoachZone: ' . ($coachZone ?? 'NULL'));
            
            $players = $this->coachModel->filterPlayers($role, $gender, $coachZone);
            
            if (empty($players)) {
                echo json_encode(['players' => []]);
                return;
            }
            
            echo json_encode(['players' => $players]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

        error_log('Role: ' . ($role ?? 'NULL') . ', Gender: ' . ($gender ?? 'NULL'));

        error_log('Players fetched: ' . count($players));
if (!empty($players)) {
    foreach ($players as $p) {
        error_log('Player: ' . json_encode($p));
    }
}
    }
    
        
        public function getPlayerStats() {
            $playerIds = $_POST['playerIds'] ?? '';
            if (empty($playerIds)) {
                echo json_encode(['status' => 'error', 'message' => 'No players selected']);
                return;
            }
        
            $players = $this->coachModel->getPlayerStats($playerIds);
            if ($players) {
                echo json_encode(['status' => 'success', 'players' => $players]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No stats found for selected players']);
            }
        }
        
        public function addPlayerToTeam() {
            $teamId = $_POST['teamId'] ?? null;
            $playerId = $_POST['playerId'] ?? null;
        
            if ($teamId && $playerId) {
                $result = $this->coachModel->addPlayerToTeam($teamId, $playerId);
                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Player added to the team successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to add player to the team.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid team or player data.']);
            }
        }
            

        public function deleteTeam() {
            $teamId = $_POST['teamId'] ?? null;
        
            if (!$teamId) {
                echo 'Error: Team ID is required.';
                return;
            }
        
            $result = $this->coachModel->deleteTeam($teamId);
        
            if ($result) {
                header('Location: ' . ROOT . '/Coach/teamManagement');
                exit;
            } else {
                echo 'Error: Failed to delete the team.';
            }
        }

        public function editTeam($teamId) {
            $team = $this->coachModel->getTeamById($teamId);
        
            if (!$team) {
                die('Team not found');
            }
        
            $players = $this->coachModel->getPlayerssByTeamId($teamId);
            $extraPlayers = [];
            if (count($players) > $team->number_of_players) {
                $extraPlayers = array_slice($players, $team->number_of_players);
            }
        
            $data = [
                'team' => $team,
                'extraPlayers' => $extraPlayers,
                'message' => ''
            ];
        
            $this->view('Coach/EditTeam', $data);
        }
        
        public function updateTeam() {
            $teamId = $_POST['teamId'];
            $teamName = $_POST['teamName'];
            $numberOfPlayers = $_POST['numberOfPlayers'];
        
            $team = $this->coachModel->getTeamById($teamId);
            if (!$team) {
                die('Team not found');
            }
        
            $this->coachModel->updateTeam($teamId, $teamName, $numberOfPlayers);
        
            $players = $this->coachModel->getPlayerssByTeamId($teamId);
            if (count($players) > $numberOfPlayers) {
                $extraPlayers = array_slice($players, $numberOfPlayers);
                $data = [
                    'team' => $team,
                    'extraPlayers' => $extraPlayers,
                    'message' => 'Please remove extra players to match the new limit.'
                ];
                $this->view('Coach/EditTeam', $data);
            } else {
                header('Location: ' . ROOT . '/Coach/teamManagement');
            }
        }
        
        public function removePlayer() {
            $teamId = $_POST['teamId'];
            $playerId = $_POST['playerId'];
        
            $this->coachModel->removePlayerFromTeam($teamId, $playerId);
            header('Location: ' . ROOT . '/Coach/editTeam/' . $teamId);
        }


        public function match() {
            if (!isset($_SESSION['user_id'])) {
                die('User not logged in - Session user_id not found');
            }
            
            $teams = $this->coachModel->getTeamsByZoneAndSport($_SESSION['user_id']);
            $data = ['teams' => $teams];
            
            $this->view('Coach/match', $data);
        }

        public function teamPlayers($teamId) {
            try {
                $players = $this->coachModel->getPlayersFromTeamId($teamId);
                header('Content-Type: application/json');
                echo json_encode($players);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to fetch players']);
            }
            exit();
        }

        public function saveMatch() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('coach/match');
    }

    $data = [
        'team_id' => trim($_POST['myteam']),
        'opponent_team' => trim($_POST['opponent']),
        'match_date' => trim($_POST['match_date']),
        'venue' => trim($_POST['venue']),
        'result' => trim($_POST['result']),
        'team_runs_scored' => isset($_POST['total_runs']) ? (int)$_POST['total_runs'] : null,
        'team_wickets_lost' => isset($_POST['wickets_lost']) ? (int)$_POST['wickets_lost'] : null,
        'team_overs_played' => isset($_POST['overs_played']) ? (float)$_POST['overs_played'] : null,
        'team_runs_conceded' => isset($_POST['runs_given']) ? (int)$_POST['runs_given'] : null,
        'team_wickets_taken' => isset($_POST['wickets_taken']) ? (int)$_POST['wickets_taken'] : null,
        'team_overs_bowled' => isset($_POST['overs_bowled']) ? (float)$_POST['overs_bowled'] : null,
        'team_catches_taken' => isset($_POST['catches_taken']) ? (int)$_POST['catches_taken'] : null,
        'player_performances' => isset($_POST['players']) ? $_POST['players'] : []
    ];

    if (empty($data['team_id']) || empty($data['opponent_team']) || empty($data['match_date']) || empty($data['result'])) {
        flash('match_error', 'Please fill in all required fields');
        redirect('coach/match');
    }

    $matchId = $this->coachModel->saveMatchData($data);

    if ($matchId && !empty($data['player_performances'])) {
        foreach ($data['player_performances'] as $performance) {
            $this->coachModel->savePlayerPerformance($matchId, $performance);
            $this->coachModel->updateCricketStats($performance);
        }
    }

    $_SESSION['match_success'] = 'Match record saved successfully';
    header('Location: ' . URLROOT . '/coach/match');
    exit();
}

public function getPlayersForCoach() {
   
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        return;
    }

    try {
       
        $players = $this->coachModel->getPlayersByCoachZone($_SESSION['user_id']);
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'players' => $players
        ]);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}

public function playerPerformance($playerId = null) {
    if (!$playerId) {
        redirect('coach/performanceTracking');
    }

    try {
        $player = $this->coachModel->getPlayerDetails($playerId);
        
        $stats = $this->coachModel->getPlayerStatsById($playerId);
        
        $performances = $this->coachModel->getPlayerRecentPerformances($playerId);

        $achievements = $this->coachModel->getPlayerAchievements($playerId);
        
        $data = [
            'player' => $player,
            'stats' => $stats,
            'performances' => $performances,
            'achievements' => $achievements
        ];
        
        $this->view('Coach/PlayerPerformance', $data);
    } catch (Exception $e) {
        flash('player_error', $e->getMessage());
        redirect('coach/performanceTracking');
    }
}


public function getTeamsForCoach() {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        return;
    }

    try {
        $teams = $this->coachModel->getTeamsByCoach($_SESSION['user_id']);
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'teams' => $teams
        ]);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}

public function teamperformance($teamId = null) {
    if (!$teamId) {
        redirect('coach/performanceTracking');
    }

    try {
        $team = $this->coachModel->getTeamDetails($teamId);
        
        $stats = $this->coachModel->getTeamStats($teamId);
        
        $recentMatches = $this->coachModel->getTeamRecentMatches($teamId, 5);
        
       
        $allMatches = $this->coachModel->getTeamMatches($teamId);
        
       
        $recentForm = $this->coachModel->getTeamRecentForm($teamId, 5);
        
        $data = [
            'team' => $team,
            'stats' => $stats,
            'recentMatches' => $recentMatches,
            'allMatches' => $allMatches,
            'recentForm' => $recentForm
        ];
        
        $this->view('Coach/TeamPerformance', $data);
    } catch (Exception $e) {
        flash('team_error', $e->getMessage());
        redirect('coach/performanceTracking');
    }
}

public function eventManagement() {
    if (!isset($_SESSION['user_id'])) {
        redirect('users/login');
    }

    
    $eventRequests = $this->coachModel->getEventRequests($_SESSION['user_id']);
    $scheduledEvents = $this->coachModel->getScheduledEvents($_SESSION['user_id']);
    $schools = $this->coachModel->getSchoolsForDropdown($_SESSION['user_id']);

    $data = [
        'eventRequests' => $eventRequests,
        'scheduledEvents' => $scheduledEvents,
        'schools' => $schools
    ];

    $this->view('Coach/EventManagement', $data);
}

public function createEventRequest() {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $coachData = $this->coachModel->getCoachByUserId($_SESSION['user_id']);

        if (!$coachData || !isset($coachData->coach_id)) {
            flash('event_error', 'Invalid coach account');
            redirect('coach/eventManagement');
        }

      
        $_POST = filter_input_array(INPUT_POST, [
            'school_id' => FILTER_SANITIZE_SPECIAL_CHARS,
            'event_name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'no_players' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'event_date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'time_from' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'time_to' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'facilities_required' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        ]);

        $data = [
            'coach_id' => $coachData->coach_id,
            'school_id' => trim($_POST['school_id']),
            'event_name' => trim($_POST['event_name']),
            'no_players' => trim($_POST['no_players']),
            'event_date' => trim($_POST['event_date']),
            'time_from' => trim($_POST['time_from']),
            'time_to' => trim($_POST['time_to']),
            'facilities_required' => trim($_POST['facilities_required']),
            'event_name_err' => '',
            'event_date_err' => '',
            'time_from_err' => '',
            'time_to_err' => '',
            'no_players_err' => ''
        ];

       
        if (empty($data['event_name'])) {
            $data['event_name_err'] = 'Please enter event name';
        }




        if (empty($data['event_date'])) {
            $data['event_date_err'] = 'Please select date';
        } elseif (strtotime($data['event_date']) < strtotime('today')) {
            $data['event_date_err'] = 'Date cannot be in the past';
        }
        if (empty($data['time_from'])) {
            $data['time_from_err'] = 'Please select start time';
        }
        if (empty($data['time_to'])) {
            $data['time_to_err'] = 'Please select end time';
        } elseif (strtotime($data['time_to']) <= strtotime($data['time_from'])) {
            $data['time_to_err'] = 'End time must be after start time';
        }

    
        if (empty($data['event_name_err']) && empty($data['event_date_err']) && 
            empty($data['time_from_err']) && empty($data['time_to_err'])) {
            
            if ($this->coachModel->createEventRequest($data)) {

                $notification = [
                    'title' => "New Facility Request",
                    'description' => "New Facilty request from a Coach",
                    'type' => "Facility Request",
                    'toWhom' => $data['school_id']
                ];

                $this->notificationModel->createUserNotification($notification);

                $activity = [
                    'act_desc' => "request Facility From ".$data['school_id'],
                    'user_id' => $_SESSION['user_id']
                ];
                $this->activityModel->insertUserActivity($activity);

                flash('event_message', 'Event request submitted successfully');
                redirect('coach/eventManagement');
            } else {
                die('Something went wrong');
            }
        } else {
         
            $this->view('Coach/EventManagement', $data);
        }
    } else {
        redirect('coach/eventManagement');
    }
}


public function deleteEventRequest($requestId) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($this->coachModel->deleteEventRequest($requestId)) {
            flash('event_message', 'Event request deleted successfully');
            redirect('coach/eventManagement');
        } else {
            die('Something went wrong');
        }
    } else {
        redirect('coach/eventManagement');
    }
}

public function createScheduledEvent($requestId) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request = $this->coachModel->getEventRequestById($requestId);
        
        if ($request && $request->status == 'approved') {
            $data = [
                'request_id' => $requestId,
                'event_name' => $request->event_name,
                'event_date' => $request->event_date,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
                'school_id' => $request->school_id,
                'facilities_used' => $request->facilities_required,
                'coach_id' => $request->coach_id
            ];
            
            if ($this->coachModel->createScheduledEvent($data)) {
                flash('event_message', 'Event scheduled successfully');
                redirect('coach/eventManagement');
            } else {
                die('Something went wrong');
            }
        } else {
            flash('event_error', 'Cannot schedule this event');
            redirect('coach/eventManagement');
        }
    } else {
        redirect('coach/eventManagement');
    }
}

public function deleteScheduledEvent($eventId) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($this->coachModel->deleteScheduledEvent($eventId)) {
            flash('event_message', 'Event deleted successfully');
            redirect('coach/eventManagement');
        } else {
            die('Something went wrong');
        }
    } else {
        redirect('coach/eventManagement');
    }
}



public function loadPlayers() {
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    header('Content-Type: application/json');

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Invalid request method');
        }

        if (!isset($_SESSION['user_id'])) {
            throw new Exception('User not logged in');
        }

        $teamId = isset($_POST['team_id']) ? $_POST['team_id'] : null;
        
    
        error_log("Loading players for team ID: " . $teamId . " for user ID: " . $_SESSION['user_id']);

        $players = $this->coachModel->getPlayersForAttendance($_SESSION['user_id'], $teamId);

        if (empty($players)) {
            error_log("No players found for team/user");
            echo json_encode([
                'status' => 'success',
                'players' => [],
                'message' => 'No players found'
            ]);
            return;
        }

        error_log('✅ Players loaded successfully: ' . count($players) . ' players found');
        
        echo json_encode([
            'status' => 'success',
            'players' => $players
        ]);
    } catch (Exception $e) {
        error_log('❌ Load Players Error: ' . $e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString() 
        ]);
    }
}


public function saveAttendance() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        return;
    }

    try {
        $coach = $this->coachModel->getCoachByUserId($_SESSION['user_id']);
    
        if (!$coach || !isset($coach->coach_id)) {
            throw new Exception('Coach ID not found for this user.');
        }
    
        $coach_id = $coach->coach_id;
        
        $sessionData = [
           'coach_id' => $coach_id,
          'team_id' => !empty($_POST['team_id']) ? $_POST['team_id'] : null,
           'session_type' => $_POST['session_type'],
           'session_date' => $_POST['session_date'],
           'start_time' => $_POST['start_time'],
           'end_time' => $_POST['end_time'],
           'location' => $_POST['location']
       ];

       $sessionId = $this->coachModel->createAttendanceSession($sessionData);
       
       if (!$sessionId) {
           throw new Exception('Failed to create attendance session');
       }

       
       $attendanceData = json_decode($_POST['attendance_data'], true);
       $successCount = 0;
       
       foreach ($attendanceData as $player) {
           $status = $player['status'];
           $notes = isset($player['notes']) ? $player['notes'] : null;
           $arrivalTime = ($status === 'late') ? date('H:i:s') : null;
           
           $result = $this->coachModel->recordPlayerAttendance(
               $sessionId,
               $player['player_id'],
               $status,
               $arrivalTime,
               $notes
           );
           
           if ($result) {
               $successCount++;
           }
       }

    
       header('Content-Type: application/json');
       echo json_encode([
           'status' => 'success',
           'message' => "Attendance recorded for $successCount players",
           'session_id' => $sessionId
       ]);
   } catch (Exception $e) {
       header('Content-Type: application/json');
       echo json_encode([
           'status' => 'error',
           'message' => $e->getMessage()
       ]);
   }
}

public function searchPlayerAttendance() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        return;
    }

    try {
        $searchTerm = trim($_POST['search_term']);
        
        if (empty($searchTerm)) {
            throw new Exception('Please enter a search term');
        }

        $result = $this->coachModel->searchPlayerAttendance($searchTerm, $_SESSION['user_id']);
        
        if (!$result) {
            echo json_encode([
                'status' => 'not_found',
                'message' => 'No player found matching your search'
            ]);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'data' => $result
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}

public function getAchievement($achievementId) {
    try {
        $achievement = $this->coachModel->getAchievementById($achievementId);
        
        if (!$achievement) {
            throw new Exception('Achievement not found');
        }
        
        echo json_encode([
            'success' => true,
            'achievement' => $achievement
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}

public function saveAchievement() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [
            'achievement_id' => trim($_POST['achievement_id']),
            'player_id' => trim($_POST['player_id']),
            'place' => trim($_POST['place']),
            'level' => trim($_POST['level']),
            'date' => trim($_POST['date']),
            'description' => trim($_POST['description']),
            'place_err' => '',
            'level_err' => '',
            'date_err' => ''
        ];
        
        
        if (empty($data['place'])) {
            $data['place_err'] = 'Please enter the achievement';
        }
        if (empty($data['level'])) {
            $data['level_err'] = 'Please select the level';
        }
        if (empty($data['date'])) {
            $data['date_err'] = 'Please select the date';
        }
        
       
        if (empty($data['place_err']) && empty($data['level_err']) && empty($data['date_err'])) {
            if (empty($data['achievement_id'])) {
            
                if ($this->coachModel->addAchievement($data)) {
                    flash('achievement_message', 'Achievement added successfully');
                    redirect('coach/playerPerformance/' . $data['player_id']);
                } else {
                    die('Something went wrong');
                }
            } else {
               
                if ($this->coachModel->updateAchievement($data)) {
                    flash('achievement_message', 'Achievement updated successfully');
                    redirect('coach/playerPerformance/' . $data['player_id']);
                } else {
                    die('Something went wrong');
                }
            }
        } else {
        
            $this->view('Coach/PlayerPerformance', $data);
        }
    } else {
        redirect('coach/performanceTracking');
    }
}

public function deleteAchievement($achievementId) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $achievement = $this->coachModel->getAchievementById($achievementId);
            
            if (!$achievement) {
                throw new Exception('Achievement not found');
            }
            
            if ($this->coachModel->deleteAchievement($achievementId)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Achievement deleted successfully'
                ]);
            } else {
                throw new Exception('Failed to delete achievement');
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    } else {
        redirect('coach/performanceTracking');
    }
}

public function aboutUs() {
    $data = [];
    $this->view('coach/aboutUs');
}

public function help() {
    $data = [];
    $this->view('coach/help');
}


}


              
