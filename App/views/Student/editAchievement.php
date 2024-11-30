<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Achievement</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/achievements.css">
</head>
<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>
<?php 
    // echo $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}?>

<center>    
    <div class="edit-section">
        <div class="form-section">
            <h2>Edit Achievement</h2>

            <!-- Display error if any -->
            <?php if (!empty($data['error'])): ?>
                <p class="error-message"><?php echo htmlspecialchars($data['error']); ?></p>
            <?php endif; ?>

            <form action="<?php echo URLROOT; ?>/Student/editAchievement/<?php echo htmlspecialchars($data['achievement']->	achievement_id ); ?>" method="POST">  
                <label for="place">Place/Rank:</label> 
                <textarea id="place" name="place" required><?php echo htmlspecialchars($data['achievement']->place ?? ''); ?></textarea>  

                <label for="level">Level:</label>
                <input type="radio" id="level1" name="level" value="zonal" <?php echo ($data['achievement']->level ?? '') == 'zonal' ? 'checked' : ''; ?> required> Zonal Level </br>
                <input type="radio" id="level2" name="level" value="provincial" <?php echo ($data['achievement']->level ?? '') == 'provincial' ? 'checked' : ''; ?> required> Provincial Level</br>
                <input type="radio" id="level3" name="level" value="national" <?php echo ($data['achievement']->level ?? '') == 'national' ? 'checked' : ''; ?> required> National Level</br>

                <label for="description">Description:</label>
                <textarea id="description" name="description"><?php echo htmlspecialchars($data['achievement']->description ?? ''); ?></textarea>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($data['achievement']->date ?? ''); ?>" required>

                <center>
                    <button class="edit-button" type="submit">Save</button>
                    <button class="edit-button" type="button" onclick="window.location.href='<?php echo URLROOT; ?>/Student/studentAchievements'">Cancel</button>
                </center>
            </form>
        </div>
    </div>
</center>

<?php require 'footer.php'; ?>

<script src="/Public/js/Student/achievements.js"></script>

</body>
</html>
