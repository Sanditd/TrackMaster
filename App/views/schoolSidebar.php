<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/TrackMaster/Public/css/School/schoolSidebar.css">
</head>
<body>

    <!-- Side Bar -->
    <div id="sidebar" class="sidebar">
        <span class="close" onmouseleave="closeNav()">
        <div class="profile">
            <img src="/TrackMaster/TrackMaster/Public/img/Student/profile.jpeg" alt="Profile Picture">
            <div style="font-size:15px;font-weight:bold;white-space: nowrap;">T.H.E.G.THENUWARA</div>
            <br>
           <hr>
        </div>

        <nav>
            <ul>
                <li><a href="/TrackMaster/TrackMaster/App/views/School/school.php">Dashboard</a></li>
                <li><a href="/TrackMaster/TrackMaster/App/views/School/schoolProfile.php">My Profile</a></li>
                <li><a href="/TrackMaster/TrackMaster/App/views/School/schoolManagement.php">Student Management</a></li>
                <li><a href="/TrackMaster/TrackMaster/App/views/School/schoolFacilities.php">Request Management</a></li>
            </ul>
        </nav>
        </span>
    </div>

    <script src="/TrackMaster/TrackMaster/Public/js/Student/sidebar.js"></script>
    
    
</body>
</html>