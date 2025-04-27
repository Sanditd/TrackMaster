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
    <title>School Profile</title>
    <link rel="stylesheet" href="../Public/css/School/editSchool.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Added Font Awesome -->
</head>
<body>
<?php require 'navbar.php'?>

    <div id="main">
        <div class="profile-container">
            <div class="profile-header">
                <h1><i class="fas fa-user-circle"></i> School Profile</h1>
                <a href="<?php echo ROOT?>/School/EditProfile">
                <button class="edit-profile-btn" onclick="openEditModal()">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
                </a>
            </div>

            <div class="profile-content">
                <!-- Profile Sidebar -->
                <div class="profile-sidebar">
                    <div class="profile-picture-container">
                        <div class="profile-picture">
                            <img src="/TrackMaster/Public/img/profile.jpeg" alt="School Profile Picture" id="profile-image">
                        </div>
                    </div>
                    <div class="profile-info">
                        <h2 class="student-name" id="display-name">Maliyadewa Collage, Kurunagala </h2>
                        <p class="student-title">School</p>
                    
                    </div>
                </div>

                <div class="detail-card">
        <div class="detail-header">
            <i class="fas fa-address-card"></i>
            <h2>School Information</h2>
        </div>
        <div class="detail-content">
    <?php 
        // Print the user information array
        $userInfo = $data['userInfo'][0];
        $schoolInfo = $data['schoolInfo'][0];
    ?>

    <div class="info-group">
        <span class="info-icon"><i class="fas fa-envelope"></i></span>
        <span class="info-text"><strong>Email:</strong> <span id="display-email"><?= $userInfo->email ?></span></span>
    </div>
    
    <div class="info-group">
        <span class="info-icon"><i class="fab fa-whatsapp"></i></span>
        <span class="info-text"><strong>Phone:</strong> <span id="display-phone"><?= $userInfo->phonenumber ?></span></span>
    </div>
    
    <div class="info-group">
        <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
        <span class="info-text"><strong>Address:</strong> <span id="display-address"><?= $userInfo->address ?></span></span>
    </div>

    <div class="info-group">
    <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
    <span class="info-text">
        <strong>Zone:</strong>
        <span id="display-zone"><?= $zoneInfo[0]->zoneName ?? 'Not specified' ?></span>
    </span>
</div>

<div class="info-group">
    <span class="info-icon"><i class="fas fa-globe-asia"></i></span>
    <span class="info-text">
        <strong>Province:</strong>
        <span id="display-province"><?= $zoneInfo[0]->provinceName ?? 'Not specified' ?></span>
    </span>
</div>


</div>

       
  



</div>
    </div>
</div>
</div>

    <!-- Edit Profile Modal -->
<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fas fa-school"></i> School Profile › Edit Profile</h2>
            <button class="close-modal" onclick="closeEditModal()">&times;</button>
        </div>
        <div class="modal-body">
            <form id="editProfileForm">
                <div class="profile-form-container">
                    <div class="left-section"> 
                        <div class="photo-upload">
                            <label class="photo-upload-label">
                                <div class="photo-preview">
                                    <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture" id="photo-preview-img">
                                    <div class="photo-preview-overlay">
                                        <i class="fas fa-camera fa-2x"></i>
                                    </div>
                                </div>
                                <span style="color: var(--primary-color); font-weight: 600;">Change Photo</span>
                                <input type="file" id="profile-photo" accept="image/*">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="name"></i> School Name</label>
                            <input type="text" id="name" value="Maliyadewa Collage, Kurunagala" required>
                        </div>
                       
                        <div class="form-group">
                            <label for="email"></i> Email</label>
                            <input type="email" id="email" value="maliyadewaclg@gmail.com" required>
                        </div>

                        <div class="form-group">
                            <label for="phone"></i> Telephone Number</label>
                            <input type="text" id="phone" value="033-2721456" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="code"></i> School Code</label>
                            <input type="text" id="code" value="R002" required>
                        </div>
                    </div>

                    <div class="right-section">
                        <div class="form-group">
                            <label for="address"></i> Address</label>
                            <input type="text" id="address" value="Maliyadeva College, Negombo Rd, Kurunegala" required>
                        </div>

                        <div class="form-group">
                            <label for="zone"></i> Zone</label>
                            <input type="text" id="zone" value="Kurunagala" required>
                        </div>

                        <div class="form-group">
                            <label for="province"></i> Select Province</label>
                            <select id="province" required>
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

                        <div class="form-group">
                            <label></i> Facilities Available</label>
                            <div class="checkbox-container">
                                <label><input type="checkbox" name="facilities" value="track" checked> Track</label>
                                <label><input type="checkbox" name="facilities" value="indoor"> Indoor</label>
                                <label><input type="checkbox" name="facilities" value="ground" checked> Ground</label>
                                <label><input type="checkbox" name="facilities" value="swimming-pool"> Swimming Pool</label>
                                <label><input type="checkbox" name="facilities" value="other"> Other</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="modal-btn cancel-btn" onclick="closeEditModal()"><i class="fas fa-ban"></i> Cancel</button>
            <button class="modal-btn save-btn" onclick="saveProfile()"><i class="fas fa-save"></i> Save Changes</button>
        </div>
    </div>
</div>    
<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

    <script>
        // Modal control functions
        function openEditModal() {
            document.getElementById('editProfileModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editProfileModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the modal content
        window.onclick = function(event) {
            const modal = document.getElementById('editProfileModal');
            if (event.target === modal) {
                closeEditModal();
            }
        };

        // Image preview
        document.getElementById('profile-photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview-img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Save profile changes
        function saveProfile() {
            // Get form values
            const firstName = document.getElementById('first-name').value;
            const lastName = document.getElementById('last-name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            const gender = document.getElementById('gender').value;
            const birthday = document.getElementById('birthday').value;
            const school = document.getElementById('school').value;
            const grade = document.getElementById('grade').value;
            const guardian = document.getElementById('guardian').value;
            const bio = document.getElementById('bio').value;
            
            // Update display values (this would normally be done after a successful AJAX call)
            document.getElementById('display-name').textContent = firstName + ' ' + lastName;
            document.getElementById('display-email').textContent = email;
            document.getElementById('display-phone').textContent = phone;
            document.getElementById('display-address').textContent = address;
            document.getElementById('display-gender').textContent = gender;
            
            // Format date for display
            const birthdayDate = new Date(birthday);
            const formattedDate = birthdayDate.toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric', 
                year: 'numeric'
            });
            document.getElementById('display-birthday').textContent = formattedDate;
            
            document.getElementById('display-school').textContent = school;
            document.getElementById('display-grade').textContent = grade;
            document.getElementById('display-guardian').textContent = guardian;
            document.getElementById('display-bio').textContent = bio;
            
            // Update profile image if changed
            const photoPreviewSrc = document.getElementById('photo-preview-img').src;
            document.getElementById('profile-image').src = photoPreviewSrc;
            
            // In a real applicatio<script>
    // Modal control functions
    function openEditModal() {
        document.getElementById('editProfileModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('editProfileModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close modal if clicking outside modal content
    window.onclick = function(event) {
        const modal = document.getElementById('editProfileModal');
        if (event.target === modal) {
            closeEditModal();
        }
    };

    // Image preview
    document.getElementById('profile-photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview-img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Save profile changes
    function saveProfile() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const code = document.getElementById('code').value;
        const address = document.getElementById('address').value;
        const zone = document.getElementById('zone').value;
        const province = document.getElementById('province').value;

        // Facilities
        const facilities = [];
        document.querySelectorAll('input[name="facilities"]:checked').forEach(checkbox => {
            facilities.push(checkbox.value);
        });

        // Update displayed values (simulate)
        document.getElementById('display-name').textContent = name;
        document.getElementById('display-email').textContent = email;
        document.getElementById('display-phone').textContent = phone;
        document.getElementById('display-code').textContent = code;
        document.getElementById('display-address').textContent = address;
        document.getElementById('display-zone').textContent = zone;
        document.getElementById('display-province').textContent = province;
        document.getElementById('display-facilities').textContent = facilities.join(', ');

        // Update profile image if changed
        const photoPreviewSrc = document.getElementById('photo-preview-img').src;
        document.getElementById('profile-image').src = photoPreviewSrc;

        // Simulate save action
        alert('School profile updated successfully!');

        // Close modal
        closeEditModal();
    }


            // For demonstration purposes, we'll just show an alert
            alert('Profile updated successfully!');
            
            // Close the modal
            closeEditModal();
        }
    </script>
    </body>
    </html>