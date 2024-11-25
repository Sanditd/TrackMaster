<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Sport</title>
    <link rel="stylesheet" href="../../Public/css/Admin/sportCreate.css">
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>

</head>

<body>

</body>
<?php require_once "adminNav.php" ?>

<!-- <div id="mainContent" style="display: none;"> -->
<div id="teamSport" >
    <div class="container">
        <h1>Create a Team Sport</h1>

        <form id="createSportForm" action="<?php echo ROOT ?>/admin/addSportForm" method="post">
            <!-- Sport Name -->
            <div class="form-group">
                <label for="sportName">Sport Name:</label>
                <input type="text" id="sportName" name="sportName" placeholder="Enter Sport Name" required
                    >
            </div>

            <!-- Sport Type -->
            <!-- <div class="form-group">
                        <label for="sportType">Sport Type:</label>
                        <select id="sportType" name="sportType" required value=">
                            <option value="">Select Type</option>
                            <option value="Individual">Individual</option>
                            <option value="Team">Team</option>
                        </select>
                    </div> -->

            <!-- Number of Players -->
            <div class="form-group">
                <label for="numPlayers">Number of Players:</label>
                <input type="number" id="numPlayers" name="numPlayers" min="1" placeholder="Enter Number of Players"
                    required >
            </div>

            <!-- Player Position List -->
            <div class="form-group">
                <label for="playerPositions">Player Positions (comma-separated):</label>
                <input type="text" id="playerPositions" name="playerPositions"
                    placeholder="e.g., Goalkeeper, Defender, Striker" >
            </div>

            <!-- Team Formation -->
            <div class="form-group">
                <label for="teamFormation">Team Formation:</label>
                <input type="text" id="teamFormation" name="teamFormation" placeholder="e.g., 4-4-2"
                    >
            </div>

            <!-- Duration of Each Game -->
            <div class="form-group">
                <label for="gameDuration">Game Duration (minutes):</label>
                <input type="number" id="gameDuration" name="gameDuration" min="1" placeholder="Enter Game Duration"
                    required >
            </div>

            <!-- Halftime Duration -->
            <div class="form-group">
                <label for="halftimeDuration">Halftime Duration (minutes):</label>
                <input type="number" id="halftimeDuration" name="halftimeDuration" min="1"
                    placeholder="Enter Halftime Duration" >
            </div>

            <!-- Indoor or Outdoor -->
            <div class="form-group">
                <label for="locationType">Location Type:</label>
                <select id="locationType" name="locationType" required >
                    <option value="">Select Location</option>
                    <option value="Indoor">Indoor</option>
                    <option value="Outdoor">Outdoor</option>
                </select>
            </div>

            <!-- Equipment -->
            <div class="form-group">
                <label for="equipment">Equipment (comma-separated):</label>
                <input type="text" id="equipment" name="equipment" placeholder="e.g., Ball, Net, Bat"
                    >
            </div>

            <!-- Rules URL -->
            <div class="form-group">
                <label for="rulesURL">Rules (URL):</label>
                <input type="url" id="rulesURL" name="rulesURL" placeholder="Enter URL for Rules"
                    >
            </div>

            <!-- Submit Button -->
            <button type="submit">Create Sport</button>
        </form>
    </div>
</div>
<!-- </div> -->

</html>