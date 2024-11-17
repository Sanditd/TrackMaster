<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../Public/css/Admin/navbar.css">
    <script src="../../../Public/js/Admin/sidebar.js"></script>
</head>

<body>
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar">
            <span class="close" onmouseleave="closeNav()">
                <div class="profile">
                    <img src="./assests/profile.jpeg" alt="Profile Picture">
                    <div style="font-size:15px;font-weight:bold;white-space: nowrap;position:fix">T.H.E.G.THENUWARA
                    </div>
                    <br>
                    <div style="font-size:10px;white-space: nowrap;">System Admin</div>
                    <br>
                    <hr>
                </div>
                <nav>
                    <ul>
                        <li><a href="adminpanel.view.php">Dashboard</a></li>
                        <li><a href="#">Manage Users</a></li>
                        <li><a href="#">Add Sports</a></li>
                        <li><a href="#">Manage Sports</a></li>
                        <li><a href="#">Announcements</a></li>
                    </ul>
                </nav>
            </span>
        </div> 

        <!-- Main Content -->
        <div id="main">
            <header>
                <button class="openbtn" onclick="toggleNav()">☰ </button>

                <nav class="navbar" id="navbar">
                    <div class="logo">
                        <img src="./assests/logo.png" alt="Logo">
                    </div>
                    <ul class="nav-links">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Account</a></li>
                    </ul>
                </nav>
            </header>
        </div>

       
</body>

</html>
