<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/sidebar.css">
</head>
<body>

<div id="sidebar" class="sidebar">
    <span class="close" onmouseleave="closeNav()">
        <div class="profile">
            <!-- Dynamically Load Profile Picture -->
            <img src="/TrackMaster/Public/img/uploads/<?php echo htmlspecialchars($_SESSION['photo'] ?? 'default.jpg'); ?>" alt="Profile Picture">

            <!-- Display Username -->
            <div style="font-size:15px;font-weight:bold;white-space: nowrap;">
                <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>
            </div>
            <br>

            <!-- Display User Role -->
            <div style="font-size:10px;white-space: nowrap;">
                <?php echo htmlspecialchars($_SESSION['role'] ?? 'Unknown'); ?>
            </div>
            <br>
            <hr>
        </div>

        <nav>
            <ul>
                <li><a href="<?php echo URLROOT ?>/Student/dashboard">Dashboard</a></li>
                <li><a href="<?php echo URLROOT ?>/Student/studentprofile">My Profile</a></li>
                <li><a href="<?php echo URLROOT ?>/Student/PlayerPerformance">My Performance</a></li>
                <li><a href="<?php echo URLROOT ?>/Student/studentSchedule">My Schedule</a></li>
            </ul>
        </nav>
    </span>
</div>

<script src="/TrackMaster/Public/js/sidebar.js"></script>

</body>
</html>
