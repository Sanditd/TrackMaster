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

$zones = $zones ?? [];
$sports = $sports ?? [];
$zonalSports = $zonalSports ?? [];
$users = $users ?? [];
$FromCoaches = $FromCoaches ?? [];

// Restructure zonalSports to [zoneId][sportId] => coachId
$formattedZonalSports = [];
foreach ($zonalSports as $zs) {
    $zid = $zs->zone_id;
    $sid = $zs->sport_id;
    $cid = $zs->coach_id;
    $formattedZonalSports[$zid][$sid] = $cid;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Coach Assignment</title>
    <link rel="stylesheet" href="<?= ROOT ?>/Public/css/Admin/navbar.css">
    <!-- <link rel="stylesheet" href="<?= ROOT ?>/Public/css/Admin/zoneManage.css"> -->
    <link rel="stylesheet" href="<?= ROOT ?>/Public/css/Admin/zonalSport.css">
    <script src="<?= ROOT ?>/Public/js/Admin/sidebar.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
</head>

<body>
<div id="customAlertOverlay">
    <div id="customAlertBox">
        <h2>Notice</h2>
        <p id="customAlertMessage"></p>
        <button onclick="hideCustomAlert()">OK</button>
    </div>
</div>

<div class="adminNav"><?php require_once 'adminNav.php' ?></div>

<div class="main-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title"><i class="fas fa-user-friends"></i> Sports Coach Assignment</h1>
        </div>
        
        <div class="steps-container">
            <div class="step active">
                <div class="step-number">1</div>
                <div class="step-text">Select Location</div>
            </div>
            <div class="step" id="step2">
                <div class="step-number">2</div>
                <div class="step-text">Assign Coaches</div>
            </div>
            <div class="step" id="step3">
                <div class="step-number">3</div>
                <div class="step-text">Confirm & Save</div>
            </div>
        </div>

        <div class="filter-container">
            <div class="filters">
                <div class="filter-column">
                    <label class="filter-label" for="provinceDropdown">
                        <i class="fas fa-map-marker-alt"></i> Province
                    </label>
                    <select id="provinceDropdown" class="form-select">
                        <option value="">-- Select Province --</option>
                    </select>
                </div>
                
                <div class="filter-column">
                    <label class="filter-label" for="districtDropdown">
                        <i class="fas fa-map"></i> District
                    </label>
                    <select id="districtDropdown" class="form-select" disabled>
                        <option value="">-- Select District --</option>
                    </select>
                </div>
                
                <div class="filter-column">
                    <label class="filter-label" for="zoneDropdown">
                        <i class="fas fa-location-arrow"></i> Zone
                    </label>
                    <select id="zoneDropdown" class="form-select" disabled>
                        <option value="">-- Select Zone --</option>
                    </select>
                </div>
            </div>
        </div>

        <form id="zonalForm" method="post" action="<?= ROOT ?>/admin/zonalSport">
            <div id="assignmentContainer">
                <div class="assignment-empty" id="emptyState">
                    <i class="fas fa-search fa-3x" style="color: #ddd; margin-bottom: 15px;"></i>
                    <p>Select a zone to view and assign coaches to sports</p>
                </div>
                
                <table class="assignment-table" id="assignmentTable" style="display: none;">
                    <thead>
                        <tr>
                            <th width="25%">Zone</th>
                            <th width="25%">Sport</th>
                            <th width="50%">Coach</th>
                        </tr>
                    </thead>
                    <tbody id="zoneTableBody"></tbody>
                </table>
            </div>
            
            <div id="summaryContainer" style="display: none;" class="summary-container">
                <div class="summary-title"><i class="fas fa-clipboard-check"></i> Assignment Summary</div>
                <div id="summaryContent"></div>
            </div>

            <div style="display: flex; justify-content: center;">
                <button type="submit" class="submit-btn" id="submitBtn" style="display: none;">
                    <i class="fas fa-save btn-icon"></i> Save Assignments
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    
const zones = <?= json_encode($zones) ?>;
const sports = <?= json_encode($sports) ?>;
const coachesData = <?= json_encode($FromCoaches) ?>;
const users = <?= json_encode($users) ?>;
const zonalSports = <?= json_encode($formattedZonalSports) ?>;
</script>

<script id="error-message" type="application/json"><?= json_encode(trim($Error_message)) ?></script>
<script id="success-message" type="application/json"><?= json_encode(trim($Success_message)) ?></script>
<script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>
<script src="<?php echo ROOT?>/Public/js/Admin/zonalSport.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const errorMessage = JSON.parse(document.getElementById('error-message').textContent);
    const successMessage = JSON.parse(document.getElementById('success-message').textContent);

    if (errorMessage) {
        showCustomAlert(errorMessage);
    }

    if (successMessage) {
        showCustomAlert(successMessage);
    }
});
</script>
</body>
</html>