<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Management</title>
    <link rel="stylesheet" href="../Public/css/Coach/newTeamManagement.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="container">
        <div class="action-buttons">
            <button id = "createteam" class="btn create-team">
            <a href="<?php echo ROOT; ?>/coach/creataddplayers">Create A Team</a>
            </button>
        </div>
    </div>
        
    
        <?php if(empty($data['teams'])): ?>
            <p>No teams available. Please create one.</p>
        <?php else: ?>
            <?php foreach($data['teams'] as $team): ?>
                <div class="team-name">
                    <h1 class="team-title">Team Name: <?= $team->team; ?></h1>
                        <div class="team-actions">
                        <button class="btn edit-team">
    <a href="<?= ROOT; ?>/Coach/editTeam/<?= $team->team_id; ?>">Edit Team</a>
</button>
                            <form method="POST" action="<?= ROOT; ?>/Coach/deleteTeam">
    <input type="hidden" name="teamId" value="<?= $team->team_id; ?>">
    <button type="submit" class="btn delete-team">Delete Team</button>
</form>
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

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

    <script src="../Public/js/sidebar.js"></script>
    <script>

function deleteTeam(teamId) {
    if (!confirm('Are you sure you want to delete this team? This action cannot be undone.')) {
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/TrackMaster/Coach/deleteTeam', true); // Update with the correct path
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                alert(response.message);
                location.reload(); // Reload the page to reflect the deletion
            } else {
                alert(response.message);
            }
        } else {
            alert('Unexpected error occurred. Please try again.');
        }
    };
    xhr.send(`teamId=${teamId}`);
}

</script>
    
</body>
</html>
