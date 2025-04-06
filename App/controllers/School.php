<?php

class School extends Controller{

    public function __construct() {
        $this->schoolModel = $this->model('SchoolModel');

    }

    public function fetchPlayers() {
        if ($_SESSION['role'] === 'school') {
            $school_id = $this->schoolModel->getSchoolId($_SESSION['user_id'])->school_id;
            return $this->schoolModel->getPlayersForSchool($school_id);
        }
    }

    public function Dashboard(){
        $data = [];

        $this->view('School/school');
    }

    public function EditProfile(){
        $data = [];

        $this->view('School/editSchool');
    }

    public function Profile(){
        $data = [];

        $this->view('School/schoolProfile');
    }
    public function StudentsData(){
        $data = [];
        $this->view('School/schoolStudentData');
}
    public function viewrecords(){
        $players = [];
        if ($_SESSION['role'] === 'school') {
            $players = $this->fetchPlayers();
        
        $data = ['players' => $players];
        $this->view('School/records', $data);
    
    }
}

    public function requests(){
        $data = [];
        $this->view('School/event');
    }

public function viewStudent(){
    $data = [];
    $this->view('School/viewStudent');

}

public function submitRecord(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        $firstname = trim($_POST['firstname']);
        $user = $this->schoolModel->getUserIdByFirstname($firstname);

        if (!$user) {

            echo "User not found for firstname: " . $firstname;

            exit;

        }
        $user_id = $user->user_id; // Get the user_id from the result

        $player = $this->schoolModel->getPlayerId($user_id);
        if (!$player) {
            echo "Player ID not found for user_id: " . $user_id;
            exit;
        }
        $player_id = $player->player_id;

        $data = [
            'player_id' => $player_id,
            'grade' => trim($_POST['grade']),
            'term' => trim($_POST['term']),
            'average' => trim($_POST['average']),
            'rank' => trim($_POST['rank']),
            'notes' => trim($_POST['notes']),
            'players' => $this->fetchPlayers()
        ];
        
        if (empty($data['player_id']) || empty($data['grade']) || empty($data['term']) || empty($data['average']) || empty($data['rank'])) {
            $data['error'] = 'Please fill in all required fields.';
            $this->view('School/records', $data);
        } else {
            if ($this->schoolModel->insertRecord($data)) {
                header('Location: ' . ROOT . '/school/records');
            } else {
                $data['error'] = 'Something went wrong. Please try again.';
                $this->view('School/records', $data);
            }
        }
    } else {
        header('Location: ' . ROOT . '/school/records');
    }
}


public function records() {
    $players = [];
    $records = [];

    if ($_SESSION['role'] === 'school') {
        $user_id = $_SESSION['user_id'];
        $school_id = $this->schoolModel->getSchoolId($user_id)->school_id;

        // Fetch players and records
        $players = $this->fetchPlayers(); 
        $records = $this->schoolModel->getAcademicRecordsByPlayerId($school_id);
    }

    // Load the view with fetched data
    $data = [
        'players' => $players,
        'records' => $records
    ];

    $this->view('school/records', $data);
}

public function editRecord($player_id) {
    $record = $this->schoolModel->getRecordByPlayerId($player_id);

    
        $data = [
            'player_id' => $player_id,
            'firstname' => $record->firstname,
            'grade' => $record->grade,
            'term' => $record->term,
            'average' => $record->average,
            'rank' => $record->rank,
            'notes' => $record->notes
        ];
        
        $this->view('School/editRecord', $data);
    } 


    

public function saveEditedRecord() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Prepare data
        $data = [
            'player_id' => trim($_POST['player_id']),
            'grade' => trim($_POST['grade']),
            'term' => trim($_POST['term']),
            'average' => trim($_POST['average']),
            'rank' => trim($_POST['rank']),
            'notes' => trim($_POST['notes'])
        ];

        // Validate data
        if (empty($data['grade']) || empty($data['term']) || empty($data['average']) || empty($data['rank'])) {
            // Handle error
            $data['error'] = 'Please fill in all required fields.';
            $this->view('School/editRecord', $data);
        } else {
            // Update record
            if ($this->schoolModel->updateRecord($data)) {
                header('Location: ' . URLROOT . '/School/records');
            } else {
                // Handle error
                $data['error'] = 'Something went wrong. Please try again.';
                $this->view('School/editRecord', $data);
            }
        }
    } else {
        // If not a POST request, redirect to records page
        header('Location: ' . URLROOT . '/School/records');
    }
}

public function deleteRecord($player_id) {
    
    if ($this->schoolModel->deleteRecordByPlayerId($player_id)) {
        header('Location: ' . URLROOT . '/School/records');
    } else {
        die('Something went wrong');
    }
}



}
?>