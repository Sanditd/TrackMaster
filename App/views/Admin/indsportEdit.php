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

$sport = $sport ?? null;
$game_types = $game_types ?? [];
$rules = $rules ?? [];

// Convert JSON strings to arrays if necessary
if (isset($sport->types) && is_string($sport->types)) {
    $sport->types = json_decode($sport->types, true); // Convert JSON to array
}

if (isset($sport->positions) && is_string($sport->positions)) {
    $sport->positions = json_decode($sport->positions, true); // Convert JSON to array
}

if (!empty($game_types) && is_array($game_types)) {
    foreach ($game_types as &$game) {
        if (is_string($game)) {
            $game = json_decode($game); // Convert to object if needed
        }
    }
}


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrackMaster - Admin</title>
    <!-- <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/form.css"> -->
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/zoneManage.css">
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

                    <form action="<?php echo ROOT ?>/admin/updateIndSport/<?= $sportId ?>" method="post">

                        <input type="hidden" name="sport_id" value="<?php echo $sportId; ?>">

                        <div class="temp2-container">
                            <div class="column">
                                <h3>Edit Sport Details</h3>
                                <br>
                                <div class="form-group">
                                    <label for="sportName">Sport Name</label>
                                    <input type="text" id="sportName" name="sportName" placeholder="Cricket"
                                        style="width: 30%;" required
                                        value="<?= htmlspecialchars($sport->sport_name ?? 'N/A') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="base">Base</label>
                                    <select name="base" id="base" placeholder="Wieght, Height, Age" style="width: 20%;"
                                        required>
                                        <option value="Weight"
                                            <?= isset($sport->base) && $sport->base == 'Weight' ? 'selected' : '' ?>>
                                            Weight</option>
                                        <option value="Height"
                                            <?= isset($sport->base) && $sport->base == 'Height' ? 'selected' : '' ?>>
                                            Height</option>
                                        <option value="Age"
                                            <?= isset($sport->base) && $sport->base == 'Age' ? 'selected' : '' ?>>Age
                                        </option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="duration">Class Types and Range (Click ➕ to add more)</label>
                                    <div id="dynamic-weight-container">
                                        <?php if (!empty($game_types) && is_array($game_types)): ?>
                                        <?php foreach ($game_types as $index => $game): ?>
                                        <div class="input-group">
                                            <input type="text" name="weightClass[]" placeholder="Enter class name"
                                                value="<?= isset($game->game_format) ? htmlspecialchars($game->game_format) : '' ?>"
                                                required>

                                            <input type="number" name="min[]" placeholder="Minimum" step="0.1"
                                                value="<?= isset($game->min) ? htmlspecialchars($game->min) : '' ?>"
                                                required>

                                            <input type="number" name="max[]" placeholder="Maximum" step="0.1"
                                                value="<?= isset($game->max) ? htmlspecialchars($game->max) : '' ?>"
                                                required>

                                            <?php if ($index == 0): ?>
                                            <button class="add-btn" type="button"
                                                onclick="addWeightField(this)">➕</button>
                                            <?php endif; ?>

                                        </div>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <div class="input-group">
                                            <input type="text" name="weightClass[]" placeholder="Enter class name" required>
                                            <input type="number" name="min[]" placeholder="Minimum" step="0.1" required>
                                            <input type="number" name="max[]" placeholder="Maximum" step="0.1" required>
                                            <button class="add-btn" type="button"
                                                onclick="addWeightField(this)">➕</button>
                                            <button class="remove-btn" type="button"
                                                onclick="removeField(this)">❌</button>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="scoring_method">Scoring Method</label>
                                    <select name="scoring_method" id="scoring_method"
                                        placeholder="Goal, Point, Runs, etc...." style="width: 20%;" required>
                                        <option value="Goal"
                                            <?= (isset($sport->scoring_method) && trim($sport->scoring_method) == 'Goal') ? 'selected' : '' ?>>
                                            Goal</option>
                                        <option value="Point"
                                            <?= (isset($sport->scoring_method) && $sport->scoring_method == 'Point') ? 'selected' : '' ?>>
                                            Point</option>
                                        <option value="Set"
                                            <?= (isset($sport->scoring_method) && $sport->scoring_method == 'Set') ? 'selected' : '' ?>>
                                            Set</option>
                                        <option value="Match"
                                            <?= (isset($sport->scoring_method) && $sport->scoring_method == 'Match') ? 'selected' : '' ?>>
                                            Match</option>
                                        <option value="Round"
                                            <?= (isset($sport->scoring_method) && $sport->scoring_method == 'Round') ? 'selected' : '' ?>>
                                            Round</option>
                                        <option value="Time"
                                            <?= (isset($sport->scoring_method) && $sport->scoring_method == 'Time') ? 'selected' : '' ?>>
                                            Time</option>
                                        <option value="Distance"
                                            <?= (isset($sport->scoring_method) && $sport->scoring_method == 'Distance') ? 'selected' : '' ?>>
                                            Distance</option>
                                        <option value="Score"
                                            <?= (isset($sport->scoring_method) && $sport->scoring_method == 'Score') ? 'selected' : '' ?>>
                                            Score</option>
                                    </select>
                                </div>

                            </div>

                            <div class="column">
                                <h3>Rules</h3>
                                <br>
                                <div id="dynamic-rules-container">
                                    <?php if (!empty($rules) && is_array($rules)): ?>
                                    <?php foreach ($rules as $index => $rule): ?>
                                    <div class="input-group">
                                        <?php if ($index == 0): ?>
                                        <label for="rules">Rules (Click ➕ to add more rules)</label>
                                        <?php endif; ?>
                                        <!-- Access the 'rule' property of the object -->
                                        <input type="text" name="rules[]" placeholder="Rule 1"
                                            value="<?= isset($rule->rule) ? htmlspecialchars($rule->rule) : '' ?>"
                                            required>
                                        <?php if ($index == 0): ?>
                                        <button class="add-btn" onclick="addRuleField(this)">➕</button>
                                        <?php endif; ?>
                                        <button class="remove-btn" onclick="removeField(this)">❌</button>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <!-- If no existing rules, show one input -->
                                    <div class="input-group">
                                        <label for="rules">Rules (Click ➕ to add more rules)</label>
                                        <input type="text" name="rules[]" placeholder="Rule 1" required>
                                        <button class="add-btn" onclick="addRuleField(this)">➕</button>
                                        <button class="remove-btn" onclick="removeField(this)">❌</button>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <br>


                                <button type="submit" style="background-color:#007BFF;width:20%">Submit</button>

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
            <button onclick="handleButtonClick()">OK</button>
        </div>
    </div>


</body>

<script id="error-message" type="application/json">
<?= json_encode(trim($Error_message)); ?>
</script>

<script id="success-message" type="application/json">
<?= json_encode(trim($Success_message)); ?>
</script>

<script>
// PHP variables passed to JavaScript
const successMessage = <?php echo json_encode($Success_message); ?>;
const errorMessage = <?php echo json_encode($Error_message); ?>;

// Logic to display the appropriate message
if (successMessage) {
    document.getElementById('customAlertMessage').textContent = successMessage;
    document.getElementById('customAlertOverlay').style.display = 'block';
} else if (errorMessage) {
    document.getElementById('customAlertMessage').textContent = errorMessage;
    document.getElementById('customAlertOverlay').style.display = 'block';
}

// Function to handle button click for success or error
function handleButtonClick() {
    if (successMessage) {
        redirectToSportManage(); // Redirect if success
    } else {
        hideCustomAlert(); // Hide the alert if error
    }
}

// Function to redirect to the sportManage page on success
function redirectToSportManage() {
    window.location.href = '<?= ROOT ?>/admin/sportManage/sdsd'; // Update this URL if needed
}
</script>

<script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>

<script>
        // Assuming your input names are like: name="weightClass[]", "min[]", "max[]"
const weightClasses = Array.from(document.querySelectorAll('[name="weightClass[]"]')).map(input => input.value.trim());
const mins = Array.from(document.querySelectorAll('[name="min[]"]')).map(input => input.value.trim());
const maxes = Array.from(document.querySelectorAll('[name="max[]"]')).map(input => input.value.trim());

console.log("Weight Classes:", weightClasses);
console.log("Mins:", mins);
console.log("Maxes:", maxes);

console.log("Weight Class Count:", weightClasses.length);
console.log("Min Count:", mins.length);
console.log("Max Count:", maxes.length);

if (weightClasses.length !== mins.length || weightClasses.length !== maxes.length) {
    console.error("Mismatch in array lengths. Fix the form inputs.");
} else {
    console.log("All arrays match in length. Ready to submit.");
}

    </script>


</html>