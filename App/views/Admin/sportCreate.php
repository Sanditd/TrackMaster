<!DOCTYPE html>
<html lang="en">

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
    <link rel="stylesheet" href="../../Public/css/Admin/sportCreate.css">
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="../../Public/css/Admin/popupSport.css">
</head>

<body>
    <?php require_once "adminNav.php"; ?>

    <div id="popup" class="popup-modal">
        <div class="popup-content">
            <h2>Select Sport Type</h2>
            <button id="teamSportBtn">
                <a href="<?php echo ROOT ?>/admin/teamSportForm/asdad">Team Sports</a>
            </button>
            <button id="individualSportBtn">
                <a href="<?php echo ROOT ?>/admin/addindSportForm/asdad">Individual Sports</a>
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

    <script src="../../Public/js/Admin/sidebar.js"></script>
    <script src="<?php echo ROOT?>/Public/js/error.js">
        console.log("error.js is loaded successfully");

    </script> <!-- ✅ Ensure this is a JS file -->
    

</body>
</html>
