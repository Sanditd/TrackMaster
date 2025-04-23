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

//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
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


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Sport View</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/zoneManage.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>
</head>

<body>
    <div class="adminNav">
        <?php require_once 'adminNav.php' ?>
    </div>

    <div id="frame" style="margin-top: 100px; margin-left:100px">
        <div class="container">
            <div class="temp-container">
                <div id="signup-port">
                    <?php if (!empty($Success_message)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($Success_message) ?></div>
                    <?php endif; ?>

                    <?php if (!empty($Error_message)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($Error_message) ?></div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="temp2-container">
                            <div class="column">
                                <h3>Sport Details</h3><br>



                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Sport Name :</label>
                                        <?= htmlspecialchars($sport->sport_name ?? 'N/A') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Base :</label>
                                        <?= htmlspecialchars($sport->base ?? 'N/A') ?>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Scoring Method :</label>
                                        <?= htmlspecialchars($sport->scoring_method ?? 'N/A') ?>
                                    </div>
                                </div>
                                <br><br>

                                <div class="form-group">
                                    <label>Game Types and Durations</label>
                                    <br>
                                    <div class="input-group">
                                        <table style="width:200%;border-collapse:collapse;border:1px solid black;">
                                            <thead>
                                                <tr>
                                                    <th>Class Name</th>
                                                    <th>maximum limit</th>
                                                    <th>Minimum limit</th>
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
                                                    <td colspan="3">No game types available.</td>
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
                                    <div class="input-group">
                                        <?php if (!empty($rules)): ?>
                                        <?php foreach ($rules as $index => $rule): ?>
                                        <strong><?= $index + 1 ?>.</strong>
                                        <?= nl2br(htmlspecialchars($rule->rule ?? 'No description available.')) ?><br><br>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        No rules available.
                                        <?php endif; ?>
                                    </div>
                                </div>



                                <button type="button" style="background-color:#007BFF;width:20%" name="action"
                                    value="edit" onclick="updateTeamSport(<?= $sport_id ?>)">
                                    Edit
                                </button>

                                <button type="submit" style="background-color:#d10909;width:20%" name="action"
                                    value="delete">Delete</button>
                                <button type="button" style="background-color:#007BFF;width:20%" name="action"
                                    value="back" onclick="goBackToManage()">Back</button>
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

    <script>
function reloadMainPage() {
    window.location.href = "<?= ROOT ?>/admin/SportManage/asd"; // Redirect to SportManage page
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
            reloadMainPage();  // Just hide the error alert
        };
    }
});


    </script>



    <script id="error-message" type="application/json">
    <?= json_encode(trim($Error_message)) ?>
    </script>

    <script id="success-message" type="application/json">
    <?= json_encode(trim($Success_message)) ?>
    </script>

    <script>
    function updateTeamSport(sportId) {
        // Redirect to the updateTeamSport page with sport_id as a parameter
        window.location.href = "<?= ROOT ?>/admin/updateIndSport/" + sportId;
    }
    </script>

    <script>
    function goBackToManage() {
        window.location.href = "<?= ROOT ?>/admin/SportManage/adasd";
    }
    </script>

    <script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>


</body>

</html>