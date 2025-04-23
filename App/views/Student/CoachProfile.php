<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Profile | TrackMaster</title>
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
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            padding: 25px;
        }

        .coach-name {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 5px;
            text-align: center;
        }

        .coach-title {
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

        .detail-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .detail-list li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 12px;
            color: var(--gray-color);
            line-height: 1.5;
        }

        .detail-list li::before {
            content: '•';
            color: var(--secondary-color);
            position: absolute;
            left: 0;
            font-weight: bold;
            font-size: 1.2rem;
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
        }

        @media (max-width: 576px) {
            .profile-picture {
                width: 150px;
                height: 150px;
            }

            .coach-name {
                font-size: 1.5rem;
            }

            .detail-header h2 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <h1><i class="fas fa-user-circle"></i> Coach Profile</h1>
        </div>

        <div class="profile-content">
            <!-- Profile Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-picture-container">
                    <div class="profile-picture">
                        <img src="<?php echo !empty($coach->photo) ? 'data:image/jpeg;base64,'.base64_encode($coach->photo) : URLROOT.'/Public/img/profile.jpeg' ?>" alt="Coach Profile Picture">
                    </div>
                </div>
                <div class="profile-info">
                    <h2 class="coach-name"><?php echo $coach->firstname . ' ' . (!empty($coach->lname) ? $coach->lname : ''); ?></h2>
                    <p class="coach-title"><?php echo !empty($coach->coach_type) ? ucfirst($coach->coach_type) : '' ?> <?php echo !empty($coach->sport_name) ? $coach->sport_name : '' ?> Coach</p>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-envelope"></i></span>
                        <span class="info-text"><?php echo $coach->email; ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-phone"></i></span>
                        <span class="info-text"><?php echo $coach->phonenumber; ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="info-text"><?php echo $coach->address; ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-venus-mars"></i></span>
                        <span class="info-text"><?php echo !empty($coach->gender) ? ucfirst($coach->gender) : 'Not specified'; ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-birthday-cake"></i></span>
                        <span class="info-text"><?php echo !empty($coach->dob) ? date('F j, Y', strtotime($coach->dob)) : 'Not specified'; ?></span>
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
                        <p><?php echo !empty($coach->bio) ? $coach->bio : 'No bio information available.'; ?></p>
                    </div>
                </div>

                <!-- Education -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-graduation-cap"></i>
                        <h2>Educational Qualifications</h2>
                    </div>
                    <div class="detail-content">
                        <ul class="detail-list">
                            <?php if (!empty($coach->educational_qualifications)): ?>
                                <?php foreach ($coach->educational_qualifications as $qualification): ?>
                                    <li><?php echo trim($qualification); ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>No educational qualifications listed.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Playing Experience -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-cricket"></i>
                        <h2>Professional Playing Experience</h2>
                    </div>
                    <div class="detail-content">
                        <ul class="detail-list">
                            <?php if (!empty($coach->professional_playing_experience)): ?>
                                <?php foreach ($coach->professional_playing_experience as $experience): ?>
                                    <li><?php echo trim($experience); ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>No professional playing experience listed.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Coaching Experience -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <h2>Coaching Experience</h2>
                    </div>
                    <div class="detail-content">
                        <ul class="detail-list">
                            <?php if (!empty($coach->coaching_experience)): ?>
                                <?php foreach ($coach->coaching_experience as $experience): ?>
                                    <li><?php echo trim($experience); ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>No coaching experience listed.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Technical Specializations -->

                <!-- Achievements -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-trophy"></i>
                        <h2>Key Achievements</h2>
                    </div>
                    <div class="detail-content">
                        <ul class="detail-list">
                            <?php if (!empty($coach->key_achievements)): ?>
                                <?php foreach ($coach->key_achievements as $achievement): ?>
                                    <li><?php echo trim($achievement); ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>No key achievements listed.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>