    <?php
    session_start(); 

    class SignUpController extends Controller {
        private $userModel;

        public function __construct() {
            $this->userModel = $this->model('User');
        }


        public function studentsignupview() {
    

            $sports = $this->userModel->getSports();
            $schools = $this->userModel->getSchools();

            $data = [
                'sports' => $sports,
                'schools' => $schools,
            ];

            $this->view('SignUp/StudentSignup', $data);
        }

        public function coachsignupview() {
    

            $sports = $this->userModel->getSports();

            $data = [
                'sports' => $sports,
            ];

            $this->view('SignUp/CoachSignup', $data);
        }

        public function schoolsignupview() {

            $data = [];
            

            $this->view('SignUp/SchoolSignup');
        }

        public function parentsignupview() {

            $data = [];
            

            $this->view('SignUp/ParentSignup');
        }

        public function selectrole() {

            $data = [];
            

            $this->view('SignUp/SelectRole');
        }
        



        public function studentsignup() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Collect and sanitize form data
                $firstname = trim($_POST['firstname']);
                $lastname = trim($_POST['lastname']);
                $email = trim($_POST['email']);
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $confirmPassword = trim($_POST['confirm-password']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $age = trim($_POST['age']);
                $zone = trim($_POST['zone']);
                $bio = trim($_POST['bio']);
                $parentName = trim($_POST['parent-name']);
                $schoolName = trim($_POST['school']);  // The school name entered by the user
                $sportName = trim($_POST['sport']); 
                $photo = $_FILES['photo'];
    
                // Validate password match
                if ($password !== $confirmPassword) {
                    // Handle password mismatch (redirect with error)
                    $_SESSION['error'] = "Passwords do not match!";
                    header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                    exit;
                }
    
                // Handle file upload (photo)
                $photoData = null;
                if ($photo['size'] > 0) {
                    $photoData = file_get_contents($photo['tmp_name']);
                }

                $sportId = $this->userModel->getSportIdByName($sportName);
                $schoolId = $this->userModel->getSchoolIdByName($schoolName);

                
        
                if (!$sportId || !$schoolId) {
                    $_SESSION['error'] = "Selected sport or school is invalid.";
                    header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                    exit;
                }
                // Insert user data
                if ($this->userModel->insertUser($firstname, $lastname, $email, $username, $password, $phone, $address, $dob, $gender, $age, $photoData, 'student')) {
                    // Get the user_id of the newly inserted user
                    $userId = $this->userModel->lastInsertId();
    
                    // Insert player data
                    $this->userModel->insertPlayer($userId, $sportId, $schoolId, $zone, $bio, $parentName);
    
                    // Redirect or display success message
                    $_SESSION['success'] = "Sign up successful!";
                    header('Location: ' . ROOT . '/logincontroller/login'); // Redirect to login page
                    exit;   
                } else {
                    // Handle error in user insertion
                    $_SESSION['error'] = "An error occurred during signup!";
                    header('Location: ' . ROOT . '/signupcontroller/studentsignupview');
                    exit;
                }
            }
        }

        public function coachsignup() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Collect and sanitize form data
                $firstname = trim($_POST['firstname']);
                $lastname = trim($_POST['lastname']);
                $email = trim($_POST['email']);
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $confirmPassword = trim($_POST['confirm-password']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $age = trim($_POST['age']);
                $zone = trim($_POST['zone']);
                $sportName = trim($_POST['sport']); 
                $coach_type =trim($_POST['coach_type']);
                $educational_qualifications = trim($_POST['educational_qualifications']);
                $professional_playing_experience = trim($_POST['professional_playing_experience']);
                $coaching_experience = trim($_POST['coaching_experience']);
                $technical_specializations = trim($_POST['technical_specializations']);
                $key_achievements = trim($_POST['key_achievements']);
                $bio = trim($_POST['bio']);
                $photo = $_FILES['photo'];

    
                // Validate password match
                if ($password !== $confirmPassword) {
                    // Handle password mismatch (redirect with error)
                    $_SESSION['error'] = "Passwords do not match!";
                    header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                    exit;
                }
    
                // Handle file upload (photo)
                $photoData = null;
                if ($photo['size'] > 0) {
                    $photoData = file_get_contents($photo['tmp_name']);
                }

                $sportId = $this->userModel->getSportIdByName($sportName);

                
        
                if (!$sportId) {
                    $_SESSION['error'] = "Selected sport is invalid.";
                    header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                    exit;
                }
                // Insert user data
                if ($this->userModel->insertUser($firstname, $lastname, $email, $username, $password, $phone, $address, $dob, $gender, $age, $photoData, 'coach')) {
                    // Get the user_id of the newly inserted user
                    $userId = $this->userModel->lastInsertId();
    
                    // Insert player data
                    $this->userModel->insertCoach($userId, $sportId, $zone, $coach_type, $educational_qualifications, $professional_playing_experience, $coaching_experience, $technical_specializations, $key_achievements, $bio);
    
                    // Redirect or display success message
                    $_SESSION['success'] = "Sign up successful!";
                    header('Location: ' . ROOT . '/logincontroller/login'); // Redirect to login page
                    exit;   
                } else {
                    // Handle error in user insertion
                    $_SESSION['error'] = "An error occurred during signup!";
                    header('Location: ' . ROOT . '/signupcontroller/coachsignupview');
                    exit;
                }
            }
        }

        public function schoolsignup() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Collect and sanitize form data
                $firstname = trim($_POST['firstname']);
                $lastname = trim($_POST['lastname']);
                $email = trim($_POST['email']);
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $confirmPassword = trim($_POST['confirm-password']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $age = trim($_POST['age']);
                $school_name = trim($_POST['school_name']);
                $school_email = trim($_POST['school_email']); 
                $bio = trim($_POST['bio']);
                $facilities = trim($_POST['facilities']);
                $photo = $_FILES['photo'];

    
                // Validate password match
                if ($password !== $confirmPassword) {
                    // Handle password mismatch (redirect with error)
                    $_SESSION['error'] = "Passwords do not match!";
                    header('Location: ' . ROOT . '/signupcontroller/schoolsignupview');
                    exit;
                }
    
                // Handle file upload (photo)
                $photoData = null;
                if ($photo['size'] > 0) {
                    $photoData = file_get_contents($photo['tmp_name']);
                }

                // Insert user data
                if ($this->userModel->insertUser($firstname, $lastname, $email, $username, $password, $phone, $address, $dob, $gender, $age, $photoData, 'school')) {
                    // Get the user_id of the newly inserted user
                    $userId = $this->userModel->lastInsertId();
    
                    // Insert player data
                    $this->userModel->insertSchool($userId, $school_name, $school_email, $bio, $facilities);
    
                    // Redirect or display success message
                    $_SESSION['success'] = "Sign up successful!";
                    header('Location: ' . ROOT . '/logincontroller/login'); // Redirect to login page
                    exit;   
                } else {
                    // Handle error in user insertion
                    $_SESSION['error'] = "An error occurred during signup!";
                    header('Location: ' . ROOT . '/signupcontroller/schoolsignupview');
                    exit;
                }
            }
        }
    }
    ?>
