<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardian Profile | TrackMaster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/parent/profile.css">
</head>
<body>
    <?php require 'navbar.php'; ?>
    <?php require 'sidebar.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <h1><i class="fas fa-user"></i> Guardian Profile</h1>
            <a href="<?php echo URLROOT ?>/guardian/editParent" class="edit-profile-btn">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        </div>

        <div class="profile-content">
            <!-- Profile Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-picture-container">
                    <div class="profile-picture">
                        <img id="profile-pic" src="/TrackMaster/Public/img/profile.jpeg" alt="Parent Profile Picture">
                    </div>
                </div>
                <div class="profile-info">
                    <h2 class="parent-name" id="display-first-name">Samantha</h2>
                    <p class="parent-title">Parent/Guardian</p>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-envelope"></i></span>
                        <span class="info-text" id="display-email">Samantha@gmail.com</span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-phone"></i></span>
                        <span class="info-text" id="display-phone">0774589123</span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="info-text" id="display-address">55/4A, Pirivena Road, Ratmalana</span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-venus-mars"></i></span>
                        <span class="info-text">Male</span>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="profile-details">
                <!-- Personal Information -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-info-circle"></i>
                        <h2>Personal Information</h2>
                    </div>
                    <div class="detail-content">
                        <p><strong>First Name:</strong> <span id="display-first-name-detail">Samantha</span></p>
                        <p><strong>Last Name:</strong> <span id="display-last-name">Thenuwara</span></p>
                        <p><strong>Student:</strong> <span id="display-student">E.Thenuwara</span></p>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-briefcase"></i>
                        <h2>Professional Information</h2>
                    </div>
                    <div class="detail-content">
                        <p><strong>Occupation:</strong> <span id="display-occupation">Accountant Manager</span></p>
                        <p><strong>Occupation Address:</strong> <span id="display-occupation-address">No 15- Kurunagala</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    <script>
    window.addEventListener('load', function() {
        const savedProfile = JSON.parse(localStorage.getItem('guardianProfile'));
        if (savedProfile) {
            document.getElementById('display-first-name').textContent = savedProfile.firstName || '';
            document.getElementById('display-first-name-detail').textContent = savedProfile.firstName || '';
            document.getElementById('display-last-name').textContent = savedProfile.lastName || '';
            document.getElementById('display-email').textContent = savedProfile.email || '';
            document.getElementById('display-phone').textContent = savedProfile.phone || '';
            document.getElementById('display-address').textContent = savedProfile.address || '';
            document.getElementById('display-occupation').textContent = savedProfile.occupation || '';
            document.getElementById('display-occupation-address').textContent = savedProfile.occupationAddress || '';
            document.getElementById('display-student').textContent = savedProfile.student || '';
        }
    });
    </script>

</body>
</html>
