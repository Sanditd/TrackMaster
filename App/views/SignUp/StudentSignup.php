<!DOCTYPE html>
<html lang="en">

<?php
    //require "../../config/init.php";
    //require "../core/init.php";
    require_once __DIR__ . '/../Admin/nav.php'; // Adjust the relative path based on your file structure

    $nav = new Nav();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Student</title>
    <link rel="stylesheet" href="../Public/css/Coach/CoachSignup.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/Public/css/Admin/login.css">
</head>

<?php
// Start session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if there's a success message in the session
if (isset($_SESSION['error'])) {
    $Erro_message = $_SESSION['error'];
    unset($_SESSION['error']); // Remove the message after retrieving it
} else {
    $Erro_message = "";
}
?>

<?php if (!empty($Erro_message)) : ?>
<script>
var errorMessage = <?= json_encode(addslashes($Erro_message)); ?>;
</script>
<?php else: ?>
<script>
var errorMessage = "";
</script>
<?php endif; ?>

<script>
var districts = <?= json_encode($data['districts']); ?>;
const schoolsData = <?= json_encode($data['schools']) ?>;
console.log("Schools Data:", schoolsData);
</script>

<body>
    <?php $nav->render(); ?>
    <div class="temp-container">
        <div id="signup-port">
            <!-- <span id="signup-port-logo">
            <img src="../Public/img/logo-black.png" alt="TrackMaster Logo">
        </span> -->
            <h2>Sign Up - Student/Player</h2>
            <?php print_r($data['schools']) ?>

            <div class="container">

                <form action="<?php echo ROOT ?>/signUpController/studentsignup" method="POST"
                    onsubmit="return validatePassword() && validateAge()">
                    <!-- Column 1 -->
                    <div class="column">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="firstname" placeholder="Enter First Name">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="lastname" placeholder="Enter Last Name" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Enter Username" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter Email" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" placeholder="Enter Address" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required>
                        </div>

                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" required>

                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" id="age" name="age" placeholder="Enter Age" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <input type="hidden" name="role" value="student">

                    </div>

                    <!-- Column 2 -->
                    <div class="column">


                        

                        <div class="form-group">
                            <label for="sport">Sport</label>
                            <select id="sport" name="sport" required>
                                <option value="" disabled selected>Select Sport</option>
                                <?php if (!empty($sports)) : ?>
                                <?php foreach ($sports as $sport) : ?>
                                <option value="<?= htmlspecialchars($sport->sport_name) ?>">
                                    <?= htmlspecialchars($sport->sport_name) ?></option>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <option value="">No sports available</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Hidden by default: Role dropdown -->
                        <div class="form-group" id="cricketRoleContainer" style="display: none;">
                            <label for="cricketRole">Role</label>
                            <select id="cricketRole" name="playerRole">
                                <option value="" disabled selected>Select Role</option>
                                <option value="Batsman">Batsman</option>
                                <option value="Bowler">Bowler</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Province">Province</label>
                            <select id="Province" name="Province" required onchange="updateDistricts()">
                                <option value="" disabled selected>Select Province</option>
                                <option value="central">Central Province</option>
                                <option value="eastern">Eastern Province</option>
                                <option value="northern">Northern Province</option>
                                <option value="southern">Southern Province</option>
                                <option value="western">Western Province</option>
                                <option value="north-central">North Central Province</option>
                                <option value="north-western">North Western Province</option>
                                <option value="sabaragamuwa">Sabaragamuwa Province</option>
                                <option value="uva">Uva Province</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="District">District</label>
                            <select id="District" name="District" required onchange="updateZones()">
                                <option value="" disabled selected>Select District</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="zone">Zone</label>
                            <select id="zone" name="zone" required>
                                <option value="" disabled selected>Select Zone</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="School">School</label>
                            <select id="school" name="school" required>
                            <option value="" disabled selected>Select School</option>
                            </select>
                        </div>


                    </div>


                    <!-- Column 3 -->
                    <div class="column">
                        <div class="form-group">
                            <label for="photo">Upload Profile Photo</label>
                            <div class="custom-file-input">
                                <label for="photo" class="custom-button">Choose File</label>
                                <span id="file-name">No file chosen</span>
                                <input type="file" id="photo" name="photo" accept="image/*" required>
                            </div>
                            <div id="photo-preview" class="photo-preview">
                                <p>No photo uploaded</p>
                            </div>
                        </div>


                        <form id="signup-form" action="process_signup.php" method="POST">
                            <div class="form-group">
                                <label for="password">Create Password</label>
                                <input type="password" id="password" name="password" placeholder="Create Password"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirmPassword"
                                    placeholder="Confirm Password" required>
                            </div>
                            <button type="submit">Sign Up</button>
                        </form>

                        <div class="form-group">
                            <a href=" <?php echo ROOT?>/loginController/login/dsasa " style="text-decoration:none"> back
                                to
                                login page</a>

                        </div>

                    </div>
            </div>
            <!-- Shared Submit Button -->

            </form>


        </div>
    </div>

    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const sportSelect = document.getElementById("sport");
        const roleContainer = document.getElementById("cricketRoleContainer");

        sportSelect.addEventListener("change", function () {
            const selectedSport = sportSelect.value.trim().toLowerCase();
            if (selectedSport === "cricket") {
                roleContainer.style.display = "block";
            } else {
                roleContainer.style.display = "none";
            }
        });
    });
</script>

</body>

</html>

<script src="<?php echo ROOT?>/Public/js/signUpjs.php"></script>