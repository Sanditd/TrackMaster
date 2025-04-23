<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Profile</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/School/editSchool.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Added Font Awesome -->
</head>
<body>
    
    <?php include 'navbar.php'?>
    <?php include 'sidebar.php'?>

    <div id="main">
        <div class="container">
            <div class="header">
                <h2><i class="fas fa-school"></i> School Profile</h2>
                <button class="edit-button" onclick="window.location.href='<?php echo URLROOT ?>/School/EditProfile'">
                    <i class="fas fa-edit"></i> Edit My Profile
                </button>
            </div>
            
            <div class="profile-form">
                <div class="left-section">
                    <div class="profile-picture">
                        <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture">
                    </div>
            
                    <div class="input-group">
                        <label for="name"><i class="fas fa-building"></i> School Name</label>
                        <input type="text" id="first-name" value="Maliyadewa Collage, Kurunagala" readonly>
                    </div>
                
                    <div class="input-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email" value="maliyadewaclg@gmail.com" readonly>
                    </div>

                    <div class="input-group">
                        <label for="phone"><i class="fas fa-phone"></i> Telephone Number</label>
                        <input type="text" id="phone" value="033-2721456" readonly>
                    </div>
                    
                    <div class="input-group">
                        <label for="code"><i class="fas fa-code"></i> School Code</label>
                        <input type="text" id="number" value="R002" readonly>
                    </div>
                </div>

                <div class="right-section">
                    <div class="input-group">
                        <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                        <input type="text" id="address" value="Maliyadeva College, Negombo Rd, Kurunegala" readonly>
                    </div>

                    <div class="input-group">
                        <label for="zone"><i class="fas fa-location-dot"></i> Zone</label>
                        <input type="text" id="zone" value="Kurunagala" readonly>
                    </div>

                    <div class="input-group">
                        <label for="province"><i class="fas fa-globe-asia"></i> Province</label>
                        <select id="province" name="province" disabled>
                            <option value="north-western" selected>North western</option>
                            <option value="central">Central</option>
                            <option value="eastern">Eastern</option>
                            <option value="northern">Northern</option>
                            <option value="southern">Southern</option>
                            <option value="western">Western</option>
                            <option value="uva">Uva</option>
                            <option value="sabaragamuwa">Sabaragamuwa</option>
                            <option value="north-central">North Central</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="facilities"><i class="fas fa-dumbbell"></i> Facilities Available</label>
                    </div>
                    <div class="checkbox-container">
                        <label><input type="checkbox" checked disabled> Track</label>
                        <label><input type="checkbox" disabled> Indoor</label>
                        <label><input type="checkbox" checked disabled> Ground</label>
                        <label><input type="checkbox" disabled> Swimming Pool</label>
                        <label><input type="checkbox" disabled> Other</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>
