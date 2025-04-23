<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Achievement</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/achievements.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Modal Styles */
        .modal {
            color: #ffa500;
            display: flex; /* Always visible */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 25px;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            position: relative;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
            animation: modalopen 0.4s;
        }

        @keyframes modalopen {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            color: #666;
            cursor: pointer;
            transition: var(--transition);
        }

        .close-modal:hover {
            color: #00264d;
        }

        .modal-content h3 {
            color: #ffa500;
            margin-bottom: 20px;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #00264d;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #ffa500;
            box-shadow: 0 0 0 2px rgba(255, 165, 0, 0.2);
            outline: none;
        }

        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-option input[type="radio"] {
            margin: 0;
        }

        .form-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            background-color: #ffa500;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
        }

        .btn-secondary {
            background-color: #f1f1f1;
            color: #333;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Edit Achievement Modal -->
<div id="editAchievementModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="window.location.href='<?php echo URLROOT; ?>/Student/studentAchievements'">
            <i class="fas fa-times"></i>
        </span>
        <h3><i class="fas fa-trophy"></i> Edit Achievement</h3>
        
        <!-- Display error if any -->
        <?php if (!empty($data['error'])): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($data['error']); ?>
            </div>
        <?php endif; ?>
        
        <form action="<?php echo URLROOT; ?>/Student/editAchievement/<?php echo htmlspecialchars($data['achievement']->achievement_id); ?>" method="POST">
            <div class="form-group">
                <label for="place"><i class="fas fa-medal"></i> Place/Rank:</label> 
                <input type="text" id="place" name="place" required value="<?php echo htmlspecialchars($data['achievement']->place ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label><i class="fas fa-layer-group"></i> Achievement Level:</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="level1" name="level" value="zonal" <?php echo ($data['achievement']->level ?? '') == 'zonal' ? 'checked' : ''; ?> required>
                        <label for="level1">Zonal</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="level2" name="level" value="provincial" <?php echo ($data['achievement']->level ?? '') == 'provincial' ? 'checked' : ''; ?> required>
                        <label for="level2">Provincial</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="level3" name="level" value="national" <?php echo ($data['achievement']->level ?? '') == 'national' ? 'checked' : ''; ?> required>
                        <label for="level3">National</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description"><i class="fas fa-align-left"></i> Description:</label>
                <textarea id="description" name="description" placeholder="Describe your achievement..."><?php echo htmlspecialchars($data['achievement']->description ?? ''); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="date"><i class="fas fa-calendar-alt"></i> Date:</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($data['achievement']->date ?? ''); ?>" required>
            </div>
            
            <div class="form-actions">
                <button class="btn" type="submit">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <button class="btn btn-secondary" type="button" onclick="window.location.href='<?php echo URLROOT; ?>/Student/studentAchievements'">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Make sure form submission works correctly
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // Form validation can be added here if needed
            console.log('Form is being submitted');
            // Let the form submit normally
        });
    });
</script>

</body>
</html>