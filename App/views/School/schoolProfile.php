<?php

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];


require_once __DIR__ . '/../../model/loginPage.php';



$loginModel = new loginPage();

$user = $loginModel->getUserById($userId);


if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Profile | TrackMaster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Public/css/school/editSchool.css">
    
</head>
<body>
    <?php require 'navbar.php'; ?>
    <?php require 'sidebar.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <h1><i class="fas fa-school"></i> School Profile</h1>
        
           
        </div>

           <?php
                    // Get user info from data
                    $userInfo = $data['userInfo'][0] ?? null;
                    if ($userInfo) :
                    ?>

        <div class="profile-content">
            <!-- Profile Sidebar with School Info -->
            <div class="profile-sidebar">
                <div class="profile-picture-container">
                    <div class="profile-picture">
                        <img src="<?php echo !empty($userInfo->photo) ? 'data:image/jpeg;base64,'.base64_encode($userInfo->photo) : URLROOT.'/Public/img/profile.jpeg' ?>" alt="School Profile Picture">
                    </div>
                </div>
                <div class="school-info">
                    <h2 class="school-name"><?php echo $username ?></h2>
                    <p class="school-type">School</p>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span><?= $userInfo->email ?></span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span><?= $userInfo->phonenumber ?></span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?= $userInfo->address ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- School Information Card -->
            <div>
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-info-circle"></i>
                        <h2>School Information</h2>
                    </div>
                    <div class="detail-content">
                        <?php
                        $schoolInfo = $data['schoolInfo'][0] ?? null;
                        $zoneInfo = $data['zoneInfo'][0] ?? null;
                        ?>

                        <div class="info-row">
                            <div class="info-label">Email:</div>
                            <div class="info-value" id="display-email"><?= $userInfo->email ?? 'Not specified' ?></div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Phone:</div>
                            <div class="info-value" id="display-phone"><?= $userInfo->phonenumber ?? 'Not specified' ?></div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Address:</div>
                            <div class="info-value" id="display-address"><?= $userInfo->address ?? 'Not specified' ?></div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Zone:</div>
                            <div class="info-value" id="display-zone"><?= $zoneInfo->zoneName ?? 'Not specified' ?></div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Province:</div>
                            <div class="info-value" id="display-province"><?= $zoneInfo->provinceName ?? 'Not specified' ?></div>
                        </div>
                    </div>
                </div>
                
              
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>