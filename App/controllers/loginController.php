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
                        $_SESSION['username'] = $user->username; 
                        $_SESSION['role'] = $user->role; // Storing the user's role in session// Corrected to object access
                        // $_SESSION['role'] = $user->role; // Storing the user's role in session
        
                        // Redirect to the appropriate dashboard based on the role
                        switch ($user->role) {
                            case 'admin':
                                header('Location: ' . ROOT . '/admin/dashboard/ads');
                                break;
                            case 'coach':
                                header('Location: ' . ROOT . '/Coach/Dashboard');
                                break;
                            case 'student':
                                header('Location: ' . ROOT . '/student/dashboard');
                                break;
                            case 'school':
                                header('Location: ' . ROOT . '/school/dashboard');
                                break;
                            case 'parent':
                                header('Location: ' . ROOT . '/guardian/dashboard');
                                break;
                            default:
                                header('Location: ' . ROOT . '/userController/dashboard');
                                break;
                        }
                        exit;
                    } else {
                        // Redirect to the sign-up page if login fails
                        header('Location: ' . ROOT . '/signUpController/signUp');
                        exit;

                    }
                    
                    
                }
            }

        
            // Load the login view (HTML)
            $this->view('/Admin/login', ['error' => $error]);

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