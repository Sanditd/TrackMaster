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
    <title>Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
</head>
<body>

<header>
        <button class="openbtn" onclick="toggleNav()">☰ </button>

        <nav class="navbar" id="navbar">
            <div class="logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="Logo"> 
            </div>
            <ul class="nav-links">
                <li><a href="<?php echo URLROOT ?>/loginController/login">Home</a></li>
                <li><a href="<?php echo URLROOT ?>/common/aboutUs">About Us</a></li>
                <li><a href="<?php echo URLROOT ?>/common/help">Help & Support</a></li>    
                <li><button class="login" onclick="window.location.href='<?php echo URLROOT ?>/loginController/logout'">LogOut</button></li>
                <li><img src="/TrackMaster/Public/img/log in.png" alt="Logo"> </li>
                <li><img src="/TrackMaster/Public/img/notification.png" alt="Logo"> </li>
            </ul>
        </nav>
    </header>
    
</body>
</html>
