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
    <title>TrackMaster - Coach Dashboard</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="<?php echo ROOT?>/Public/js/notification.js"></script>
    <style>
        :root {
            
            --secondary-color: #ffa500;
            --accent-color: #333;
            --text-light: #ffffff;
            --text-dark: #333333;
            --shadow: 0 4px 12px rgba(0, 38, 77, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            color: var(--text-dark);
            background-color: #f5f5f5;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ===== HEADER STYLES ===== */
        header {
            background-color: rgb(8, 8, 8);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
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
            transition: var(--transition);
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            list-style: none;
            align-items: center;
        }

        .nav-links li {
            margin-left: 20px;
            position: relative;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-links a:hover {
            background: var(--secondary-color);
            color: var(--text-light);
            transform: translateY(-2px);
        }

        .nav-links a i {
            font-size: 1.1rem;
        }

        /* ===== LOGIN BUTTON ===== */
        .login {
            margin-left: 30px;
            background-color: var(--secondary-color);
            color: var(--text-light);
            border: none;
            padding: 10px 18px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login:hover {
            background-color: #e69400;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 165, 0, 0.3);
        }

        .login:active {
            transform: scale(0.98);
        }

        /* ===== NOTIFICATION STYLES ===== */
        .notification-icon {
            background-color: var(--accent-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            transition: var(--transition);
        }

        .notification-icon i {
            color: var(--text-light);
            font-size: 1.2rem;
        }

        .notification-icon:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff3e3e;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .notification-panel {
            position: absolute;
            top: 50px;
            right: -100px;
            width: 320px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: none;
            overflow: hidden;
        }

        .notification-num:hover .notification-panel {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .notification-header h3 {
            color: var(--secondary-color);
            font-size: 1.1rem;
        }

        .mark-all-read {
            background: none;
            border: none;
            color: var(--secondary-color);
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .mark-all-read:hover {
            text-decoration: underline;
        }

        .notification-list {
            max-height: 300px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--secondary-color) #f1f1f1;
        }

        .notification-list::-webkit-scrollbar {
            width: 5px;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background-color: var(--secondary-color);
            border-radius: 10px;
        }

        .notification-item {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
            transition: var(--transition);
        }

        .notification-item:hover {
            background-color: #f9f9f9;
        }

        .active-notification {
            border-left: 3px solid var(--secondary-color);
            background-color: rgba(255, 165, 0, 0.05);
        }

        .notification-item .title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .notification-item .description {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 8px;
        }

        .notification-item .time {
            font-size: 0.8rem;
            color: #888;
        }

        .mark-read-btn {
            background-color: transparent;
            border: 1px solid var(--secondary-color);
            color: var(--secondary-color);
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            cursor: pointer;
            margin-top: 5px;
            transition: var(--transition);
        }

        .mark-read-btn:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .notification-footer {
            padding: 12px;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .notification-footer a {
            text-decoration: none;
            font-size: 0.9rem;
            color: var(--secondary-color);
            transition: var(--transition);
        }

        .notification-footer a:hover {
            text-decoration: underline;
        }

        /* ===== SIDEBAR STYLES ===== */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, rgb(8, 8, 8) 0%, var(--accent-color) 100%);
            color: var(--text-light);
            overflow-x: hidden;
            transition: width 0.3s ease-in-out;
            padding-top: 40px;
            box-shadow: var(--shadow);
        }

        .sidebar .profile {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid var(--secondary-color);
            transition: var(--transition);
            object-fit: cover;
        }

        .sidebar .profile img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(255, 165, 0, 0.4);
        }

        .profile-details {
            margin-top: 10px;
        }

        .profile-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .profile-role {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            background-color: rgba(255, 255, 255, 0.1);
            padding: 3px 10px;
            border-radius: 12px;
            display: inline-block;
        }

        .sidebar nav {
            margin-top: 20px;
        }

        .sidebar nav ul {
            list-style-type: none;
            padding: 0 10px;
        }

        .sidebar nav ul li {
            margin: 10px 0;
        }

        .sidebar nav ul li a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .sidebar nav ul li a:hover {
            background: rgba(255, 165, 0, 0.2);
            transform: translateX(5px);
        }

        .sidebar nav ul li a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--secondary-color);
            opacity: 0;
            transition: var(--transition);
        }

        .sidebar nav ul li a:hover::before {
            opacity: 1;
        }

        .sidebar nav ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            padding: 15px;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .close {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 24px;
            color: var(--text-light);
            transition: var(--transition);
        }

        .close:hover {
            color: var(--secondary-color);
        }

        .openbtn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
            color: white;
            transition: var(--transition);
        }

        .openbtn:hover {
            color: var(--secondary-color);
        }

        /* ===== MAIN CONTENT PADDING ===== */
        .main-content {
            transition: margin-left 0.3s ease-in-out;
            padding: 20px;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes bellRing {
            0%, 100% { transform-origin: top; }
            15% { transform: rotateZ(10deg); }
            30% { transform: rotateZ(-10deg); }
            45% { transform: rotateZ(5deg); }
            60% { transform: rotateZ(-5deg); }
            75% { transform: rotateZ(2deg); }
        }

        /* ===== RESPONSIVE STYLES ===== */
        @media (max-width: 992px) {
            .logo {
                width: 30%;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: row;
                padding: 10px;
            }

            .logo {
                width: 40%;
                margin: 0 auto;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                position: fixed;
                top: 80px;
                left: 0;
                width: 100%;
                background-color: var(--primary-color);
                padding: 20px 0;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                z-index: 99;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-links li {
                margin: 10px 0;
                width: 100%;
                text-align: center;
            }

            .nav-links a {
                padding: 12px;
                width: 100%;
                justify-content: center;
            }

            .mobile-menu-btn {
                display: block;
                background: none;
                border: none;
                color: var(--text-light);
                font-size: 24px;
                cursor: pointer;
            }

            .notification-panel {
                right: -150px;
                width: 300px;
            }
        }

        @media (max-width: 576px) {
            .logo {
                width: 50%;
            }

            .notification-panel {
                right: -120px;
                width: 280px;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <button class="openbtn" onclick="toggleNav()"><i class="fas fa-bars"></i></button>
            <div class="logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="TrackMaster Logo">
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="<?php echo URLROOT ?>/school/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="<?php echo URLROOT ?>/school/aboutUs"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li><a href="<?php echo URLROOT ?>/school/help"><i class="fas fa-question-circle"></i> Help</a></li>
                <li>
                    <div class="notification-num">
                        <div class="notification-icon">
                            <i class="fas fa-bell"></i>
                            <?php if ($unreadCount['count'] > 0): ?>
                                <span class="notification-count"><?php echo $unreadCount['count']?></span>
                            <?php endif; ?>
                        </div>
                        <div class="notification-panel">
                            <div class="notification-header">
                                <h3>Notifications</h3>
                                <button class="mark-all-read" onclick="markAllAsRead()">Mark all as read</button>
                            </div>
                            <div class="notification-list">
                                <?php if (is_array($notifications) && !empty($notifications['notifications'])): ?>
                                    <?php foreach ($notifications['notifications'] as $notification): ?>
                                        <div class="notification-item <?php echo $notification->active == 1 ? 'active-notification' : ''; ?>" data-id="<?php echo htmlspecialchars($notification->n_id); ?>">
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
                                <?php else: ?>
                                    <div class="notification-item">
                                        <div class="title">No notifications</div>
                                        <div class="description">You don't have any notifications at the moment.</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="notification-footer">
                                <a href="<?php echo URLROOT ?>/coach/allNotifications">View all notifications</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <button class="login" onclick="window.location.href='<?php echo URLROOT ?>/loginController/logout'">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </li>
            </ul>
            
        </nav>
    </header>

    <div id="sidebar" class="sidebar">
        <span class="close" onclick="closeNav()"><i class="fas fa-times"></i></span>
        <div class="profile">
            <img src="\TrackMaster\Public\img\users\Screenshot 2025-04-29 0029.png" alt="Profile Picture">
            <div class="profile-details">
                <div class="profile-name"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></div>
                <div class="profile-role">School</div>
            </div>
        </div>

        <nav> 
            <ul>
            <li><a href="<?php echo URLROOT ?>/School/Dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
<li><a href="<?php echo URLROOT ?>/School/Profile"><i class="fas fa-user"></i> My Profile</a></li>
<li><a href="<?php echo URLROOT ?>/School/StudentsData"><i class="fas fa-users"></i> Student Records</a></li>
<li><a href="<?php echo URLROOT ?>/School/records"><i class="fas fa-book"></i> Academic Records</a></li>
<li><a href="<?php echo URLROOT ?>/School/requests"><i class="fas fa-tasks"></i> Request Management</a></li>

            </ul>
        </nav>

        <div class="sidebar-footer">
            TrackMaster &copy; <?php echo date('Y'); ?>
        </div>
    </div>

    </header>

   
    <script>

function openNav() {
    document.getElementById("sidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("sidebar").style.width = "0"; 
}

function toggleNav() {
    const sidebar = document.getElementById("sidebar");
    sidebar.style.width = sidebar.style.width === "250px" ? "0" : "250px"; 
}

    </script>
</body>
</html>

