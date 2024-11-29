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
                error_log("Form submitted");
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
                    'role' => FILTER_SANITIZE_STRING,
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
                    'cpassword' => trim($_POST['password']),
                    'coach_type' => trim($_POST['coach_type']),
                    'description' => trim($_POST['description']),
                    'division' => trim($_POST['division']),
                    'sport' => trim($_POST['sport']),
                    'age' => trim($_POST['age']),
                    'dob' => trim($_POST['dob']),
                    'level' => trim($_POST['level']),
                    'school' => trim($_POST['school']),
                    'student' => trim($_POST['password']),
                    
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
                }else{
                    if (
                        empty($data['fname']) || empty($data['lname']) || empty($data['address']) || 
                        empty($data['pnum']) || empty($data['email']) || empty($data['password']) || 
                        empty($data['cpassword'])
                    ) {
                        $data['error'] = "Please fill all the fields";
                    }
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
                    header('Location: ' . ROOT . '/loginController/login/asdd');
                    exit;
                } else {
                    $data['error'] = 'Something went wrong while adding your information.';
                    $this->view('/Admin/signUp', $data);
                }
            } else {

            $divisions=$this->signUp->getDiv();
            $provinces=$this->signUp->getProv();
            $sports=$this->signUp->getSports();
            $schools=$this->signUp->getSchools();


            if (!$provinces) {
                $data = [
                    'error' => 'Provinces not founded.',
                ];
                $this->view('/Admin/signUp', $data);
                return;
            }
            
            if(!$divisions){
                $data=[
                    'error'=> 'Divisions not founded'
                ];
                $this->view('/Admin/signUp', $data);
                return;
            }

            if(!$sports){
                $data=[
                    'error'=> 'Sports not founded'
                ];
                $this->view('/Admin/signUp', $data);
                return;
            }

            if(!$schools){
                $data=[
                    'error'=> 'Schools not founded'
                ];
                $this->view('/Admin/signUp', $data);
                return;
            }

            $data = [
                'divisions' => $divisions,
                'provinces' => $provinces,
                'sports' => $sports,
                'schools' => $schools,
                'role' => '',
                'username' => '',
                'fname' => '',
                'lname' => '',
                'address' => '',
                'pnum' => '',
                'email' => '',
                'password' => '',
                'cpassword' => '',
                'error' => ''
            ];
        
                $this->view('/Admin/signUp', $data);
            }
        }
        

    
        

    }