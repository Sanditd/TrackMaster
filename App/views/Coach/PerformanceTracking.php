<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Public/css/Coach/PerformanceTracking.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
</head>
<body>
   <?php require 'CoachNav.php'; ?> 

   <div class="dashboard-container">
      <div class="header">
          <h1>Cricket Performance Tracking</h1>
          <p>Select an option to proceed:</p>
      </div>
  
      <main class="options-container">
          <!-- First Row -->
          <div class="option-row">
              <div class="option-card" onclick="navigateTo('update-team.html')">
                  <img src="../Public/img/Coach/girlsteam.png" alt="Team Tracking" class="option-icon">
                  <h2>Track Team Performance</h2>
              </div>
              
  
              <div class="option-card" onclick="navigateTo('<?php echo ROOT; ?>/coach/playerperformance')">
                  <img src="../Public/img/Coach/runninggirl.png" alt="Player Tracking" class="option-icon">
                  <h2>Track Player Performance</h2>
              </div>
          </div>
  
          <!-- Second Row -->
          <div class="option-row">
              <div class="option-card" onclick="navigateTo('update-team.html')">
                  <img src="../Public/img/Coach/coach.png" alt="Update Team Tracking" class="option-icon">
                  <h2>Update Team Performance</h2>
              </div>
  
              <div class="option-card" onclick="showSearchPopup()">
                  <img src="../Public/img/Coach/boysteam.png" alt="Update Player Tracking" class="option-icon">
                  <h2>Update Player Performance</h2>
              </div>
          </div>
      </main>
  </div>
  
  <!-- Search Popup -->
  <div id="searchPopup" class="popup hidden">
    <form action="update-player.html" method="GET" onsubmit="return validateSearch()">
        <input type="text" name="playerName" placeholder="Enter Player Name" class="search-input" required>
        <button type="submit" class="search-button">Search</button>
    </form>
</div>

<!-- Overlay -->
<div class="overlay hidden"></div>


  
<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    <script src="../Public/js/Student/carousel.js"></script>
    <script src="../Public/js/Coach/PerformanceTracking.js"></script>
    <script src="../Public/js/Student/profile.js"></script>
    <script src="../Public/js/sidebar.js"></script>
    <script src="../Public/js/Student/calender.js"></script>

</body>