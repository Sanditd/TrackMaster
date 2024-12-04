<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Dashboard</title>

    <link rel="stylesheet" href="../Public/css/Coach/profileManagement.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
    <link rel="stylesheet" href="../Public/css/sidebar.css">
    <link rel="stylesheet" href="../Public/css/footer.css">

</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="form-container">
        <h2>Share Player Profile</h2>
        <form id="shareProfileForm">
            <!-- Select Coach -->
            <div class="form-group">
                <label for="selectCoach">Select Coach</label>
                <select id="selectCoach" required>
                    <option value="" disabled selected>Select a coach</option>
                    <option value="Coach1">Coach 1</option>
                    <option value="Coach2">Coach 2</option>
                    <option value="Coach3">Coach 3</option>
                </select>
            </div>
            
            <!-- Select Player -->
            <div class="form-group">
                <label for="selectPlayer">Select Player</label>
                <select id="selectPlayer" onchange="populateStats()" required>
                    <option value="" disabled selected>Select a player</option>
                    <option value="Player1">Player 1</option>
                    <option value="Player2">Player 2</option>
                    <option value="Player3">Player 3</option>
                </select>
            </div>

            <!-- Player Stats -->
            <div class="stats-group" id="playerStats">
                <div class="stat-item">
                    <span>Runs</span>
                    <strong id="runs">-</strong>
                </div>
                <div class="stat-item">
                    <span>Wickets</span>
                    <strong id="wickets">-</strong>
                </div>
                <div class="stat-item">
                    <span>Batting Avg</span>
                    <strong id="battingAvg">-</strong>
                </div>
                <div class="stat-item">
                    <span>Bowling Avg</span>
                    <strong id="bowlingAvg">-</strong>
                </div>
                <div class="stat-item">
                    <span>Batting SR</span>
                    <strong id="battingSR">-</strong>
                </div>
                <div class="stat-item">
                    <span>Bowling SR</span>
                    <strong id="bowlingSR">-</strong>
                </div>
                <div class="stat-item">
                    <span>Economy</span>
                    <strong id="economyRate">-</strong>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" placeholder="Enter a description..." required></textarea>
            </div>

            <!-- Share Button -->
            <div class="form-group">
                <button type="submit">Share Profile</button>
            </div>
        </form>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    <script src="../../../Public/js/Student/carousel.js"></script>
    <script src="../../../Public/js/Student/profile.js"></script>
    <script src="../../../Public/js/sidebar.js"></script>
    <script src="../../../Public/js/Student/calender.js"></script>
</body>
</html>