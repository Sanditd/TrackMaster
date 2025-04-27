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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Profile</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/profile.css">
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

    <div class="Phead">
        <div class="Pcontainer">
            <h1>Player Profile</h1>
        </div>
    </div>

    <div class="Pcontainer">
        <div class="profile-container">
            <div class="profile-sidebar">
                <div class="profile-header">
                    <?php if(!empty($data['user'][0]->photo)): ?>
                    <img src="<?php echo $data['user'][0]->photo; ?>" alt="Player Photo" class="profile-photo">
                    <?php else: ?>
                    <img src="<?php echo ROOT?>/Public/images/placeholder-profile.jpg" alt="Player Photo"
                        class="profile-photo">
                    <?php endif; ?>
                    <h2><?php echo $data['user'][0]->firstname . ' ' . $data['user'][0]->lname; ?></h2>
                    <p><?php echo ucfirst($data['user'][0]->role); ?></p>
                </div>
                <div class="profile-info">
                    <div class="info-group">
                        <div class="info-label">Username</div>
                        <div class="info-value"><?php echo $data['user'][0]->username; ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value"><?php echo $data['user'][0]->phonenumber; ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo $data['user'][0]->email; ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Address</div>
                        <div class="info-value"><?php echo $data['user'][0]->address; ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Date of Birth</div>
                        <div class="info-value"><?php echo date('F j, Y', strtotime($data['user'][0]->dob)); ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Age</div>
                        <div class="info-value"><?php echo $data['user'][0]->age; ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Gender</div>
                        <div class="info-value">
                            <?php echo !empty($data['user'][0]->gender) ? $data['user'][0]->gender : 'Not specified'; ?>
                        </div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Registered Date</div>
                        <div class="info-value"><?php echo date('F j, Y', strtotime($data['user'][0]->regDate)); ?>
                        </div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Registered Sport</div>
                        <div class="info-value">
                            <?php
            $sportName = 'Unknown'; // Default if not found
            if (isset($data['sport']) && !empty($data['sport'])) {
                foreach ($data['sport'] as $sport) {
                    if ($sport->sport_id == $data['player']->sport_id) {
                        $sportName = $sport->sport_name;
                        break;
                    }
                }
            }
            echo htmlspecialchars($sportName);
        ?>
                        </div>
                    </div>
                    <?php if(isset($data['player'])): ?>
                    <div class="info-group">
                        <div class="info-label">Sport Role</div>
                        <div class="info-value"><?php echo $data['player']->role; ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Status</div>
                        <div class="info-value"><?php echo $data['player']->statusus; ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Zone</div>
                        <div class="info-value"><?php echo $data['player']->zone; ?></div>
                    </div>
                    <?php endif; ?>
                    <div class="actions">
                        <?php if($data['user'][0]->active == 1): ?>
                        <button class="btn btn-danger"
                            onclick="suspendUser(<?php echo $data['user'][0]->user_id; ?>)">Suspend User</button>
                        <?php else: ?>
                        <button class="btn btn-success"
                            onclick="activateUser(<?php echo $data['user'][0]->user_id; ?>)">Activate User</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="profile-content">
                <h2 class="section-title">Activity Log</h2>
                <?php if(isset($data['activity']) && !empty($data['activity'])): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['activity'] as $log): ?>
                        <tr>
                            <td><?php echo date('Y-m-d', strtotime($log->date)); ?></td>
                            <td><?php echo date('H:i:s', strtotime($log->date)); ?></td>
                            <td><?php echo htmlspecialchars($log->act_desc); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p>No activity logs found for this user.</p>
                <?php endif; ?>



            </div>
        </div>
    </div>

    <script>
    function suspendUser(userId) {
        showCustomAlert('Are you sure you want to suspend this user?', function() {
            window.location.href = '<?php echo ROOT; ?>/adminController/suspendUser/' + userId;
            hideCustomAlert(); // Close the alert after user confirms
        });
    }

    function activateUser(userId) {
        showCustomAlert('Are you sure you want to activate this user?', function() {
            window.location.href = '<?php echo ROOT; ?>/adminController/activateUser/' + userId;
            hideCustomAlert(); // Close the alert after user confirms
        });
    }
    </script>

    <script id="error-message" type="application/json">
    <?= json_encode(trim($Error_message)); ?>
    </script>

    <script id="success-message" type="application/json">
    <?= json_encode(trim($Success_message)); ?>
    </script>


    <script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>
</body>

</html>