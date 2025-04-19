<!DOCTYPE html>
<html lang="en">

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="../../Public/css/Admin/zoneManage.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>
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
                                        <label>Number of Players :</label>
                                        <?= htmlspecialchars($sport->num_of_players ?? 'N/A') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Player Positions :</label><br><br>
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

                                <br>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Player Types :</label><br><br>
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
                                <br>


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
                                        <table style="width:230%;border-collapse:collapse;border:1px solid black;">
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
    </script>

    <script>
    function goBackToManage() {
        window.location.href = "<?= ROOT ?>/admin/SportManage/adasd";
    }
    </script>

    <script src="../../Public/js/Admin/formHandler.js"></script>
</body>

</html>