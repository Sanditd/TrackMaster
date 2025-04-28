<?php
// Start session to access session variables
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile | TrackMaster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/TrackMaster/public/css/school/studentProfile.css">
</head>
<body>
    <div id="navbar">
        <!-- Navbar content (can be included dynamically) -->
    </div>

    <div id="main">
        <div class="message-container" id="message-container">
            <?php if (isset($data['error'])): ?>
                <p style="color: red;"><?php echo htmlspecialchars($data['error']); ?></p>
            <?php endif; ?>
        </div>
        <div class="profile-container">
            <div class="profile-header">
                <h1><i class="fas fa-user-circle"></i> Student Profile</h1>
            </div>

            <div class="profile-content">
                <!-- Profile Sidebar -->
                <div class="profile-sidebar">
                    <div class="profile-picture-container">
                        <div class="profile-picture">
                            <img src="<?php echo $data['photo'] ? 'data:image/jpeg;base64,' . base64_encode($data['photo']) : '/TrackMaster/public/img/profile.jpeg'; ?>" alt="Student Profile Picture" id="profile-image">
                        </div>
                    </div>
                    <div class="profile-info">
                        <h2 class="student-name"><?php echo htmlspecialchars($data['firstname'] . ' ' . ($data['lname'] ?? '')); ?></h2>
                        <p class="student-title">Student Athlete</p>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-envelope"></i></span>
                            <span class="info-text"><?php echo htmlspecialchars($data['email'] ?? 'N/A'); ?></span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fab fa-whatsapp"></i></span>
                            <span class="info-text"><?php echo htmlspecialchars($data['phonenumber'] ?? 'N/A'); ?></span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-venus-mars"></i></span>
                            <span class="info-text"><?php echo htmlspecialchars($data['gender'] ?? 'N/A'); ?></span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-birthday-cake"></i></span>
                            <span class="info-text"><?php echo $data['dob'] ? date('F j, Y', strtotime($data['dob'])) : 'N/A'; ?></span>
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
                            <p><?php echo htmlspecialchars($data['bio'] ?? 'No bio available.'); ?></p>
                        </div>
                    </div>

                    <!-- Sports Information -->
                    <div class="detail-card">
                        <div class="detail-header">
                            <i class="fas fa-running"></i>
                            <h2>Sports Information</h2>
                        </div>
                        <div class="detail-content">
                            <div class="info-group">
                                <span class="info-icon"><i class="fas fa-baseball-ball"></i></span>
                                <span class="info-text"><strong>Sport:</strong> <?php echo htmlspecialchars($data['sport_name'] ?? 'N/A'); ?></span>
                            </div>
                            
                            <div class="info-group">
                                <span class="info-icon"><i class="fas fa-user-tag"></i></span>
                                <span class="info-text"><strong>Role:</strong> <?php echo htmlspecialchars($data['role'] ?? 'N/A'); ?></span>
                            </div>
                            
                            <button class="view-profile-btn" onclick="window.location.href='/TrackMaster/Student/Playerperformance'">
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
                            <div class="info-group">
                                <span class="info-icon"><i class="fas fa-building"></i></span>
                                <span class="info-text"><strong>School:</strong> <?php echo htmlspecialchars($data['school_name'] ?? 'N/A'); ?></span>
                            </div>
                            <div class="info-group">
                                <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
                                <span class="info-text"><strong>Zone:</strong> <?php echo htmlspecialchars($data['zone'] ?? 'N/A'); ?></span>
                            </div>
                            
                            <button class="view-profile-btn" onclick="window.location.href='/TrackMaster/Student/schoolProfile'">
                                <i class="fas fa-eye"></i> View School Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <!-- Footer content (can be included dynamically) -->
    </div>
</body>
</html>