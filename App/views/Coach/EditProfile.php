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
            <h2>My profile › Edit Profile</h2>
            <button class="save-button">Save</button>
        </div>
        <div class="profile-form">
            <div class="left-section">
                <div class="profile-picture">
                    <img src="../Public/img/Student/practicing.png" alt="Profile Picture">
                </div>
                <div class="input-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" placeholder="Arthur">
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" placeholder="Nancy">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="********">
                    <span class="change-password">CHANGE PASSWORD</span>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="bradley.ortiz@gmail.com">
                </div>
                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" placeholder="477-046-1827">
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" placeholder="116 Jaskolski Stravenue Suite 883">
                </div>
                <div class="input-group">
                    <label for="nation">Nation</label>
                    <input type="text" id="nation" placeholder="Colombia">
                </div>
            </div>
            <div class="right-section">
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="language">Language</label>
                    <select id="language">
                        <option>English</option>
                        <option>Spanish</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="dob">Date of Birth</label>
                    <div class="dob-group">
                        <select>
                            <option>September</option>
                            <option>October</option>
                        </select>
                        <select>
                            <option>31</option>
                            <option>30</option>
                        </select>
                        <select>
                            <option>1990</option>
                            <option>1991</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" id="twitter" placeholder="twitter.com/envato">
                </div>
                <div class="input-group">
                    <label for="linkedin">LinkedIn</label>
                    <input type="text" id="linkedin" placeholder="linkedin.com/envato">
                </div>
                <div class="input-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" id="facebook" placeholder="facebook.com/envato">
                </div>
                <div class="input-group">
                    <label for="google">Google</label>
                    <input type="text" id="google" placeholder="zachary Ruiz">
                </div>
                <div class="input-group">
                    <label for="slogan">Slogan</label>
                    <input type="text" id="slogan" placeholder="Land acquisition Specialist">
                </div>
                <div class="payment-methods">
                    <h4>Payment Method</h4>
                    <div class="cards">
                        <div class="card">Visa ... 8314 <span>Expires 06/21</span></div>
                        <div class="card">Master ... 8314 <span>Expires 07/19</span></div>
                    </div>
                    <button class="add-payment">ADD PAYMENT METHOD</button>
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