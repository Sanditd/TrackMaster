<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Profile</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/profile.css">

</head>
<body>

<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>

    <div id="main">

    <div class="container">
        <div class="header">
            <h2>Guardian Profile</h2>
        </div>
        
    <div class="profile-form">
            <div class="left-section">
                <div class="profile-picture">
                    <img src="/TrackMaster/Public/img/profile.jpeg"" alt="Profile Picture">
                </div>
                <div class="input-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" value="Samantha" readonly>
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" value="Thenuwara" readonly>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="Samantha@gmail.com" readonly>
                </div>
            
            </div>

            <div class="right-section">
                <div class="input-group">
                    <label for="phone">WhatsApp Number</label>
                    <input type="text" id="phone" value="0774589123" readonly>
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" value="55/4A, Pirivena Road, Ratmalana" readonly>
                </div>
                
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" disabled>
                        <option selected>Male</option>
                        <option>    Female</option>
                    </select>
                </div>
           
                
                <div class="input-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" id="occupation" value="Accountant Manager" readonly>
                </div>
                <div class="input-group">
                    <label for="occu-address">Occupation Address</label>
                    <input type="text" id="occu-address" value="No 15- Kurunagala" readonly>
                </div>
             
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>

</body>
</html>