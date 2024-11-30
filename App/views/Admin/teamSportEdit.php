<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Edit View</title>
    <link rel="stylesheet" href="../../Public/css/Admin/sportView.css">
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>
</head>
<body>
<?php require_once "adminNav.php"; ?>
<div class="container">
    <?php echo $data['error']; ?>
    <h1>Edit <?php echo $sportName['sportName']?> Details</h1>
    <form action="<?php echo ROOT ?>/admin/teamsportEdit/<?php echo isset($sport['sportId']) ? $sport['sportId'] : ''; ?>" method="POST">

        <!-- Duration -->
        <div class="form-group detail-row">
            <label for="numPlayers"><strong>Number of players:</strong></label>
            <input type="text" id="numPlayers" name="numPlayers" value="<?php echo isset($sport['numPlayers']) ? $sport['durationMinutes'] : ''; ?>" required>
        </div>

        <!-- Is Indoor -->
        <div class="form-group detail-row">
            <label for="isIndoor"><strong>Location Type:</strong></label>
            <select id="isIndoor" name="isOutdoor" required>
                <option value="Indoor" <?php echo (isset($sport['isIndoor']) && $sport['isIndoor'] == 'Indoor') ? 'selected' : ''; ?>>Indoor</option>
                <option value="Outdoor" <?php echo (isset($sport['isOutdoor']) && $sport['isOutdoor'] == 'Outdoor') ? 'selected' : ''; ?>>Outdoor</option>
            </select>
        </div>
        
        <div class="form-group detail-row">
            <label for="teamFormation"><strong>Team Formation:</strong></label>
            <input type="text" id="teamFormation" name="teamFormation" value="<?php echo isset($sport['teamFormation']) ? $sport['teamFormation'] : ''; ?>" required>
        </div>

        <!-- Equipment -->
        <div class="form-group detail-row">
            <label for="positions"><strong>Positions:</strong></label>
            <input type="text" id="positions" name="positions" value="<?php echo isset($sport['positions']) ? $sport['positions'] : ''; ?>" required>
        </div>

        <!-- Categories -->
        <div class="form-group detail-row">
            <label for="durationMinutes"><strong>Game Duration:</strong></label>
            <input type="text" id="durationMinutes" name="durationMinutes" value="<?php echo isset($sport['durationMinutes']) ? $sport['durationMinutes'] : ''; ?>" required>
        </div>

        <!-- Scoring System -->
        <div class="form-group detail-row">
            <label for="halfTimeDuration"><strong>Half Time of the Game:</strong></label>
            <input type="text" id="halfTimeDuration" name="halfTimeDuration" value="<?php echo isset($sport['halfTimeDuration']) ? htmlspecialchars($sport['halfTimeDuration']) : ''; ?>" required>
        </div>

        <!-- Scoring System -->
        <div class="form-group detail-row">
            <label for="equipment"><strong>Equipment:</strong></label>
            <textarea id="equipment" name="equipment" required><?php echo isset($sport['equipment']) ? htmlspecialchars($sport['equipment']) : ''; ?></textarea>
        </div>

        <!-- Rules Link -->
        <div class="form-group detail-row">
            <label for="rulesLink"><strong>Rules Link:</strong></label>
            <input type="url" id="rulesLink" name="rulesLink" value="<?php echo isset($sport['rulesLink']) ? $sport['rulesLink'] : ''; ?>" required>
        </div>

        <!-- Save Changes Button -->
        <div class="form-group">
            <button type="submit">Save Changes</button>
        </div>
    </form>
</div>

</body>
</html>
