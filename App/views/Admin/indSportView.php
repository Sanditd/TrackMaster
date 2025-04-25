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


$Success_message = $_SESSION['success_message'] ?? '';
$Error_message = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);

// These are already passed from controller
$sport = $sport ?? null;
$game_types = $game_types ?? [];
$rules = $rules ?? [];

$sport_id = $sport->sport_id ?? null;
$sport_name = $sport->sport_name ?? 'Individual Sport Details';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($sport_name) ?> Details</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/sportView.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>
</head>

<body>
    <div class="adminNav">
        <?php require_once 'adminNav.php' ?>
    </div>

    <div id="frame" style="margin-top: 100px; margin-left:100px">
        <div class="container">
            <!-- New Header Section -->
            <div class="sport-header">
                <h1><?= htmlspecialchars($sport_name) ?></h1>
            </div>
            
            <div class="temp-container">
                <div id="signup-port">
                    <!-- <?php if (!empty($Success_message)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($Success_message) ?></div>
                    <?php endif; ?>

                    <?php if (!empty($Error_message)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($Error_message) ?></div>
                    <?php endif; ?> -->

                    <form method="post">
                        <div class="temp2-container">
                            <div class="column">
                                <h3>Sport Details</h3><br>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Sport Name:</label>
                                        <span><?= htmlspecialchars($sport->sport_name ?? 'N/A') ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Base:</label>
                                        <span><?= htmlspecialchars($sport->base ?? 'N/A') ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Scoring Method:</label>
                                        <span><?= htmlspecialchars($sport->scoring_method ?? 'N/A') ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Classification Categories</label>
                                    <div class="input-group" style="margin-top: 10px;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Class Name</th>
                                                    <th>Maximum Limit</th>
                                                    <th>Minimum Limit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($game_types)): ?>
                                                <?php foreach ($game_types as $game): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($game->game_format ?? 'N/A') ?></td>
                                                    <td>
                                                        <?php
                                                        if ($sport->base === 'Age') {
                                                            echo htmlspecialchars(($game->max ?? 'N/A') . ' years');
                                                        } elseif ($sport->base === 'Height') {
                                                            echo htmlspecialchars(($game->max ?? 'N/A') . ' meter');
                                                        } elseif ($sport->base === 'Weight') {
                                                            echo htmlspecialchars(($game->max ?? 'N/A') . ' Kg');
                                                        } else {
                                                            echo htmlspecialchars($game->max ?? 'N/A');
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($sport->base === 'Age') {
                                                            echo htmlspecialchars(($game->min ?? 'N/A') . ' years');
                                                        } elseif ($sport->base === 'Height') {
                                                            echo htmlspecialchars(($game->min ?? 'N/A') . ' meter');
                                                        } elseif ($sport->base === 'Weight') {
                                                            echo htmlspecialchars(($game->min ?? 'N/A') . ' Kg');
                                                        } else {
                                                            echo htmlspecialchars($game->min ?? 'N/A');
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td colspan="3">No classifications available.</td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="column">
                                <h3>Rules</h3><br>
                                <div class="form-group">
                                    <div class="input-group" style="background-color: #f5f5f5; padding: 15px; border-radius: 5px;">
                                        <?php if (!empty($rules)): ?>
                                        <?php foreach ($rules as $index => $rule): ?>
                                        <div style="margin-bottom: 15px;">
                                            <strong><?= $index + 1 ?>.</strong>
                                            <?= nl2br(htmlspecialchars($rule->rule ?? 'No description available.')) ?>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <div>No rules available for this sport.</div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div style="margin-top: 30px; display: flex; justify-content: space-between;">
                                    <button type="button" style="background-color:#007BFF; width:30%" 
                                        onclick="updateTeamSport(<?= $sport_id ?>)">
                                        Edit Sport
                                    </button>

                                    <button type="submit" style="background-color:#d10909; width:30%" name="action"
                                        value="delete">Delete Sport</button>
                                        
                                    <button type="button" style="background-color:#6c757d; width:30%" name="action"
                                        value="back" onclick="goBackToManage()">Back to List</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Alert Box -->
    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button id="customAlertOkBtn">OK</button>
        </div>
    </div>

    <script id="error-message" type="application/json">
    <?= json_encode(trim($Error_message)) ?>
    </script>

    <script id="success-message" type="application/json">
    <?= json_encode(trim($Success_message)) ?>
    </script>

    <script>
    function reloadMainPage() {
        window.location.href = "<?= ROOT ?>/admin/SportManage/adasd"; // Redirect to SportManage page
    }

    document.addEventListener("DOMContentLoaded", function () {
        const successMessage = <?= json_encode($Success_message) ?>;
        const errorMessage = <?= json_encode($Error_message) ?>;
        const okBtn = document.getElementById("customAlertOkBtn");

        if (successMessage) {
            showCustomAlert(successMessage);
            
            okBtn.onclick = function() {
                hideCustomAlert();  // Hide the alert
                setTimeout(reloadMainPage, 300);  // Wait 300ms to ensure the alert is hidden before redirecting
            };
        } else if (errorMessage) {
            showCustomAlert(errorMessage);
            
            okBtn.onclick = function() {
                hideCustomAlert();  // Just hide the error alert
            };
        }
    });

    function updateTeamSport(sportId) {
        // Redirect to the updateIndSport page with sport_id as a parameter
        window.location.href = "<?= ROOT ?>/admin/updateIndSport/" + sportId;
    }
    
    function goBackToManage() {
        window.location.href = "<?= ROOT ?>/admin/SportManage/adasd";
    }
    </script>

    <script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>
</body>

</html>