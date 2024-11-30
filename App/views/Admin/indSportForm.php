<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Sport</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Admin/createSport.css">

</head>

<body>

<?php require_once "adminNav.php" ?>

<!-- Individual sports -->
<div id="indSports">
    <div class="container">
        <h1>Create an Individual Sport</h1>
        <h2>Please Fill the Inputs : </h2>
        <br>
        <spna class="form-invalid"><?php echo $data['errorMsg']?></spna>
        <br><br>

        <form class="form-section" id="createSportForm" action="<?php echo ROOT ?>/admin/addindSportForm" method="post">

            <div class="form-group">
                <label for="sportName">Sport Name:</label>
                <input type="text" id="sportName" name="sportName" placeholder="Enter Sport Name" required
                    >
            </div>

            <div class="form-group">
                <label for="gameDuration">Game Duration (minutes):</label>
                <input type="number" id="gameDuration" name="gameDuration" min="1" placeholder="Enter Game Duration"
                    required >
            </div>

            <div class="form-group">
                <label for="locationType">Location Type:</label>
                <select id="locationType" name="locationType" required >
                    <option value="">Select Location</option>
                    <option value="Indoor">Indoor</option>
                    <option value="Outdoor">Outdoor</option>
                </select>
            </div>

            <div class="form-group">
                <label for="categories">Categories:</label>
                <input type="text" id="category" name="category" placeholder="under 16,19"
                    >
            </div>

            <div class="form-group">
                <label for="scoring">Scoring System:</label>
                <input type="text" id="scoring" name="scoring" placeholder="briefly explain scoring system"
                    >
            </div>

            <div class="form-group">
                <label for="equipment">Equipment (comma-separated):</label>
                <input type="text" id="equipment" name="equipment" placeholder="e.g., Ball, Net, Bat"
                    >
            </div>

            <div class="form-group">
                <label for="rulesURL">Rules (URL):</label>
                <input type="url" id="rulesURL" name="rulesURL" placeholder="Enter URL for Rules"
                    >
            </div>

            <button class="edit-button" type="submit">Create The Sport</button>
        </form>
    </div>
</div>

</html>