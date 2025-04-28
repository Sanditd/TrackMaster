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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Account Settings</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/accountSetting.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/sportForm.css">
</head>

<body>

    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>

    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>
    <div class="container">
        <div class="header">
            <div class="logo">Admin Panel</div>
            <button class="btn btn-secondary" onclick="logout()">Logout</button>
        </div>

        <div id="success-alert" class="success-message">
            Settings updated successfully!
        </div>

        <div class="settings-card">
            <div class="card-title">
                <i>👤</i> Account Details
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 25px;">
                <div class="user-avatar">
                    <img src="<?php echo ROOT ?>/public/img/icon/admin_profile.png" alt="admin profile"
                        class="admin-profile">
                </div>
                <div style="margin-left: 20px;">
                    <h3 style="margin: 0;"><?php echo htmlspecialchars($data['user'][0]->username); ?></h3>
                    <p style="margin: 5px 0; color: #5f6368;">Administrator</p>
                </div>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                    <input type="text" id="username" value="<?php echo htmlspecialchars($data['user'][0]->username); ?>"
                        disabled>
                    <button class="edit-btn" onclick="enableEdit('username')" title="Username cannot be changed">
                        <i>🔒</i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-group">
                    <input type="email" id="email" value="<?php echo htmlspecialchars($data['user'][0]->email); ?>"
                        disabled>
                    <button class="edit-btn" onclick="enableEdit('username')" title="Email cannot be changed">
                        <i>🔒</i>
                    </button>
                </div>
            </div>
        </div>


        <div class="settings-card">
            <div class="card-title">
                <i>🔐</i> Security
            </div>

            <form action="<?php echo ROOT ?>/loginController/resetAdminPassword" method="post"
                onsubmit="return validatePassword()">
                <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <div class="password-input">
                        <input type="password" id="current-password" name="currentPassword">
                        <button class="toggle-password"></button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <div class="password-input">
                        <input type="password" id="password" name="password">
                        <button class="toggle-password"></button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm New Password</label>
                    <div class="password-input">
                        <input type="password" id="confirm-password" name="confirmPassword">
                        <button class="toggle-password"></button>
                    </div>
                </div>


                <div class="save-section">
                    <button class="btn btn-secondary" onclick="resetForm()">Cancel</button>
                    <button class="btn" type="submit">Save Changes</button>
                </div>
        </div>
    </div>
    </form>

    <script>
    function enableEdit(fieldId) {
        const field = document.getElementById(fieldId);
        if (fieldId !== 'username') {
            field.disabled = false;
            field.focus();
        }
    }

    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        if (field.type === 'password') {
            field.type = 'text';
        } else {
            field.type = 'password';
        }
    }

    function resetForm() {
        document.getElementById('email').value = 'admin@example.com';
        document.getElementById('email').disabled = true;

        document.getElementById('current-password').value = '';
        document.getElementById('new-password').value = '';
        document.getElementById('confirm-password').value = '';

        document.getElementById('success-alert').style.display = 'none';
    }

    function saveChanges() {
        // Here you would typically add validation and API calls
        // This is simplified for demonstration
        const currentPassword = document.getElementById('current-password').value;
        const newPassword = document.getElementById('new-password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (newPassword && !currentPassword) {
            alert("Please enter your current password");
            return;
        }

        if (newPassword && newPassword !== confirmPassword) {
            alert("New passwords don't match");
            return;
        }

        // Show success message
        document.getElementById('success-alert').style.display = 'block';

        // In a real application, here you would send the data to your backend
        console.log("Changes saved:", {
            email: document.getElementById('email').value,
            passwordChanged: !!newPassword
        });

        // Reset form state
        document.getElementById('email').disabled = true;
        document.getElementById('current-password').value = '';
        document.getElementById('new-password').value = '';
        document.getElementById('confirm-password').value = '';

        // Hide success message after 3 seconds
        setTimeout(() => {
            document.getElementById('success-alert').style.display = 'none';
        }, 3000);
    }

    function logout() {
        window.location.href = "<?php echo ROOT ?>/loginController/adminLogout";
    }
    </script>
    <script src="<?php echo ROOT?>/Public/js/signUpjs.php"></script>

    <script id="error-message" type="application/json">
    <?= json_encode(trim($Error_message)); ?>
    </script>

    <script id="success-message" type="application/json">
    <?= json_encode(trim($Success_message)); ?>
    </script>


    <script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>
</body>

</html>