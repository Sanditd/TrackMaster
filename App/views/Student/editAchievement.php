<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievements</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/achievements.css">
    <style>
        /* Modal Styles */
        .modal-container {
            display: block; /* Always visible */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            width: 60%;
            max-width: 600px;
            animation: modalopen 0.5s;
        }

        @keyframes modalopen {
            from {opacity: 0; transform: translateY(-60px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-modal:hover,
        .close-modal:focus {
            color: #000;
            text-decoration: none;
        }

        .form-section {
            width: 100%;
            padding: 15px;
            border: none;
        }

        .form-section h2 {
            margin-bottom: 20px;
            color: #00264d;
        }

        .form-section label {
            display: block;
            margin: 15px 0 5px;
            font-weight: 600;
            color: #333;
        }

        .form-section textarea, 
        .form-section input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form-section textarea {
            min-height: 80px;
            resize: vertical;
        }

        .form-section input[type="radio"] {
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .error-message {
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 20px;
        }

        .edit-button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin: 10px 5px;
        }

        .edit-button[type="submit"] {
            background-color: #ffa500;
            color: white;
        }

        .edit-button[type="submit"]:hover {
            background-color: #cc8400;
        }

        .edit-button[type="button"] {
            background-color: #ccc;
            color: #333;
        }

        .edit-button[type="button"]:hover {
            background-color: #b3b3b3;
        }
    </style>
</head>
<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>
<?php 
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}?>

<!-- Fixed modal structure that won't interfere with form submission -->
<div class="modal-container">
    <div class="modal-content">
        <span class="close-modal" onclick="window.location.href='<?php echo URLROOT; ?>/Student/studentAchievements'">&times;</span>
        <div class="form-section">
            <h2>Edit Achievement</h2>
            
            <!-- Display error if any -->
            <?php if (!empty($data['error'])): ?>
                <p class="error-message"><?php echo htmlspecialchars($data['error']); ?></p>
            <?php endif; ?>

            <form action="<?php echo URLROOT; ?>/Student/editAchievement/<?php echo htmlspecialchars($data['achievement']->achievement_id); ?>" method="POST">  
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
</div>

<?php require 'footer.php'; ?>

<script>
    // Add any JavaScript needed for the page
    document.addEventListener('DOMContentLoaded', function() {
        // Make sure form submission works correctly
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // You can add validation here if needed
            console.log('Form is being submitted');
            // Let the form submit normally
        });
    });
</script>

</body>
</html>