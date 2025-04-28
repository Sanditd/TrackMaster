<?php
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];


 require_once __DIR__ . '/../../model/loginPage.php';

$loginModel = new loginPage();

$user = $loginModel->getUserById($userId);


if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}




$Success_message = "";
$Error_message = "";

if (isset($_SESSION['success_message'])) {
    $Success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    $Error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/sidebar.css">
</head>
<body>

    <div id="sidebar" class="sidebar">
        <span class="close" onmouseleave="closeNav()">
        <div class="profile">
            <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture">
            <div style="font-size:15px;font-weight:bold;white-space: nowrap;"> <?php echo $username ?></div>
            <br>
            <div style="font-size:10px;white-space: nowrap;">School</div>
            
            <br>
            <hr>
        </div>

        <nav>
            <ul>
                <li><a href="<?php echo URLROOT ?>/School/Dashboard">Dashboard</a></li>
                <li><a href="<?php echo URLROOT ?>/School/Profile">My Profile</a></li>
                <li><a href="<?php echo URLROOT ?>/School/StudentsData">Student Records</a></li>
                <li><a href="<?php echo URLROOT ?>/School/records">Acedemic Records</a></li>
                <li><a href="<?php echo URLROOT ?>/School/requests">Request Management</a></li>
                <li><a href="<?php echo URLROOT ?>/School/facility">Facility Management</a></li>
                
            </ul>
        </nav>
        </span>
    </div>
    <script src="/TrackMaster/Public/js/sidebar.js"></script>
<script src="/TrackMaster/Public/js/profile.js"></script>

</body>
</html>