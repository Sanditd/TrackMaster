<?php

class Coach extends Controller {
    private $coachModel;

    public function __construct() {
        $this->coachModel = $this->model('CoachModel');
    }

    // Default method if none is specified
    public function index() {
        $this->Dashboard();
    }

    public function Dashboard() {
        $data = [];
        $this->view('Coach/Dashboard');
    }

    public function viewProfile() {
        $data = [];
        $this->view('Coach/ViewProfile');
    }

    public function eventManagement() {
        $data = [];
        $this->view('Coach/EventManagement');
    }

    public function performanceTracking() {
        $data = [];
        $this->view('Coach/PerformanceTracking');
    }

    public function editProfile() {
        $data = [];
        $this->view('Coach/EditProfile');
    }

    public function playerPerformance() {
        $data = [];
        $this->view('Coach/PlayerPerformance');
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
                $teamName = $_POST['teamName'] ?? '';
                $numPlayers = $_POST['numPlayers'] ?? 0;
        
                if (empty($teamName) || $numPlayers <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
                    return;
                }
        
                // Create team
                $teamId = $this->coachModel->createTeam($teamName, $numPlayers);
        
                if ($teamId) {
                    echo json_encode(['status' => 'success', 'teamId' => $teamId]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to create team']);
                }
        }

        public function filterPlayers() {
            $role = $_POST['role'] ?? null;
            $gender = $_POST['gender'] ?? null;
    
            // Call the model's filterPlayers method
            $players = $this->coachModel->filterPlayers($role, $gender);
    
            // Return the filtered players as a JSON response
            echo json_encode(['players' => $players]);
        }
        
        public function comparePlayers() {
            $playerIds = $_POST['playerIds'] ?? '';
            $playerIdsArray = explode(',', $playerIds);
        
            if (empty($playerIdsArray) || count($playerIdsArray) < 2) {
                echo json_encode(['status' => 'error', 'message' => 'At least two players must be selected for comparison.']);
                return;
            }
        
            // Fetch player stats from the model
            $stats = $this->coachModel->getPlayerStatsByIds($playerIdsArray);
        
            echo json_encode(['status' => 'success', 'stats' => $stats]);
        }
        
     
        
    }