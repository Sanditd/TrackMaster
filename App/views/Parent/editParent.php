<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guardian Profile | TrackMaster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/parent/editParent.css">
</head>
<body>
    <?php require 'navbar.php'; ?>
    <?php require 'sidebar.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <h1><i class="fas fa-user"></i> Guardian Profile › Edit Profile</h1>
        </div>

        <div class="profile-form">
            <div class="left-section">
                <div class="profile-picture">
                    <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture" id="profile-pic-preview">
                    <label for="profile-pic-input" class="photo-upload-label"><i class="fas fa-camera"></i> Change Photo</label>
                    <input type="file" id="profile-pic-input" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="first-name"><i class="fas fa-user"></i> First Name</label>
                    <input type="text" id="first-name">
                </div>
                <div class="form-group">
                    <label for="last-name"><i class="fas fa-user"></i> Last Name</label>
                    <input type="text" id="last-name">
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email">
                </div>
                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> WhatsApp Number</label>
                    <input type="text" id="phone">
                </div>
            </div>

            <div class="right-section">
                <div class="form-group">
                    <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <input type="text" id="address">
                </div>
                <div class="form-group">
                    <label for="occupation"><i class="fas fa-briefcase"></i> Occupation</label>
                    <input type="text" id="occupation">
                </div>
                <div class="form-group">
                    <label for="occu-address"><i class="fas fa-building"></i> Occupation Address</label>
                    <input type="text" id="occu-address">
                </div>
                <div class="form-group">
                    <label for="student"><i class="fas fa-user-graduate"></i> Student</label>
                    <input type="text" id="student">
                </div>
                <div class="btn-container">
                    <button type="submit" class="edit-btn"><i class="fas fa-save"></i> Save Changes</button>
                    <button class="cancel-btn" onclick="window.location.href='<?php echo URLROOT ?>/guardian/parentProfile'"><i class="fas fa-ban"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    <script>
// Pre-fill inputs from localStorage
window.addEventListener('load', function() {
    const savedProfile = JSON.parse(localStorage.getItem('guardianProfile'));
    if (savedProfile) {
        document.getElementById('first-name').value = savedProfile.firstName || '';
        document.getElementById('last-name').value = savedProfile.lastName || '';
        document.getElementById('email').value = savedProfile.email || '';
        document.getElementById('phone').value = savedProfile.phone || '';
        document.getElementById('address').value = savedProfile.address || '';
        document.getElementById('occupation').value = savedProfile.occupation || '';
        document.getElementById('occu-address').value = savedProfile.occupationAddress || '';
        document.getElementById('student').value = savedProfile.student || '';
    }
});

// Save changes to localStorage when Save Changes is clicked
document.querySelector('.edit-btn').addEventListener('click', function(event) {
    event.preventDefault();

    const profileData = {
        firstName: document.getElementById('first-name').value,
        lastName: document.getElementById('last-name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        address: document.getElementById('address').value,
        occupation: document.getElementById('occupation').value,
        occupationAddress: document.getElementById('occu-address').value,
        student: document.getElementById('student').value
    };

    localStorage.setItem('guardianProfile', JSON.stringify(profileData));
    alert('Profile saved!');
    window.location.href = "<?php echo URLROOT ?>/guardian/parentProfile";
});
    </script>

</body>
</html>
