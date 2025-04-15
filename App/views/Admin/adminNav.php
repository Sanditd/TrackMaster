<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../Public/css/Admin/navbar.css">
    <script src="../../../Public/js/Admin/sidebar.js"></script>
</head>

<body>
    <!-- Side Navigation Bar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <img src="https://via.placeholder.com/40" alt="Logo" class="sidebar-logo">
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li><a href="<?php echo ROOT ?>/admin/dashboard/ads"><img src="https://via.placeholder.com/20" class="icon"><span class="menu-text">Dashboard</span></a></li>
                <li><a href="<?php echo ROOT ?>/admin/userManage/asdasd"><img src="https://via.placeholder.com/20" class="icon"><span class="menu-text">Manage Users</span></a></li>
                <li><a href="<?php echo ROOT ?>/admin/sportCreate/asdad"><img src="https://via.placeholder.com/20" class="icon"><span class="menu-text">Add Sports</span></a></li>
                <li><a href="<?php echo ROOT ?>/admin/sportManage/asdad"><img src="https://via.placeholder.com/20" class="icon"><span class="menu-text">Manage Sports</span></a></li>
                <li><a href="<?php echo ROOT ?>/admin/zoneManage/asdad"><img src="https://via.placeholder.com/20" class="icon"><span class="menu-text">Manage Zones</span></a></li>
                <li><a href="<?php echo ROOT ?>/admin/zonalSport/asdad"><img src="https://via.placeholder.com/20" class="icon"><span class="menu-text">Sport Assigning</span></a></li>
                <li><a href="#"><img src="https://via.placeholder.com/20" class="icon"><span class="menu-text">Announcements</span></a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="main">
        <!-- Top Navigation Bar -->
        <header>
    <button class="openbtn" onclick="toggleNav()">☰ </button>
    <nav class="navbar">
        

        <div class="track-logo">
            <img src="../../Public/img/logo.png" alt="Track Master Logo"> <!-- Track Master Logo in the middle -->
        </div>

        <div class="account-section">
            <div class="user-details">
                <div class="username">T.H.E.G.THENUWARA</div>
                <div class="user-role">System Admin</div>
            </div>
            <div class="account-settings">
                <a href="#">Account Settings</a>
            </div>
        </div>
    </nav>
</header>

      
    </div>

</body>

</html>
