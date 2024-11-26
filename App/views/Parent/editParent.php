<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parent Profile</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Parent/editParent.css">
</head>

<body>
<?php include './../navbar.php'?>
<?php include 'sidebar.php'?>

    <!-- Main Content -->
    <div id="main">

        <div class="container">
            <div class="header">
                <h2>Parent profile › Edit Profile</h2>
    
                </a>
            </div>
            <div class="profile-form">
                <div class="left-section">
                    <div class="profile-picture">
                        <img src="/TrackMaster/Public/img/profile.jpeg"" alt="Profile Picture" id="profile-pic-preview">
                        <input type="file" id="profile-pic-input" accept="image/*">
                    </div>
                    <div class="input-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" value="Samantha">
                    </div>
                    <div class="input-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" value="Thenuwara" >
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="Samantha@gmail.com">
                    </div>
                    <div class="input-group">
                        <label for="phone">WhatsApp Number</label>
                        <input type="text" id="phone" value="0774589123">
                    </div>
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" value="55/4A, Pirivena Road, Ratmalana">
                    </div>
                 
    
                  
                    </div>
    
                <div class="right-section">
                    
                    <div class="input-group">
                        <label for="gender">Gender</label>
                        <select id="gender">
                            <option selected>Male</option>
                            <option>Female</option>
                        </select>
                    </div>

                     <div class="input-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" id="occupation" value="Accountant Manager" >
                </div>
                <div class="input-group">
                    <label for="address"><Address></Address></label>
                    <input type="text" id="occupation" value="No 15- Kurunagala" >
                </div>


               
              
                <div class="input-group">
                    <label for="Student">Student</label>
                    <input type="text" id="Student" value="E.Thenuwara" >
                </div>
                <div class="btns">
                        <button  type="submit" class="edit-button">Save Changes</button>
                        <button class="edit-button" onclick="window.location.href='/TrackMaster/App/views/Parent/parentProfile.php'">Cancel</button></center>
                    </div>

                </div>
            </div>
        </div>        

    </div>

    

            <script src="/TrackMaster/Public/js/Student/edit_studentprofile.js"></script>

</body>

<?php include './../footer.php'?>
</html>