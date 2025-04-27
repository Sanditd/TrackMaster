<?php
//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];

//Load required model file if not already loaded
require_once __DIR__ . '/../../model/loginPage.php';
// Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getUserById($userId);

//If user does not exist in DB, destroy session and redirect
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
    <style>
        /* Base Styles */
        :root {
            --primary-color: #00264d;
            --secondary-color: #ffa500;
            --light-bg: #f4f4f9;
            --white: #ffffff;
            --text-dark: #333;
            --text-muted: #666;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 38, 77, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text-dark);
        }

        /* Main Container */
        .profile-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        /* Profile Header */
        .profile-header {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 20px 25px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-header h1 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .edit-profile-btn {
            background-color: var(--secondary-color);
            color: var(--white);
            border: none;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Profile Content Layout */
        .profile-content {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 20px;
        }

        /* Profile Sidebar */
        .profile-sidebar {
            background-color: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }

        .profile-picture-container {
            background-color: var(--primary-color);
            padding: 40px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: var(--white);
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .school-info {
            padding: 20px;
            text-align: center;
        }

        .school-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .school-type {
            color: var(--secondary-color);
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .contact-info {
            margin-top: 20px;
            text-align: left;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: var(--text-muted);
        }

        .contact-item i {
            min-width: 30px;
            color: var(--primary-color);
        }

        /* Detail Cards */
        .detail-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            margin-bottom: 20px;
            
        }

        .detail-header {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-header i {
            color: var(--secondary-color);
            font-size: 1.2rem;
            margin-right: 10px;
        }

        .detail-header h2 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .detail-content {
            padding: 20px;
        }

        .info-row {
            display: flex;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .info-label {
            font-weight: 600;
            min-width: 150px;
            color: var(--text-dark);
        }

        .info-value {
            color: var(--text-muted);
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .edit-profile-btn {
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <?php require 'sidebar.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <h1><i class="fas fa-school"></i> School Profile</h1>
        
           
        </div>

        <div class="profile-content">
            <!-- Profile Sidebar with School Info -->
            <div class="profile-sidebar">
                <div class="profile-picture-container">
                    <div class="profile-picture">
                        <img src="/TrackMaster/Public/img/profile.jpeg" alt="School Profile Picture" id="profile-image">
                    </div>
                </div>
                <div class="school-info">
                    <h2 class="school-name"><?php echo $username ?></h2>
                    <p class="school-type">School</p>

                    <?php
                    // Get user info from data
                    $userInfo = $data['userInfo'][0] ?? null;
                    if ($userInfo) :
                    ?>
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
                
                <!-- You can add additional detail cards here as needed -->
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>