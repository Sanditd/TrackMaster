<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Management</title>
    <link rel="stylesheet" href="../Public/css/Coach/TeamManagement.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="container">
        <div class="action-buttons">
            <button id = "createteam" class="create-team">
            <a href="<?php echo ROOT; ?>/coach/creataddplayers">Create Team</a>
            </button>
        </div>
    </div>
        
    
        <?php if(empty($data['teams'])): ?>
            <p>No teams available. Please create one.</p>
        <?php else: ?>
            <?php foreach($data['teams'] as $team): ?>
                <div class="team-name">
                    <h2 class="team-title">Team Name: <?= $team->team; ?></h2>
                        <div class="team-actions">
                            <button class="btn edit-team">Edit Team</button>
                            <button class="btn delete-team">Delete Team</button>
                        </div>
                    </div>
                <div class="team-list">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Contact Info</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($team->players as $player): ?>
                                <tr>
                                    <td><?= $player->player_id; ?></td>
                                    <td><img src="data:image/jpeg;base64,<?= base64_encode($player->photo); ?>" alt="Player Photo" style="max-width:50px;"></td>                                        <td><?= $player->name; ?></td>
                                    <td><?= $player->phonenumber; ?>
                                        <br>  <?= $player->email; ?></td>
                                        <td><?= $player->role; ?></td>   
                                    <td>
                                        <button class="btn replace">Replace Player</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script src="../Public/js/sidebar.js"></script>
    
</body>
</html>
