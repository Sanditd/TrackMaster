<?php
$userId = (int) $_SESSION['user_id'];
require_once __DIR__ . '/../../model/Notification.php';
require_once __DIR__ . '/../../libraries/Database.php';
require_once __DIR__ . '/../../controllers/NotificationController.php';
$NotificationModel = new Notification();
$database = new Database();
$notificationController = new NotificationController();
$notifications = $NotificationModel->getUserNotifications($userId, 10);
$unreadCount = $NotificationModel->getUserUnreadCount($userId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/notification.css">
    <link rel="stylesheet" href="/TrackMaster/public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="<?php echo ROOT?>/Public/js/notification.js"></script>

</head>
<body>
    <header>
        <nav class="navbar">
            <button class="openbtn" onclick="toggleNav()"><i class="fas fa-bars"></i></button>
            <div class="logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="TrackMaster Logo">
            </div>
            <ul class="nav-links">
                <li><a href="<?php echo URLROOT ?>/student/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="<?php echo URLROOT ?>/common/aboutUs"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li><a href="<?php echo URLROOT ?>/common/help"><i class="fas fa-question-circle"></i> Help & Support</a></li>
                <li><a class="notification-icon"><i class="fas fa-bell"></i></a>
                <div class="notification-num">
                    <span class="notification-count"><?php echo $unreadCount['count']?></span>
                    <div class="notification-panel">
                        <div class="notification-header">
                            <h3 style="color: var(--secondary-color)">Notifications</h3>
                            <button class="mark-all-read">Mark all as read</button>
                        </div>
                        <div class="notification-list">
                            <?php if (is_array($notifications)): ?>
                            <?php foreach ($notifications['notifications'] as $notification): ?>
                            <div class="notification-item <?php echo $notification->active == 1 ? 'active-notification' : ''; ?>">
                                <div class="title"><?php echo htmlspecialchars($notification->title); ?></div>
                                <div class="description"><?php echo htmlspecialchars($notification->description); ?></div>
                                <div class="time"><?php echo date('M j, Y g:i A', strtotime($notification->date)); ?></div>
                                <?php if ($notification->active == 1): ?>
                                <form action="<?php echo ROOT ?>/NotificationController/markAsRead" method="POST">
                                    <input type="hidden" name="notification_id" value="<?php echo htmlspecialchars($notification->n_id); ?>">
                                    <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                    <button class="mark-read-btn" type="submit">Mark as read</button>
                                </form>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="notification-footer">
                            <a href="" style="color: var(--secondary-color)">View all notifications</a>
                        </div>
                    </div>
                </div>
            </li>
                <li></li>
                <li>
                    <button class="login" onclick="window.location.href='<?php echo URLROOT ?>/loginController/logout'">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </li>
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