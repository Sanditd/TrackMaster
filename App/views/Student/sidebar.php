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
            <div style="font-size:15px;font-weight:bold;white-space: nowrap;">T.H.E.G.THENUWARA</div>
            <br>
            <div style="font-size:10px;white-space: nowrap;">Student Player</div>
            <div>
                <select id="status">
                  <option value="rest">Rest</option>
                  <option value="practicing">Practicing</option>
                  <option value="meet">In a Meet</option>
                  <option value="injury">Injury</option>
                  <option value="studying">Studying</option>
                </select>
              </div>
            <br>
            <hr>
        </div>

        <nav>
            <ul>
                <li><a href="<?php echo URLROOT ?>/Student/dashboard">Dashboard</a></li>
                <li><a href="<?php echo URLROOT ?>/Student/studentprofile">My Profile</a></li>
                <li><a href="<?php echo URLROOT ?>/Coach/performancetracking">My Performance</a></li>
                <li><a href="<?php echo URLROOT ?>/Student/studentSchedule">My Schedule</a></li>
            </ul>
        </nav>
        </span>
    </div>

    <script src="/TrackMaster/Public/js/sidebar.js"></script>
    <script src="/TrackMaster/Public/js/profile.js"></script>
    
</body>
</html>