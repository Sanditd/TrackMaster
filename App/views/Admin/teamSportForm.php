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

// Store success message separately
if (isset($_SESSION['success_message'])) {
    $Success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Store error message separately
if (isset($_SESSION['error_message'])) {
    $Error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/form.css"> -->
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/sportForm.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>

    <!-- FullCalendar CSS and JS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script> -->
</head>

<body>
    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>

    <div id="frame" style="margin-top: 100px; margin-left:100px">
        <div class="container">

            <div class="temp-container">
                <div id="signup-port">
                    
                    <form action="<?php echo ROOT ?>/admin/addTeamSport" method="post">

                        <div class="temp2-container">
                            <div class="column">
                                <h3>Add New Sport</h3>
                                <br>
                                <div class="form-group">
                                    <label for="sportName">Sport Name</label>
                                    <input type="text" id="sportName" name="sportName" placeholder="Cricket"
                                        style="width: 30%;" required>
                                </div>

                                <div class="form-group">
                                    <label for="numOfPlayers">Number of Players</label>
                                    <input type="number" id="numOfPlayers" name="numOfPlayers" placeholder="11"
                                        style="width: 30%;width: 100%;padding: 12px 10px;margin: 4px 0;display: block;border: 1px solid #ccc;box-sizing: border-box;border-radius: 4px;font-size: 14px;"
                                        required>
                                </div>

                                <div class="form-group">
                                    <div id="dynamic-positions-container">
                                        <div class="input-group">
                                            <label for="positions">Player Position (Click ➕ to add more
                                                positions)</label>
                                            <input type="text" id="positions-1" name="positions[]" placeholder="Batsman"
                                                required>
                                            <button class="add-btn" onclick="addPositionField(this)" >➕</button>

                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div id="dynamic-types-container">
                                        <div class="input-group">
                                            <label for="types">Player Types (Click ➕ to add more types)</label>
                                            <input type="text" id="types-1" name="types[]"
                                                placeholder="Left Hand Batsman" required>
                                            <button class="add-btn" onclick="addTypeField(this)">➕</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="duration">Game Types and Durations (Click ➕ to add more)</label>
                                    <div id="dynamic-games-container">
                                        <div class="input-group">
                                            <input type="text" id="Gtypes-1" name="Gtypes[]"
                                                placeholder="Enter game type name" required>
                                            <select name="durationType[]" id="duration-type-1" required>
                                                <option value="T">Time Based</option>
                                                <option value="O">Over Based</option>
                                                <option value="S">Score Based</option>
                                            </select>
                                            <input type="number" name="duration[]" id="duration-1"
                                                placeholder="Enter duration" required>
                                            <button class="add-btn" onclick="addGameField(this)" >➕</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="scoring_method">Scoring Method</label>
                                    <select name="scoring_method" id="scoring_method"
                                        placeholder="Goal, Point, Runs, etc...." style="width: 20%;" required>
                                        <option value="Goal	">Goal</option>
                                        <option value="Point">Point</option>
                                        <option value="Set">Set</option>
                                        <option value="Match">Match</option>
                                        <option value="Round">Round</option>
                                        <option value="Time">Time</option>
                                        <option value="Distance">Distance</option>
                                        <option value="Score">Score</option>
                                    </select>
                                </div>


                            </div>

                            <div class="column">
                                <h3>Add Rules</h3>
                                <br><br>

                                <div class="form-group">
                                    <div id="dynamic-rules-container">
                                        <div class="input-group">
                                            <textarea id="rule-1" name="rules[]" placeholder="Enter a rule"
                                                style="width:400%" required></textarea>
                                            <button class="add-btn" onclick="addRuleField(this)" >➕</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" style="background-color:#007BFF;width:20%">Submit</button>

                    </form>
                </div>



            </div>

        </div>
    </div>
    </div>
    </div>


    <!-- Custom Alert Box -->
    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>


</body>

<script id="error-message" type="application/json">
    <?= json_encode(trim($Error_message)); ?>
</script>

<script id="success-message" type="application/json">
    <?= json_encode(trim($Success_message)); ?>
</script>


<script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>


</html>