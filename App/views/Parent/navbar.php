

<?php
//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];


//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getUserById($userId);


//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/notification.css">
    <link rel="stylesheet" href="/TrackMaster/public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="<?php echo ROOT?>/Public/js/notification.js"></script>

</head>
<body>
    <header>
        <nav class="navbar">
            <button class="openbtn" onclick="toggleNav()"><i class="fas fa-bars"></i></button>
            <div class="logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="TrackMaster Logo">
            </div>
            <ul class="nav-links">
            <li><a href="<?php echo URLROOT ?>/loginController/login"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="<?php echo URLROOT ?>/common/aboutUs"><i class="fas fa-info-circle"></i> About Us</a></li>
    <li><a href="<?php echo URLROOT ?>/common/help"><i class="fas fa-headset"></i> Help & Support</a></li> 
               
                        </div>
                    </div>
                </div>
            </li>
                <li></li>
                <li>
                <li><button class="login" onclick="window.location.href='<?php echo URLROOT ?>/loginController/logout'"><i class="fas fa-sign-out-alt"></i> LogOut</button></li>

                    </button>
                </li>
            </ul>
        </nav>
    </header>
    <script>
        function toggleNav() {
            const navLinks = document.querySelector(".nav-links");
            navLinks.classList.toggle("active");
        }
    </script>
</body>
</html>