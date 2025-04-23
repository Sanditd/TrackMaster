<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/school/records.css">

</head>
<body>

<?php require 'navbar.php'; ?>  
<?php require 'sidebar.php'; ?>

<div class="dashboard-container">
        <div class="dashboard-header">
            <h1><i class="fas fa-tachometer-alt"></i> School Dashboard</h1>
            <p><i class="fas fa-user"></i> Welcome, Anthony!</p>
        </div>
<div class="section recent-clients">
    <table> 
        <thead>
            <tr>
                <th><i class="fas fa-user"></i> Name</th>
                <th><i class="fas fa-graduation-cap"></i> Grade</th>
                <th><i class="fas fa-calendar-alt"></i> Term</th>
                <th><i class="fas fa-percentage"></i> Average</th>
                <th><i class="fas fa-trophy"></i> Rank</th>
                <th><i class="fas fa-sticky-note"></i> Notes</th>
                <th><i class="fas fa-cogs"></i> Actions</th>
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
                            <button class="action-btn edit-btn" type="button" onclick="window.location.href='<?php echo URLROOT ?>/School/editRecord/<?php echo $record->player_id; ?>'">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="action-btn delete-btn" type="button" onclick="confirmDelete('<?php echo $record->player_id; ?>')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No records found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="main-content">
    <div class="section recent-clients">
        <h2><i class="fas fa-plus-circle"></i> Submit a New Record</h2>
        <form class="formcontent" method="POST" action="<?php echo URLROOT; ?>/school/submitRecord">
            <ul>
                <li>
                    <label for="studentName"><i class="fas fa-user"></i> Student Name:</label>
                    <select id="studentName" name="firstname">
                        <option value="" disabled selected>Please select a player</option>
                        <?php foreach ($data['players'] as $player): ?>
                            <option><?php echo htmlspecialchars($player->firstname); ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <li>
                    <label for="grade"><i class="fas fa-graduation-cap"></i> Grade:</label>
                    <input type="text" id="grade" name="grade" placeholder="Enter grade">
                </li>
                <li>
                    <label for="term"><i class="fas fa-calendar-alt"></i> Term:</label>
                    <input type="text" id="term" name="term" placeholder="Enter term">
                </li>
                <li>
                    <label for="average"><i class="fas fa-percentage"></i> Average:</label>
                    <input type="number" id="average" name="average" placeholder="Enter average">
                </li>
                <li>
                    <label for="rank"><i class="fas fa-trophy"></i> Rank:</label>
                    <input type="number" id="rank" name="rank" placeholder="Enter rank">
                </li>
                <li>
                    <label for="notes"><i class="fas fa-sticky-note"></i> Additional Notes:</label>
                    <textarea id="notes" name="notes"></textarea>
                </li>
            </ul>
           <center> <button type="submit"><i class="fas fa-paper-plane"></i> Submit</button> </center>
        </form>
    </div>
</div>

<script src="/Public/js/School/record.js"></script>
<script src="/Public/js/School/submit.js"></script>


<script>
    function confirmDelete(playerId) {
        if (confirm("Are you sure you want to delete this record? This action cannot be undone.")) {
            window.location.href = '<?php echo URLROOT; ?>/School/deleteRecord/' + playerId;
        }
    }
</script>

<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>
