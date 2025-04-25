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
$sport_name = $sport->sport_name ?? 'Sport Details';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($sport_name) ?> Details</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/sportView.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>
    <style>
        
    </style>
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
                <!-- <p>Sport ID: <?= htmlspecialchars($sport_id) ?> | Players: <?= htmlspecialchars($sport->num_of_players ?? 'N/A') ?></p> -->
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
                                        <label>Number of Players:</label>
                                        <span><?= htmlspecialchars($sport->num_of_players ?? 'N/A') ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Player Positions:</label>
                                        <div style="margin-left: 150px; margin-top: -20px;">
                                            <?php
                                            if (!empty($sport->positions)) {
                                                $positions = json_decode($sport->positions, true);
                                                if (is_array($positions)) {
                                                    foreach ($positions as $pos) {
                                                        echo htmlspecialchars($pos) . '<br>';
                                                    }
                                                } else {
                                                    // fallback if not valid JSON (maybe comma-separated)
                                                    foreach (explode(',', $sport->positions) as $pos) {
                                                        echo htmlspecialchars(trim($pos)) . '<br>';
                                                    }
                                                }
                                            } else {
                                                echo 'N/A';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Player Types:</label>
                                        <div style="margin-left: 150px; margin-top: -20px;">
                                            <?php
                                            if (!empty($sport->types)) {
                                                $types = json_decode($sport->types, true);
                                                if (is_array($types)) {
                                                    foreach ($types as $type) {
                                                        echo htmlspecialchars($type) . '<br>';
                                                    }
                                                } else {
                                                    foreach (explode(',', $sport->types) as $type) {
                                                        echo htmlspecialchars(trim($type)) . '<br>';
                                                    }
                                                }
                                            } else {
                                                echo 'N/A';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Scoring Method:</label>
                                        <span><?= htmlspecialchars($sport->scoring_method ?? 'N/A') ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Game Types and Durations</label>
                                    <div class="input-group" style="margin-top: 10px;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Game Type</th>
                                                    <th>Duration Type</th>
                                                    <th>Duration</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($game_types)): ?>
                                                <?php foreach ($game_types as $game): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($game->game_format ?? 'N/A') ?></td>
                                                    <td><?= htmlspecialchars($game->duration_type ?? 'N/A') ?></td>
                                                    <td><?= htmlspecialchars($game->duration_value ?? 'N/A') ?></td>
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
                                        value="delete" onclick="deleteSport(<?= htmlspecialchars(json_encode($sport->sport_id)) ?>)">Delete Sport</button>
                                        
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

    <script id="error-message" type="application/json">
    <?= json_encode(trim($Error_message)) ?>
    </script>

    <script id="success-message" type="application/json">
    <?= json_encode(trim($Success_message)) ?>
    </script>

    <script>
    function updateTeamSport(sportId) {
        // Redirect to the updateTeamSport page with sport_id as a parameter
        window.location.href = "<?= ROOT ?>/admin/updateTeamSport/" + sportId;
    }
    
    function goBackToManage() {
        window.location.href = "<?= ROOT ?>/admin/SportManage/adasd";
    }
    </script>

    <script>
        function deleteSport(sport_id) {
    const root = <?= json_encode(ROOT) ?>; // Get root path from PHP
    const url = `${root}/admin/deleteSport/${encodeURIComponent(sport_id)}`;

    // Override the OK button action temporarily
    const okButton = document.querySelector('#customAlertBox button');
    const originalHandler = okButton.onclick; // Save existing handler

    // Set new handler
    okButton.onclick = function () {
        hideCustomAlert(); // Hide the alert first

        // Perform DELETE request
        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then((response) => {
            if (response.ok) {
                // Show success message and trigger reload after confirmation
                showCustomAlert("Sport deleted successfully.");
                // Override the OK button handler again after the message is shown
                okButton.onclick = function () {
                    location.reload(); // Reload the page after confirmation
                };
            } else {
                return response.text().then((text) => {
                    throw new Error(text || "Failed to delete the sport.");
                });
            }
        })
        .catch((error) => {
            console.error("Error deleting sport:", error);
            alert(`Error: ${error.message}`);
        });

        // Restore the original OK button behavior after execution
        okButton.onclick = originalHandler;
    };

    // Show custom confirmation message
    showCustomAlert("Are you sure you want to delete this sport?");
}
    </script>

    <script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>
</body>

</html>