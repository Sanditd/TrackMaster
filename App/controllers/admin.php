<?php
    class admin extends Controller{
        private $sportModel;
        private $userModel;
        private $calmodel;
        private $zoneModel;
        public function __construct(){
          $this->sportModel=$this->model('sportModel');
          $this->userModel =$this->model('User');
          $this->zoneModel =$this->model('zoneModel');
          //$this->calmodel =$this->model('calenderModel');
        }

        public function index(){

        }

        //to load sportCrete.php
        public function sportCreate(){
            $this->view('/Admin/sportCreate');
        }

        public function teamSportForm(){
            $this->view('/Admin/teamSportForm');
        }

        public function indSportForm(){
            $idata=[];
            $this->view('/Admin/indSportForm',$idata);
        }

        //to load dashbaord.php
        public function dashboard(){
            $data=$this->showMonthlySignups();
            //$caldata=$this->getCalendarData();
            //$data=array_merge($userdata,$caldata);
            $this->view('Admin/adminpanelview',$data);
        }

        //to load userManage.php
        public function userManage($name){
            $data=[
                'username'=>$name
            ];
            $this->view('/Admin/userManage');
        }

        //to load sportManege.php
        public function sportManage(){
            $data=$this->sportModel->getSports();
            $this->view('/Admin/sportManage',$data);
        }

        //handle sport adding to database
        public function addTeamSport() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                header('Content-Type: application/json');
        
                $filters = [
                    'sportName' => FILTER_SANITIZE_STRING,
                    'numOfPlayers' => FILTER_SANITIZE_NUMBER_INT,
                    'positions' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'types' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'Gtypes' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'durationType' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'duration' => ['filter' => FILTER_SANITIZE_NUMBER_INT, 'flags' => FILTER_REQUIRE_ARRAY],
                    'scoring_method' => FILTER_SANITIZE_STRING,
                    'rules' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY]
                ];
        
                $_POST = filter_input_array(INPUT_POST, $filters);
        
                $data = [
                    'sportName' => trim($_POST['sportName']),
                    'sportType' => 'teamSport',
                    'numOfPlayers' => trim($_POST['numOfPlayers']),
                    'positions' => isset($_POST['positions']) ? array_map('trim', $_POST['positions']) : [],
                    'types' => $_POST['types'],
                    'Gtypes' => isset($_POST['Gtypes']) ? array_map('trim', $_POST['Gtypes']) : [],
                    'durationType' => isset($_POST['durationType']) ? $_POST['durationType'] : [],
                    'duration' => isset($_POST['duration']) ? $_POST['duration'] : [],
                    'scoring_method' => trim($_POST['scoring_method']),
                    'rules' => isset($_POST['rules']) ? $_POST['rules'] : [],
                ];
        
                $result = $this->sportModel->addTeamSport($data);
        
                if ($result['success']) {
                    session_start();
                    $_SESSION['success_message'] = "Sport added successfully.";
                    header('Location: ' . ROOT . '/admin/teamSportForm/success');
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_message'] = $result['error'];
                    error_log("Database Insert Failed: " . $result['error']);
                    header('Location: ' . ROOT . '/admin/teamSportForm/error');
                    exit;
                }
            } else {
                $data = [
                    'sportName' => '',
                    'sportType' => '',
                    'numPlayers' => '',
                    'positions' => '',
                    'types' => [],
                    'durationType' => [],
                    'duration' => [],
                    'scoring_method' => '',
                    'rules' => []
                ];
                $this->view('/Admin/teamSportForm', $data);
            }
        }
        
        

        public function addindSportForm(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                header('Content-Type: application/json');
        
                $filters = [
                    'sportName' => FILTER_SANITIZE_STRING,
                    'types' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'Gtypes' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'durationType' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'duration' => ['filter' => FILTER_SANITIZE_NUMBER_INT, 'flags' => FILTER_REQUIRE_ARRAY],
                    'scoring_method' => FILTER_SANITIZE_STRING,
                    'weightClass' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'minWeight' => ['filter' => FILTER_SANITIZE_NUMBER_INT, 'flags' => FILTER_REQUIRE_ARRAY],
                    'maxWeight' => ['filter' => FILTER_SANITIZE_NUMBER_INT, 'flags' => FILTER_REQUIRE_ARRAY],
                    'rules' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY]
                ];
        
                $_POST = filter_input_array(INPUT_POST, $filters);
        
                $data = [
                    'sportName' => trim($_POST['sportName']),
                    'sportType' => 'IndSport',
                    'types' => $_POST['types'],
                    'Gtypes' => isset($_POST['Gtypes']) ? array_map('trim', $_POST['Gtypes']) : [],
                    'durationType' => isset($_POST['durationType']) ? $_POST['durationType'] : [],
                    'duration' => isset($_POST['duration']) ? $_POST['duration'] : [],
                    'scoring_method' => trim($_POST['scoring_method']),
                    'rules' => isset($_POST['rules']) ? $_POST['rules'] : [],
                    'weightClass' => isset($_POST['weightClass']) ? $_POST['weightClass'] : [],
                    'minWeight' => isset($_POST['minWeight']) ? $_POST['minWeight'] : [],
                    'maxWeight' => isset($_POST['maxWeight']) ? $_POST['maxWeight'] : [],
                ];
        
                $result = $this->sportModel->addIndSport($data);
        
                if ($result['success']) {
                    session_start();
                    $_SESSION['success_message'] = "Sport added successfully.";
                    header('Location: ' . ROOT . '/admin/teamSportForm/success');
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_message'] = $result['error'];
                    error_log("Database Insert Failed: " . $result['error']);
                    header('Location: ' . ROOT . '/admin/teamSportForm/error');
                    exit;
                }
            } else {
                // Initial form load
                $idata = [
                    'sportName' => '',
                    'sportType' => '',
                    'gameDuration' => '',
                    'locationType' => '',
                    'equipment' => '',
                    'category' => '',
                    'scoring' => '',
                    'rulesURL' => '',
                    'errorMsg' => 'nothing'
                ];
        
                $this->view('/Admin/indSportForm', $idata);
            }
        }
        

        //load sport view
        public function sportView($sportId) {
            try {
                 //$sportId = 'TS002';
                // Validate input
                if (empty($sportId)) {
                    throw new Exception("Invalid sport ID!");
                }
        
                // Debug: Display the passed sportId
                // echo "Debug: Passed sportId = " . htmlspecialchars($sportId) . "<br>";
        
                // Get the sport data by ID
                $sport = $this->sportModel->getSportById($sportId);
                //var_dump($sport);
        
                // Debug: Check if sport data is returned
                if (!$sport) {
                    echo "Debug: Query returned no results for sportId = " . htmlspecialchars($sportId) . "<br>";
                    throw new Exception("Sport not found!");
                }
        
                // Determine sport type and fetch additional details
                $details = null;
                if ($sport['sportType'] === 'teamSport') {
                    $details = $this->sportModel->getTeamSportDetails($sportId);
                } elseif ($sport['sportType'] === 'Individual Sport') {
                    $details = $this->sportModel->getIndSportDetails($sportId);
                } else {
                    throw new Exception("Unknown sport type!");
                }
        
                // Debug: Display fetched data
                // echo "Debug: Sport data: <pre>" . print_r($sport, true) . "</pre>";
                // echo "Debug: Details: <pre>" . print_r($details, true) . "</pre>";
        
                // Combine data into a single array
                $data = [
                    'sport' => $sport,
                    'details' => $details
                ];
        
                // Load the view with the data
                $this->view('/Admin/sportView', $data);
        
            } catch (Exception $e) {
                // Log the error message for debugging
                error_log("[sportView] Error: " . $e->getMessage());
        
                // Display a user-friendly error message
                echo "<p>An error occurred: " . htmlspecialchars($e->getMessage()) . "</p>";
                http_response_code(500); // Send appropriate HTTP error code
                exit;
            }
        }
        
        public function updateIndSportDetail(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fieldName = $_POST['fieldName'] ?? null;
            $fieldValue = $_POST['fieldValue'] ?? null;
            $sportId = $_POST['sportId'] ?? null;

            if ($fieldName && $fieldValue) {
                // Assuming you have a Sport model to interact with the database
                if ($sportId) {
                    $success = $this->sportModel->updateIndField($sportId, $fieldName, $fieldValue);
                    if ($success) {
                        $this->sportView($sportId);
                        exit();
                    }
                }
            }
        }
            echo "Error updating sport detail.";
        }

        public function indsportEdit($sportId) {
            // Check if the request method is POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $filters = [
                    'duration' => FILTER_SANITIZE_NUMBER_INT,
                    'isIndoor' => FILTER_SANITIZE_STRING,
                    'equipment' => FILTER_SANITIZE_STRING,
                    'categories' => FILTER_SANITIZE_STRING,
                    'scoringSystem' => FILTER_SANITIZE_STRING,
                    'rulesLink' => FILTER_SANITIZE_URL,
                ];
        
                // Filter and sanitize POST data
                $_POST = filter_input_array(INPUT_POST, $filters);
        
                // Create the data array with sanitized data
                $data = [
                    'sportId' => $sportId,  // Use $sportId passed to the method
                    'duration' => trim($_POST['duration']),
                    'isIndoor' => trim($_POST['isIndoor']),
                    'equipment' => trim($_POST['equipment']),
                    'categories' => trim($_POST['categories']),
                    'categoriesJson' => json_encode(explode(',', 'categories')),
                    'scoringSystem' => trim($_POST['scoringSystem']),
                    'rulesLink' => trim($_POST['rulesLink']),
                    'error' => ''
                ];

                
        
                // Validate the input data
                if (empty($data['sportId'])) {
                    $data['error'] = 'Sport Id not available';
                } elseif (empty($data['duration'])) {
                    $data['error'] = 'Please enter duration';
                } elseif (empty($data['isIndoor'])) {
                    $data['error'] = 'Please enter location type';
                } elseif (empty($data['equipment'])) {
                    $data['error'] = 'Please enter equipment';
                } elseif (empty($data['categories'])) {
                    $data['error'] = 'Please enter categories';
                } elseif (empty($data['scoringSystem'])) {
                    $data['error'] = 'Please enter scoringSystem';
                } elseif (empty($data['rulesLink'])) {
                    $data['error'] = 'Please enter URL of rules';
                }
        
                // If there are errors, reload the form with error messages
                if (!empty($data['error'])) {
                    $this->view('/Admin/indsportEdit', $data);
                    return;
                }
        
                // Update the sport in the database using the model
                if ($this->sportModel->indsportEdit($data)) {
                    header('Location: ' . ROOT . '/admin/sportManage/asd');
                    exit;
                } else {
                    $data['error'] = 'Something went wrong while updating the sport.';
                    $this->view('/Admin/indsportEdit', $data);
                }
        
            } else {
                // Retrieve the sport data from the model
                $sport = $this->sportModel->getIndSportDetails($sportId);
                $sportName = $this->sportModel->getSportById($sportId);
        
                if (!$sport) {
                    $data = [
                        'error' => 'Sport not found.'
                    ];
                    $this->view('/Admin/indsportEdit', $data);
                    return;
                }
        
                // Pass the sport data to the view for editing
                $data = [
                    'sport' => $sport,
                    'sportName' => $sportName,
                    'error' => ''
                ];
                $this->view('/Admin/indsportEdit', $data);
            }
        }
        
        public function teamsportEdit($sportId) {
            // Check if the request method is POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $filters = [
                    'numPlayers' => FILTER_SANITIZE_NUMBER_INT,
                    'positions' => FILTER_SANITIZE_STRING,
                    'teamFormation' => FILTER_SANITIZE_STRING,
                    'durationMinutes' => FILTER_SANITIZE_NUMBER_INT,
                    'halfTimeDuration' => FILTER_SANITIZE_NUMBER_FLOAT,
                    'isOutdoor' => FILTER_SANITIZE_STRING,
                    'equipment' => FILTER_SANITIZE_STRING,
                    'rulesLink' => FILTER_SANITIZE_URL,
                ];
        
                // Filter and sanitize POST data
                $_POST = filter_input_array(INPUT_POST, $filters);
        
                // Create the data array with sanitized data
                $data = [
                    'sportId' => $sportId,  // Use $sportId passed to the method
                    'numPlayers' => trim($_POST['numPlayers']),
                    'positions' => trim($_POST['positions']),
                    'positionsJson' => json_encode(explode(',', 'positions')),
                    'teamFormation' => trim($_POST['teamFormation']),
                    'durationMinutes' => trim($_POST['durationMinutes']),
                    'halfTimeDuration' => trim($_POST['halfTimeDuration']),
                    'isOutdoor' => trim($_POST['isOutdoor']),
                    'equipment' => trim($_POST['equipment']),
                    'rulesLink' => trim($_POST['rulesLink']),
                    'error' => ''
                ];

                
        
                // Validate the input data
                if (empty($data['sportId'])) {
                    $data['error'] = 'Sport Id not available';
                } elseif (empty($data['numPlayers'])) {
                    $data['error'] = 'Please enter duration';
                } elseif (empty($data['positions'])) {
                    $data['error'] = 'Please enter location type';
                } elseif (empty($data['teamFormation'])) {
                    $data['error'] = 'Please enter equipment';
                } elseif (empty($data['durationMinutes'])) {
                    $data['error'] = 'Please enter categories';
                } elseif (empty($data['halfTimeDuration'])) {
                    $data['error'] = 'Please enter scoringSystem';
                } elseif (empty($data['isOutdoor'])) {
                    $data['error'] = 'Please enter URL of rules';
                } elseif (empty($data['equipment'])) {
                    $data['error'] = 'Please enter URL of rules';
                }elseif (empty($data['rulesLink'])) {
                    $data['error'] = 'Please enter URL of rules';
                }
        
        
                // If there are errors, reload the form with error messages
                if (!empty($data['error'])) {
                    $this->view('/Admin/teamsportEdit', $data);
                    return;
                }
        
                // Update the sport in the database using the model
                if ($this->sportModel->teamsportEdit($data)) {
                    header('Location: ' . ROOT . '/admin/sportManage/asd');
                    exit;
                } else {
                    $data['error'] = 'Something went wrong while updating the sport.';
                    $this->view('/Admin/teamsportEdit', $data);
                }
        
            } else {
                // Retrieve the sport data from the model
                $sport = $this->sportModel->getTeamSportDetails($sportId);
                $sportName = $this->sportModel->getSportById($sportId);
        
                if (!$sport) {
                    $data = [
                        'error' => 'Sport not found.'
                    ];
                    $this->view('/Admin/teamsportEdit', $data);
                    return;
                }
        
                // Pass the sport data to the view for editing
                $data = [
                    'sport' => $sport,
                    'sportName' => $sportName,
                    'error' => ''
                ];
                $this->view('/Admin/teamSportEdit', $data);
            }
        }

        public function deleteSport($sportId) {
            try {
                // Validate sportId
                if (empty($sportId)) {
                    throw new Exception("Invalid sport ID.");
                }
    
            }
        }
        
        public function showMonthlySignups() {
            $month = date('m'); // Returns the current month as a two-digit number (e.g., "01" for January)
            $year = date('Y'); // Returns the current year as a four-digit number (e.g., "2024")

            $signups = $this->userModel->getMonthlySignups($month, $year);

            if(empty($signups)){
                return [
                    'signups' => [
                        'month' => 0, // Current month in "Month Year" format
                        'coaches' => 0,
                        'players' => 0,
                        'schools' => 0,
                        'parents' => 0,
                        'deletions' => 0,
                        'errormsg' => 'No data found'
                    ],
                ];
            }else{
            // Return data for rendering in the view
            return [
                'signups' => [
                    'month' => date("F Y"), // Current month in "Month Year" format
                    'coaches' => $signups['coaches'] ?? 0,
                    'players' => $signups['players'] ?? 0,
                    'schools' => $signups['schools'] ?? 0,
                    'parents' => $signups['parents'] ?? 0,
                    'deletions' => $signups['deleted_accounts'] ?? 0,
                ],
            ];
        }
        }

        

        //calender controllers
        public function addReminder($date, $description) {
            $this->calmodel->addReminder($date, $description);
        }

        public function getCalendarData() {
            $reminders = $this->calmodel->getReminders();
            $holidays = $this->calmodel->getHolidays();
    
            $data = [
                'reminders' => [],
                'holidays' => []
            ];
    
            foreach ($reminders as $reminder) {
                $data['reminders'][$reminder['date']][] = $reminder['description'];
            }
    
            foreach ($holidays as $holiday) {
                $data['holidays'][$holiday['date']] = $holiday['name'];
            }
    
            return $data;
        }


        public function zoneManage(){
            $data=$this->showZones();
            $this->view('/Admin/zoneManage',$data);
        }

        
        public function showZones() {
            $zones = $this->zoneModel->getZones();
            if (empty($zones)) {
                return [
                    'zones' => [],
                    'errormsg' => 'No data found'
                ];
            }
            return ['zones' => $zones, 'errormsg' => ''];
        }
        

        public function addZone() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $filters = [
                    'Province' => FILTER_SANITIZE_STRING,
                    'District' => FILTER_SANITIZE_STRING,
                    'zone' => FILTER_SANITIZE_STRING
                ];
                $_POST = filter_input_array(INPUT_POST, $filters);
        
                $data = [
                    'province' => trim($_POST['Province']),
                    'district' => trim($_POST['District']),
                    'zone' => isset($_POST['zone']) ? trim($_POST['zone']) : '',
                    'active' => '0',
                    'errormsg' => ''
                ];
        
                if (empty($data['province']) || empty($data['district']) || empty($data['zone'])) {
                    $errorMsg = urlencode('Please provide all information.');
                    header('Location: ' . ROOT . '/admin/zoneManage/dffsds?error=' . $errorMsg);
                    exit;
                }

                if ($this->zoneModel->isZoneExists($data)) {
                    $errorMsg = urlencode('The specified zone already exists.');
                    header('Location: ' . ROOT . '/admin/zoneManage/dffsds?error=' . $errorMsg);
                    exit;
                }
                
        
                if ($this->zoneModel->addZone($data)) {
                    $errorMsg = urlencode('New Zone added to Database');
                    header('Location: ' . ROOT . '/admin/zoneManage/dffsds?error=' . $errorMsg);
                    exit;
                } else {
                    $errorMsg = urlencode('Something went wrong.');
                    header('Location: ' . ROOT . '/admin/zoneManage/dffsds?error=' . $errorMsg);
                    exit;
                }
            }
        }
        
        public function updateZoneStatus() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get zone name and status from POST data
                $zoneName = $_POST['zoneName'];
                $status = $_POST['status']; // 1 for active, 0 for inactive
        
                // Call the model function to update the status in the database
                $result = $this->zoneModel->updateZoneStatus($zoneName, $status);
        
                // Redirect to the zone management page with a success message
                if ($result) {
                    // Success redirect (you can modify this to include a success message)
                    $errorMsg = urlencode('Zone update sucessfully');
                    header('Location: ' . ROOT . '/admin/zoneManage/sdasd?error=' . $errorMsg);
                    exit;
                } else {
                    // Error redirect (you can modify this to include an error message)
                    $errorMsg = urlencode($zoneName.' deactivated');
                    header('Location: ' . ROOT . '/admin/zoneManage/sdsdas?error=' . $errorMsg);
                    exit;
                }
            }
        }
        
        public function deleteZone() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize the input to prevent SQL injection
                $zoneName = htmlspecialchars(trim($_POST['zoneName']));
        
                // Call the model function to delete the zone
                if ($this->zoneModel->deleteZoneByName($zoneName)) {
                    // Redirect with a success message
                    $successMsg = urlencode("Zone '$zoneName' has been deleted successfully.");
                    header("Location: " . ROOT . "/admin/zoneManage/dssdf?success=$successMsg");
                    exit;
                } else {
                    // Redirect with an error message
                    $errorMsg = urlencode("Failed to delete zone '$zoneName'. Please try again.");
                    header("Location: " . ROOT . "/admin/zoneManage/sdfsdf?error=$errorMsg");
                    exit;
                }
            } else {
                // Redirect if the request method is not POST
                header("Location: " . ROOT . "/admin/zoneManage/sdfsdf");
                exit;
            }
        }

       }
    

    ?>