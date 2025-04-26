<?php
//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];


//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getUserById($userId);


//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit School Profile</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/School/editSchool.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>

<div id="main">
    <div class="container">
        <div class="header">
            <h2><i class="fas fa-school"></i> School Profile › Edit Profile</h2>
        </div>

        <div class="profile-form">
            <div class="left-section"> 
                <div class="profile-picture">
                    <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture" id="profile-pic-preview">
                    <input type="file" id="profile-pic-input" accept="image/*">
                </div>

                <div class="input-group">
                    <label for="name"><i class="fas fa-building"></i> School Name</label>
                    <input type="text" id="first-name" value="Maliyadewa Collage, Kurunagala">
                </div>
               
                <div class="input-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" value="maliyadewaclg@gmail.com">
                </div>

                <div class="input-group">
                    <label for="phone"><i class="fas fa-phone"></i> Telephone Number</label>
                    <input type="text" id="phone" value="033-2721456">
                </div>
                
                <div class="input-group">
                    <label for="code"><i class="fas fa-id-badge"></i> School Code</label>
                    <input type="text" id="number" value="R002">
                </div>
            </div>

            <div class="right-section">

                <div class="input-group">
                    <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <input type="text" id="address" value="Maliyadeva College, Negombo Rd, Kurunegala">
                </div>

                <div class="input-group">
                    <label for="zone"><i class="fas fa-location-dot"></i> Zone</label>
                    <input type="text" id="zone" value="Kurunagala">
                </div>

                <div class="input-group">
                    <label for="province"><i class="fas fa-map"></i> Select Province</label>
                    <select id="province" name="province">
                        <option value="central">Central</option>
                        <option value="eastern">Eastern</option>
                        <option value="northern">Northern</option>
                        <option value="southern">Southern</option>
                        <option value="western">Western</option>
                        <option value="north-central">North Central</option>
                        <option value="uva">Uva</option>
                        <option value="sabaragamuwa">Sabaragamuwa</option>
                        <option value="north-western" selected>North Western</option>
                    </select>
                </div> 

                <div class="input-group">
                    <label for="facilities"><i class="fas fa-dumbbell"></i> Facilities Available</label>
                </div>
                <div class="checkbox-container">
                    <label><input type="checkbox" name="facilities" value="track" checked> Track</label>
                    <label><input type="checkbox" name="facilities" value="indoor"> Indoor</label>
                    <label><input type="checkbox" name="facilities" value="ground" checked> Ground</label>
                    <label><input type="checkbox" name="facilities" value="swimming-pool"> Swimming Pool</label>
                    <label><input type="checkbox" name="facilities" value="other"> Other</label>
                </div>
                
                <div class="btns">
                    <button type="submit" class="edit-button"><i class="fas fa-save"></i> Save Changes</button>
                    <button class="edit-button" onclick="window.location.href='<?php echo URLROOT ?>/School/Profile'"><i class="fas fa-ban"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>        
</div>

<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

</body>
</html>
