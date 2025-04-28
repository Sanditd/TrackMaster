<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Parent/parent_dashboard.css">
 
</head>
<body>

<?php require 'navbar.php'; ?>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Guardian Dashboard</h1>
            <p>Welcome, Mr Thenuwara </p>
        </div>

<div class="main-content">
<div class="section attended-appointments ">
                   <h2>Player Profile</h2>
                <ul>
                   <div class="profile">
                    <li><strong>Name:</strong> Kusal Mendis</li>
                    <li><strong>Grade:</strong> 4</li>
                    <li><strong>School:</strong> lac</li>
                    <li><strong>Sport:</strong> Cricket 
                </div>
              
                </ul>
            </div>
</div> 


       <div class="section attended-appointments ">
 <h2>Player Performance</h2>
                 
    <div class="performance-container">
        <div class="performance-header">
      
  
        </div>
        
        <!-- Player Info Section -->
        <div class="player-info-section">
            <div class="player-avatar">
                <?php if (isset($data['player']) && !empty($data['player']->photo)): ?>
                    <img src="<?= URLROOT ?>/public/Uploads/<?= htmlspecialchars($data['player']->photo) ?>" 
                         alt="Player Photo" 
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                <?php else: ?>
                    <i class="fas fa-user"></i>
                <?php endif; ?>
            </div>
            <div class="player-details">
                <h2>
                    <?php echo isset($data['player']) ? htmlspecialchars($data['player']->firstname . ' ' . ($data['player']->lname ?? '')) : 'N/A'; ?>
                </h2>
                <span class="player-role">
                    <i class="fas fa-running"></i> 
                    <?= !empty($data['player']->role) ? htmlspecialchars($data['player']->role) : 'Player' ?>
                </span>
                <div class="player-meta">
                    <div class="player-meta-item">
                        <i class="fas fa-id-card"></i> ID: <?= isset($data['player']) ? $data['player']->user_id : 'N/A' ?>
                    </div>
                    <?php if (isset($data['player']) && !empty($data['player']->age)): ?>
                        <div class="player-meta-item">
                            <i class="fas fa-birthday-cake"></i> Age: <?= $data['player']->age ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($data['stats']) && !empty($data['stats']->matches)): ?>
                        <div class="player-meta-item">
                            <i class="fas fa-trophy"></i> Matches: <?= $data['stats']->matches ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="quick-stats">
                    <?php if (isset($data['stats']) && isset($data['stats']->runs)): ?>
                        <div class="stat-item">
                            <span class="stat-value"><?= $data['stats']->runs ?></span>
                            <span class="stat-label">Total Runs</span>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($data['stats']) && isset($data['stats']->wickets)): ?>
                        <div class="stat-item">
                            <span class="stat-value"><?= $data['stats']->wickets ?></span>
                            <span class="stat-label">Wickets</span>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($data['stats']) && isset($data['stats']->batting_avg)): ?>
                        <div class="stat-item">
                            <span class="stat-value"><?= number_format($data['stats']->batting_avg, 2) ?></span>
                            <span class="stat-label">Batting Avg</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
                    </div>
                    </div>
                
                    
                    <div class="section attended-appointments ">
 <h2>Attendance History</h2>
                 
    <div class="performance-container">
        <div class="performance-header">

    <!-- Player Attendance History Section -->
    <div class="player-attendance-history" id="playerAttendanceHistory">
        <div class="history-header">
         
        </div>
        
        <div class="history-stats"></div>
        
        <div style="overflow-x: auto; margin-top: 20px;">
            <table class="history-table">
                <thead>
                    <tr>
                        <th width="25%">Date</th>
                        <th width="25%">Session Type</th>
                        <th width="25%">Location</th>
                        <th width="25%">Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
       
    </div>
</div>

         
                    </div>
                    </div>
        


       
            

        
    </div>
    </div>        
        

    </div>

  

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
  

</body>