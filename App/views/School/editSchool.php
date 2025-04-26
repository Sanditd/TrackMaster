<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit guardian Profile | TrackMaster</title>
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
        }

        .profile-header h1 {
            font-size: 2.2rem;
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
        }

        /* Profile Form */
        .profile-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
        }

        .left-section, .right-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .profile-picture {
            text-align: center;
            position: relative;
        }

        .profile-picture img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 5px solid var(--primary-color);
            object-fit: cover;
            box-shadow: var(--box-shadow);
        }

        .profile-picture input[type="file"] {
            display: none;
        }

        .photo-upload-label {
            display: inline-block;
            margin-top: 10px;
            color: var(--primary-color);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .photo-upload-label:hover {
            color: var(--secondary-color);
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group input {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 38, 77, 0.1);
        }

        .btn-container {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .edit-btn, .cancel-btn {
            padding: 12px 25px;
            border-radius: var(--border-radius);
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .edit-btn {
            background-color: var(--secondary-color);
            color: white;
        }

        .edit-btn:hover {
            background-color: #cc8400;
            transform: translateY(-2px);
        }

        .cancel-btn {
            background-color: #e9ecef;
            color: var(--dark-color);
        }

        .cancel-btn:hover {
            background-color: #dde2e6;
            transform: translateY(-2px);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .profile-form {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .profile-header h1 {
                font-size: 1.8rem;
            }

            .profile-picture img {
                width: 150px;
                height: 150px;
            }
        }

        @media (max-width: 576px) {
            .profile-container {
                padding: 15px;
            }

            .profile-header h1 {
                font-size: 1.6rem;
            }

            .form-group input {
                font-size: 0.9rem;
            }

            .edit-btn, .cancel-btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>
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
                    <input type="text" id="first-name" value="Samantha">
                </div>
                <div class="form-group">
                    <label for="last-name"><i class="fas fa-user"></i> Last Name</label>
                    <input type="text" id="last-name" value="Thenuwara">
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" value="Samantha@gmail.com">
                </div>
                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> WhatsApp Number</label>
                    <input type="text" id="phone" value="0774589123">
                </div>
            </div>

            <div class="right-section">
                <div class="form-group">
                    <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <input type="text" id="address" value="55/4A, Pirivena Road, Ratmalana">
                </div>
                <div class="form-group">
                    <label for="occupation"><i class="fas fa-briefcase"></i> Occupation</label>
                    <input type="text" id="occupation" value="Accountant Manager">
                </div>
                <div class="form-group">
                    <label for="occu-address"><i class="fas fa-building"></i> Occupation Address</label>
                    <input type="text" id="occu-address" value="No 15- Kurunagala">
                </div>
                <div class="form-group">
                    <label for="student"><i class="fas fa-user-graduate"></i> Student</label>
                    <input type="text" id="student" value="E.Thenuwara">
                </div>
                <div class="btn-container">
                    <button type="submit" class="edit-btn"><i class="fas fa-save"></i> Save Changes</button>
                    <button class="cancel-btn" onclick="window.location.href='<?php echo URLROOT ?>/guardian/Profile'"><i class="fas fa-ban"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

    <script>
        document.getElementById('profile-pic-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-pic-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>