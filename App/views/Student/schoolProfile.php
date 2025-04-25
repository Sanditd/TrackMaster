<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Profile | TrackMaster</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/studentProfile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <?php require 'navbar.php'?>
    <?php require 'sidebar.php'?> 

    <div class="profile-container">
        <div class="profile-header">
            <h1><i class="fas fa-school"></i> School Profile</h1>
        </div>

        <div class="profile-content">
            <!-- Profile Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-picture-container">
                    <div class="profile-picture">
                        <img src="<?php echo URLROOT . '/Public/img/profile.jpeg' ?>" alt="School Profile Picture">
                    </div>
                </div>
                <div class="profile-info">
                    <h2 class="school-name"><?php echo htmlspecialchars($school->school_name ?? 'School Name'); ?></h2>
                    <p class="school-type"><?php echo htmlspecialchars($school->zoneName ?? 'Zone Name'); ?></p>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-envelope"></i></span>
                        <span class="info-text"><?php echo htmlspecialchars($school->email ?? 'Not specified'); ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-phone"></i></span>
                        <span class="info-text"><?php echo htmlspecialchars($school->phonenumber ?? 'Not specified'); ?></span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="info-text"><?php echo htmlspecialchars($school->address ?? 'Not specified'); ?></span>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="profile-details">
                <!-- School Information -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-info-circle"></i>
                        <h2>School Information</h2>
                    </div>
                    <div class="detail-content">
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-map"></i></span>
                            <span class="info-text"><strong>Zone:</strong> <?php echo htmlspecialchars($school->zoneName ?? 'Not specified'); ?></span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-globe-asia"></i></span>
                            <span class="info-text"><strong>Province:</strong> <?php echo htmlspecialchars($school->province ?? 'Not specified'); ?></span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-city"></i></span>
                            <span class="info-text"><strong>District:</strong> <?php echo htmlspecialchars($school->district ?? 'Not specified'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Facilities -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-dumbbell"></i>
                        <h2>Sports Facilities</h2>
                    </div>
                    <div class="detail-content">
                        <p>The school has the following sports facilities available:</p>
                        <div class="facilities-list">
                            <?php if (!empty($school->facilities)): ?>
                                <?php foreach ($school->facilities as $facility): ?>
                                    <div class="facility-item">
                                        <i class="fas fa-check"></i>
                                        <?php echo htmlspecialchars($facility); ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No facilities information available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'?>
</body>
</html>