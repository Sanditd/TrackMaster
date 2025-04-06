<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>\Public\css\Coach\EditTeam.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>\Public\css\navbar.css">
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="container">
        <h1>Edit Team</h1>
        <?php if (!empty($data['message'])): ?>
            <p class="message"><?= $data['message']; ?></p>
        <?php endif; ?>
        <form method="POST" action="<?= ROOT; ?>/Coach/updateTeam">
            <input type="hidden" name="teamId" value="<?= $data['team']->team_id; ?>">

            <div class="form-group">
                <label for="teamName">Team Name:</label>
                <input type="text" id="teamName" name="teamName" value="<?= $data['team']->team_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="numberOfPlayers">Number of Players:</label>
                <input type="number" id="numberOfPlayers" name="numberOfPlayers" value="<?= $data['team']->number_of_players; ?>" required>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn save-team">Save Changes</button>
            </div>
        </form>

        <?php if (!empty($data['extraPlayers'])): ?>
            <h2>Extra Players in the Team</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['extraPlayers'] as $player): ?>
                        <tr>
                            <td><?= $player->player_id; ?></td>
                            <td><?= $player->name; ?></td>
                            <td><?= $player->role; ?></td>
                            <td>
                                <form method="POST" action="<?= ROOT; ?>/Coach/removePlayer">
                                    <input type="hidden" name="teamId" value="<?= $data['team']->team_id; ?>">
                                    <input type="hidden" name="playerId" value="<?= $player->player_id; ?>">
                                    <button type="submit" class="btn remove-player">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>
