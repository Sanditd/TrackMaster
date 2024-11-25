<?php

class Student extends Controller{
    private $studentModel;

    public function __construct() {
        $this->studentModel = $this->model('StudentModel');
    }


    public function dashboard(){
        $data = [];

        $this->view('Student/dashboard');

    }

    public function editStudentProfile(){
        $data = [];

        $this->view('Student/editStudentProfile');

    }

    public function editAchievement(){
        $data = [];

        $this->view('Student/editAchievement');

    }

    public function financialStatus(){
        $data = [];

        $this->view('Student/financialStatus');

    }

    public function medicalStatus(){
        $data = [];

        $this->view('Student/medicalStatus');

    }

    public function studentAchievements(){
        $data = [];

        $this->view('Student/studentAchievements');

    }

    public function studentprofile(){
        $data = [];

        $this->view('Student/studentprofile');

    }

    public function studentSchedule(){
        $data = [];

        $this->view('Student/studentSchedule');

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
        
    


