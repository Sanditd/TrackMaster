<?php require 'navbar.php'; ?>

<div id="sidebar" class="sidebar">
    <span class="close" onmouseleave="closeNav()">
    <div class="profile">
        <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture">
        <div style="font-size:15px;font-weight:bold;white-space: nowrap;">T.H.E.G.THENUWARA</div>
        <br>
        <div style="font-size:10px;white-space: nowrap;">Coach</div>
        <br>
       
        <br>
        <hr>
    </div>

    <nav> 
        <ul>
            <li><a href="<?php echo ROOT ?>/coach/dashboard">Dashboard</a></li>
            <li><a href="<?php echo ROOT ?>/coach/viewprofile">My Profile</a></li>
            <li><a href="<?php echo ROOT ?>/coach/performancetracking">Performance Tracking</a></li>
            <li><a href="<?php echo ROOT ?>/coach/teammanagement">Team Management</a></li>
            <li><a href="<?php echo ROOT ?>/coach/eventmanagement">Event Management</a></li>
            <li><a href="<?php echo ROOT ?>/coach/profilemanagement">Profile Management</a></li>
            <li><a href="<?php echo ROOT ?>/coach/Attendance">Attendance</a></li>
        </ul>
    </nav>
    </span>
</div>

<script src="/TrackMaster/Public/js/sidebar.js"></script>
<script src="/TrackMaster/Public/js/coachlevel.js"></script>
    <script src="/TrackMaster/Public/js/sidebar.js"></script>
    <script src="/TrackMaster/Public/js/coachlevel.js"></script>