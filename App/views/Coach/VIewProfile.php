<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Public/css/Coach/Profile.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="container">
        <div class="header">
            <h2>My Profile</h2>
           
            <button id = "editprofile" class="edit-button">
            <a href="<?php echo ROOT; ?>/coach/editprofile">Edit Profile</a>
            </button>
            
        </div>
        <div class="profile-form">
            <div class="left-section">
                <div class="profile-picture">
                    <img src="../Public/img/Student/practicing.png" alt="Profile Picture">
                </div>
                <div class="input-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" value="Sandith" readonly>
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" value="Moras" readonly>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" value="********" readonly>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="sandith@gmail.com" readonly>
                </div>
                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" value="0764911397" readonly>
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" value="55/4A, Pirivena Road, Ratmalana" readonly>
                </div>
            </div>
            <div class="right-section">
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" disabled>
                        <option selected>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="dob">Date of Birth</label>
                    <div class="dob-group">
                        <select disabled>
                            <option selected>September</option>
                            <option>October</option>
                        </select>
                        <select disabled>
                            <option selected>31</option>
                            <option>30</option>
                        </select>
                        <select disabled>
                            <option selected>1990</option>
                            <option>1991</option>
                        </select>
                    </div>
                </div>
                
                <div class="input-group">
                    <label for="account-number">Account Number</label>
                    <input type="text" id="account-number" value="1001 1001 1001" readonly>
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea id="description" rows="16" readonly >"Experienced cricket coach with over 10 years of expertise in developing and mentoring young athletes. Skilled in building strong team dynamics, enhancing individual performance, and creating personalized training plans to help players reach their highest potential. Passionate about fostering a positive and disciplined environment that encourages growth, resilience, and sportsmanship. Proven track record in leading teams to victory in regional and national tournaments. Dedicated to supporting each player's journey from beginner to elite athlete."</textarea>               
                </div>
            
            </div>
        </div>
    </div>

    <script src="../Public/js/Student/carousel.js"></script>
    <script src="../Public/js/Student/profile.js"></script>
    <script src="../Public/js/sidebar.js"></script>
    <script src="../Public/js/Student/calender.js"></script>

</body>
</html>
