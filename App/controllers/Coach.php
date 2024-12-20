<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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

    public function profilemanagement() {
        $data = [];
        $this->view('Coach/ProfileManagement');
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
        
            // Call the model to delete the team
            $result = $this->coachModel->deleteTeam($teamId);
        
            if ($result) {
                header('Location: ' . ROOT . '/Coach/teamManagement');
                exit; // Redirect back to the team management page
            } else {
                echo 'Error: Failed to delete the team.';
            }
        }

        public function editTeam($teamId) {
            // Load team details
            $team = $this->coachModel->getTeamById($teamId);
        
            if (!$team) {
                die('Team not found');
            }
        
            // Check if there are extra players
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
        
            // Update the team
            $this->coachModel->updateTeam($teamId, $teamName, $numberOfPlayers);
        
            // Check if the number of players exceeds the updated limit
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
        
}       
