    <?php
    session_start(); 

    class SignUpController extends Controller {
        private $userModel;

        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function signupview() {
            $this->view('SignUp/CoachSignup');
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

        public function signup() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Ensure a user model instance is used
                $userModel = new User();

                // Handling the photo upload
                $photo = null;
                if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                    $photo = file_get_contents($_FILES['photo']['tmp_name']);
                }

                $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $data = [
                    'firstname' => $_POST['firstname'],
                    'lname' => $_POST['lastname'],
                    'phonenumber' => $_POST['phone'],
                    'address' => $_POST['address'],
                    'email' => $_POST['email'],
                    'password' => $passwordHash,
                    'username' => $_POST['username'],
                    'photo' => $photo,
                    'age' => $_POST['age'],
                    'dob' => $_POST['dob'],
                    'gender' => $_POST['gender']
                ];

                if ($userModel->createUser($data)) {
                    header('Location: ' . ROOT . '/logincontroller/login');
                    exit;
                } else {
                    echo "Error: Could not sign up.";
                }   
            } else {
                $this->signupview();
            }
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
    }
    ?>
