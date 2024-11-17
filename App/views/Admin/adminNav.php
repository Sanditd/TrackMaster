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
                        <li><a href="<?php echo ROOT ?>/dashboard/dashboard/ads">Dashboard</a></li>
                        <li><a href="<?php echo ROOT ?>/userManageController/userManage/asdasd">Manage Users</a></li>
                        <li><a href="#" class="open-popup" data-popup="addSport">Add Sports</a></li>
                        <li><a href="#" class="open-popup" data-popup="manageSport">Manage Sports</a></li>
                        <li><a href="#" class="open-popup" data-popup="annoucements">Announcements</a></li>
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

<script>
    document.getElementById('manageUsersLink').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the default link behavior

    const targetUrl = this.getAttribute('href'); // Get the href attribute of the link
    const pageTitle = "Manage Users"; // Set the title of the page (optional)

    // Update the URL without reloading the page
    history.pushState(null, pageTitle, targetUrl);

    // Optionally, load the content via AJAX
    // Uncomment the following lines if you want to load the page content dynamically
    /*
    fetch(targetUrl)
        .then(response => response.text())
        .then(html => {
            document.getElementById('content').innerHTML = html; // Replace 'content' with your target div ID
        });
    */
});

</script>
