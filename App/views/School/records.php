    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>School Dashboard</title>
        <link rel="stylesheet" href="/TrackMaster/Public/css/School/records.css">

    </head>
    <body>

    <?php require 'navbar.php'; ?>  
    <?php require 'sidebar.php'; ?>

    <div class="section recent-clients">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Term</th>
                    <th>Average</th>
                    <th>Rank</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <?php if (!empty($data['records'])): ?>
                    <?php foreach ($data['records'] as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record->firstname); ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->grade); ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->term); ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->average); ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->rank); ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->notes); ?></td>
                            <td>
                            <button class="action-btn edit-btn" type="button" onclick="window.location.href='<?php echo URLROOT ?>/School/editRecord?player_id=<?php echo $record->player_id; ?>'">Edit</button>
                            <button 
                                class="action-btn delete-btn" 
                                type="button" 
                                onclick="confirmDelete('<?php echo $record->player_id; ?>')">
                                Delete
                            </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


            <div class="main-content">
                <div class="section recent-clients">
                    <h2>Submit a New Record</h2>
                    <form class="formcontent" method="POST" action="<?php echo URLROOT; ?>/school/submitRecord">                    <ul>
                            <li>
                                <label for="studentName">Student Name:</label>
                                <select id="studentName" name="firstname">
                                    <option value="" disabled selected>Please select a player</option>
                                <?php
                                foreach ($data['players'] as $player) {
                                    echo '<option>' . htmlspecialchars($player->firstname) . '</option>';
                                }
                                ?>
                                </select>
                            </li>
                            <li>
                                <label for="grade">Grade:</label>
                                <input type="text" id="grade" name="grade" placeholder="Enter grade">                        </li>
                            <li>
                                <label for="term">Term:</label>
                                <input type="text" id="term" name="term" placeholder="Enter term">                        </li>
                            <li>
                                <label for="average">Average:</label>
                                <input type="number" id="average" name="average" placeholder="Enter average">                        </li>
                            <li>
                                <label for="rank">Rank:</label>
                                <input type="number" id="rank" name="rank" placeholder="Enter rank">                        </li>
                            <li>
                            <label for="notes">Additional Notes:</label>
                            <textarea id="notes" name="notes"></textarea>                        </li>
                        </ul>
                        <button type="submit">Submit</button>
                    </form>
                </div>

            </div>
        </div>

        <script src="/Public/js/School/record.js"></script>
        <script src="/Public/js/School/submit.js"></script>

        <script>
    function confirmDelete(playerId) {
    if (confirm("Are you sure you want to delete this record? This action cannot be undone.")) {
        // Redirect to the deleteRecord method with the player's ID
        window.location.href = '<?php echo URLROOT; ?>/School/viewrecords/' + playerId;
    }
}
</script>


        <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    </body>