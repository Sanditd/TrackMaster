
<?php
    //require "../../config/init.php";
    //require "../core/init.php";
    require_once 'nav.php';
    $nav = new Nav();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="../Public/css/Admin/login.css">
    <link rel="stylesheet" href="../Public/css/Admin/signUp.css">
</head>

<body id="loginbody">
<spna class="form-invalid"><?php echo $data['error']?></spna>

    <?php $nav->render(); ?>

    <div class="container">
        <h1>Select Your Role</h1>
        <div class="roles">
            <div class="role" data-role="Coach">Coach</div>
            <div class="role" data-role="Player">Player</div>
            <div class="role" data-role="School">School</div>
            <div class="role" data-role="Parent">Parent</div>
            <div class="role" data-role="Admin">Admin</div>
        </div>
    </div>

    <!-- Signup Popup -->
    <div class="popup" id="signupPopup">
        <div class="popup-content">
            <h2>Signup Form</h2>
            <form method="POST" action="<?php echo ROOT ?>/signUpController/Signup">
                <!-- Hidden input to store selected role -->
                <input type="hidden" id="role" name="role" value="">

                <input type="text" id="firstName" placeholder="First Name" name="fname" required>
                <input type="text" id="lastName" placeholder="Last Name" name="lname" required>
                <input type="text" id="userName" placeholder="User Name" name="uname" required>
                <input type="tel" id="phone" placeholder="Phone Number" name="pnum" required>
                <input type="text" id="address" placeholder="Address" name="address" required>
                <input type="email" id="email" placeholder="Email" name="email" required>
                <input type="password" id="password" placeholder="Password" name="password" required>
                <input type="password" id="confirmPassword" placeholder="Confirm Password" name="cpassword" required>
                <button type="submit">Sign Up</button>
                <button type="button" class="close-popup">Cancel</button>
            </form>
        </div>
    </div>

    <script>
    // Handle role selection
    const roles = document.querySelectorAll('.role');
    const popup = document.getElementById('signupPopup');
    const closePopup = document.querySelector('.close-popup');
    const roleInput = document.getElementById('role');

    roles.forEach(role => {
        role.addEventListener('click', () => {
            const selectedRole = role.getAttribute('data-role');
            console.log('Selected role:', selectedRole);
            // Set the selected role to the hidden input
            roleInput.value = selectedRole;
            // Show the signup form popup
            popup.classList.add('active');
        });
    });

    // Close popup
    closePopup.addEventListener('click', () => {
        const root = <?= json_encode(ROOT) ?>;
        window.location.href = `${root}/loginController/login/dsasa`; // Replace '/path-to-login-page' with your login page URL
    });

    const signupForm = document.querySelector('form');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirmPassword');

    signupForm.addEventListener('submit', (e) => {
        const password = passwordField.value.trim();
        const confirmPassword = confirmPasswordField.value.trim();

        // Validate passwords match
        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            e.preventDefault();
            return;
        }

        // Validate password criteria (at least 8 characters, 1 uppercase, 1 number, 1 special character)
        const passwordCriteria = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!passwordCriteria.test(password)) {
            alert('Password must be at least 8 characters long, include an uppercase letter, a number, and a special character.');
            e.preventDefault();
            return;
        }
    });
    </script>

</body>

</html>
