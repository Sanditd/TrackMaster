<?php

$userId = (int) $_SESSION['user_id'];

require_once __DIR__ . '/../../model/Notification.php';
require_once __DIR__ . '/../../libraries/Database.php';// Adjust path as needed
 require_once __DIR__ . '/../../controllers/NotificationController.php';
// Create login model instance
$NotificationModel = new Notification();
$database = new Database();
$notificationController = new NotificationController();

$notifications = $NotificationModel->getUserNotifications($userId, 10);
$unreadCount = $NotificationModel->getUserUnreadCount($userId);
// $userActive = $loginModel->getUserActivation($userId);

// if (!$user) {
//     session_unset();
//     session_destroy();
//     $_SESSION['error_message']='Login Failed! Try Again.';
//     header('Location: ' . ROOT . '/loginController/login');
//     exit;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/notification.css">
    <script src="<?php echo ROOT?>/Public/js/notification.js"></script>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
    }

    header {
        background-color: #000000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo {
        width: 20%;
        height: 60px;
    }

    .logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .nav-links {
        display: flex;
        list-style: none;
        align-items: center;
    }

    .nav-links li {
        margin-left: 20px;
    }

    .nav-links a {
        text-decoration: none;
        color: #ffffff;
        font-weight: 500;
        padding: 5px 10px;
        transition: color 0.3s;
    }

    .nav-links a:hover {
        color: #007bff;
    }

    .login {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .login:hover {
        background-color: #0056b3;
    }

    .openbtn {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        padding: 10px;
        color: white;
    }

    .button {
        margin-left: 30px;
        width: 40px;
        height: 40px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgb(44, 44, 44);
        border-radius: 50%;
        cursor: pointer;
        transition-duration: .3s;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.13);
        border: none;
    }

    .bell {
        width: 18px;
    }

    .bell path {
        fill: white;
    }

    .button:hover {
        background-color: rgb(56, 56, 56);
    }

    .button:hover .bell {
        animation: bellRing 0.9s both;
    }

    @keyframes bellRing {

        0%,
        100% {
            transform-origin: top;
        }

        15% {
            transform: rotateZ(10deg);
        }

        30% {
            transform: rotateZ(-10deg);
        }

        45% {
            transform: rotateZ(5deg);
        }

        60% {
            transform: rotateZ(-5deg);
        }

        75% {
            transform: rotateZ(2deg);
        }
    }

    .button:active {
        transform: scale(0.8);
    }

    @media (max-width: 768px) {
        .openbtn {
            display: block;
            position: absolute;
            left: 15px;
            top: 15px;
            z-index: 101;
        }

        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .logo {
            margin: 0 auto;
            padding: 10px 0;
            width: 40%;
        }

        .nav-links {
            flex-direction: column;
            width: 100%;
            background-color: #000000;
            position: fixed;
            top: 0;
            left: -100%;
            height: 100vh;
            padding-top: 80px;
            transition: left 0.3s ease;
            z-index: 100;
        }

        .nav-links.active {
            left: 0;
        }

        .nav-links li {
            margin: 15px 0;
            width: 100%;
            text-align: center;
        }

        .nav-links .button {
            margin-left: 0;
        }
    }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <button class="openbtn" onclick="toggleNav()">☰</button>

            <div class="logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="TrackMaster Logo">
            </div>
            <ul class="nav-links">
                <li><a href="<?php echo URLROOT ?>/student/dashboard">Dashboard</a></li>
                <li><a href="<?php echo URLROOT ?>/common/aboutUs">About Us</a></li>
                <li><a href="<?php echo URLROOT ?>/common/help">Help & Support</a></li>
                <li>
                    <button class="login" onclick="window.location.href='<?php echo URLROOT ?>/loginController/logout'">
                        Logout
                    </button>
                </li>
                <!-- notification view -->
                <div class="notification-num">

                    <span class="notification-count"><?php echo $unreadCount['count']?></span>
                    <div class="notification-panel">
                        <div class="notification-header">
                            <h3 style="color:#3498db">Notifications</h3>
                            <button class="mark-all-read">Mark all as read</button>
                        </div>
                        <div class="notification-list">
                            <?php if (is_array($notifications)): ?>
                            <?php foreach ($notifications['notifications'] as $notification): ?>
                            <div
                                class="notification-item <?php echo $notification->active == 1 ? 'active-notification' : ''; ?>">
                                <div class="title"><?php echo htmlspecialchars($notification->title); ?></div>
                                <div class="description"><?php echo htmlspecialchars($notification->description); ?>
                                </div>
                                <div class="time">
                                    <?php echo date('M j, Y g:i A', strtotime($notification->date)); ?></div>

                                <?php if ($notification->active == 1): ?>
                                <form action="<?php echo ROOT ?>/NotificationController/markAsRead" method="POST">
                                    <input type="hidden" name="notification_id"
                                        value="<?php echo htmlspecialchars($notification->n_id); ?>">
                                    <input type="hidden" name="redirect_url"
                                        value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                    <button class="mark-read-btn" type="submit">Mark as read</button>
                                </form>

                                <!-- <button class="mark-read-btn" data-id="<?php echo htmlspecialchars($notification->n_id); ?>">Mark as read</button> -->

                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>

                            <?php endif; ?>

                        </div>
                        <div class="notification-footer">
                            <a href="" style="color:#3498db">View all notifications</a>

                        </div>
                    </div>
                </div>
                <li><img src="/TrackMaster/Public/img/notification.png" alt="Logo" class="notification-icon"
                        style="width: 33px; height: 33px;margin-left: 10px;margin-top:10px"> </li>

            </ul>
        </nav>
    </header>

    <script>
    function toggleNav() {
        const navLinks = document.querySelector(".nav-links");
        navLinks.classList.toggle("active");
    }
    </script>
</body>

</html>