<?php
class loginController extends Controller {

    private $login;

    public function __construct() {
        $this->login = $this->model('loginPage');
    }

    public function index() {
        // Placeholder for the default method
    }


        public function login() {
            $error = ''; // Error message if login fails
        
            // Check if form is submitted
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get the username and password from the form
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';
        
                // Check if both fields are filled
                if (empty($username) || empty($password)) {
                    $error = 'Please fill in both fields.';
                } else {
                    // Attempt to login with the provided credentials
                    $user = $this->login->checkLoginCredentials($username, $password);  
                    // If user is found and credentials are correct
                    if ($user) {
                        // Start session and store user information
                        
                        $_SESSION['user_id'] = $user->user_id; // Corrected to object access
                        $_SESSION['role'] = $user->role; // Storing the user's role in session
        
                        // Redirect to the appropriate dashboard based on the role
                        switch ($user->role) {
                            case 'admin':
                                $this->view('admin/dashboard');
                                break;
                            case 'coach':
                                $this->view('coach/dashboard');
                                break;
                            case 'player':
                                $this->view('student/Dashboard');
                                break;
                            case 'school':
                                $this->view('school/school');
                                break;
                            case 'parent':
                                $this->view('parent/dashboard');
                                break;
                            default:
                                header('Location: ' . ROOT . '/userController/dashboard');
                                break;
                        }
                        exit;
                    } else {
                        // Redirect to the sign-up page if login fails
                        header('Location: ' . ROOT . '/loginController/login');
                        exit;

                    }
                    
                    
                }
            }

        
            // Load the login view (HTML)
            $this->view('/Admin/login', ['error' => $error]);

        }


        public function adminLogin() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            } else {
                session_unset();     // Remove all session variables
                session_destroy();   // Destroy the session
                session_start();     // Start a fresh session again
            }
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';
        
                if (empty($username) || empty($password)) {
                    $_SESSION['error_message'] = 'Please fill in both fields.';
                    header('Location: ' . ROOT . '/logincontroller/adminLogin');
                    exit;
                } else {
                    $user = $this->login->checkAdminLoginCredentials($username, $password);
        
                    if ($user) {
                        $_SESSION['user_id'] = $user->admin_id;
                        $_SESSION['role'] = 'Admin';
                        $_SESSION['username'] = $user->username; // Store username in session
                        header('Location: ' . ROOT . '/admin/Dashboard');
                        exit;
                    }
        
                    $_SESSION['error_message'] = "Login Failed! Try Again.";
                    header('Location: ' . ROOT . '/logincontroller/adminLogin');
                    exit;
                }
            }
        
            $this->view('Admin/adminLogin');
        }
        
        

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            session_destroy();

            header('Location: ' . ROOT . '/loginController/login');
                        exit;
        }

    }

?>