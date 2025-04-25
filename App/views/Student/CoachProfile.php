<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Profile | TrackMaster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/coachProfile.css">
</head>
<body>
    <?php require 'navbar.php'?>
    <?php require 'sidebar.php'?> 

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
                    <h2 class="coach-name"><?php echo htmlspecialchars($coach->firstname . ' ' . ($coach->lname ?? '')); ?></h2>
                    <p class="coach-title"><?php echo htmlspecialchars(($coach->coach_type ?? '') . ' ' . ($coach->sport_name ?? '') . ' Coach'); ?></p>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-envelope"></i></span>
                        <span class="info-text"><?php echo htmlspecialchars($coach->email ?? 'Not specified'); ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-phone"></i></span>
                        <span class="info-text"><?php echo htmlspecialchars($coach->phonenumber ?? 'Not specified'); ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="info-text"><?php echo htmlspecialchars($coach->address ?? 'Not specified'); ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-map"></i></span>
                        <span class="info-text"><?php echo htmlspecialchars($coach->zoneName ?? 'Not specified'); ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-venus-mars"></i></span>
                        <span class="info-text"><?php echo !empty($coach->gender) ? htmlspecialchars(ucfirst($coach->gender)) : 'Not specified'; ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-birthday-cake"></i></span>
                        <span class="info-text"><?php echo !empty($coach->dob) ? htmlspecialchars(date('F j, Y', strtotime($coach->dob))) : 'Not specified'; ?></span>
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
                        <p><?php echo !empty($coach->bio) ? htmlspecialchars($coach->bio) : 'No bio information available.'; ?></p>
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
                                    <li><?php echo htmlspecialchars($qualification); ?></li>
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
                        <i class="fas fa-running"></i>
                        <h2>Professional Playing Experience</h2>
                    </div>
                    <div class="detail-content">
                        <ul class="detail-list">
                            <?php if (!empty($coach->professional_playing_experience)): ?>
                                <?php foreach ($coach->professional_playing_experience as $experience): ?>
                                    <li><?php echo htmlspecialchars($experience); ?></li>
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
                                    <li><?php echo htmlspecialchars($experience); ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>No coaching experience listed.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

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
                                    <li><?php echo htmlspecialchars($achievement); ?></li>
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
    <?php require 'footer.php'?>
</body>
</html>