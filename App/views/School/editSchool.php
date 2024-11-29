<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit School Profile</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/School/editSchool.css">
</head>

<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>
        

    <!-- Main Content -->
    <div id="main">

        <div class="container">
            <div class="header">
                <h2>School Profile › Edit Profile</h2>
    
                </a>
            </div>
            <div class="profile-form">
                <div class="left-section"> 
                    <div class="profile-picture">
                        <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture" id="profile-pic-preview">
                        <input type="file" id="profile-pic-input" accept="image/*">
                    </div>
                    <div class="input-group">
                        <label for="name">School Name </label>
                        <input type="text" id="first-name" value="Maliyadewa Collage, Kurunagala" >
                    </div>
                   
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="maliyadewaclg@gmail.com" >
                    </div>
    
                    <div class="input-group">
                            <label for="phone">Telephone Number</label>
                            <input type="text" id="phone" value="033-2721456" >
                    </div>
                    
                    <div class="input-group">
                        <label for="code">School Code</label>
                        <input type="text" id="number" value ="R002" >
                    </div>
    
                </div>
    
                <div class="right-section">
    
                    
    
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" value="Maliyadeva College, Negombo Rd, Kurunegala
                        " >
                    </div>
    
                    <div class="input-group">
                        <label for="zone">Zone</label>
                        <input type="text" id="zone" value="Kurunagala" >
                    
                    </div>
    
                    <div class="input-group">
                        <label for="province">Select Province</label>
                        <select id="province" name="province" >
                            <option value="" disabled selected>Select a province</option>
                            <option value="central">Central</option>
                            <option value="eastern">Eastern</option>
                            <option value="northern">Northern</option>
                            <option value="southern">Southern</option>
                            <option value="western">Western</option>
                            <option value="north-central">North Central</option>
                            <option value="uva">Uva</option>
                            <option value="sabaragamuwa">Sabaragamuwa</option>
                            <option value="north-western">North Western</option>
                        </select>
                    </div> 
                    
    
                    
                    <div class="input-group">
                        <label for="facilities">Facilities Available</label>
                    </div>
                        <div class="checkbox-container">
                            <label><input type="checkbox" name="facilities" value="track"> Track</label>
                            <label><input type="checkbox" name="facilities" value="indoor"> Indoor</label>
                            <label><input type="checkbox" name="facilities" value="ground"> Ground</label>
                            <label><input type="checkbox" name="facilities" value="swimming-pool"> Swimming Pool</label>
                            <label><input type="checkbox" name="facilities" value="other"> Other</label>
                        </div>
                    
                        <div class="btns">
                        <button  type="submit" class="edit-button">Save Changes</button>
                        <button class="edit-button" onclick="window.location.href='/TrackMaster/App/views/School/schoolProfile.php'">Cancel</button></center>
                    </div>

                </div>
            </div>
        </div>        

    </div>


    <?php include './../footer.php'?>

</body>
</html>