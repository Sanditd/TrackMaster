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
    <link rel="stylesheet" href="<?php echo ROOT ?>/Public/css/Coach/CoachSignup.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/Public/css/Admin/login.css">


</head>


<?php
// Start session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if there's a success message in the session
if (isset($_SESSION['error_message'])) {
    $Erro_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Remove the message after retrieving it
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
</script>


<body>
    <?php $nav->render(); ?>
    <div class="temp-container">
        <div id="signup-port" style="width: 400px;margin-top: 5%;">
            <!-- <span id="signup-port-logo">
            <img src="../Public/img/logo-black.png" alt="TrackMaster Logo">
        </span> -->
            <h2>Sign Up - Coach</h2>
            <br>

            <div class="container">
                <!-- Column 1 -->

                <form action="<?php echo ROOT ?>/signUpController/Admin" method="POST"
                    onsubmit="return validatePassword() && validateAge()">
                    <div class="column">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Enter Username" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter Email" required>
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

