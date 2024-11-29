<div id="sidebar" class="sidebar">
        <span class="close" onmouseleave="closeNav()">
        <div class="profile">
            <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture">
            <div style="font-size:15px;font-weight:bold;white-space: nowrap;">T.H.E.G.THENUWARA</div>
            <br>
            <div style="font-size:10px;white-space: nowrap;">Coach - Cricket</div>
            <br>
            <div>
                <select id="level">
                  <option value="zonal">Zonal</option>
                  <option value="provincial">Provincial</option>
                  <option value="national">National</option>
                </select>
              </div>
            <br>
            <hr>
        </div>

        <nav>
            <ul>
                <li><a href="<?php echo ROOT ?>/coach/dashboard">Dashboard</a></li>
                <li><a href="<?php echo ROOT ?>/coach/viewprofile">My Profile</a></li>
                <li><a href="<?php echo ROOT ?>/coach/performancetracking">Performancce Tracking</a></li>
                <li><a href="<?php echo ROOT ?>/coach/teammanagement">Team Management</a></li>
                <li><a href="<?php echo ROOT ?>/coach/eventmanagement">Event Management</a></li>
                <li><a href="../Student/Profile Management.html">Profile Management</a></li>
            </ul>
        </nav>
        </span>
    </div>

    <div id="main">
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
    </div>

    <script src="/TrackMaster/Public/js/sidebar.js"></script>
    <script src="/TrackMaster/Public/js/coachlevel.js"></script>