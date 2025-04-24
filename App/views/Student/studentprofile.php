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
                            <img src="/TrackMaster/Public/img/profile.jpeg" alt="Student Profile Picture" id="profile-image">
                        </div>
                    </div>
                    <div class="profile-info">
                        <h2 class="student-name" id="display-name">Eraji Thenuwara</h2>
                        <p class="student-title">Student Athlete</p>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-envelope"></i></span>
                            <span class="info-text" id="display-email">thenuwara@gmail.com</span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fab fa-whatsapp"></i></span>
                            <span class="info-text" id="display-phone">0712345678</span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
                            <span class="info-text" id="display-address">55/4A, Pirivena Road, Ratmalana</span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-venus-mars"></i></span>
                            <span class="info-text" id="display-gender">Female</span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-birthday-cake"></i></span>
                            <span class="info-text" id="display-birthday">January 16, 2008</span>
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
                            <p id="display-bio">🏃‍♂️When I'm not on the track, you'll probably find me relaxing with a smoothie or jamming to my favorite playlist. My motto is "Hard work beats talent when talent doesn't work hard," and it's what keeps me striving for greatness every day! 🚀</p>
                        </div>
                    </div>

                    <!-- School Information -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-school"></i>
                            <h2>School Information</h2>
                        </div>
                        <div class="detail-content">
                            <div class="info-group">
                                <span class="info-icon"><i class="fas fa-building"></i></span>
                                <span class="info-text"><strong>School:</strong> <span id="display-school">Maliyadeva Balika Vidyalaya</span></span>
                            </div>
                            
                            <div class="info-group">
                                <span class="info-icon"><i class="fas fa-graduation-cap"></i></span>
                                <span class="info-text"><strong>Grade:</strong> <span id="display-grade">11 - A</span></span>
                            </div>
                            
                            <button class="view-profile-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/schoolProfile'">
                                <i class="fas fa-eye"></i> View School Profile
                            </button>
                        </div>
                    </div>

                    <!-- Guardian Information -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-user-shield"></i>
                            <h2>Guardian Information</h2>
                        </div>
                        <div class="detail-content">
                            <div class="info-group">
                                <span class="info-icon"><i class="fas fa-user"></i></span>
                                <span class="info-text"><strong>Guardian Name:</strong> <span id="display-guardian">T.H.C.Silva</span></span>
                            </div>
                            
                            <button class="view-profile-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/parentProfile'">
                                <i class="fas fa-eye"></i> View Guardian Profile
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
                <button class="close-modal" onclick="closeEditModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm">
                    <div class="edit-form">
                        <div class="full-width" style="text-align: center;">
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
                        </div>

                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" value="Eraji" required>
                        </div>

                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" value="Thenuwara" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" value="thenuwara@gmail.com" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">WhatsApp Number</label>
                            <input type="text" id="phone" value="0712345678" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" value="55/4A, Pirivena Road, Ratmalana" required>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" required>
                                <option value="Female" selected>Female</option>
                                <option value="Male">Male</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input type="date" id="birthday" value="2008-01-16" required>
                        </div>

                        <div class="form-group">
                            <label for="school">School</label>
                            <input type="text" id="school" value="Maliyadeva Balika Vidyalaya" required>
                        </div>

                        <div class="form-group">
                            <label for="grade">Grade</label>
                            <input type="text" id="grade" value="11 - A" required>
                        </div>

                        <div class="form-group">
                            <label for="guardian">Guardian</label>
                            <input type="text" id="guardian" value="T.H.C.Silva" required>
                        </div>

                        <div class="form-group full-width">
                            <label for="bio">Bio</label>
                            <textarea id="bio" rows="6" required>🏃‍♂️When I'm not on the track, you'll probably find me relaxing with a smoothie or jamming to my favorite playlist. My motto is "Hard work beats talent when talent doesn't work hard," and it's what keeps me striving for greatness every day! 🚀</textarea>
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
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Modal control functions
        const openEditModal = () => {
            // Pre-fill the form with current values
            document.getElementById('name').value = document.getElementById('display-name').textContent.trim();
            document.getElementById('email').value = document.getElementById('display-email').textContent.trim();
            document.getElementById('phone').value = document.getElementById('display-phone').textContent.trim();
            document.getElementById('code').value = document.getElementById('display-code').textContent.trim();
            document.getElementById('address').value = document.getElementById('display-address').textContent.trim();
            document.getElementById('zone').value = document.getElementById('display-zone').textContent.trim();
            document.getElementById('province').value = document.getElementById('display-province').textContent.trim().toLowerCase().replace(' ', '-');
            
            // Show the modal
            document.getElementById('editProfileModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        };

        const closeEditModal = () => {
            document.getElementById('editProfileModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        };

        // Close modal when clicking outside or on close button
        document.addEventListener('click', (event) => {
            const modal = document.getElementById('editProfileModal');
            if (event.target === modal || event.target.classList.contains('close-modal')) {
                closeEditModal();
            }
        });

        // Image preview and update handler
        const profilePhotoInput = document.getElementById('profile-photo');
        if (profilePhotoInput) {
            profilePhotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Update both preview and main profile image
                        const previewImg = document.getElementById('photo-preview-img');
                        const profileImg = document.getElementById('profile-image');
                        
                        previewImg.src = e.target.result;
                        profileImg.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Save profile changes
        window.saveProfile = function(event) {
            event.preventDefault();
            
            // Get all form values
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                code: document.getElementById('code').value,
                address: document.getElementById('address').value,
                zone: document.getElementById('zone').value,
                province: document.getElementById('province').value,
                facilities: {
                    track: document.querySelector('input[name="facilities"][value="track"]').checked,
                    indoor: document.querySelector('input[name="facilities"][value="indoor"]').checked,
                    ground: document.querySelector('input[name="facilities"][value="ground"]').checked,
                    swimmingPool: document.querySelector('input[name="facilities"][value="swimming-pool"]').checked,
                    other: document.querySelector('input[name="facilities"][value="other"]').checked
                }
            };

            // Update display values
            document.getElementById('display-name').textContent = formData.name;
            document.getElementById('display-email').textContent = formData.email;
            document.getElementById('display-phone').textContent = formData.phone;
            document.getElementById('display-code').textContent = formData.code;
            document.getElementById('display-address').textContent = formData.address;
            document.getElementById('display-zone').textContent = formData.zone;
            document.getElementById('display-province').textContent = formatProvinceName(formData.province);

            // Update facilities checkboxes display
            updateFacilitiesDisplay(formData.facilities);

            // Here you would typically send the data to the server via AJAX
            // Example (commented out):
            /*
            fetch('/api/school/update-profile', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                alert('Profile updated successfully!');
                closeEditModal();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating profile');
            });
            */

            // For demo purposes, just show success message
            alert('School profile updated successfully!');
            closeEditModal();
        };

        // Helper function to format province name for display
        function formatProvinceName(province) {
            return province.split('-')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
        }

        // Helper function to update facilities display
        function updateFacilitiesDisplay(facilities) {
            const facilityElements = {
                track: document.querySelector('#facilities-display input[value="track"]'),
                indoor: document.querySelector('#facilities-display input[value="indoor"]'),
                ground: document.querySelector('#facilities-display input[value="ground"]'),
                swimmingPool: document.querySelector('#facilities-display input[value="swimming-pool"]'),
                other: document.querySelector('#facilities-display input[value="other"]')
            };

            for (const [facility, element] of Object.entries(facilityElements)) {
                if (element) {
                    element.checked = facilities[facility];
                }
            }
        }

        // Attach event listeners
        document.querySelector('.edit-profile-btn').addEventListener('click', openEditModal);
        document.querySelector('.modal-footer .cancel-btn').addEventListener('click', closeEditModal);
        document.querySelector('.modal-footer .save-btn').addEventListener('click', saveProfile);

        // Prevent form submission
        const editForm = document.getElementById('editProfileForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                saveProfile(e);
            });
        }
    });
</script>
</body>
</html>