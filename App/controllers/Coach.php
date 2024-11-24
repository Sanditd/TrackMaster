<?php

class Coach extends Controller{
    private $coachModel;

    public function __construct() {
        $this->coachModel = $this->model('CoachModel');
    }


    public function Dashboard(){
        $data = [];

        $this->view('Coach/Dashboard');

    }

    public function viewprofile(){
        $data = [];

        $this->view('Coach/ViewProfile');

    }

    public function eventmanagement(){
        $data = [];

        $this->view('Coach/EventManagement');

    }

    public function performancetracking(){
        $data = [];

        $this->view('Coach/PerformanceTracking');

    }

    public function editprofile(){
        $data = [];

        $this->view('Coach/EditProfile');

    }

    public function playerperformance(){
        $data = [];

        $this->view('Coach/PlayerPerformance');

    }

    public function teammanagemen(){
        $data = [];

        $this->view('Coach/TeamManagement');

    }

    public function creataddplayers(){
        $data = [];

        $this->view('Coach/CreateTeam');

    }


    
     
    
        // To load the team management page
        public function teamManagement() {
            $teams = $this->coachModel->getTeams();
            $data = ['teams' => $teams];
        
            // If teams are found, fetch their players
            if (!empty($teams)) {
                foreach ($teams as $team) {
                    $team->players = $this->coachModel->getPlayersByTeamId($team->team_id);
                }
            }
        
            $this->view('Coach/TeamManagement', $data);
        }
        

        public function filterPlayers() {
            $role = $_POST['role'] ?? '';
            $gender = $_POST['gender'] ?? '';

            $players = $this->coachModel->getFilteredPlayers($role, $gender);

            echo json_encode($players);
            
            }

            public function comparePlayers() {
                $selectedPlayerNames = json_decode($_POST['selectedPlayers'], true);
            
                if (empty($selectedPlayerNames)) {
                    echo json_encode([]);
                    return;
                }
            
                $players = $this->coachModel->getPlayersByName($selectedPlayerNames);
                echo json_encode($players);
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
            
            public function addPlayerToTeam() {
                $teamId = $_POST['teamId'] ?? 0;
                $playerId = $_POST['playerId'] ?? 0;
                
                if ($teamId <= 0 || $playerId <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid team or player ID']);
                    return;
                }

                $result = $this->coachModel->addPlayerToTeam($teamId, $playerId);

                if ($result) {
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to add player to team']);
                }
            }
            
            
        }
        
    


