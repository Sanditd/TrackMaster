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
                        session_start();
                        $_SESSION['user_id'] = $user->userId; // Corrected to object access
                        $_SESSION['username'] = $user->userName; // Corrected to object access
                        // $_SESSION['role'] = $user->role; // Storing the user's role in session
        
                        // Redirect to the appropriate dashboard based on the role
                        switch ($user->role) {
                            case 'Admin':
                                header('Location: ' . ROOT . '/admin/dashboard/ads');
                                break;
                            case 'Coach':
                                header('Location: ' . ROOT . '/Coach/Dashboard/sasad');
                                break;
                            case 'Player':
                                header('Location: ' . ROOT . '/student/dashboard/sadss');
                                break;
                            case 'school':
                                header('Location: ' . ROOT . '/schoolController/dashboard');
                                break;
                            case 'parent':
                                header('Location: ' . ROOT . '/parentController/dashboard');
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
                    exit;
                } else {
                    $error = 'Invalid credentials. Please try again.';
                }
            }

        
            // Load the login view (HTML)
            $this->view('/Admin/login', ['error' => $error]);

        }

        // Load the login view (HTML)
        $this->view('Admin/login', ['error' => $error]);
    }

    public function logout() {
        // Start session and destroy it
        session_start();
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session

        // Redirect to the login page
        header('Location: ' . ROOT . '/loginController/login');
        exit;
    }
}
?>
