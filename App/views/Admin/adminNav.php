<?php 

//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];

//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 require_once __DIR__ . '/../../model/Notification.php';
 require_once __DIR__ . '/../../libraries/Database.php';
 require_once __DIR__ . '/../../controllers/NotificationController.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();
$NotificationModel = new Notification();
$database = new Database();
$notificationController = new NotificationController();


$user = $loginModel->getAdminById($userId);
$notifications = $NotificationModel->getAdminNotifications($userId, 10);
$unreadCount = $NotificationModel->getAdminUnreadCount($userId);
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



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/notification.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>
    <script src="<?php echo ROOT?>/Public/js/notification.js"></script>
</head>

<body>

    <!-- Main Content -->
    <div id="main">
        <!-- Top Navigation Bar -->
        <header>
            <nav class="navbar">



                <img src="<?php echo ROOT ?>/public/img/icon/admin_profile.png" alt="admin profile"
                    class="admin-profile" style="width: 55px; height: 55px; margin-left:-10px">
                <!-- Admin Profile Picture on the left -->


                <div class="user-details">
                    <div class="username"><?php echo $username?></div>
                    <div class="user-role">System Admin</div>
                </div>


                <div class="track-logo">
                    <img src="<?php echo ROOT?>/public/img/icon/logo.png" alt="Track Master Logo">
                    <!-- Track Master Logo in the middle -->
                </div>



                <div class="account-section">

                    <div class="notification-num">
                        <i class="fa fa-bell"></i>
                        <span class="notification-count"><?php echo $unreadCount['count']?></span>
                        <div class="notification-panel">
                            <div class="notification-header">
                                <h3>Notifications</h3>
                                <button class="mark-all-read">Mark all as read</button>
                            </div>
                            <div class="notifications-list">
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
                                <a href="notifications.php">View all notifications</a>
                            </div>
                        </div>
                    </div>

                    <div class="account-settings">
                        <a href="#">
                            <img src="<?php echo ROOT ?>/public/img/icon/notification.png" alt="acc setting"
                                class="notification-icon"
                                onmouseover="this.src='<?php echo ROOT ?>/public/img/icon/notification-hover.png';"
                                onmouseout="this.src='<?php echo ROOT ?>/public/img/icon/notification.png';"
                                style="width: 33px; height: 33px;margin-right: 10px;">
                        </a>
                    </div>

                    <div class="account-settings">
                        <a href="#">
                            <img src="<?php echo ROOT ?>/public/img/icon/account.png" alt="acc setting"
                                class="account-icon"
                                onmouseover="this.src='<?php echo ROOT ?>/public/img/icon/account-hover.png';"
                                onmouseout="this.src='<?php echo ROOT ?>/public/img/icon/account.png';">
                        </a>
                    </div>

                </div>
            </nav>
        </header>


    </div>

    <!-- Side Navigation Bar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <!-- <img src="<?php echo ROOT?>/public/img/icon/logo.png" alt="Logo" class="sidebar-logo"> -->
        </div>
        <nav class="sidebar-menu">

            <script>
            function hoverLi(liElement, isHover) {
                const img = liElement.querySelector('img[data-icon-name]');
                if (!img) return;

                const iconName = img.getAttribute('data-icon-name');
                const basePath = "<?php echo ROOT ?>/public/img/icon/";
                img.src = isHover ? `${basePath}${iconName}-hover.png` : `${basePath}${iconName}.png`;
            }
            </script>
            <?php
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function isActive($pathPart) {
    global $currentPath;
    return strpos($currentPath, $pathPart) !== false;
    
}
?>


            <ul>
                <li class="<?= isActive('/admin/dashboard') ? 'active' : '' ?>" onmouseover="hoverLi(this, true)"
                    onmouseout="hoverLi(this, false)">
                    <a href="<?php echo ROOT ?>/admin/dashboard" class="menu-link">
                        <img src="<?php echo ROOT ?>/public/img/icon/<?= isActive('/admin/dashboard') ? 'dashboard-hover' : 'dashboard' ?>.png"
                            class="icon" data-icon-name="dashboard">
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="<?= isActive('/admin/userManage') ? 'active' : '' ?>" onmouseover="hoverLi(this, true)"
                    onmouseout="hoverLi(this, false)">
                    <a href="<?php echo ROOT ?>/admin/userManage" class="menu-link">
                        <img src="<?php echo ROOT ?>/public/img/icon/<?= isActive('/admin/userManage') ? 'users-hover' : 'users' ?>.png"
                            class="icon" data-icon-name="users">
                        <span class="menu-text">Manage Users</span>
                    </a>
                </li>
                <li class="<?= isActive('/admin/sportCreate') ? 'active' : '' ?>" onmouseover="hoverLi(this, true)"
                    onmouseout="hoverLi(this, false)">
                    <a href="<?php echo ROOT ?>/admin/sportCreate" class="menu-link">
                        <img src="<?php echo ROOT ?>/public/img/icon/<?= isActive('/admin/sportCreate') ? 'sports-hover' : 'sports' ?>.png"
                            class="icon" data-icon-name="sports">
                        <span class="menu-text">Add Sports</span>
                    </a>
                </li>
                <li class="<?= isActive('/admin/sportManage') ? 'active' : '' ?>" onmouseover="hoverLi(this, true)"
                    onmouseout="hoverLi(this, false)">
                    <a href="<?php echo ROOT ?>/admin/sportManage" class="menu-link">
                        <img src="<?php echo ROOT ?>/public/img/icon/<?= isActive('/admin/sportManage') ? 'manageSports-hover' : 'manageSports' ?>.png"
                            class="icon" data-icon-name="manageSports">
                        <span class="menu-text">Manage Sports</span>
                    </a>
                </li>
                <li class="<?= isActive('/admin/zoneManage') ? 'active' : '' ?>" onmouseover="hoverLi(this, true)"
                    onmouseout="hoverLi(this, false)">
                    <a href="<?php echo ROOT ?>/admin/zoneManage" class="menu-link">
                        <img src="<?php echo ROOT ?>/public/img/icon/<?= isActive('/admin/zoneManage') ? 'zones-hover' : 'zones' ?>.png"
                            class="icon" data-icon-name="zones">
                        <span class="menu-text">Manage Zones</span>
                    </a>
                </li>
                <li class="<?= isActive('/admin/zonalSport') ? 'active' : '' ?>" onmouseover="hoverLi(this, true)"
                    onmouseout="hoverLi(this, false)">
                    <a href="<?php echo ROOT ?>/admin/zonalSport" class="menu-link">
                        <img src="<?php echo ROOT ?>/public/img/icon/<?= isActive('/admin/zonalSport') ? 'assign-hover' : 'assign' ?>.png"
                            class="icon" data-icon-name="assign">
                        <span class="menu-text">Sport Assigning</span>
                    </a>
                </li>
                <li class="<?= isActive('/announcement') ? 'active' : '' ?>" onmouseover="hoverLi(this, true)"
                    onmouseout="hoverLi(this, false)">
                    <a href="#" class="menu-link">
                        <img src="<?php echo ROOT ?>/public/img/icon/<?= isActive('/announcement') ? 'announcement-hover' : 'announcement' ?>.png"
                            class="icon" data-icon-name="announcement">
                        <span class="menu-text">Announcements</span>
                    </a>
                </li>
            </ul>


        </nav>
    </div>






</body>

</html>