<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile | TrackMaster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/studentProfile.css">

</head>
<body>
<?php require 'navbar.php'?>

    <div id="main">
        <div class="message-container" id="message-container"></div>
        <div class="profile-container">
            <div class="profile-header">
                <h1><i class="fas fa-user-circle"></i> My Profile</h1>
                <button class="edit-profile-btn" onclick="openEditModal()">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
            </div>

            <div class="profile-content">
                <!-- Profile Sidebar -->
                <div class="profile-sidebar">
                    <div class="profile-picture-container">
                        <div class="profile-picture">
                            <img src="<?php echo !empty($data['user']->photo) ? URLROOT . '/Uploads/' . $data['user']->photo : URLROOT . '/img/profile.jpeg'; ?>" alt="Student Profile Picture" id="profile-image">
                        </div>
                    </div>
                    <div class="profile-info">
                        <h2 class="student-name" id="display-name"><?php echo htmlspecialchars($data['user']->firstname . ' ' . $data['user']->lname); ?></h2>
                        <p class="student-title">Student Athlete</p>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-envelope"></i></span>
                            <span class="info-text" id="display-email"><?php echo htmlspecialchars($data['user']->email); ?></span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fab fa-whatsapp"></i></span>
                            <span class="info-text" id="display-phone"><?php echo htmlspecialchars($data['user']->phonenumber); ?></span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-venus-mars"></i></span>
                            <span class="info-text" id="display-gender"><?php echo htmlspecialchars($data['user']->gender); ?></span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-birthday-cake"></i></span>
                            <span class="info-text" id="display-birthday"><?php echo !empty($data['user']->dob) ? date('F j, Y', strtotime($data['user']->dob)) : 'Not specified'; ?></span>
                        </div>
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="profile-details">
                    <!-- About Me -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-user"></i>
                            <h2>About Me</h2>
                        </div>
                        <div class="detail-content">
                            <p id="display-bio"><?php echo !empty($data['user']->bio) ? htmlspecialchars($data['user']->bio) : 'No bio provided'; ?></p>
                        </div>
                    </div>

                    <!-- Sports Information -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-running"></i>
                            <h2>Sports Information</h2>
                        </div>
                        <div class="detail-content">
                            <?php if (!empty($data['sports'])): ?>
                                <div class="info-group">
                                    <span class="info-icon"><i class="fas fa-baseball-ball"></i></span>
                                    <span class="info-text"><strong>Sport:</strong> <?php echo htmlspecialchars($data['sports'][0]->sport_name); ?></span>
                                </div>
                                
                                <div class="info-group">
                                    <span class="info-icon"><i class="fas fa-user-tag"></i></span>
                                    <span class="info-text"><strong>Role:</strong> <?php echo htmlspecialchars($data['role']); ?></span>
                                </div>
                            <?php else: ?>
                                <p>No sports information available</p>
                            <?php endif; ?>
                            
                            <button class="view-profile-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/Playerperformance'">
                                <i class="fas fa-chart-line"></i> View Performance
                            </button>
                        </div>
                    </div>

                    <!-- School Information -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-school"></i>
                            <h2>School Information</h2>
                        </div>
                        <div class="detail-content">
                            <?php if (!empty($data['school'])): ?>
                                <div class="info-group">
                                    <span class="info-icon"><i class="fas fa-building"></i></span>
                                    <span class="info-text"><strong>School:</strong> <?php echo htmlspecialchars($data['school']->school_name); ?></span>
                                </div>
                                <div class="info-group">
                                    <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
                                    <span class="info-text"><strong>Zone:</strong> <?php echo !empty($data['school']->zoneName) ? htmlspecialchars($data['school']->zoneName) : 'Not specified'; ?></span>
                                </div>
                            <?php else: ?>
                                <p>No school information available</p>
                            <?php endif; ?>
                            
                            <button class="view-profile-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/schoolProfile'">
                                <i class="fas fa-eye"></i> View School Profile
                            </button>
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
                <h2><i class="fas fa-user-edit"></i> Edit Profile</h2>
                <button class="close-modal" onclick="closeEditModal()">×</button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <div class="edit-form">
                        <div class="full-width" style="text-align: center;">
                            <div class="photo-upload">
                                <label class="photo-upload-label">
                                    <div class="photo-preview">
                                        <img src="<?php echo !empty($data['user']->photo) ? URLROOT . '/Uploads/' . $data['user']->photo : URLROOT . '/img/profile.jpeg'; ?>" alt="Profile Picture" id="photo-preview-img">
                                        <div class="photo-preview-overlay">
                                            <i class="fas fa-camera fa-2x"></i>
                                        </div>
                                    </div>
                                    <span style="color: var(--primary-color); font-weight: 600;">Change Photo</span>
                                    <input type="file" id="profile-photo" name="profile_photo" accept="image/*">
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="firstname" value="<?php echo htmlspecialchars($data['user']->firstname); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="lname" value="<?php echo htmlspecialchars($data['user']->lname); ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['user']->email); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phonenumber" value="<?php echo htmlspecialchars($data['user']->phonenumber); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender">
                                <option value="Male" <?php echo $data['user']->gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo $data['user']->gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="<?php echo !empty($data['user']->dob) ? htmlspecialchars($data['user']->dob) : ''; ?>">
                        </div>

                        <div class="form-group full-width">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" rows="6"><?php echo !empty($data['user']->bio) ? htmlspecialchars($data['user']->bio) : ''; ?></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="modal-btn cancel-btn" onclick="closeEditModal()">Cancel</button>
                <button class="modal-btn save-btn" onclick="saveProfile()">Save Changes</button>
            </div>
        </div>
    </div>

    <?php require 'footer.php'; ?>

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
                };
                reader.readAsDataURL(file);
            }
        });

        // Show message
        function showMessage(message, type) {
            const messageContainer = document.getElementById('message-container');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;
            messageDiv.innerHTML = `${message} <span class="close-message" onclick="this.parentElement.remove()">×</span>`;
            messageContainer.appendChild(messageDiv);
            setTimeout(() => {
                messageDiv.remove();
            }, 5000);
        }

        // Save profile changes
        function saveProfile() {
            const form = document.getElementById('editProfileForm');
            const formData = new FormData(form);

            fetch('<?php echo URLROOT; ?>/Student/updateProfile', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update display values
                    const lastName = formData.get('lname') ? ' ' + formData.get('lname') : '';
                    document.getElementById('display-name').textContent = formData.get('firstname') + lastName;
                    document.getElementById('display-email').textContent = formData.get('email');
                    document.getElementById('display-phone').textContent = formData.get('phonenumber');
                    document.getElementById('display-gender').textContent = formData.get('gender');
                    
                    // Format date for display
                    if (formData.get('dob')) {
                        const dobDate = new Date(formData.get('dob'));
                        const formattedDate = dobDate.toLocaleDateString('en-US', {
                            month: 'long',
                            day: 'numeric', 
                            year: 'numeric'
                        });
                        document.getElementById('display-birthday').textContent = formattedDate;
                    } else {
                        document.getElementById('display-birthday').textContent = 'Not specified';
                    }
                    
                    document.getElementById('display-bio').textContent = formData.get('bio') || 'No bio provided';
                    
                    // Update profile image if changed
                    if (data.photo) {
                        const newImageUrl = '<?php echo URLROOT; ?>/Uploads/' + data.photo;
                        document.getElementById('profile-image').src = newImageUrl;
                        document.getElementById('photo-preview-img').src = newImageUrl;
                    }
                    
                    showMessage(data.message, 'success');
                    closeEditModal();
                } else {
                    showMessage(data.message, 'error');
                }
            })
            .catch(error => {
                showMessage('An error occurred while updating the profile.', 'error');
                console.error('Error:', error);
            });
        }

        // Display session messages if any
        <?php if (!empty($data['message'])): ?>
            showMessage('<?php echo addslashes($data['message']); ?>', '<?php echo $data['message_type']; ?>');
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>
    </script>
</body>
</html>