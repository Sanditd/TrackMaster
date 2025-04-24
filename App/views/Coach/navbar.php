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
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">

    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/notification.css">
    <script src="<?php echo ROOT?>/Public/js/notification.js"></script>
</head>
<body>

    <header>
        <button class="openbtn" onclick="toggleNav()">☰ </button>

        <nav class="navbar" id="navbar">
            <div class="logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="Logo"> 
            </div>
            <ul class="nav-links">
                <li><a href="<?php echo URLROOT ?>/loginController/login">Home</a></li>
                <li><a href="<?php echo URLROOT ?>/common/aboutUs">About Us</a></li>
                <li><a href="<?php echo URLROOT ?>/common/help">Help & Support</a></li>    
                <li><button class="login" onclick="window.location.href='<?php echo URLROOT ?>/loginController/logout'">LogOut</button></li>
                <li><img src="/TrackMaster/Public/img/log in.png" alt="Logo"> </li>

                <!-- notification view -->
                <div class="notification-num">
        
                        <span class="notification-count"><?php echo $unreadCount['count']?></span>
                        <div class="notification-panel">
                            <div class="notification-header">
                                <h3>Notifications</h3>
                                <button class="mark-all-read">Mark all as read</button>
                            </div>
                            <div class="notification-list">
                                <?php if (is_array($notifications)): ?>
                                <?php foreach ($notifications['notifications'] as $notification): ?>
                                <div class="notification-item <?php echo $notification->active == 1 ? 'active-notification' : ''; ?>">
                                    <div class="title"><?php echo htmlspecialchars($notification->title); ?></div>
                                    <div class="description"><?php echo htmlspecialchars($notification->description); ?>
                                    </div>
                                    <div class="time">
                                        <?php echo date('M j, Y g:i A', strtotime($notification->date)); ?></div>

                                    <?php if ($notification->active == 1): ?>
                                    <form action="<?php echo ROOT ?>/NotificationController/markAsRead" method="POST">
                                        <input type="hidden" name="notification_id"
                                            value="<?php echo htmlspecialchars($notification->n_id); ?>">
                                            <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                        <button class="mark-read-btn" type="submit">Mark as read</button>
                                    </form>

                                    <!-- <button class="mark-read-btn" data-id="<?php echo htmlspecialchars($notification->n_id); ?>">Mark as read</button> -->

                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>

                                <?php endif; ?>

                            </div>
                            <div class="notification-footer">
                                <a href="" >View all notifications</a>

                            </div>
                        </div>
                    </div>
                <li><img src="/TrackMaster/Public/img/notification.png" alt="Logo"  class="notification-icon"
                                style="width: 33px; height: 33px;margin-right: 10px;"> </li>
            </ul>
        </nav>
    </header>
    
</body>
</html>
