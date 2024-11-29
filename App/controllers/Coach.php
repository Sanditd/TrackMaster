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

    public function filterPlayers() {
        $role = $_POST['role'] ?? '';
        $players = $this->coachModel->getFilteredPlayers($role);
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
