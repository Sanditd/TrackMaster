
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
</head>
<body>

    <header>
        <button class="openbtn" onclick="toggleNav()">☰ </button>

        <nav class="navbar" id="navbar">
            <div class="logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="Logo"> 
            </div>
            <ul class="nav-links">
                <li><a href="/TrackMaster/App/views/Student/dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="/TrackMaster/App/views/aboutUs.php">About Us</a></li>
                <li><a href="/TrackMaster/App/views/help.php">Help & Support</a></li>    
                <li><button class="login" onclick="" >Log in</button></li>
                <li><img src="/TrackMaster/Public/img/log in.png" alt="Logo"> </li>
                <li><img src="/TrackMaster/Public/img/notification.png" alt="Logo"> </li>
            </ul>
        </nav>
    </header>
    
</body>
</html>
