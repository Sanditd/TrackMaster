<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile | TrackMaster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base Styles */
        :root {
            --primary-color: #00264d;
            --secondary-color: #ffa500;
            --light-color: #f8f9fa;
            --dark-color: #333;
            --gray-color: #666;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 38, 77, 0.1);
            --transition: all 0.3s ease;
            --success-color: #28a745;
            --error-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: var(--dark-color);
        }

        /* Message Styles */
        .message-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            max-width: 400px;
        }

        .message {
            padding: 15px 20px;
            border-radius: var(--border-radius);
            color: white;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            box-shadow: var(--box-shadow);
            animation: slideIn 0.3s ease;
        }

        .message.success {
            background-color: var(--success-color);
        }

        .message.error {
            background-color: var(--error-color);
        }

        .message .close-message {
            cursor: pointer;
            font-size: 1.2rem;
            margin-left: 15px;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* Profile Container */
        .profile-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Profile Header */
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-header h1 {
            font-size: 2.2rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .edit-profile-btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .edit-profile-btn:hover {
            background: #cc8400;
            transform: translateY(-2px);
        }

        /* Profile Content */
        .profile-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
        }

        /* Profile Sidebar */
        .profile-sidebar {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            height: fit-content;
        }

        .profile-picture-container {
            background: var(--primary-color);
            padding: 30px;
            text-align: center;
        }

        .profile-picture {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 5px solid white;
            overflow: hidden;
            margin: 0 auto;
            box-shadow: var(--box-shadow);
            position: relative;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            padding: 25px;
        }

        .student-name {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 5px;
            text-align: center;
        }

        .student-title {
            color: var(--secondary-color);
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }

        .info-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .info-icon {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        .info-text {
            color: var(--gray-color);
        }

        /* Profile Details */
        .profile-details {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .detail-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }

        .detail-header {
            background: var(--light-color);
            padding: 15px 25px;
            border-bottom: 1px solid rgba(0, 38, 77, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .detail-header h2 {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin: 0;
        }

        .detail-header i {
            color: var(--secondary-color);
            font-size: 1.4rem;
        }

        .detail-content {
            padding: 25px;
        }

        .detail-content p {
            color: var(--gray-color);
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .view-profile-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            transition: var(--transition);
        }

        .view-profile-btn:hover {
            background: #001a33;
            transform: translateY(-2px);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow-y: auto;
            padding: 40px 0;
        }

        .modal-content {
            background-color: white;
            max-width: 800px;
            margin: 0 auto;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            background: var(--primary-color);
            color: white;
            padding: 20px 25px;
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .close-modal {
            font-size: 1.8rem;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .close-modal:hover {
            color: var(--secondary-color);
        }

        .modal-body {
            padding: 25px;
            max-height: 70vh;
            overflow-y: auto;
        }

        .edit-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 38, 77, 0.1);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .modal-footer {
            padding: 15px 25px 25px;
            text-align: right;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .modal-btn {
            padding: 12px 25px;
            border-radius: var(--border-radius);
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .cancel-btn {
            background-color: #e9ecef;
            color: var(--dark-color);
        }

        .cancel-btn:hover {
            background-color: #dde2e6;
        }

        .save-btn {
            background-color: var(--secondary-color);
            color: white;
        }

        .save-btn:hover {
            background-color: #cc8400;
        }

        .photo-upload {
            position: relative;
            margin-bottom: 15px;
        }

        .photo-upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .photo-preview {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-preview-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transition: var(--transition);
        }

        .photo-preview:hover .photo-preview-overlay {
            opacity: 1;
        }

        .photo-upload input[type="file"] {
            position: absolute;
            width: 0;
            height: 0;
            opacity: 0;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .profile-header h1 {
                justify-content: center;
            }
            
            .edit-form {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .profile-picture {
                width: 150px;
                height: 150px;
            }

            .student-name {
                font-size: 1.5rem;
            }

            .detail-header h2 {
                font-size: 1.2rem;
            }
            
            .modal-content {
                margin: 0 15px;
            }
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <?php require 'sidebar.php'; ?>

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