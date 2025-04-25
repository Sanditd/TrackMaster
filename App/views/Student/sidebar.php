<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div id="sidebar" class="sidebar">
    <span class="close" onclick="closeNav()">
        <i class="fas fa-times"></i>
    </span>
    <div class="profile">
        <div style="font-size: 14px; color: var(--light-color); white-space: nowrap;">
            Welcome to TrackMaster
            </br>
            </br>

            </br>
            </br>
        </div>
        <!-- Display Username -->
        <div style="font-size: 20px; font-weight: 600; color: var(--secondary-color); white-space: nowrap;">
            <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>
        </div>
        <br>
    </div>
    <nav>
        <ul>
            <li><a href="<?php echo URLROOT ?>/Student/dashboard"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li><a href="<?php echo URLROOT ?>/Student/studentprofile"><i class="fas fa-user"></i> My Profile</a></li>
            <li><a href="<?php echo URLROOT ?>/Student/studentSchedule"><i class="fas fa-calendar-alt"></i> My Schedule</a></li>
            <li><a href="<?php echo URLROOT ?>/Student/studentSchedule"><i class="fas fa-bell"></i> Notifications</a></li>
        </ul>
    </nav>
</div>
<script src="/TrackMaster/Public/js/sidebar.js"></script>
</body>
</html>