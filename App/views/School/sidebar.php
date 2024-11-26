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
            <div style="font-size:15px;font-weight:bold;white-space: nowrap;">S.THENUWARA</div>
            <br>
            <div style="font-size:10px;white-space: nowrap;">Parentr</div>
            
            <br>
            <hr>
        </div>

        <nav>
            <ul>
                <li><a href="/TrackMaster/App/views/School/school.php">Dashboard</a></li>
                <li><a href="/TrackMaster/App/views/School/schoolProfile.php">My Profile</a></li>
                <li><a href="/TrackMaster/App/views/School/schoolStudentData.php">Student Records</a></li>
                <li><a href="/TrackMaster/App/views/Parent/parentProfile.php">Request Management</a></li>
                
            </ul>
        </nav>
        </span>
    </div>
    <script src="/TrackMaster/Public/js/sidebar.js"></script>
<script src="/TrackMaster/Public/js/profile.js"></script>

</body>
</html>