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
    
    <h1>Edit <?php echo $sportName['sportName']?> Details</h1>
    <form action="<?php echo ROOT ?>/admin/indsportEdit/<?php echo isset($sport['sportId']) ? $sport['sportId'] : ''; ?>" method="POST">

        <!-- Duration -->
        <div class="form-group detail-row">
            <label for="duration"><strong>Duration:</strong></label>
            <input type="text" id="duration" name="duration" value="<?php echo isset($sport['durationMinutes']) ? $sport['durationMinutes'] : ''; ?>" required>
        </div>

        <!-- Is Indoor -->
        <div class="form-group detail-row">
            <label for="isIndoor"><strong>Is Indoor:</strong></label>
            <select id="isIndoor" name="isIndoor" required>
                <option value="Indoor" <?php echo (isset($sport['isIndoor']) && $sport['isIndoor'] == 'Indoor') ? 'selected' : ''; ?>>Indoor</option>
                <option value="Outdoor" <?php echo (isset($sport['isIndoor']) && $sport['isIndoor'] == 'Outdoor') ? 'selected' : ''; ?>>Outdoor</option>
            </select>
        </div>

        <!-- Equipment -->
        <div class="form-group detail-row">
            <label for="equipment"><strong>Equipment:</strong></label>
            <input type="text" id="equipment" name="equipment" value="<?php echo isset($sport['equipment']) ? $sport['equipment'] : ''; ?>" required>
        </div>

        <!-- Categories -->
        <div class="form-group detail-row">
            <label for="categories"><strong>Categories:</strong></label>
            <input type="text" id="categories" name="categories" value="<?php echo isset($sport['categories']) ? $sport['categories'] : ''; ?>" required>
        </div>

        <!-- Scoring System -->
        <div class="form-group detail-row">
            <label for="scoringSystem"><strong>Scoring System:</strong></label>
            <textarea id="scoringSystem" name="scoringSystem" required><?php echo isset($sport['scoringSystem']) ? htmlspecialchars($sport['scoringSystem']) : ''; ?></textarea>
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
