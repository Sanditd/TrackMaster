<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/sidebar.css">

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
                <li><button class="login" onclick="window.location.href='<?php echo URLROOT ?>/login'">Log in</button></li>
                <li><img src="/TrackMaster/Public/img/log in.png" alt="Logo"> </li>
                <li><img src="/TrackMaster/Public/img/notification.png" alt="Logo"> </li>
            </ul>
        </nav>
    </header>

        <span class="close" onmouseleave="closeNav()">
        <div id="sidebar" class="sidebar">
            
                <div class="profile">
                    <img src="../../Public/img/profile.jpeg" alt="Profile Picture">
                    <div style="font-size:15px;font-weight:bold;white-space: nowrap;position:fix">T.H.E.G.THENUWARA
                    </div>
                    <br>
                    <div style="font-size:10px;white-space: nowrap;">System Admin</div>
                    <br>
                    <hr>
                </div>
                <nav>
                    <ul>
                        <li><a href="<?php echo ROOT ?>/admin/dashboard/ads">Dashboard</a></li>
                        <li><a href="<?php echo ROOT ?>/admin/userManage/asdasd">Manage Users</a></li>
                        <li><a href="<?php echo ROOT ?>/admin/sportCreate/asdad" >Add Sports</a></li>
                        <li><a href="<?php echo ROOT ?>/admin/sportManage/asdad" >Manage Sports</a></li>
                        <li><a href="#" class="open-popup" data-popup="annoucements">Announcements</a></li>
                    </ul>
                </nav>
            </span>
        </div> 
    <script src="/TrackMaster/Public/js/sidebar.js"></script>
       
</body>

</html>
