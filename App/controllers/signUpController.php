<?php
    class signUpController extends Controller{

        private $signUp;

        public function __construct(){
          $this->signUp=$this->model('loginPage');
        }

        public function index(){

        }

        public function Signup() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Sanitize input data
                $filters = [
                    'uname' => FILTER_SANITIZE_STRING,
                    'fname' => FILTER_SANITIZE_STRING,
                    'lname' => FILTER_SANITIZE_STRING,
                    'address' => FILTER_SANITIZE_STRING,
                    'pnum' => FILTER_SANITIZE_NUMBER_INT,
                    'email' => FILTER_SANITIZE_EMAIL,
                    'password' => FILTER_SANITIZE_STRING,
                    'cpassword' => FILTER_SANITIZE_STRING,
                    'role' => FILTER_SANITIZE_STRING
                ];
        
                $_POST = filter_input_array(INPUT_POST, $filters);
        
                // Assigning data array
                $data = [
                    'role' => trim($_POST['role']),
                    'username' => trim($_POST['uname']),
                    'fname' => trim($_POST['fname']),
                    'lname' => trim($_POST['lname']),
                    'address' => trim($_POST['address']),
                    'pnum' => trim($_POST['pnum']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'cpassword' => trim($_POST['cpassword']),
                    'error' => ''
                ];
        
                // Check for empty fields
                if (empty($data['role'])) {
                    $data['error'] = 'Please select a role';
                } elseif (empty($data['username'])) {
                    $data['error'] = 'Please enter a username';
                } elseif (empty($data['fname'])) {
                    $data['error'] = 'Please enter your first name';
                } elseif (empty($data['lname'])) {
                    $data['error'] = 'Please enter your last name';
                } elseif (empty($data['address'])) {
                    $data['error'] = 'Please enter your address';
                } elseif (empty($data['pnum'])) {
                    $data['error'] = 'Please enter your phone number';
                } elseif (empty($data['email'])) {
                    $data['error'] = 'Please enter your email';
                } elseif (empty($data['password'])) {
                    $data['error'] = 'Please enter your password';
                } elseif (empty($data['cpassword'])) {
                    $data['error'] = 'Please confirm your password';
                } elseif ($data['password'] !== $data['cpassword']) {
                    $data['error'] = 'Passwords do not match';
                }
        
                // Check if username or email already exists in the database
                if (empty($data['error'])) {
                    if ($this->signUp->checkUsernameExists($data['username'])) {
                        $data['error'] = 'Username already taken';
                    } elseif ($this->signUp->checkEmailExists($data['email'])) {
                        $data['error'] = 'Email already registered';
                    }
                }
        
                // If errors exist, reload the form with the error message
                if (!empty($data['error'])) {
                    $this->view('/Admin/signUp', $data);
                    return;
                }
        
                // Proceed with user registration
                if ($this->signUp->signUpUser($data)) {
                    header('Location: ' . ROOT . '/signupController/addinfo/'.$data['username']);
                    exit;
                } else {
                    $data['error'] = 'Something went wrong while adding your information.';
                    $this->view('/Admin/signUp', $data);
                }
            } else {
                // Initial form
                $data = [
                    'role' => '',
                    'username' => '',
                    'fname' => '',
                    'lname' => '',
                    'address' => '',
                    'pnum' => '',
                    'email' => '',
                    'password' => '',
                    'cpassword' => '',
                    'error' => '',
                ];
        
                $this->view('/Admin/signUp', $data);
            }
        }
        

        public function addinfo($username = null) {
            // If no username is provided (empty), redirect back to the sign-up page
            if ($username === null) {
                header('Location: ' . ROOT . '/signupController/signup');
                exit;
            }
        
            // Query the database for the user ID and role based on the username
            $userData = $this->signUp->getUserByUsername($username); // Assume you have this method in your model
        
            $data = [
                'role' => $userData->role,  // Use object notation
                'username' => $userData->userName,  // Use object notation
                'user_id' => $userData->userId,  // Use object notation
                'error' => ''
            ];
            
        
                // Process form data if POST request
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Sanitize and collect POST data
                    $filters = [
                        'role' => FILTER_SANITIZE_STRING,
                        'username' => FILTER_SANITIZE_STRING,
                        'fname' => FILTER_SANITIZE_STRING,
                        'lname' => FILTER_SANITIZE_STRING,
                        'address' => FILTER_SANITIZE_STRING,
                        'pnum' => FILTER_SANITIZE_NUMBER_INT,
                        'email' => FILTER_SANITIZE_EMAIL,
                        'password' => FILTER_SANITIZE_STRING,
                        'cpassword' => FILTER_SANITIZE_STRING,
                        'coach_type' => FILTER_SANITIZE_STRING,
                        'description' => FILTER_SANITIZE_STRING,
                        'division' => FILTER_SANITIZE_NUMBER_INT,
                        'sport' => FILTER_SANITIZE_NUMBER_INT,
                        'age' => FILTER_SANITIZE_NUMBER_INT,
                        'dob' => FILTER_SANITIZE_STRING,
                        'level' => FILTER_SANITIZE_STRING,
                        'school' => FILTER_SANITIZE_NUMBER_INT,
                        'student' => FILTER_SANITIZE_STRING
                    ];
        
                    $_POST = filter_input_array(INPUT_POST, $filters);
        
                    // Assigning the sanitized data
                    $data = array_merge($data, $_POST);
        
                    // Validate required fields based on role
                    if (
                        empty($data['fname']) || empty($data['lname']) || empty($data['address']) || 
                        empty($data['pnum']) || empty($data['email']) || empty($data['password']) || 
                        empty($data['cpassword'])
                    ) {
                        $data['error'] = "Please fill all the fields";
                    }
        
                    if ($data['role'] == 'coach' && (empty($data['coach_type']) || empty($data['description']) || empty($data['division']) || empty($data['sport']))) {
                        $data['error'] = "Please provide all coach-related information";
                    } elseif ($data['role'] == 'player' && (empty($data['sport']) || empty($data['division']) || empty($data['school']) || empty($data['age']) || empty($data['dob']) || empty($data['level']))) {
                        $data['error'] = "Please provide all player-related information";
                    } elseif ($data['role'] == 'school' && empty($data['profile_photo'])) {
                        $data['error'] = "Please upload profile photo";
                    } elseif ($data['role'] == 'parent' && (empty($data['student']) || empty($data['sport']) || empty($data['school']))) {
                        $data['error'] = "Please provide all parent-related information";
                    }
        
                    // If validation fails, reload the page with error message
                    if (!empty($data['error'])) {
                        $this->view('/Admin/addinfo', $data);
                        return;
                    }
        
                    // Insert or update user information in the database
                    if ($this->signUp->addAdditionalInfo($data)) {
                        // Redirect based on the user's role after successfully adding the info
                        if ($data['role'] == 'coach') {
                            header('Location: ' . ROOT . '/Admin//coachController/coachDashboard');
                        } elseif ($data['role'] == 'player') {
                            header('Location: ' . ROOT . '/Admin//playerController/playerDashboard');
                        } elseif ($data['role'] == 'school') {
                            header('Location: ' . ROOT . '/Admin//schoolController/schoolDashboard');
                        } elseif ($data['role'] == 'parent') {
                            header('Location: ' . ROOT . '//Admin/parentController/parentDashboard');
                        }
                        exit;
                    } else {
                        // If something went wrong with the insertion, show error
                        $data['error'] = 'Something went wrong while adding your information.';
                        $this->view('addinfo', $data);
                    }
                } else {
                    // Render the form to add additional information
                    $this->view('addinfo', $data);
                }
            
        }
        

    
        

    }