<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/sidebar.css">
</head>
<body>

    <!-- Side Bar -->
    <div id="sidebar" class="sidebar">
        <span class="close" onmouseleave="closeNav()">
        <div class="profile">
            <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture">
            <div style="font-size:15px;font-weight:bold;white-space: nowrap;">MALIYADEVA BALIKA <br>VIDYALAYA</div>
            <br>
            <div style="font-size:10px;white-space: nowrap;">School</div>
            
            <br>
            <hr>
        </div>

        <nav>
            <ul>
                <li><a href="<?php echo URLROOT ?>/School/Dashboard">Dashboard</a></li>
                <li><a href="<?php echo URLROOT ?>/School/Profile">My Profile</a></li>
                <li><a href="<?php echo URLROOT ?>/School/StudentsData">Student Records</a></li>
                <li><a href="<?php echo URLROOT ?>/School/viewrecords">Acedemic Records</a></li>
                <li><a href="<?php echo URLROOT ?>/School/requests">Request Management</a></li>
                
            </ul>
        </nav>
        </span>
    </div>
    <script src="/TrackMaster/Public/js/sidebar.js"></script>
<script src="/TrackMaster/Public/js/profile.js"></script>

</body>
</html>