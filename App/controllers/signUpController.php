<?php

class SignUpController extends Controller {
    private $userModel;
    private $zoneModel;
    private $notificationModel;
    private $schoolModel;
    

    public function __construct() {
        $this->userModel = $this->model('User');
        $this->zoneModel =$this->model('zoneModel');
        $this->notificationModel = $this->model('Notification'); 
        $this->schoolModel = $this->model('SchoolModel');
    }

    public function index() {
        // Default logic for the controller
        // echo "SignUp index method called.";
    }


    public function studentsignupview() {

        $districts = $this->zoneModel->getDistrictsAndZones();
        $sports = $this->userModel->getSports();
        $schools = $this->userModel->getSchools();

        $data = [
            'sports' => $sports,
            'schools' => $schools,
            'districts' => $districts,
        ];

        $this->view('SignUp/StudentSignup', $data);
    }

    public function coachsignupview() {

        $districts = $this->zoneModel->getDistrictsAndZones();
        $sports = $this->userModel->getSports();

        $data = [
            'sports' => $sports,
            'districts' => $districts,
        ];

        $this->view('SignUp/CoachSignup', $data);
    }

    public function schoolsignupview() {
        $districts = $this->zoneModel->getDistrictsAndZones();

        $data = [
            'districts' => $districts,
        ];
        

        $this->view('SignUp/SchoolSignup',$data);
    }

    public function parentsignupview() {

        $data = [];
        

        $this->view('SignUp/ParentSignup');
    }

    public function selectrole() {

        $data = [];
        

        $this->view('SignUp/SelectRole');
    }


    //adminsignupview
    public function adminsignupview() {
        $data = [];
        $this->view('SignUp/Admin', $data);
    }
    



    public function studentsignup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_log("Form submitted.");
            error_log(print_r($_POST, true));
            error_log(print_r($_FILES, true));
    
            $filters = [
                'firstname' => FILTER_SANITIZE_STRING,
                'lastname' => FILTER_SANITIZE_STRING,
                'email' => FILTER_SANITIZE_EMAIL,
                'username' => FILTER_SANITIZE_STRING,
                'password' => FILTER_SANITIZE_STRING,
                'confirmPassword' => FILTER_SANITIZE_STRING,
                'phone' => FILTER_SANITIZE_NUMBER_FLOAT,
                'address' => FILTER_SANITIZE_STRING,
                'dob' => FILTER_SANITIZE_STRING,
                'gender' => FILTER_SANITIZE_STRING,
                'age' => FILTER_SANITIZE_NUMBER_INT,
                'sport' => FILTER_SANITIZE_STRING,
                'playerRole' => FILTER_SANITIZE_STRING,
                'province' => FILTER_SANITIZE_STRING,
                'district' => FILTER_SANITIZE_STRING,
                'zone' => FILTER_SANITIZE_STRING,
                'school' => FILTER_SANITIZE_STRING,

            ];
    
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, $filters);
            error_log("Sanitized POST data:");
            error_log(print_r($_POST, true));
    
            // Initialize data array
            $data = [
                'firstname' => trim($_POST['firstname'] ?? ''),
                'lastname' => trim($_POST['lastname'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'username' => trim($_POST['username'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'confirmPassword' => trim($_POST['confirm-password'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
                'dob' => $_POST['dob'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'age' => trim($_POST['age'] ?? ''),
                'role' => trim('player'),
                'sportName' => trim($_POST['sport'] ?? ''),
                'playerRole' => trim($_POST['playerRole'] ?? ''),
                'province' => trim($_POST['province'] ?? ''),
                'district' => trim($_POST['district'] ?? ''),
                'school' => trim($_POST['school'] ?? ''),
                'zone' => trim($_POST['zone'] ?? ''),
                'bio' => trim($_POST['bio'] ?? ''),
                'photo' => null, // Default photo value
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->userModel->checkUserExists($data['email'], $data['username'])) {
                $_SESSION['error'] = "Email or username is already taken.";
                header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                exit;
            }
    
              // Handle file upload
              if (!empty($_FILES['photo']['name']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                error_log("File uploaded successfully.");
                $fileTmpPath = $_FILES['photo']['tmp_name'];
                $fileName = $_FILES['photo']['name'];
                $fileType = $_FILES['photo']['type'];
                $fileSize = $_FILES['photo']['size'];

                // Sanitize file name
                $safeFileName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($fileName, PATHINFO_FILENAME)) . '.' . strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Allowed file types
                $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Validate file extension
                if (!in_array($fileExtension, $allowedFileTypes)) {
                    session_start(); // Ensure session is started
                    $_SESSION['error'] = "Validate file extension error.";
                    header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                    exit;
                }

                // Validate file size (Max: 2MB)
                if ($fileSize > 2 * 1024 * 1024) {
                    session_start(); // Ensure session is started
                    $_SESSION['error'] = "Validate file size error.";
                    header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                    exit;
                }

                // Define upload directory
                $uploadDir = 'uploads/'; // Make sure this directory exists and has write permissions
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
                }

                // Define file path
                $destinationPath = $uploadDir . $safeFileName;

                // Move uploaded file to the target directory
                if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                    $data['photo'] = $destinationPath; // Store file path in DB
                } else {
                    session_start(); // Ensure session is started
                    $_SESSION['error'] = "fail to move file.";
                    header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                    exit;
                }
            } else {
                error_log("File upload error: " . ($_FILES['photo']['error'] ?? 'No file uploaded.'));
            }



    
            // Validate password match
            if ($data['password'] !== $data['confirmPassword']) {
                //session_start(); // Ensure session is started
                //$_SESSION['error'] = "Passwords do not match. Try again.";
                //header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                //exit;
                error_log("Password: " . $data['password']);
                error_log("Confirm Password: " . $data['confirmPassword']);

            }

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
            // Convert sport name and zone to their respective IDs
            $data['sportName'] = $this->userModel->getSportIdByName($data['sportName']);
            
    
            // Validate sport ID
            if (!$data['sportName']) {
                session_start(); // Ensure session is started
                    $_SESSION['error'] = "Selected sport invalid";
                    header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                    exit;
            }
    
            // Insert user data
            if ($this->userModel->createUser($data)) {
                error_log("User created successfully.");
    
                // Get the new user ID
                $data['user_id'] = $this->userModel->lastInsertId();
    
                // Insert coach data
                $this->userModel->insertPlayer($data);
    
                // Redirect to login with success message
                session_start(); // Ensure session is started
                $_SESSION['success_message'] = "Registration successful! Please log in.";
                header('Location: ' . ROOT . '/logincontroller/login/asd');
                exit;
            } else {
                error_log("Failed to create user.");
                session_start(); // Ensure session is started
                $_SESSION['error'] = "";
                header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                exit;
            }
        }
    }

    public function coachsignup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_log("Form submitted.");
            error_log(print_r($_POST, true));
            error_log(print_r($_FILES, true));
    
            $filters = [
                'firstname' => FILTER_SANITIZE_STRING,
                'lastname' => FILTER_SANITIZE_STRING,
                'email' => FILTER_SANITIZE_EMAIL,
                'username' => FILTER_SANITIZE_STRING,
                'password' => FILTER_SANITIZE_STRING,
                'confirm-password' => FILTER_SANITIZE_STRING,
                'phone' => FILTER_SANITIZE_NUMBER_FLOAT,
                'address' => FILTER_SANITIZE_STRING,
                'dob' => FILTER_SANITIZE_STRING,
                'gender' => FILTER_SANITIZE_STRING,
                'age' => FILTER_SANITIZE_NUMBER_INT,
                'sport' => FILTER_SANITIZE_STRING,
                'coach_type' => FILTER_SANITIZE_STRING,
                'educational_qualifications' => FILTER_SANITIZE_STRING,
                'professional_playing_experience' => FILTER_SANITIZE_STRING,
                'coaching_experience' => FILTER_SANITIZE_STRING,
                'bio' => FILTER_SANITIZE_STRING,
                'province' => FILTER_SANITIZE_STRING,
                'district' => FILTER_SANITIZE_STRING,
                'zone' => FILTER_SANITIZE_NUMBER_INT,
            ];
    
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, $filters);
            error_log("Sanitized POST data:");
            error_log(print_r($_POST, true));
    
            // Initialize data array
            $data = [
                'firstname' => trim($_POST['firstname'] ?? ''),
                'lastname' => trim($_POST['lastname'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'username' => trim($_POST['username'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'confirmPassword' => trim($_POST['confirm-password'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
                'dob' => $_POST['dob'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'age' => trim($_POST['age'] ?? ''),
                'role' => trim('coach'),
                'sportName' => trim($_POST['sport'] ?? ''),
                'coach_type' => trim($_POST['coach_type'] ?? ''),
                'educational_qualifications' => trim($_POST['educational_qualifications'] ?? ''),
                'professional_playing_experience' => trim($_POST['professional_playing_experience'] ?? ''),
                'coaching_experience' => trim($_POST['coaching_experience'] ?? ''),
                'key_achievements' => trim($_POST['key_achievements'] ?? ''),
                'bio' => trim($_POST['bio'] ?? ''),
                'province' => trim($_POST['province'] ?? ''),
                'district' => trim($_POST['district'] ?? ''),
                'zone' => trim($_POST['zone'] ?? ''),
                'photo' => null, // Default photo value
                'created_at' => date('Y-m-d H:i:s')
            ];

                    // Check if email or username already exists
            if ($this->userModel->checkUserExists($data['email'], $data['username'])) {
                $_SESSION['error'] = "Email or username is already taken.";
                header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                exit;
            }

            
    
          // Handle file upload
            if (!empty($_FILES['photo']['name']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                error_log("File uploaded successfully.");
                $fileTmpPath = $_FILES['photo']['tmp_name'];
                $fileName = $_FILES['photo']['name'];
                $fileType = $_FILES['photo']['type'];
                $fileSize = $_FILES['photo']['size'];

                // Sanitize file name
                $safeFileName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($fileName, PATHINFO_FILENAME)) . '.' . strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Allowed file types
                $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Validate file extension
                if (!in_array($fileExtension, $allowedFileTypes)) {
                    session_start(); // Ensure session is started
                    $_SESSION['error'] = "Validate file extension error.";
                    header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                    exit;
                }

                // Validate file size (Max: 2MB)
                if ($fileSize > 2 * 1024 * 1024) {
                    session_start(); // Ensure session is started
                    $_SESSION['error'] = "Validate file size error.";
                    header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                    exit;
                }

                // Define upload directory
                $uploadDir = 'uploads/'; // Make sure this directory exists and has write permissions
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
                }

                // Define file path
                $destinationPath = $uploadDir . $safeFileName;

                // Move uploaded file to the target directory
                if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                    $data['photo'] = $destinationPath; // Store file path in DB
                } else {
                    session_start(); // Ensure session is started
                    $_SESSION['error'] = "fail to move file.";
                    header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                    exit;
                }
            } else {
                error_log("File upload error: " . ($_FILES['photo']['error'] ?? 'No file uploaded.'));
            }

            // Validate password match
            if ($data['password'] !== $data['confirmPassword']) {
                error_log("Password: " . $data['password']);
                error_log("Confirm Password: " . $data['confirmPassword']);

                session_start(); // Ensure session is started
                $_SESSION['error'] = "Passwords do not match. Try again.";
                header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                exit;
            }

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
            // Convert sport name and zone to their respective IDs
            $data['sportName'] = $this->userModel->getSportIdByName($data['sportName']);
            // $data['zone'] = $this->zoneModel->getZoneId($data['zone']);
    
            // Validate sport ID
            if (!$data['sportName']) {
                session_start(); // Ensure session is started
                    $_SESSION['error'] = "Selected sport invalid.";
                    header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                    exit;
            }

            $sportName = $this->userModel->getSportNameById($data['sportName']);

            
            //Insert user data
            if ($this->userModel->createUser($data)) {
                error_log("User created successfully.");
    
                // Get the new user ID
                $data['user_id'] = $this->userModel->lastInsertId();

            // Insert coach data
            $this->userModel->insertCoach($data);
            
            // Get the sport name instead of just the ID for a more readable notification
            $sportName = $this->userModel->getSportNameById($data['sportName']);

            $notification = [
                'title' => "New Coach Registration",
                'description' => "A new coach ({$data['firstname']} {$data['lastname']}) has registered for {$sportName}",
                'type' => "coach registration",
            ];
            
            // Call only once
            $this->sendAdminNotification($notification);

            
              

                // Redirect to login with success message
                session_start(); // Ensure session is started
                $_SESSION['success_message'] = "Registration successful! Please log in.";
                header('Location: ' . ROOT . '/logincontroller/login/asd');
                exit;
            } else {
                error_log("Failed to create user.");
                session_start(); // Ensure session is started
                $_SESSION['error'] = "An error occure.";
                header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                exit;
            }
        }
    }

    private function sendAdminNotification($notification) {
        $requiredKeys = ['title', 'description', 'type'];
        foreach ($requiredKeys as $key) {
            if (!isset($notification[$key])) {
                $msg = "Missing '$key' in notification array.";
                error_log($msg);
                return ['success' => false, 'error' => $msg];
            }
        }
    
        $adminIds = $this->userModel->getAdminUserIds();
    
        if (empty($adminIds)) {
            $msg = "No admin users found to notify about new coach signup.";
            error_log($msg);
            return ['success' => false, 'error' => $msg];
        }
    
        $title = $notification['title'];
        $description = $notification['description'];
        $type = $notification['type'];
    
        $results = [];
        foreach ($adminIds as $adminId) {
            $toAdmin = is_object($adminId) ? $adminId->admin_id : $adminId; // handle object or int
            $data = [
                'title' => $title,
                'description' => $description,
                'type' => $type,
                'toAdmin' => $toAdmin
            ];
    
            $result = $this->notificationModel->createAdminNotification($data);
    
            if ($result['success']) {
                error_log("Notification sent to admin ID: $toAdmin");
                $results[] = ['admin_id' => $toAdmin, 'success' => true];
            } else {
                $errorMsg = "Failed to send notification to admin ID: $toAdmin. Reason: " . $result['error'];
                error_log($errorMsg);
                $results[] = ['admin_id' => $toAdmin, 'success' => false, 'error' => $result['error']];
            }
        }
    
        // Check if any failed
        $hasError = false;
        foreach ($results as $res) {
            if (!$res['success']) {
                $hasError = true;
                break;
            }
        }
    
        return [
            'success' => !$hasError,
            'details' => $results
        ];
    }
    
    
    
    
    public function schoolsignup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_log("Form submitted.");
            error_log(print_r($_POST, true));
            error_log(print_r($_FILES, true));
    
            $filters = [
                'firstname' => FILTER_SANITIZE_STRING,
                'email' => FILTER_SANITIZE_EMAIL,
                'username' => FILTER_SANITIZE_STRING,
                'password' => FILTER_SANITIZE_STRING,
                'confirm-password' => FILTER_SANITIZE_STRING,
                'phone' => FILTER_SANITIZE_NUMBER_FLOAT,
                'address' => FILTER_SANITIZE_STRING,
                'province' => FILTER_SANITIZE_STRING,
                'district' => FILTER_SANITIZE_STRING,
                'zone' => FILTER_SANITIZE_STRING,

            ];
    
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, $filters);
            error_log("Sanitized POST data:");
            error_log(print_r($_POST, true));
    
            // Initialize data array
            $data = [
                'firstname' => trim($_POST['firstname'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'username' => trim($_POST['username'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'confirmPassword' => trim($_POST['confirm-password'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
                'role' => trim('school'),
                'province' => trim($_POST['province'] ?? ''),
                'district' => trim($_POST['district'] ?? ''),
                'zone' => trim($_POST['zone'] ?? ''),
                'bio' => trim($_POST['bio'] ?? ''),
                'photo' => null, // Default photo value
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            // Handle file upload
            if (!empty($_FILES['photo']['name']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                error_log("File uploaded successfully.");
                $fileTmpPath = $_FILES['photo']['tmp_name'];
                $fileName = $_FILES['photo']['name'];
                $fileType = $_FILES['photo']['type'];
                $fileSize = $_FILES['photo']['size'];
    
                // Sanitize file name
                $safeFileName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($fileName, PATHINFO_FILENAME)) . '.' . strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                // Allowed file types
                $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                // Validate file extension
                if (!in_array($fileExtension, $allowedFileTypes)) {
                    $data['errormsg'] = "Invalid file type for profile picture.";
                    $this->view('signupcontroller/coachsignupview', $data);
                    exit;
                }
    
                // Validate file size (Max: 2MB)
                if ($fileSize > 2 * 1024 * 1024) {
                    $data['errormsg'] = "File size exceeds the 2MB limit.";
                    $this->view('signupcontroller/coachsignupview', $data);
                    exit;
                }
    
                // Store file content
                $data['photo'] = file_get_contents($fileTmpPath);
            } else {
                error_log("File upload error: " . ($_FILES['photo']['error'] ?? 'No file uploaded.'));
            }
    
            // Validate password match
            if ($data['password'] !== $data['confirmPassword']) {
                $data['errormsg'] = "Passwords do not match. Please try again.";
                $this->view('signupcontroller/coachsignupview', $data);
                exit;
            }

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
            //check School already exisits on db
            if ($this->userModel->checkUserExists($data['email'], $data['username'])) {
                $_SESSION['error_message'] = "Email or username is already taken.";
                header('Location: ' . ROOT . '/logincontroller/login');
                exit;
            }
        
            // Insert user data
            if ($this->userModel->createSchoolUser($data)) {
                error_log("User created successfully.");
    
                // Get the new user ID
                $data['user_id'] = $this->userModel->lastInsertId();
    
                // Insert coach data
                $this->userModel->insertSchool($data);

                $notification = [
                    'title' => "New School Registration",
                    'description' => "A new School ({$data['firstname']} ) has registered ",
                    'type' => "school registration",
                ];
                
                // Call only once
                $this->notificationModel->sendAdminNotification($notification);

    
                // Redirect to login with success message
                session_start(); // Ensure session is started
                $_SESSION['success_message'] = "Registration successful! Please log in.";
                header('Location: ' . ROOT . '/logincontroller/login/asd');
                exit;
            } else {
                error_log("Failed to create user.");
                $data['errormsg'] = "An error occurred during signup.";
                $this->view('signupcontroller/coachsignupview', $data);
                exit;
            }
        }
    }


    public function Admin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_log("Form submitted.");
            error_log(print_r($_POST, true));
            error_log(print_r($_FILES, true));
    
            $filters = [
                'email' => FILTER_SANITIZE_EMAIL,
                'username' => FILTER_SANITIZE_STRING,
                'password' => FILTER_SANITIZE_STRING,
                'confirm-password' => FILTER_SANITIZE_STRING
            ];
    
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, $filters);
            error_log("Sanitized POST data:");
            error_log(print_r($_POST, true));
    
            // Initialize data array
            $data = [
                'email' => trim($_POST['email'] ?? ''),
                'username' => trim($_POST['username'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'confirmPassword' => trim($_POST['confirm-password'] ?? ''),
            ];

            if (strlen($data['username']) >= 10) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
            
                error_log("Username is too short: " . $data['username']);
                error_log("Length: " . strlen($data['username']));
            
                $_SESSION['error'] = "Username must be less than 10 characters.";
                $this->view('SignUp/Admin');
                exit;
            }

            if ($this->userModel->checkAdminExists($data['email'], $data['username'])) {
                $_SESSION['error_message'] = "Email or username is already taken.";
                header('Location: ' . ROOT . '/logincontroller/AdminLogin');
                exit;
            }
            
             
    
            // Validate password match
            if ($data['password'] !== $data['confirmPassword']) {
                error_log("Password: " . $data['password']);
                error_log("Confirm Password: " . $data['confirmPassword']);

                session_start(); // Ensure session is started
                $_SESSION['error_message'] = "Passwords do not match. Try again.";
                $this->view('SignUp/Admin');
                exit;
            }

            

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
            // Insert user data
            if ($this->userModel->createAdmin($data)) {
                error_log("User created successfully.");

                $notification = [
                    'title' => "New Admin Registration",
                    'description' => "A new admin ({$data['userName']})  has registered for System Admin",
                    'type' => "Admin registration",
                ];

                $this->sendAdminNotification($notification);

    
                // Redirect to login with success message
                //session_start(); // Ensure session is started
                $_SESSION['success_message'] = "Registration successful! Please log in.";
                header('Location: ' . ROOT . '/logincontroller/adminLogin');
                exit;
            } else {
                error_log("Failed to create user.");
                session_start(); // Ensure session is started
                $_SESSION['error_message'] = "An error occure.";
                $this->view('SignUp/Admin');
                exit;
            }
        }else{
            // Load the admin signup view (HTML)
            $data=[];
            $this->view('SignUp/Admin',$data);
        }
    }


    public function error() {
        $data = [];
    
        // Check if there's an error message in the session
        if (isset($_SESSION['error_nessage'])) {
            $data['error'] = $_SESSION['error_nessage'];
            unset($_SESSION['error_nessage']); // clear after showing
        }
    
        $this->view('signup/error', $data);
    }

    
}
?>