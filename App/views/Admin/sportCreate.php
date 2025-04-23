<!DOCTYPE html>
<html lang="en">

<?php
//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

$userId = (int) $_SESSION['user_id'];

//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getAdminById($userId);

$userActive = $loginModel->getAdminActivation($userId);

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

$Error_message  = "";

if (isset($_SESSION['success_message'])) {
    $Error_message  .= $_SESSION['success_message'] . " ";
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    $Error_message  .= $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Sport</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/sportCreate.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/popupSport.css">
</head>

<body>
    <?php require_once "adminNav.php"; ?>

    <div id="popup" class="popup-modal">
        <div class="popup-content">
            <h2>Select Sport Type</h2>
            <button id="teamSportBtn" style="background-color: aqua;">
            <a href="<?php echo ROOT ?>/admin/teamSportForm/asdad" style="color: black;">Team Sports</a>

            </button>
            <button id="individualSportBtn" style="background-color: aqua;">
                <a href="<?php echo ROOT ?>/admin/addindSportForm/asdad" style="color: black;">Individual Sports</a>
            </button>
            <button id="close">
                <a href="<?php echo ROOT ?>/admin/dashboard/asdad" style="text-decoration: none; color: inherit;">Close</a>
            </button>
        </div>
    </div>

    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>


    <!-- ✅ JavaScript Placement Fixed -->
    <script>
        var errorMessage = <?= json_encode(trim($Error_message )); ?>;
        console.log(errorMessage);
        console.log("Error Message:", errorMessage);
console.log("Overlay Element:", document.getElementById('customAlertOverlay'));
console.log("Message Element:", document.getElementById('customAlertMessage'));

    </script>

    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>
    <script src="<?php echo ROOT?>/Public/js/error.js">
        console.log("error.js is loaded successfully");

    </script> <!-- ✅ Ensure this is a JS file -->
    

</body>
</html>
