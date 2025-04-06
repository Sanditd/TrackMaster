<!DOCTYPE html>
<html lang="en">

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
    <!-- <link rel="stylesheet" href="../../Public/css/Admin/form.css"> -->
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="../../Public/css/Admin/zoneManage.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>

    <title>Create a Sport</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Admin/createSport.css">


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

                    <form action="<?php echo ROOT ?>/admin/addIndSport" method="post">

                        <div class="temp2-container">
                            <div class="column">
                                <h3>Add New Individual Sport</h3>
                                <br>
                                <div class="form-group">
                                    <label for="sportName">Sport Name</label>
                                    <input type="text" id="sportName" name="sportName" placeholder="Cricket"
                                        style="width: 30%;" required>
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
                                            <button class="add-btn" onclick="addGameField(this)">➕</button>
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

                                <div class="form-group">
                                    <label for="weight-classes">Weight Classes (Click ➕ to add more)</label>
                                    <div id="dynamic-weight-container">
                                        <div class="input-group">
                                            <input type="text" id="weight-class-1" name="weightClass[]"
                                                placeholder="Enter weight class name (e.g., Lightweight)" required>
                                            <input type="number" name="minWeight[]" id="min-weight-1"
                                                placeholder="Min Weight (kg/lbs)" step="0.1" required>
                                            <input type="number" name="maxWeight[]" id="max-weight-1"
                                                placeholder="Max Weight (kg/lbs)" step="0.1" required>
                                            <button class="add-btn" onclick="addWeightField(this)">➕</button>
                                        </div>
                                    </div>
                                </div>
                                <br>


                            </div>

                            <div class="column">
                                

                                <h3>Add Rules</h3>
                                <br>

                                <div class="form-group">
                                    <div id="dynamic-rules-container">
                                        <div class="input-group">
                                            <textarea id="rule-1" name="rules[]" placeholder="Enter a rule"
                                                style="width:400%" required></textarea>
                                            <button class="add-btn" onclick="addRuleField(this)">➕</button>
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


<script src="../../Public/js/Admin/formHandler.js"></script>


<?php require_once "adminNav.php" ?>

<!-- Individual sports -->
<div id="indSports">
    <div class="container">
        <h1>Create an Individual Sport</h1>
        <h2>Please Fill the Inputs : </h2>
        <br>
        <spna class="form-invalid"><?php echo $data['errorMsg']?></spna>
        <br><br>

        <form class="form-section" id="createSportForm" action="<?php echo ROOT ?>/admin/addindSportForm" method="post">

            <div class="form-group">
                <label for="sportName">Sport Name:</label>
                <input type="text" id="sportName" name="sportName" placeholder="Enter Sport Name" required
                    >
            </div>

            <div class="form-group">
                <label for="gameDuration">Game Duration (minutes):</label>
                <input type="number" id="gameDuration" name="gameDuration" min="1" placeholder="Enter Game Duration"
                    required >
            </div>

            <div class="form-group">
                <label for="locationType">Location Type:</label>
                <select id="locationType" name="locationType" required >
                    <option value="">Select Location</option>
                    <option value="Indoor">Indoor</option>
                    <option value="Outdoor">Outdoor</option>
                </select>
            </div>

            <div class="form-group">
                <label for="categories">Categories:</label>
                <input type="text" id="category" name="category" placeholder="under 16,19"
                    >
            </div>

            <div class="form-group">
                <label for="scoring">Scoring System:</label>
                <input type="text" id="scoring" name="scoring" placeholder="briefly explain scoring system"
                    >
            </div>

            <div class="form-group">
                <label for="equipment">Equipment (comma-separated):</label>
                <input type="text" id="equipment" name="equipment" placeholder="e.g., Ball, Net, Bat"
                    >
            </div>

            <div class="form-group">
                <label for="rulesURL">Rules (URL):</label>
                <input type="url" id="rulesURL" name="rulesURL" placeholder="Enter URL for Rules"
                    >
            </div>

            <button class="edit-button" type="submit">Create The Sport</button>
        </form>
    </div>
</div>


</html>