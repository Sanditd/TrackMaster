<?php
class loginController extends Controller {

    private $login;
    private $zonalModel;

    public function __construct() {
        $this->login = $this->model('loginPage');
        $this->zonalModel=$this->model('zoneModel');
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

                        
                        if($user->active==0){
                            $_SESSION['error_message']='User not activate. Contact System Administrator';
                            header('Location: ' . ROOT . '/loginController/login');
                            exit;
                        }

                        if($user->active==2){
                            $_SESSION['error_message']='Your account rejected by System Admonostrator';
                            header('Location: ' . ROOT . '/loginController/login');
                            exit;
                        }


                        // Start session and store user information
                        
                        $_SESSION['user_id'] = $user->user_id; // Corrected to object access

                        $_SESSION['active'] = $user->active; // Storing the user's account activation status
                        $_SESSION['username']= $user->username;

                       

        
                        // Redirect to the appropriate dashboard based on the role
                        switch ($user->role) {
                            case 'admin':
                                $this->view('admin/dashboard');
                                break;
                            case 'coach':
                                    $zone=$this->zonalModel->checkCoachInZone($user->user_id);

                                    if(!$zone){
                                        $_SESSION['error_message']='You not assign for any sport. Contact System Administrator';
                                        header('Location: ' . ROOT . '/loginController/login');
                                        exit;
                                    }
                                    
                                    session_write_close();
                                    header('Location: ' . URLROOT . '/coach/dashboard');
                                    exit;
                                
                            case 'player':
                                    session_write_close();
                                    header('Location: ' . URLROOT . '/Student/studentDashboard');
                                    exit;
                                
                            case 'school':
                            session_write_close();
                            header('Location: ' . URLROOT . '/school/Dashboard');
                            exit;
                        

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
                        $_SESSION['error_message']='Username or Password incorrect';
                        header('Location: ' . ROOT . '/loginController/login');
                        exit;

                    }
                    
                    
                }
            }

        
            // Load the login view (HTML)
            
            $this->view('/Admin/login',);

        }


        public function adminLogin() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = trim($_POST['username'] ?? '');
                $password = trim($_POST['password'] ?? '');
        
                // Validation
                if (empty($username) && empty($password)) {
                    $_SESSION['error_message'] = 'Username and Password are required.';
                    header('Location: ' . ROOT . '/loginController/adminLogin');
                    exit;
                } elseif (empty($username)) {
                    $_SESSION['error_message'] = 'Please enter your username.';
                    header('Location: ' . ROOT . '/loginController/adminLogin');
                    exit;
                } elseif (empty($password)) {
                    $_SESSION['error_message'] = 'Please enter your password.';
                    header('Location: ' . ROOT . '/loginController/adminLogin');
                    exit;
                }
        
                // Check user credentials
                $user = $this->login->checkAdminLoginCredentials($username, $password);
        
                if ($user) {
                    $_SESSION['user_id'] = $user->admin_id;
                    $_SESSION['role'] = 'Admin';
                    $_SESSION['username'] = $user->username; // Store username in session
                    header('Location: ' . ROOT . '/admin/Dashboard');
                    exit;
                } else {
                    $_SESSION['error_message'] = 'Invalid username or password.';
                    header('Location: ' . ROOT . '/loginController/adminLogin');
                    exit;
                }
            }
        
            // Just show the login page normally if GET request
            $this->view('Admin/adminLogin');
        }
        
        
        

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            session_destroy();

            header('Location: ' . ROOT . '/loginController/login');
                        exit;
        }

        public function adminLogout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            session_destroy();

            header('Location: ' . ROOT . '/loginController/adminLogin');
                        exit;
        }

        public function resetAdminPassword() {
            session_start(); // just in case, if not already started
        
            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['error_message']='Invalid Login! Please login again.';
                header('Location: ' . ROOT . '/loginController/adminLogin');
                exit;
            }
            
            $userId = (int) $_SESSION['user_id'];
            
            
            $user = $this->login->getAdminById($userId);
            
            $userActive = $this->login->getAdminActivation($userId);
            
            //If user does not exist in DB, destroy session and redirect
            if (!$user) {
                session_unset();
                session_destroy();
                $_SESSION['error_message']='Login Failed! Try Again.';
                header('Location: ' . ROOT . '/loginController/adminLogin');
                exit;
            }
            
            //check user account active status
            if ($userActive[0]->active != 1) {
                $_SESSION['error_message'] = 'Login Failed! Try Again.';
                session_unset();
                session_destroy();
                header('Location: ' . ROOT . '/loginController/adminLogin');
                exit;
            }
        
            // Validate POST data
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userId = (int) $_SESSION['user_id'];
        
                $currentPassword = $_POST['currentPassword'] ?? '';
                $newPassword = $_POST['password'] ?? '';
                $confirmPassword = $_POST['confirmPassword'] ?? '';
        
                // Basic validation
                if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                    $_SESSION['error_message'] = 'Please fill in all fields!';
                    header('Location: ' . ROOT . '/admin/accountSetting');
                    exit;
                }
        
                if ($newPassword !== $confirmPassword) {
                    $_SESSION['error_message'] = 'New passwords do not match!';
                    header('Location: ' . ROOT . '/admin/accountSetting');
                    exit;
                }
    
        
                // Fetch current user
                $user = $this->login->getAdminById($userId);
        
                if (!$user) {
                    $_SESSION['error_message'] = 'User not found!';
                    header('Location: ' . ROOT . '/login/adminLogin');
                    exit;
                }
        
                // Verify current password
                if (!password_verify($currentPassword, $user[0]->password)) {
                    $_SESSION['error_message'] = 'Current password is incorrect!';
                    header('Location: ' . ROOT . '/admin/accountSetting');
                    exit;
                }
        
                // Hash new password
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        
                // Update password in database
                $result = $this->login->updateAdminPassword($userId, $newPasswordHash);
        
                if ($result) {
                    $_SESSION['success_message'] = 'Password updated successfully!';
                } else {
                    $_SESSION['error_message'] = 'Failed to update password. Please try again.';
                }
        
                header('Location: ' . ROOT . '/admin/accountSetting');
                exit;
            } else {
                $_SESSION['error_message'] = 'Invalid Request!';
                header('Location: ' . ROOT . '/admin/accountSetting');
                exit;
            }
        }

        Public function userLoginReset(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
                $username = $_POST['username'] ?? '';
                $email = $_POST['email'] ?? '';
                $phone = $_POST['phone'] ?? '';
                $newPassword = $_POST['password'] ?? '';
                $confirmPassword = $_POST['confirmPassword'] ?? '';
        
                // Basic validation
                if (empty($newPassword) || empty($confirmPassword)) {
                    $_SESSION['error_message'] = 'Please fill in all fields!';
                    header('Location: ' . ROOT . '/admin/login');
                    exit;
                }
        
                if ($newPassword !== $confirmPassword) {
                    $_SESSION['error_message'] = 'New passwords do not match!';
                    header('Location: ' . ROOT . '/admin/login');
                    exit;
                }
    
        
                // Fetch current user
                $user = $this->login->checkUserByEmail($username, $email, $phone);
        
                if (!$user) {
                    $_SESSION['error_message'] = 'User not found!';
                    header('Location: ' . ROOT . '/admin/login');
                    exit;
                }

                $userId=$user->user_id;
        
                // Verify current password
                // if (!password_verify($currentPassword, $user[0]->password)) {
                //     $_SESSION['error_message'] = 'Current password is incorrect!';
                //     header('Location: ' . ROOT . '/admin/accountSetting');
                //     exit;
                // }
        
                // Hash new password
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        
                // Update password in database
                $result = $this->login->updateUserPassword($userId, $newPasswordHash);
        
                if ($result) {
                    $_SESSION['success_message'] = 'Password reset successfully!';
                } else {
                    $_SESSION['error_message'] = 'Failed to update password. Please try again.';
                }
        
                header('Location: ' . ROOT . '/admin/login');
                exit;
            } else {
                $_SESSION['error_message'] = 'Invalid Request!';
                header('Location: ' . ROOT . '/admin/login');
                exit;
            }
        }
        

    }

?>