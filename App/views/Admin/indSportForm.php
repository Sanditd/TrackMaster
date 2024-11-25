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

<!-- Individual sports -->
<div id="indSports">
    <div class="container">
        <h1>Create a Individual Sport</h1>
        <p><b>please fill the inputs</b></p>
        <br>
        <spna class="form-invalid"><?php echo $data['errorMsg']?></spna>
        <br><br>

        <form id="createSportForm" action="<?php echo ROOT ?>/admin/addindSportForm" method="post">
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

            <!-- Duration of Each Game -->
            <div class="form-group">
                <label for="gameDuration">Game Duration (minutes):</label>
                <input type="number" id="gameDuration" name="gameDuration" min="1" placeholder="Enter Game Duration"
                    required >
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

            <!-- category -->
            <div class="form-group">
                <label for="categories">Categories:</label>
                <input type="text" id="category" name="category" placeholder="under 16,19"
                    >
            </div>

            <!-- scoering system -->
            <div class="form-group">
                <label for="scoring">Scoring System:</label>
                <input type="text" id="scoring" name="scoring" placeholder="briefly explain scoring system"
                    >
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

</html>