<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | TrackMaster</title>
    <link rel="stylesheet" href="../Public/css/navbar.css">
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
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
        }

        .profile-header h1 {
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .breadcrumb-item {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: white;
            font-weight: 600;
        }

        .breadcrumb-divider {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Profile Form */
        .profile-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 25px;
        }

        @media (max-width: 1100px) {
            .profile-form {
                grid-template-columns: 1fr;
            }
        }

        /* Form Sections */
        .form-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .form-header {
            background: var(--light-color);
            padding: 15px 25px;
            border-bottom: 1px solid rgba(0, 38, 77, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-header h2 {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin: 0;
        }

        .form-header i {
            color: var(--secondary-color);
            font-size: 1.4rem;
        }

        .form-content {
            padding: 25px;
        }

        /* Profile Picture Upload */
        .profile-picture-container {
            text-align: center;
            margin-bottom: 25px;
            position: relative;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid var(--light-color);
            overflow: hidden;
            margin: 0 auto 15px;
            box-shadow: var(--box-shadow);
            position: relative;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 38, 77, 0.7);
            color: white;
            padding: 10px 0;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .upload-overlay:hover {
            background: rgba(0, 38, 77, 0.9);
        }

        .upload-label {
            cursor: pointer;
            display: inline-block;
            margin-top: 10px;
            color: var(--primary-color);
            font-weight: 500;
            transition: var(--transition);
        }

        .upload-label:hover {
            color: var(--secondary-color);
        }

        #profile-pic-input {
            display: none;
        }

        /* Form Inputs */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-color);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 15px;
            padding-right: 45px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* Form Buttons */
        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            border: none;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #cc8400;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #e9ecef;
            color: var(--dark-color);
        }

        .btn-secondary:hover {
            background: #dde2e6;
            transform: translateY(-2px);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .profile-header {
                padding: 20px;
            }
            
            .profile-header h1 {
                font-size: 1.5rem;
            }
            
            .form-content {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .profile-form {
                grid-template-columns: 1fr;
            }
            
            .form-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <h1>
                <i class="fas fa-user-edit"></i>
                <div class="breadcrumb">
                    <a href="<?php echo URLROOT ?>/Coach/ViewProfile" class="breadcrumb-item">My Profile</a>
                    <span class="breadcrumb-divider">›</span>
                    <span class="breadcrumb-item active">Edit Profile</span>
                </div>
            </h1>
        </div>

        <form action="<?php echo URLROOT ?>/Coach/updateProfile" method="post" enctype="multipart/form-data">
            <div class="profile-form">
                <!-- Personal Information Section -->
                <div class="form-section">
                    <div class="form-header">
                        <i class="fas fa-user-circle"></i>
                        <h2>Personal Information</h2>
                    </div>
                    <div class="form-content">
                        <div class="profile-picture-container">
                            <div class="profile-picture">
                                <img src="<?php echo !empty($coach->photo) ? 'data:image/jpeg;base64,'.base64_encode($coach->photo) : URLROOT.'/Public/img/profile.jpeg' ?>" alt="Profile Picture" id="profile-pic-preview">
                                <div class="upload-overlay">Change Photo</div>
                            </div>
                            <label for="profile-pic-input" class="upload-label">
                                <i class="fas fa-camera"></i> Upload New Photo
                            </label>
                            <input type="file" id="profile-pic-input" name="profile_image" accept="image/*">
                        </div>

                        <div class="input-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first_name" class="form-control" value="<?php echo $coach->firstname; ?>">
                            <span class="invalid-feedback"><?php echo $data['firstname_err'] ?? ''; ?></span>
                        </div>

                        <div class="input-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last_name" class="form-control" value="<?php echo $coach->lname ?? ''; ?>">
                        </div>

                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $coach->email; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err'] ?? ''; ?></span>
                        </div>

                        <div class="input-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $coach->phonenumber; ?>">
                        </div>

                        <div class="input-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control" value="<?php echo $coach->address; ?>">
                        </div>

                        <div class="input-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="Male" <?php echo ($coach->gender ?? '') == 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($coach->gender ?? '') == 'Female' ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="birthday">Birthday</label>
                            <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo $coach->dob ?? ''; ?>">
                        </div>

                        <div class="input-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="5"><?php echo $coach->bio ?? ''; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Professional Information Section -->
                <div class="form-section">
                    <div class="form-header">
                        <i class="fas fa-briefcase"></i>
                        <h2>Professional Information</h2>
                    </div>
                    <div class="form-content">
                        <div class="input-group">
                            <label for="educational-qualifications">Educational Qualifications (One per line)</label>
                            <textarea id="educational-qualifications" name="educational_qualifications" class="form-control" rows="5"><?php echo $coach->educational_qualifications ?? ''; ?></textarea>
                        </div>

                        <div class="input-group">
                            <label for="playing-experience">Professional Playing Experience (One per line)</label>
                            <textarea id="playing-experience" name="playing_experience" class="form-control" rows="5"><?php echo $coach->professional_playing_experience ?? ''; ?></textarea>
                        </div>

                        <div class="input-group">
                            <label for="coaching-experience">Coaching Experience (One per line)</label>
                            <textarea id="coaching-experience" name="coaching_experience" class="form-control" rows="5"><?php echo $coach->coaching_experience ?? ''; ?></textarea>
                        </div>

                        <div class="input-group">
                            <label for="key-achievements">Key Achievements (One per line)</label>
                            <textarea id="key-achievements" name="key_achievements" class="form-control" rows="5"><?php echo $coach->key_achievements ?? ''; ?></textarea>
                        </div>

                        <div class="form-buttons">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo URLROOT ?>/Coach/ViewProfile'">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

    <script>
        // Preview image before upload
        document.getElementById('profile-pic-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profile-pic-preview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Click the hidden file input when clicking on the profile picture
        document.querySelector('.upload-overlay').addEventListener('click', function() {
            document.getElementById('profile-pic-input').click();
        });
    </script>
</body>
</html>
