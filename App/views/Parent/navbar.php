
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
                <li><a href="<?php echo URLROOT ?>/loginController/login">Home</a></li>
                <li><a href="<?php echo URLROOT ?>/common/aboutUs">About Us</a></li>
                <li><a href="<?php echo URLROOT ?>/common/help">Help & Support</a></li>    
                <li><button class="login" onclick="window.location.href='<?php echo URLROOT ?>/login'">Log in</button></li>
                <li><img src="/TrackMaster/Public/img/log in.png" alt="Logo"> </li>
                <li><img src="/TrackMaster/Public/img/notification.png" alt="Logo"> </li>
            </ul>
        </nav>
    </header>
    
</body>
</html>
