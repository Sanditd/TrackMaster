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


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up - Student</title>
        <link rel="stylesheet" href="../Public/css/Coach/CoachSignup copy.css">
    </head>
    <body>
        <div id="signup-port">
            <span id="signup-port-logo">
                <img src="../Public/img/logo-black.png" alt="TrackMaster Logo">
            </span>
            <h2>Sign Up - Coach</h2>
            <form method="POST" action="<?php echo ROOT; ?>/signupcontroller/coachsignup" enctype="multipart/form-data">


            <div class="container">
                <!-- Column 1 -->

                <form action="<?php echo ROOT ?>/signUpController/coachsignup" method="POST"
                    onsubmit="return validatePassword() && validateAge()">
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
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <input type="hidden" name="role" value="coach">

                    </div>

                    <!-- Column 2 -->
                    <div class="column">


                        <div class="form-group">
                            <label for="coach_type">Coach Type</label>
                            <select id="coach_type" name="coach_type" required>
                                <option value="" disabled selected>Select Level</option>
                                <option value="Zonal">Zonal</option>
                                <option value="provincial">Provincial</option>
                                <option value="National">Natioanl</option>
                            </select>
                        </div>

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

                        <div class="form-group">
                            <label for="Province">Province</label>
                            <select id="Province" name="province" required onchange="updateDistricts()">
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
                            <select id="District" name="district" required onchange="updateZones()">
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
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" placeholder="Enter a brief biography" rows="3"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="educational-qualifications">Educational Qualifications</label>
                            <textarea id="educational_qualifications" name="educational_qualifications"
                                placeholder="Qualification 1, Qualification 2, Qualification 3" rows="3"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="professional-playing-experience">Professioanl Experience</label>
                            <textarea id="professional_playing_experience" name="professional_playing_experience"
                                placeholder="Experience 1, Experience 2, Experience 3" rows="3" required></textarea>
                        </div>



                    </div>


                    <!-- Column 3 -->
                    <div class="column">
                        <div class="form-group">
                            <label for="coaching_experience">Coachine Experience</label>
                            <textarea id="coaching_experience" name="coaching_experience"
                                placeholder="Experience 1, Experience 2, Experience 3" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="key_achievements">Key Achievements</label>
                            <textarea id="key_achievements" name="key_achievements"
                                placeholder="Achievement 1, Achievement 2, Achievement 3" rows="3" required></textarea>
                        </div>

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


                        <div class="form-group">
                            <label for="password">Create Password</label>
                            <input type="password" id="password" name="password" placeholder="Create Password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" name="confirm-password"
                                placeholder="Confirm Password" required>
                        </div>


                        <div class="form-group">
                            <button type="submit">Submit</button>
                        </div>

                        <div class="form-group">
                            <a href=" <?php echo ROOT?>/loginController/login/dsasa " style="text-decoration:none"> back
                                to
                                login page</a>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>


</body>


<script src="<?php echo ROOT?>/Public/js/signUpjs.php"></script>

</html>

