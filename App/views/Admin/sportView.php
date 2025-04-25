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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sport Details</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/sportView.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>
    <script src="<?php echo ROOT?>/Public/js/Admin/sportView.js" defer></script>
</head>

<body>
    <?php require_once "adminNav.php"; ?>

    <?php 
    // Check if sportType exists in the $sport array
    if (isset($sport['sportType'])) {
        if ($sport['sportType'] === 'teamSport') {
            // Include team sport view
            require_once 'teamSportView.php';
        } elseif ($sport['sportType'] === 'Individual Sport') {
            // Include individual sport view
            require_once 'indSportView.php';
        } else {
            // Default case if sportType doesn't match
            echo '<p>Sport type is not recognized.</p>';
        }
    } else {
        echo '<p>Sport type not specified or data missing.</p>';
    }
    ?>

    <!-- Edit Popup Form -->
    <div id="editPopup" class="edit-popup">
        <div class="edit-popup-content">
            <h2>Edit Details</h2>
            <label for="editValue">New Value:</label>
            <input type="text" id="editValue">
            <button onclick="saveEdit()">Save</button>
            <button onclick="closeEditPopup()">Cancel</button>
        </div>
    </div>
</body>

</html>
