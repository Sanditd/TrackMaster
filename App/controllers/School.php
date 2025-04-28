<?php

class School extends Controller{
    private $schoolModel;
    private $userModel;
    private $zoneModel;
    private $sportModel;

    public function __construct() {
        $this->schoolModel = $this->model('SchoolModel');
        $this->userModel = $this->model('User');

        $this->zoneModel = $this->model('zoneModel');
        $this->sportModel = $this->model('sportModel');

    }

    public function fetchPlayers() {
        if ($_SESSION['role'] === 'school') {
            $school_id = $this->schoolModel->getSchoolId($_SESSION['user_id'])->school_id;
            return $this->schoolModel->getPlayersForSchool($school_id);
        }
    }
    public function index() {
        $this->view('School/school');
    }
    public function Dashboard() {
        $userId = (int) $_SESSION['user_id'];
    
        $school_id_obj = $this->schoolModel->getSchoolId($userId);
        $school_id = $school_id_obj->school_id;
    
        $players = $this->userModel->getPlayersName($school_id);
        $facilityReq= $this->schoolModel->getFacilityRequests($school_id);
        $extraClassReq= $this->schoolModel->getExtraClassRequests($_SESSION['user_id']);
    
        $data = [
            'players' => $players,
            'facilityReq' => $facilityReq,
            'extraClassReq' => $extraClassReq
        ];
    
        $this->view('School/school', $data);
    }
    
    public function EditProfile(){

        $user_id=$_SESSION['user_id'];
        $school_id_obj = $this->schoolModel->getSchoolId($user_id);
        $school_id = $school_id_obj->school_id;

        
        $userInfo=$this->userModel->getUserInfo($user_id);
        $schoolInfo=$this->userModel->getSchoolInfo($school_id);

        $zone_id=$schoolInfo[0]->zone;

        $zoneInfo = $this->zoneModel->getZoneInfo($zone_id);

        $data=[
            'userInfo' => $userInfo,
            'schoolInfo' => $schoolInfo,
            'zoneInfo' => $zoneInfo,
        ];
        $this->view('School/editSchool',$data);
    }

    public function Profile(){
        $user_id=$_SESSION['user_id'];
        $school_id_obj = $this->schoolModel->getSchoolId($user_id);
        $school_id = $school_id_obj->school_id;

        
        $userInfo=$this->userModel->getUserInfo($user_id);
        $schoolInfo=$this->userModel->getSchoolInfo($school_id);

        $zone_id=$schoolInfo[0]->zone;

        $zoneInfo = $this->zoneModel->getZoneInfo($zone_id);

        $data=[
            'userInfo' => $userInfo,
            'schoolInfo' => $schoolInfo,
            'zoneInfo' => $zoneInfo,
        ];
        $this->view('School/schoolProfile',$data);
    }

    public function StudentsData(){
        $userId = (int) $_SESSION['user_id'];
    
        $school_id_obj = $this->schoolModel->getSchoolId($userId);
        $school_id = $school_id_obj->school_id;
    
        $players = $this->userModel->getPlayersName($school_id);
        
        $records = $this->schoolModel->getAcademicRecordsByPlayerId($school_id);
        $sports = $this->sportModel->getSportsNameId();

        $data=[
            'players' => $players,
            'records' => $records,
            'sports' => $sports,
        ];
        
        $this->view('School/schoolStudentData',$data);
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
        $userId = (int) $_SESSION['user_id'];
    
        $school_id_obj = $this->schoolModel->getSchoolId($userId);
        $school_id = $school_id_obj->school_id;
    
        $facilityReq= $this->schoolModel->getFacilityRequests($school_id);
        $coaches=$this->userModel->getCoachesName();
    
        $data = [
            'facilityReq' => $facilityReq,
            'coaches' => $coaches,
        ];
        $this->view('School/event',$data);
    }

    public function viewStudent(){
        $data = [];
        $this->view('School/viewStudent');
    }

    public function submitRecord(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'school_id' => trim($_POST['school_id']),
                'player_id' => trim($_POST['player_id']),
                'grade' => trim($_POST['grade']),
                'term' => trim($_POST['term']),
                'average' => trim($_POST['average']),
                'rank' => trim($_POST['rank']),
                'additional_notes' => trim($_POST['additional_notes']),
                'players' => $this->fetchPlayers()
            ];
            
            if (empty($data['player_id']) || empty($data['grade']) || empty($data['term']) || empty($data['average']) || empty($data['rank'])) {
                $data['error'] = 'Please fill in all required fields.';
                
                $data['records'] = $this->schoolModel->getRecords();
                $data['playerNames'] = $this->userModel->getPlayerNames();
                
                $this->view('School/records', $data);
            } else {
                if ($this->schoolModel->insertRecord($data)) {
                    header('Location: ' . URLROOT . '/school/records');
                } else {
                    $data['error'] = 'Something went wrong. Please try again.';
                    
                    $data['records'] = $this->schoolModel->getRecords();
                    $data['playerNames'] = $this->userModel->getPlayerNames();
                    
                    $this->view('School/records', $data);
                }
            }
        } else {
            header('Location: ' . URLROOT . '/school/records');
        }
    }
    public function records() {
        $userId = (int) $_SESSION['user_id'];
        
        $school_id_obj = $this->schoolModel->getSchoolId($userId);
        $school_id = $school_id_obj->school_id;
        
        $players = $this->userModel->getPlayersName($school_id);
        $records = $this->schoolModel->getAcademicRecordsByPlayerId();
        $playerNames = $this->schoolModel->getPlayersNamesBySchoolId($school_id);
    
        $data = [
            'players' => $players,
            'records' => $records,
            'playerNames' => $playerNames
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
            'notes' => $record->additional_notes
        ];
            
        $this->view('School/editRecord', $data);
    }


    public function saveEditedRecord() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
           
            $data = [
                'player_id' => trim($_POST['player_id']),
                'grade' => trim($_POST['grade']),
                'term' => trim($_POST['term']),
                'average' => trim($_POST['average']),
                'rank' => trim($_POST['rank']),
                'notes' => trim($_POST['notes'])
            ];
    
           
            if (empty($data['grade']) || empty($data['term']) || empty($data['average']) || empty($data['rank'])) {
               
                $data['error'] = 'Please fill in all required fields.';
                $this->view('School/editRecord', $data);
            } else {
                
                if ($this->schoolModel->updateRecord($data)) {
                    header('Location: ' . URLROOT . '/School/records');
                } else {
                  
                    $data['error'] = 'Something went wrong. Please try again.';
                    $this->view('School/editRecord', $data);
                }
            }
        } else {
           
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

    public function facility(){
        $this->view('School/facility');
    }

    public function facilityForm() {
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         
            $filters = [
                'facilityType' => FILTER_SANITIZE_STRING, 
                'otherFacility' => FILTER_SANITIZE_STRING,
                'facilityName' => FILTER_SANITIZE_STRING,
                'location' => FILTER_SANITIZE_STRING,
                'dateEstablished' => FILTER_SANITIZE_STRING,
                'size' => FILTER_SANITIZE_STRING,
                'condition' => FILTER_SANITIZE_STRING,
                'capacity' => FILTER_SANITIZE_NUMBER_INT,
                'scheduleNotes' => FILTER_SANITIZE_STRING,
                'remarks' => FILTER_SANITIZE_STRING
            ];
    
            $_POST = filter_input_array(INPUT_POST, $filters);
    
           
            $data = [
                'facilityType' => isset($_POST['facilityType']) ? $_POST['facilityType'] : '',
                'otherFacility' => trim($_POST['otherFacility']),
                'facilityName' => trim($_POST['facilityName']),
                'location' => trim($_POST['location']),
                'dateEstablished' => trim($_POST['dateEstablished']),
                'size' => trim($_POST['size']),
                'condition' => trim($_POST['condition']),
                'capacity' => trim($_POST['capacity']),
                'scheduleNotes' => trim($_POST['scheduleNotes']),
                'remarks' => trim($_POST['remarks']),
            ];
    
            
            $result = $this->schoolModel->addFacility($data);
    
      
            if ($result) {
                $_SESSION['success_message'] = "Facility added successfully!";
                header('Location: ' . ROOT . '/school/facilityForm');
                exit;
            } else {
                $_SESSION['error_message'] = "Failed to add facility. Please try again.";
                header('Location: ' . ROOT . '/school/facilityForm/error');
                exit;
            }
        } else {

            $this->view('School/facilityForm');
        }
    }

    public function approveRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = htmlspecialchars(trim($_POST['status']));
            $requestId = filter_var($_POST['request_id'], FILTER_VALIDATE_INT);
    
            if (!$requestId || empty($status)) {
                $_SESSION['flash_message'] = 'Invalid input.';
                header('Location: ' . ROOT . '/school/requests');
                exit;
            }
    
            if ($this->sportModel->updateRequestStatus($requestId, $status)) {
                $_SESSION['flash_message'] = 'Request status updated to ' . ucfirst($status) . '!';
                header('Location: ' . ROOT . '/School/requests');
                exit;
            } else {
                $_SESSION['flash_message'] = 'Failed to update request status.';
                header('Location: ' . ROOT . '/school/requests');
 
                exit;
            }
        } else {
          
            $this->view('School/facilityForm');
        }
    }

    private function updateRequestStatus($type, $id, $status) {
        if ($type === 'facility') {
            return $this->schoolModel->updateFacilityRequestStatus($id, $status);
        } else if ($type === 'extraclass') {
            return $this->schoolModel->updateExtraClassRequestStatus($id, $status);
        }
        return false;
    }

    public function extraClassForm() {
        $userId = $_SESSION['user_id'];
    
        
        $school = $this->schoolModel->getSchoolByUserId($userId); 
    
        $this->view('School/extra_class_form', ['school' => $school]);
    }

    public function scheduleExtraClass() {
      
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $filters = [
                'players' => FILTER_SANITIZE_STRING,
                'subject' => FILTER_SANITIZE_STRING,
                'description' => FILTER_SANITIZE_STRING,
                'date' => FILTER_SANITIZE_STRING,
                'venue' => FILTER_SANITIZE_STRING
            ];
            
            $_POST = filter_input_array(INPUT_POST, $filters);
    
           
            $data = [
                'players' => isset($_POST['players']) ? implode(',', $_POST['players']) : '', 
                'description' => trim($_POST['description']),
                'date' => trim($_POST['date']),
                'venue' => trim($_POST['venue'])
            ];
    
            
            $result = $this->schoolModel->addExtraClass($data);
    
            if ($result) {
                $_SESSION['success_message'] = "Extra class scheduled successfully!";
                header('Location: ' . ROOT . '/school/scheduleExtraClass');
                exit;
            } else {
                $_SESSION['error_message'] = "Failed to schedule extra class. Please try again.";
                header('Location: ' . ROOT . '/school/scheduleExtraClass/error');
                exit;
            }
        } else {
            
            $this->view('School/scheduleExtraClass');
        }
    }


   
    public function scheduleExtra(){
        $this->view('School/scheduleEx');
    }

    public function scheduleEx() {
        $userId = (int) $_SESSION['user_id'];
    
        $school_id_obj = $this->schoolModel->getSchoolId($userId);
        $school_id = $school_id_obj->school_id;
    
        $players = $this->userModel->getPlayersName($school_id);
        $facilityReq= $this->schoolModel->getFacilityRequests($school_id);
        $extraClassReq= $this->schoolModel->getExtraClassRequests();
    
        $data = [
            'players' => $players,
            'facilityReq' => $facilityReq,
            'extraClassReq' => $extraClassReq
        ];
        return $this->view('School/scheduleEx',$data);
        
    }

    public function handleRequest()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $requestId = $_POST['request_id'] ?? '';
        $action = $_POST['action'] ?? '';

        if (empty($requestId) || empty($action)) {
          
            redirect('school/requests'); 
            return;
        }

        
            if ($action === 'approve') {
               
                $this->schoolModel->updateRequestStatus($requestId, 'approved');
                flash('request_message', 'Request approved successfully.');
            } elseif ($action === 'decline') {
                
                $this->schoolModel->updateRequestStatus($requestId, 'declined');
                flash('request_message', 'Request declined.');
            }
        

   
        header('Location: ' . ROOT . '/school/scheduleEx');
    } else {
        header('Location: ' . ROOT . '/school/scheduleEx');
    }
}
public function aboutUs() {
    $data = [];
    $this->view('school/aboutUs');
}

public function help() {
    $data = [];
    $this->view('school/help');
}

}
?>