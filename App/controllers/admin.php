<?php
    class admin extends Controller{
        private $sportModel;
        private $userModel;
        private $calmodel;
        private $zoneModel;
        private $activityModel;
        private $notificationModel;
        public function __construct(){
          $this->sportModel=$this->model('sportModel');
          $this->userModel =$this->model('User');
          $this->zoneModel =$this->model('zoneModel');
          $this->activityModel =$this->model('activityModel');
            $this->notificationModel =$this->model('Notification');
          //$this->calmodel =$this->model('calenderModel');
        }

        public function index(){
            $this->dashboard();
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
            $users = $this->userModel->getUsers();
            $players = $this->userModel->getPlayers();
            $coaches = $this->userModel->getCoaches();
            $schools = $this->userModel->getSchoolsData();
            $zones = $this->zoneModel->getZonals();
            $sports = $this->sportModel->getSports();

        
            $countUsers = $this->userModel->countAllUsers();
            $countPlayers = $this->userModel->countPlayers();
            $countCoaches = $this->userModel->countCoaches();
            $countSchools = $this->userModel->countSchools();
            $countZones = $this->zoneModel->countZonals();


        
            $data = [
                'users' => $users,
                'players' => $players,
                'coaches' => $coaches,
                'schools' => $schools,
                'zones' => $zones,
                'countUsers' => $countUsers,
                'countPlayers' => $countPlayers,
                'countCoaches' => $countCoaches,
                'countSchools' => $countSchools,
                'countZones' => $countZones,
                'sports' => $sports,
            ];
            $this->view('Admin/adminpanelview',$data);
        }

        //to load userManage.php
        public function userManage(){
            $users = $this->userModel->getUsers();
            $players = $this->userModel->getPlayers();
            $coaches = $this->userModel->getCoaches();
            $schools = $this->userModel->getSchoolsData();
            $zones = $this->zoneModel->getZonals();
        
            $countUsers = $this->userModel->countAllUsers();
            $countPlayers = $this->userModel->countPlayers();
            $countCoaches = $this->userModel->countCoaches();
            $countSchools = $this->userModel->countSchools();
            $countZones = $this->zoneModel->countZonals();



        
            $data = [
                'users' => $users,
                'players' => $players,
                'coaches' => $coaches,
                'schools' => $schools,
                'zones' => $zones,
                'countUsers' => $countUsers,
                'countPlayers' => $countPlayers,
                'countCoaches' => $countCoaches,
                'countSchools' => $countSchools,
                'countZones' => $countZones
            ];
        
            $this->view('/Admin/userManage', $data);
        }
        

        public function notification(){
            $user_id = $_SESSION['user_id']; // Assuming you have the user ID in the session
            $data=$this->notificationModel->getAdminNotifications($user_id);
            $this->view('/Admin/notification',$data);
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
                    $activity = [
                        'act_desc' => 'Added a new team sport: ' . $data['sportName'],
                        'user_id' => $_SESSION['user_id'], // Assuming you have the user ID in the session
                    ];
                    $this->activityModel->insertAdminActivity($activity);
            
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
                    // 'Gtypes' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    // 'durationType' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    // 'duration' => ['filter' => FILTER_SANITIZE_NUMBER_INT, 'flags' => FILTER_REQUIRE_ARRAY],
                    'base' => FILTER_SANITIZE_STRING,
                    'scoring_method' => FILTER_SANITIZE_STRING,
                    'weightClass' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'min' => ['filter' => FILTER_SANITIZE_NUMBER_INT, 'flags' => FILTER_REQUIRE_ARRAY],
                    'max' => ['filter' => FILTER_SANITIZE_NUMBER_INT, 'flags' => FILTER_REQUIRE_ARRAY],
                    'rules' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY]
                ];
        
                $_POST = filter_input_array(INPUT_POST, $filters);
        
                $data = [
                    'sportName' => trim($_POST['sportName']),
                    'sportType' => 'IndSport',
                    // 'types' => $_POST['types'],
                    // 'Gtypes' => isset($_POST['Gtypes']) ? array_map('trim', $_POST['Gtypes']) : [],
                    // 'durationType' => isset($_POST['durationType']) ? $_POST['durationType'] : [],
                    // 'duration' => isset($_POST['duration']) ? $_POST['duration'] : [],
                    'base' => trim($_POST['base']),
                    'scoring_method' => trim($_POST['scoring_method']),
                    'rules' => isset($_POST['rules']) ? $_POST['rules'] : [],
                    'weightClass' => isset($_POST['weightClass']) ? $_POST['weightClass'] : [],
                    'minWeight' => isset($_POST['min']) ? $_POST['min'] : [],
                    'maxWeight' => isset($_POST['max']) ? $_POST['max'] : [],
                ];
        
                $result = $this->sportModel->addIndSport($data);
        
                if ($result['success']) {
                    $activity = [
                        'act_desc' => 'Added a new individual sport: ' . $data['sportName'],
                        'user_id' => $_SESSION['user_id'], // Assuming you have the user ID in the session
                    ];
                    $this->activityModel->insertAdminActivity($activity);
            
                    session_start();
                    $_SESSION['success_message'] = "Sport added successfully.";
                    header('Location: ' . ROOT . '/admin/indSportForm/success');
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_message'] = $result['error'];
                    error_log("Database Insert Failed: " . $result['error']);
                    header('Location: ' . ROOT . '/admin/indSportForm/error');
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

        public function teamSportView($sportId) {
            try {
                if (empty($sportId)) {
                    $_SESSION['error_message'] = "Invalid sport ID!";
                    return $this->view('/Admin/teamSportView');
                }
        
                $result = $this->sportModel->getTeamSportDetails($sportId);
        
                if (isset($result['error']) && $result['error']) {
                    $_SESSION['error_message'] = $result['message'];
                    return $this->view('/Admin/teamSportView');
                }
        
                // ✅ Pass sport, game_types, rules directly to the view
                $this->view('/Admin/teamSportView', [
                    'sport' => $result['sport'],
                    'game_types' => $result['game_types'],
                    'rules' => $result['rules']
                ]);
        
            } catch (Exception $e) {
                $_SESSION['error_message'] = $e->getMessage();
                return $this->view('/Admin/teamSportView');
            }
        }
        
        
        public function indSportView($sportId) {
            try {
                if (empty($sportId)) {
                    $_SESSION['error_message'] = "Invalid sport ID!";
                    return $this->view('/Admin/indSportView');
                }
        
                $result = $this->sportModel->getIndSportDetails($sportId);
        
                if (isset($result['error']) && $result['error']) {
                    $_SESSION['error_message'] = $result['message'];
                    return $this->view('/Admin/indSportView');
                }
        
                // ✅ Pass sport, game_types, rules directly to the view
                $this->view('/Admin/indSportView', [
                    'sport' => $result['sport'],
                    'game_types' => $result['game_types'],
                    'rules' => $result['rules']
                ]);
        
            } catch (Exception $e) {
                $_SESSION['error_message'] = $e->getMessage();
                return $this->view('/Admin/indSportView');
            }
        }
        
        public function updateIndSport($sportId) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Filter and sanitize POST data
                header('Content-Type: application/json');
                
                $filters = [
                    'sport_id' => FILTER_SANITIZE_NUMBER_INT,
                    'sportName' => FILTER_SANITIZE_STRING,
                    'base' => FILTER_SANITIZE_STRING,
                    'scoring_method' => FILTER_SANITIZE_STRING,
                    'weightClass' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'min' => ['filter' => FILTER_SANITIZE_NUMBER_INT, 'flags' => FILTER_REQUIRE_ARRAY],
                    'max' => ['filter' => FILTER_SANITIZE_NUMBER_INT, 'flags' => FILTER_REQUIRE_ARRAY],
                    'rules' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY]
                ];
        
                $_POST = filter_input_array(INPUT_POST, $filters);
        
                $data = [
                    'sport_id' => trim($_POST['sport_id']),
                    'sportName' => trim($_POST['sportName']),
                    'sportType' => 'IndSport',
                    'base' => trim($_POST['base']),
                    'scoring_method' => trim($_POST['scoring_method']),
                    'rules' => isset($_POST['rules']) ? $_POST['rules'] : [],
                    'weightClass' => isset($_POST['weightClass']) ? $_POST['weightClass'] : [],
                    'min' => isset($_POST['min']) ? $_POST['min'] : [],
                    'max' => isset($_POST['max']) ? $_POST['max'] : [],
                ];
        
                // Call model method to update team sport
                $result = $this->sportModel->updateIndSport($data);
        
                if ($result['success']) {
                    $activity = [
                        'act_desc' => 'Updated a team sport: ' . $data['sportName'],
                        'user_id' => $_SESSION['user_id'], // Assuming you have the user ID in the session
                    ];
                    $this->activityModel->insertAdminActivity($activity);
                    session_start();
                    $_SESSION['success_message'] = "Sport update successfully.";
                    
                    // Redirect with sport_id in the URL
                    header('Location: ' . ROOT . '/admin/updateIndSport/' . $sportId );
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_message'] = $result['error'];
                    error_log("Database Insert Failed: " . $result['error']);
                    
                    // Redirect with sport_id in the URL
                    header('Location: ' . ROOT . '/admin/updateIndSport/' . $sportId );
                    exit;
                }
                
            } else {
                // Load the view for editing the sport
                try {
                    if (empty($sportId)) {
                        $_SESSION['error_message'] = "Invalid sport ID!";
                        return $this->view('/admin/updateIndSport/'. $sportId );
                    }
        
                    // Fetch sport details from the model
                    $result = $this->sportModel->getIndSportDetails($sportId);
        
                    if (isset($result['error']) && $result['error']) {
                        $_SESSION['error_message'] = $result['message'];
                        return $this->view('/admin/updateIndSport/'. $sportId );
                    }
        
                    // Pass the fetched data and sportId to the view
                    $this->view('/Admin/indSportEdit', [
                        'sport' => $result['sport'],
                        'game_types' => $result['game_types'],
                        'rules' => $result['rules'],
                        'sportId' => $sportId  // Pass the sportId to the view
                    ]);
        
                } catch (Exception $e) {
                    $_SESSION['error_message'] = $e->getMessage();
                    return $this->view('/Admin/indSportEdit');
                }
            }
        }

        
        public function updateTeamSport($sportId) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Filter and sanitize POST data
                header('Content-Type: application/json');
                
                $filters = [
                    'sportName' => FILTER_SANITIZE_STRING,
                    'numOfPlayers' => FILTER_SANITIZE_NUMBER_INT,
                    'sport_id' => FILTER_SANITIZE_NUMBER_INT,
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
                    'sport_id' => trim($_POST['sport_id']),
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
        
                // Call model method to update team sport
                $result = $this->sportModel->updateTeamSport($data);
        
                if ($result['success']) {
                    $activity = [
                        'act_desc' => 'Updated a new team sport: ' . $data['sportName'],
                        'user_id' => $_SESSION['user_id'], // Assuming you have the user ID in the session
                    ];
                    $this->activityModel->insertAdminActivity($activity);
                    session_start();
                    $_SESSION['success_message'] = "Sport update successfully.";
                    
                    // Redirect with sport_id in the URL
                    header('Location: ' . ROOT . '/admin/updateTeamSport/' . $sportId );
                    exit;
                } else {
                    session_start();
                    $_SESSION['error_message'] = $result['error'];
                    error_log("Database Insert Failed: " . $result['error']);
                    
                    // Redirect with sport_id in the URL
                    header('Location: ' . ROOT . '/admin/updateTeamSport/' . $sportId );
                    exit;
                }
                
            } else {
                // Load the view for editing the sport
                try {
                    if (empty($sportId)) {
                        $_SESSION['error_message'] = "Invalid sport ID!";
                        return $this->view('/Admin/updateTeamSport');
                    }
        
                    // Fetch sport details from the model
                    $result = $this->sportModel->getTeamSportDetails($sportId);
        
                    if (isset($result['error']) && $result['error']) {
                        $_SESSION['error_message'] = $result['message'];
                        return $this->view('/Admin/updateTeamSport');
                    }
        
                    // Pass the fetched data and sportId to the view
                    $this->view('/Admin/teamSportEdit', [
                        'sport' => $result['sport'],
                        'game_types' => $result['game_types'],
                        'rules' => $result['rules'],
                        'sportId' => $sportId  // Pass the sportId to the view
                    ]);
        
                } catch (Exception $e) {
                    $_SESSION['error_message'] = $e->getMessage();
                    return $this->view('/Admin/teamSportEdit');
                }
            }
        }
        

        
        public function deleteSport($sportId) {
            try {
                // Validate sportId
                if (empty($sportId)) {
                    throw new Exception("Invalid sport ID.");
                }
        
                // Delete the sport from the database
                $this->sportModel->deleteSportById($sportId);
                $data=$this->sportModel->getSportById($sportId);

                $activity = [
                    'act_desc' => 'Added a new team sport: ' . $data['sportName'],
                    'user_id' => $_SESSION['user_id'], // Assuming you have the user ID in the session
                ];
                $this->activityModel->insertAdminActivity($activity);
        
                // Return a success response
                http_response_code(200);
                echo json_encode(["message" => "Sport deleted successfully."]);
            } catch (Exception $e) {
                // Handle errors and send error response
                http_response_code(400);
                echo json_encode(["error" => $e->getMessage()]);
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
                    $activity = [
                        'act_desc' => 'Added a new Zone: ' . $data['zone'],
                        'user_id' => $_SESSION['user_id'], // Assuming you have the user ID in the session
                    ];
                    $this->activityModel->insertAdminActivity($activity);
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
                    $activity = [
                        'act_desc' => 'Added a new team sport: ' . $zoneName,
                        'user_id' => $_SESSION['user_id'], // Assuming you have the user ID in the session
                    ];
                    $this->activityModel->insertAdminActivity($activity);
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
                    $activity = [
                        'act_desc' => 'Added a new team sport: ' . $zoneName,
                        'user_id' => $_SESSION['user_id'], // Assuming you have the user ID in the session
                    ];
                    $this->activityModel->insertAdminActivity($activity);
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

        public function zonalSport(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selections = $_POST['coach_selection'] ?? [];

        $zones = $this->sportModel->getZones();
        $sports = $this->sportModel->getSports();
        $zonalSports = $this->sportModel->getZonalSports();
        $users = $this->sportModel->getCoaches();
        $FromCoaches = $this->sportModel->getFromCoaches();

        foreach ($selections as $zoneId => $sportsArray) {
            $zoneId = filter_var($zoneId, FILTER_VALIDATE_INT);
            if ($zoneId === false) {
                $_SESSION['error_message'] = "Invalid Zone ID.";
                break;
            }

            foreach ($sportsArray as $sportId => $coachId) {
                $sportId = filter_var($sportId, FILTER_VALIDATE_INT);
                $coachId = filter_var($coachId, FILTER_VALIDATE_INT);

                if ($sportId === false) {
                    $_SESSION['error_message'] = "Invalid Sport ID in Zone ID: $zoneId.";
                    break 2;
                }

                // Handle "Not Selected" case (coachId is null or 0 or invalid)
                if (empty($coachId) || !$coachId || $coachId === 0) {
                    $result = $this->sportModel->assignCoachToSport($zoneId, $sportId, 0, 0);
                    if (!empty($result['error'])) {
                        $_SESSION['error_message'] = "Error saving coach: Zone $zoneId, Sport $sportId — " . $result['message'];
                        break 2;
                    }
                    continue;
                }

                $coachExists = false;
                foreach ($FromCoaches as $coach) {
                    if ((int)$coach->coach_id === (int)$coachId) {
                        $coachExists = true;
                        break;
                    }
                }

                if (!$coachExists) {
                    $_SESSION['error_message'] = "Invalid coach (ID: $coachId) for Sport ID: $sportId in Zone ID: $zoneId.";
                    break 2;
                }

                // Save with active = 1
                $result = $this->sportModel->assignCoachToSport($zoneId, $sportId, $coachId, 1);
                if (!empty($result['error'])) {
                    $_SESSION['error_message'] = "Error assigning coach: Zone $zoneId, Sport $sportId — " . $result['message'];
                    break 2;
                }

                $coachName = $this->sportModel->getCoachName($coachId);
                $Sportdata = $this->sportModel->getSportById($sportId);
                
                // Fallback if no coach name found
                $coachFirstName = 'Unknown';
                $coachLastName = '';
                
                if ($coachName) {
                    $coachFirstName = $coachName['firstName'];
                    $coachLastName = $coachName['lname'];
                }
                
                $activity = [
                    'act_desc' => 'Assign coach ' . $coachFirstName . ' ' . $coachLastName . ': ' . $Sportdata['sportName'],
                    'user_id' => $_SESSION['user_id'],
                ];
                
                $this->activityModel->insertAdminActivity($activity);
                
            }
        }

        if (!isset($_SESSION['error_message'])) {
            $_SESSION['success_message'] = "Coach assignments saved successfully.";
        }

        // Redirect to avoid resubmission
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    // GET request
    try {
        $zones = $this->sportModel->getZones();
        $sports = $this->sportModel->getSports();
        $zonalSports = $this->sportModel->getZonalSports();
        $users = $this->sportModel->getCoaches();
        $FromCoaches = $this->sportModel->getFromCoaches();
        

        if (!$zones || isset($zones['error'])) {
            $_SESSION['error_message'] = "Error fetching zones.";
        }

        if (!$sports || isset($sports['error'])) {
            $_SESSION['error_message'] = "Error fetching sports.";
        }

        if (!$users || isset($users['error'])) {
            $_SESSION['error_message'] = "Error fetching coaches.";
        }

        if (!$zonalSports || isset($zonalSports['error'])) {
            $_SESSION['error_message'] = "Error fetching ZonalSport.";
        }

        if (!$FromCoaches || isset($FromCoaches['error'])) {
            $_SESSION['error_message'] = "Error fetching FromCoaches.";
        }

        return $this->view('/Admin/zonalSport', [
            'zones' => $zones,
            'sports' => $sports,
            'zonalSports' => $zonalSports,
            'users' => $users,
            'FromCoaches' => $FromCoaches,
        ]);
    } catch (Exception $e) {
        $_SESSION['error_message'] = "An error occurred: " . $e->getMessage();
        return $this->view('/Admin/zonalSport');
    }
}

public function searchUser()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $searchTerm = trim($_POST['search_term'] ?? '');
        $userType = trim($_POST['user_type'] ?? '');
        $zoneId = trim($_POST['zone_id'] ?? '');

        // Basic validation
        if (empty($searchTerm)) {
            $_SESSION['error_message'] = "Please enter a search term.";
            header("Location: " . ROOT.'/admin/userManage');
            exit;
        }

        // Split search term
        $nameParts = explode(' ', $searchTerm);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';
        // $_SESSION['error_message'] = 'firstname: '.$firstName.' '.'lastname :'.$lastName;
        //     header("Location: " . ROOT.'/admin/userManage');
        //     exit;

        if (empty($firstName)) {
            $_SESSION['error_message'] = "First name is required.";
            header("Location: " . ROOT.'/admin/userManage');
            exit;
        }

        if($userType!='school'){
        // Search user
        $user = $this->userModel->findUserByName($firstName, $lastName);
        // $_SESSION['error_message'] = 'User details: ' . print_r($user, true);
        // header("Location: " . ROOT.'/admin/userManage');
        // exit;
        }else{
            $user = $this->userModel->findSchoolByName($searchTerm);
        }


        if (!$user) {
            $_SESSION['error_message'] = "User not found with given name.";
            header("Location: " . ROOT.'/admin/userManage');
            exit;
        }

        // Validate user role
        $userRole = $user->role ?? null;
        if (!$userRole) {
            $_SESSION['error_message'] = "User role is missing.";
            header("Location: " . ROOT.'/admin/userManage');
            exit;
        }

        if (!empty($userType) && strtolower($userRole) !== strtolower($userType)) {
            $_SESSION['error_message'] = "User types does not match";
            header("Location: " . ROOT.'/admin/userManage');
            exit;
        }

        

        // Route user based on role
        switch (strtolower($userRole)) {
            case 'player':
                $userZoneId = (int)($this->userModel->getPlayerZoneId($user->user_id) ?? 0);
                $zoneId = (int)($_POST['zone_id'] ?? 0);
                // $_SESSION['error_message'] = "db ". $userZoneId. " post ".$zoneId;
                //     header("Location: " . ROOT.'/admin/userManage');
                //     exit;
        
                if (!empty($zoneId) && $userZoneId !== $zoneId) {
                    $_SESSION['error_message'] = "User zone does not match.";
                    header("Location: " . ROOT.'/admin/userManage');
                    exit;
                }
    
                $this->loadPlayerProfile($user->user_id);
                break;
            case 'coach':
                $userZoneId = (int)($this->userModel->getCoachZoneId($user->user_id) ?? 0);
                $zoneId = (int)($_POST['zone_id'] ?? 0);
                //  $_SESSION['error_message'] = "db ". $userZoneId. " post ".$zoneId;
                //    header("Location: " . ROOT.'/admin/userManage');
                //     exit;

                if (!empty($zoneId) && $userZoneId !== $zoneId) {
                    $_SESSION['error_message'] = "User zone does not match.";
                    header("Location: " . ROOT.'/admin/userManage');
                    exit;
                }

                // $_SESSION['error_message'] = "User ".$user->user_id;
                //     header("Location: " . ROOT.'/admin/userManage');
                //     exit;

                $this->loadCoachProfile($user->user_id);
                break;
            case 'school':
                $userZoneId = (int)($this->userModel->getSchoolZoneId($user->user_id) ?? 0);
                $zoneId = (int)($_POST['zone_id'] ?? 0);
                //  $_SESSION['error_message'] = "db ". $userZoneId. " post ".$zoneId;
                //    header("Location: " . ROOT.'/admin/userManage');
                //     exit;

                if (!empty($zoneId) && $userZoneId !== $zoneId) {
                    $_SESSION['error_message'] = "User zone does not match.";
                    header("Location: " . ROOT.'/admin/userManage');
                    exit;
                }

            // $_SESSION['error_message'] = "User ".$user->user_id;
            //     header("Location: " . ROOT.'/admin/userManage');
            //     exit;

            $this->loadSchoolProfile($user->user_id);
            break;
            // case 'admin':
            //     $this->loadAdminProfile($user->userId);
            //     break;
            default:
                $_SESSION['error_message'] = "Unknown user role.";
                header("Location: " . ROOT.'/admin/userManage');
                exit;
        }
    } else {
        $_SESSION['error_message'] = "Invalid request method.";
        header("Location: " . ROOT.'/admin/userManage');
        exit;
    }
}



        public function loadPlayerProfile($user_id){
            $school_id=$this->userModel->getPlayerId($user_id);

            if(!$school_id){
                $_SESSION['error_message']="Unknown Player";
                header("Location: " . ROOT.'/admin/userManage');
                exit;
            }

            $user=$this->userModel->getUserInfo($user_id);
            $player=$this->userModel->getPlayerInfo($school_id);
            $activity=$this->activityModel->getUserActivityByUserId($user_id);
            $zones=$this->zoneModel->getZoneIdName();
            $sport=$this->sportModel->getSports();

            $data=[
                'user'=>$user,
                'player'=>$player,
                'activity'=>$activity,
                'zones'=>$zones,
                'sport'=>$sport,
            ];

            $this->view('admin/playerProfile',$data);
        }

        public function loadCoachProfile($user_id){
            $coach_id=$this->userModel->getCoachId($user_id);

            if(!$coach_id){
                $_SESSION['error_message']="Unknown Coach z".$user_id;
                header("Location: " . ROOT.'/admin/userManage');
                exit;
            }

            $user=$this->userModel->getUserInfo($user_id);
            $coach=$this->userModel->getCoachInfo($coach_id);
            $activity=$this->activityModel->getUserActivityByUserId($user_id);
            $zones=$this->zoneModel->getZoneIdName();
            $sport=$this->sportModel->getSports();

            $data=[
                'user'=>$user,
                'coach'=>$coach,
                'activity'=>$activity,
                'zones'=>$zones,
                'sport'=>$sport,
            ];

            $this->view('admin/coachProfile',$data);
        }


        public function loadSchoolProfile($user_id){
            $school_id=$this->userModel->getSchoolId($user_id);

            if(!$school_id){
                $_SESSION['error_message']="Unknown School ".$user_id;
                header("Location: " . ROOT.'/admin/userManage');
                exit;
            }

            $user=$this->userModel->getUserInfo($user_id);
            $school=$this->userModel->getSchoolInfor($school_id);
            $activity=$this->activityModel->getUserActivityByUserId($user_id);
            $zones=$this->zoneModel->getZoneIdName();
            

            $data=[
                'user'=>$user,
                'school'=>$school,
                'activity'=>$activity,
                'zones'=>$zones,
            ];

            $this->view('admin/schoolProfile',$data);
        }

        public function accountSetting(){
            $user_id=$_SESSION['user_id'];
            $user=$this->userModel->getAdminData($user_id);

            $data=[
                'user' => $user,
            ];

            $this->view('admin/accountSetting',$data);

        }

        public function adminActivity(){
            $admin=$this->userModel->getAdmin();
            $adminActivity=$this->activityModel->getAdminActivities();

            $data = [
                'admin' => $admin,
                'adminActivity' => $adminActivity,
            ];

            $this->view('admin/adminActivity',$data);
        }

        public function inactiveUsers(){
            $user=$this->userModel->inactiveUsers();

            $data=[
                'user'=>$user
            ];

            $this->view('admin/inactiveUsers',$data);
        }

        public function activeUser()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $userId = $_POST['user_id'];
                $action = $_POST['action'];
        
                // Validate inputs
                if (!empty($userId) && ($action == '1')) {
        
                    // Connect to modelssuming you have a User model
        
                    // Update user active status
                    if($this->userModel->updateActiveStatus($userId, $action)){

                        $activity = [
                            'act_desc' => 'Active User ' . $userId,
                            'user_id' => $_SESSION['user_id'],
                        ];
                        
                        $this->activityModel->insertAdminActivity($activity);

                        $_SESSION['error_message']="User Activate";
                        $this->inactiveUsers();
                        exit;
                    }
                    
        
                    // Redirect back to user list or whatever page
                    $_SESSION['error_message']="User Activate Failed";
                        $this->inactiveUsers();
                        exit;// adjust this URL based on your project
                } else {
                    // Invalid request
                    die('Invalid data');
                }
            } else {
                // Not a POST request
                redirect('admin/users');
            }
        }

        public function rejectUser()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $userId = $_POST['user_id'];
                $action = $_POST['action'];
        
                // Validate inputs
                if (!empty($userId) && ($action == '2')) {
        
                    // Connect to modelssuming you have a User model
        
                    // Update user active status
                    if($this->userModel->updateActiveStatus($userId, $action)){

                        $activity = [
                            'act_desc' => 'Reject User ' . $userId,
                            'user_id' => $_SESSION['user_id'],
                        ];
                        
                        $this->activityModel->insertAdminActivity($activity);

                        $_SESSION['error_message']="User Rejected";
                        $this->inactiveUsers();
                        exit;
                    }
                    
        
                    // Redirect back to user list or whatever page
                    $_SESSION['error_message']="User Reject Failed";
                        $this->inactiveUsers();
                        exit;// adjust this URL based on your project
                } else {
                    // Invalid request
                    die('Invalid data');
                }
            } else {
                // Not a POST request
                redirect('admin/users');
            }
        }
        

        }

    ?>