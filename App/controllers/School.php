    <?php


class School extends Controller{
    private $schoolModel;
    private $userModel;


        public function __construct() {
            $this->schoolModel = $this->model('SchoolModel');
            $this->userModel = $this->model('UserModel');
            $this->studyModel = $this->model('StudyModel');



        $this->schoolModel = $this->model('SchoolModel');
        $this->userModel = $this->model('User');

    }

    public function fetchPlayers() {
        if ($_SESSION['role'] === 'school') {
            $school_id = $this->schoolModel->getSchoolId($_SESSION['user_id'])->school_id;
            return $this->schoolModel->getPlayersForSchool($school_id);
        }
    }

    public function Dashboard() {
        $userId = (int) $_SESSION['user_id'];
    
        $school_id_obj = $this->schoolModel->getSchoolId($userId);
        $school_id = $school_id_obj->school_id;
    
        $players = $this->userModel->getPlayersName($school_id);
        $facilityReq= $this->schoolModel->getFacilityRequests($school_id);
    
        $data = [
            'players' => $players,
            'facilityReq' => $facilityReq
        ];
    
        $this->view('School/school', $data);
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

        
        public function school() {
            $user_id = $_SESSION['user_id'] ?? null;
            
            if (!$user_id) {
                redirect('users/login');
            }
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


public function records() {

    $userId = (int) $_SESSION['user_id'];
    
        $school_id_obj = $this->schoolModel->getSchoolId($userId);
        $school_id = $school_id_obj->school_id;
    
        $players = $this->userModel->getPlayersName($school_id);
        $records = $this->schoolModel->getAcademicRecordsByPlayerId($school_id);


        public function submitRecord(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $firstname = trim($_POST['firstname']);
                $user = $this->schoolModel->getUserIdByFirstname($firstname);

                if (!$user) {
                    echo "User not found for firstname: " . $firstname;
                    exit;
                }
                $user_id = $user->user_id;

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

                $players = $this->fetchPlayers(); 
                $records = $this->schoolModel->getAcademicRecordsByPlayerId($school_id);
            }

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
            }
        }

        public function approveRequest() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $requestType = htmlspecialchars(trim($_POST['request_type']));
                $requestId = filter_var($_POST['request_id'], FILTER_VALIDATE_INT);

                if ($this->updateRequestStatus($requestType, $requestId, 'approved')) {
                    $_SESSION['flash_message'] = 'Request approved successfully!';
                } else {
                    $_SESSION['flash_message'] = 'Failed to approve request.';
                }

                header('Location: ' . ROOT . '/school/getrequests');
                exit;
            }
        }

        public function declineRequest() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $requestType = htmlspecialchars(trim($_POST['request_type']));
                $requestId = filter_var($_POST['request_id'], FILTER_VALIDATE_INT);

                if ($this->updateRequestStatus($requestType, $requestId, 'declined')) {
                    $_SESSION['flash_message'] = 'Request declined successfully!';
                } else {
                    $_SESSION['flash_message'] = 'Failed to decline request.';
                }

                header('Location: ' . ROOT . '/school/getrequests');
                exit;
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
            $this->view('extra_class_form', ['school' => $school]);
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
                    'subject' => trim($_POST['subject']),
                    'description' => trim($_POST['description']),
                    'date' => trim($_POST['date']),
                    'venue' => trim($_POST['venue'])
                ];

                $result = $this->schoolModel->addExtraClass($data);

                if ($result) {
                    $_SESSION['success_message'] = "Extra class scheduled successfully!";
                    header('Location: ' . ROOT . '/class/scheduleExtraClass');
                    exit;
                } else {
                    $_SESSION['error_message'] = "Failed to schedule extra class. Please try again.";
                    header('Location: ' . ROOT . '/class/scheduleExtraClass/error');
                    exit;
                }
            }
        }

        public function scheduleExtra(){
            $this->view('School/scheduleEx');
        }

       
        

        public function showDashboard() {
            if ($_SESSION['role'] !== 'school') {
                redirect('users/login');
            }

            $user_id = $_SESSION['user_id'];
            $school_id = $this->schoolModel->getSchoolId($user_id)->school_id;

            $studyPerformance = $this->schoolModel->getStudyPerformance($school_id);
            $upcomingSessions = $this->schoolModel->getUpcomingSessions($school_id);

            $data = [
                'studyPerformance' => $studyPerformance,
                'upcomingSessions' => $upcomingSessions,
                'school_id' => $school_id,
                'user_name' => $_SESSION['user_name'] ?? 'School Admin'
            ];

            $this->view('school/school', $data);
        }

    

            // Fetch players for the school
            public function fetchPlayer() {
                // Debug session values
                error_log("Session user_id: " . ($_SESSION['user_id'] ?? 'not set'));
                error_log("Session role: " . ($_SESSION['role'] ?? 'not set'));
        
                if ($_SESSION['role'] === 'school') {
                    $school_id = $this->schoolModel->getSchoolId($_SESSION['user_id']);
                    error_log("School ID: " . ($school_id ?? 'not found'));
        
                    if (!$school_id) {
                        $_SESSION['error_message'] = "School ID not found for the logged-in user.";
                        return [];
                    }
                    $players = $this->schoolModel->getPlayersForSchool($school_id);
                    error_log("Players found: " . count($players));
                    return $players;
                }
                $_SESSION['error_message'] = "User role is not 'school'.";
                return [];
            }
        
            // Schedule Extra Class
            public function scheduleEx() {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Sanitize POST data
                    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
                    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
                    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
                    $venue = filter_input(INPUT_POST, 'venue', FILTER_SANITIZE_STRING);
        
                    // Handle players (array of user_ids)
                    $user_ids = isset($_POST['players']) && is_array($_POST['players'])
                        ? array_map('htmlspecialchars', $_POST['players'])
                        : [];
        
                    // Convert user_ids to player_ids
                    $player_ids = [];
                    foreach ($user_ids as $user_id) {
                        $player = $this->schoolModel->getPlayerIdByUserId($user_id);
                        if ($player && isset($player->player_id)) {
                            $player_ids[] = $player->player_id;
                        }
                    }
        
                    // Get the school ID for the logged-in user
                    $school_id = $this->schoolModel->getSchoolId($_SESSION['user_id']);
                    if (!$school_id) {
                        $_SESSION['error_message'] = "School ID not found for the logged-in user.";
                        header('Location: ' . ROOT . '/school/scheduleEx');
                        exit;
                    }
        
                    // Prepare data for insertion
                    $data = [
                        'players' => implode(", ", $player_ids), // Store as comma-separated player_ids
                        'subject' => trim($subject ?? ''),
                        'description' => trim($description ?? ''),
                        'class_date' => trim($date ?? ''),
                        'venue' => trim($venue ?? ''),
                        'school_id' => $school_id
                    ];
        
                    // Debug the data being inserted
                    error_log("Data to insert: " . json_encode($data));
        
                    // Validate required fields
                    if (empty($data['players']) || empty($data['subject']) || empty($data['class_date']) || empty($data['venue'])) {
                        $_SESSION['error_message'] = "Please fill in all required fields.";
                        header('Location: ' . ROOT . '/school/scheduleEx');
                        exit;
                    }
        
                    // Insert into the database
                    $result = $this->schoolModel->addExtraClass($data);
        
                    if ($result) {
                        $_SESSION['success_message'] = "Extra class scheduled successfully!";
                        header('Location: ' . ROOT . '/school/scheduleEx');
                        exit;
                    } else {
                        $_SESSION['error_message'] = "Failed to schedule extra class. Please try again.";
                        header('Location: ' . ROOT . '/school/scheduleEx');
                        exit;
                    }
                } else {
                    // Fetch players for the form
                    $players = $this->fetchPlayers();
        
                    if (empty($players)) {
                        $_SESSION['error_message'] = "No players found.";
                    }
        
                    return $this->view('School/scheduleEx', [
                        'players' => $players
                    ]);
                }
            }
        
            // ... other existing methods ...
        }
    
    ?>