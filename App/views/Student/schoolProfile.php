<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Profile | TrackMaster</title>
    <link rel="stylesheet" href="../Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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

        .profile-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

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

        .profile-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
        }

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

        .school-name {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 5px;
            text-align: center;
        }

        .school-type {
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

        .facilities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }

        .facility-item {
            display: flex;
            align-items: center;
            background: #f0f0f0;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .facility-item i {
            margin-right: 8px;
            color: var(--secondary-color);
        }

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

            .school-name {
                font-size: 1.5rem;
            }

            .detail-header h2 {
                font-size: 1.2rem;
            }
        }
    </style>
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
                    <h2 class="school-name">Maliyadewa College, Kurunagala</h2>
                    <p class="school-type">National School</p>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-envelope"></i></span>
                        <span class="info-text">maliyadewaclg@gmail.com</span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-phone"></i></span>
                        <span class="info-text">033-2721456</span>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="info-text">55/4A, Pirivena Road, Ratmalana</span>
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
                            <span class="info-icon"><i class="fas fa-code"></i></span>
                            <span class="info-text"><strong>School Code:</strong> R002</span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-map"></i></span>
                            <span class="info-text"><strong>Zone:</strong> Kurunagala</span>
                        </div>
                        
                        <div class="info-group">
                            <span class="info-icon"><i class="fas fa-globe-asia"></i></span>
                            <span class="info-text"><strong>Province:</strong> North Western</span>
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
                            <div class="facility-item">
                                <i class="fas fa-running"></i> Track
                            </div>
                            <div class="facility-item">
                                <i class="fas fa-baseball-ball"></i> Ground
                            </div>
                            <div class="facility-item">
                                <i class="fas fa-swimming-pool"></i> Swimming Pool
                            </div>
                            <div class="facility-item">
                                <i class="fas fa-basketball-ball"></i> Indoor Stadium
                            </div>
                            <div class="facility-item">
                                <i class="fas fa-table-tennis"></i> Table Tennis
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sports Offered -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-trophy"></i>
                        <h2>Sports Offered</h2>
                    </div>
                    <div class="detail-content">
                        <p>The school participates in the following sports:</p>
                        <div class="facilities-list">
                            <div class="facility-item">
                                <i class="fas fa-running"></i> Athletics
                            </div>
                            <div class="facility-item">
                                <i class="fas fa-cricket"></i> Cricket
                            </div>
                            <div class="facility-item">
                                <i class="fas fa-futbol"></i> Football
                            </div>
                            <div class="facility-item">
                                <i class="fas fa-swimmer"></i> Swimming
                            </div>
                            <div class="facility-item">
                                <i class="fas fa-table-tennis"></i> Table Tennis
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'?>
</body>
</html>