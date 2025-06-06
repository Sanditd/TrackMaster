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
    <style>
    /* Account Dropdown Menu Styles */
    .account-dropdown {
        position: relative;
        display: inline-block;
    }

    .account-menu {
        position: absolute;
        top: 45px;
        right: 0;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 180px;
        z-index: 1000;
        display: none;
    }

    .account-menu.show {
        display: block;
    }

    .account-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .account-menu ul li {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        transition: background 0.3s;
    }

    .account-menu ul li:last-child {
        border-bottom: none;
    }

    .account-menu ul li:hover {
        background-color: #f5f5f5;
    }

    .account-menu ul li a {
        color: #333;
        text-decoration: none;
        display: block;
    }

    .account-menu ul li.logout a {
        color: #e74c3c;
    }
    </style>
</head>

<body>

    <!-- Main Content -->
    <div id="main">
        <!-- Top Navigation Bar -->
        <header>
            <nav class="navbar">



                <img src="<?php echo ROOT ?>/public/img/icon/admin_profile.png" alt="admin profile"
                    class="admin-profile" style="width: 55px; height: 55px;">
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
                        <span class="notification-count"><?php echo $unreadCount['count']?></span>
                        <div class="notification-panel">
                            <div class="notification-header">
                                <h3>Notifications</h3>
                                <button class="mark-all-read">Mark all as read</button>
                            </div>
                            <div class="notification-list">
                                <?php if (is_array($notifications)): ?>
                                <?php foreach ($notifications['notifications'] as $notification): ?>
                                <div class="notification-item <?php echo $notification->active == 1 ? 'active-notification' : ''; ?>"
                                    <?php if (in_array($notification->type, ['school_registration', 'admin_registration', 'coach_registration'])): ?>
                                    data-type="<?php echo htmlspecialchars($notification->type); ?>"
                                    data-id="<?php echo htmlspecialchars($notification->n_id); ?>"
                                    onclick="loadViewByType('<?php echo htmlspecialchars($notification->type); ?>', <?php echo htmlspecialchars($notification->n_id); ?>)"
                                    style="cursor: pointer;" <?php endif; ?>>
                                    <div class="title"><?php echo htmlspecialchars($notification->title); ?></div>
                                    <div class="description"><?php echo htmlspecialchars($notification->description); ?>
                                    </div>
                                    <div class="time">
                                        <?php echo date('M j, Y g:i A', strtotime($notification->date)); ?></div>

                                    <?php if ($notification->active == 1): ?>
                                    <form action="<?php echo ROOT ?>/NotificationController/markAsRead" method="POST"
                                        class="mark-read-form">
                                        <input type="hidden" name="notification_id"
                                            value="<?php echo htmlspecialchars($notification->n_id); ?>">
                                        <input type="hidden" name="redirect_url"
                                            value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                        <button class="mark-read-btn" type="submit"
                                            onclick="event.stopPropagation();">Mark as read</button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="notification-footer">
                                <a href="<?php echo ROOT ?>/admin/notification">View all notifications</a>
                            </div>
                        </div>
                    </div>

                    <script>
                    function loadViewByType(type, notificationId) {
                        // Prevent default behavior if needed
                        event.preventDefault();

                        // Map notification types to their respective views
                        const viewUrls = {
                            'school registration': '<?php echo ROOT ?>/admin/inactiveUsers',
                            'Admin registration': '<?php echo ROOT ?>/admin/inactiveUsers',
                            'coach registration': '<?php echo ROOT ?>/admin/inactiveUsers'
                        };

                        // Check if the notification type is in our mapping
                        if (viewUrls[type]) {
                            // Construct the URL with the notification ID
                            const url = viewUrls[type] + notificationId;

                            // Navigate to the URL
                            window.location.href = url;

                            // Also mark the notification as read
                            fetch('<?php echo ROOT ?>/NotificationController/markAsRead', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: 'notification_id=' + notificationId + '&redirect_url=' +
                                    encodeURIComponent(url)
                            });
                        }
                    }
                    </script>

                    <div class="account-settings">
                        <a href="#">
                            <img src="<?php echo ROOT ?>/public/img/icon/notification.png" alt="acc setting"
                                class="notification-icon"
                                onmouseover="this.src='<?php echo ROOT ?>/public/img/icon/notification-hover.png';"
                                onmouseout="this.src='<?php echo ROOT ?>/public/img/icon/notification.png';"
                                style="width: 33px; height: 33px;margin-right: 10px;">
                        </a>
                    </div>

                    <div class="account-settings account-dropdown">
                        <a href="#" id="accountDropdownToggle">
                            <img src="<?php echo ROOT ?>/public/img/icon/account.png" alt="acc setting"
                                class="account-icon"
                                onmouseover="this.src='<?php echo ROOT ?>/public/img/icon/account-hover.png';"
                                onmouseout="this.src='<?php echo ROOT ?>/public/img/icon/account.png';">
                        </a>
                        <!-- Account Dropdown Menu -->
                        <div class="account-menu" id="accountDropdownMenu">
                            <ul>
                                <li><a href="<?php echo ROOT ?>/admin/accountSetting">Account Settings</a></li>
                                <li><a href="<?php echo ROOT ?>/admin/adminActivity">Activity Log</a></li>
                                <li class="logout"><a href="<?php echo ROOT ?>/loginController/adminLogout">Logout</a>
                                </li>
                            </ul>
                        </div>
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
                <li class="<?= isActive('/admin/notification') ? 'active' : '' ?>" onmouseover="hoverLi(this, true)"
                    onmouseout="hoverLi(this, false)">
                    <a href="<?php echo ROOT ?>/admin/notification" class="menu-link">
                        <img src="<?php echo ROOT ?>/public/img/icon/<?= isActive('/admin/notification') ? 'notification-hover' : 'notification' ?>.png"
                            class="icon" data-icon-name="notification">
                        <span class="menu-text">Notification</span>
                    </a>
                </li>
                <li class="<?= isActive('/inactiveUsers') ? 'active' : '' ?>" onmouseover="hoverLi(this, true)"
                    onmouseout="hoverLi(this, false)">
                    <a href="<?php echo ROOT ?>/admin/inactiveUsers" class="menu-link">
                        <img src="<?php echo ROOT ?>/public/img/icon/<?= isActive('/inactiveUsers') ? 'inactiveUsers-hover' : 'inactiveUsers' ?>.png"
                            class="icon" data-icon-name="inactiveUsers">
                        <span class="menu-text">Inactive Users</span>
                    </a>
                </li>
            </ul>


        </nav>
    </div>

    <script>
    // Script for account dropdown menu
    document.addEventListener('DOMContentLoaded', function() {
        const accountToggle = document.getElementById('accountDropdownToggle');
        const accountMenu = document.getElementById('accountDropdownMenu');

        // Toggle dropdown when account icon is clicked
        accountToggle.addEventListener('click', function(e) {
            e.preventDefault();
            accountMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!accountToggle.contains(e.target) && !accountMenu.contains(e.target)) {
                accountMenu.classList.remove('show');
            }
        });
    });
    </script>

</body>

</html>