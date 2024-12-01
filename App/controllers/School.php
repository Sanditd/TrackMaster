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
        }
        $data = ['players' => $players];
        $this->view('School/records', $data);
    
    }

    public function requests(){
        $data = [];
        $this->view('School/event');
    }

public function editRecord(){
    $data = [];
    $this->view('School/editRecord');

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
        $players = $this->fetchPlayers();
        $user_id = $_SESSION['user_id'];

        

        $school_id = $this->schoolModel->getSchoolId($_SESSION['user_id'])->school_id;

       

        $records = $this->schoolModel->getAcademicRecordsByPlayerId($school_id);  

        
    }

    $data = ['players' => $players, 'records' => $records];
    $this->view('School/records', $data);
}
    public function updateRecord($id) {
        // Fetch the player's record using the ID
        $record = $this->model('RecordModel')->getRecordById($id);

        if ($record) {
            // Pass the record to the view
            $data = [
                'record' => $record
            ];
            $this->view('School/editRecord', $data);
        } else {
            // Redirect back if record is not found
            header('Location: ' . URLROOT . '/School/Records');
        }
}
public function saveEditedRecord() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'player_id' => $_POST['player_id'],
            'firstname' => $_POST['firstname'],
            'grade' => $_POST['grade'],
            'term' => $_POST['term'],
            'average' => $_POST['average'],
            'rank' => $_POST['rank'],
            'notes' => $_POST['notes']
        ];

        // Update the record in the database
        $updated = $this->model('RecordModel')->updateRecord($data);

        if ($updated) {
            // Redirect back to the records page
            header('Location: ' . URLROOT . '/School/Records');
        } else {
            die('Something went wrong while updating the record.');
        }
    }
}

public function deleteRecord($id) {
    // Delete the record by ID
    if ($this->model('RecordModel')->deleteRecordById($id)) {
        // Redirect back to the records page with a success message
        header('Location: ' . URLROOT . '/School/Records');
        exit;
    } else {
        // Handle failure (optional)
        die('Something went wrong while deleting the record.');
    }
}

}
?>