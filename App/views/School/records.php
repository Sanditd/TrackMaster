<?php
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];


 require_once __DIR__ . '/../../model/loginPage.php';

$loginModel = new loginPage();

$user = $loginModel->getUserById($userId);


if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Performance Tracking | TrackMaster</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Public/css/school/records.css">
    <style>
       
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
    
    <div class="academic-container">
        <div class="academic-header">
            <h1><i class="fas fa-graduation-cap"></i> Academic Performance Center</h1>
            <p>Track, analyze, and improve student academic performance with detailed grade records</p>
        </div>

        <!-- Records Section -->
        <div class="records-section">
            <div class="section-header">
                <h2><i class="fas fa-list"></i> Student Records</h2>
            </div>
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
                            <?php 
                                $player_fullname = "Unknown";
                                foreach ($data['playerNames'] as $player) {
                                    if ($player->player_id == $record->player_id) {
                                        $player_fullname = htmlspecialchars($player->firstname . ' ' . $player->lname);
                                        break;
                                    }
                                }
                            ?>
                            <td class="editable"><?php echo $player_fullname; ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->grade); ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->term); ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->average); ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->rank); ?></td>
                            <td class="editable"><?php echo htmlspecialchars($record->additional_notes); ?></td>
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

        <div class="add-record-section">
            <div class="section-header">
                <h2><i class="fas fa-plus-circle"></i> Submit New Academic Record</h2>
            </div>
            <form class="formcontent" method="POST" action="<?php echo URLROOT; ?>/school/submitRecord">
                <ul>
                    <li>
                        <label for="studentName"><i class="fas fa-user"></i> Student Name:</label>
                        <select id="studentName" name="player_id">
                            <option value="" disabled selected>Please select a student</option>
                            <?php foreach ($data['playerNames'] as $player): ?>
                                <option value="<?php echo $player->player_id; ?>"><?php echo htmlspecialchars($player->firstname . ' ' . $player->lname); ?></option>
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
                        <textarea id="notes" name="additional_notes" placeholder="Enter any additional information about the student's performance"></textarea>
                        <input type="hidden" id="school_id" name="school_id" value="<?php echo isset($data['records'][0]->school_id) ? $data['records'][0]->school_id : 1; ?>">
                    </li>
                </ul>
                <center>
                    <button type="submit"><i class="fas fa-paper-plane"></i> Submit Record</button>
                </center>
            </form>
        </div>
    </div>

    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('confirmModal')">&times;</span>
            <h3><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h3>
            <p>Are you sure you want to delete this record? This action cannot be undone.</p>
            <div style="margin-top: 20px; text-align: right;">
                <button class="action-btn edit-btn" onclick="closeModal('confirmModal')">Cancel</button>
                <button class="action-btn delete-btn" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
    <div class="modal-overlay" id="modalOverlay"></div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.getElementById('modalOverlay').classList.remove('active');
        }

        function confirmDelete(playerId) {
            document.getElementById('confirmModal').classList.add('active');
            document.getElementById('modalOverlay').classList.add('active');
            
            document.getElementById('confirmDeleteBtn').onclick = function() {
                window.location.href = '<?php echo URLROOT; ?>/School/deleteRecord/' + playerId;
            };
        }

        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('#studentTableBody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseover', function() {
                    this.style.backgroundColor = 'rgba(255, 165, 0, 0.05)';
                });
                row.addEventListener('mouseout', function() {
                    this.style.backgroundColor = '';
                });
            });
        });
    </script>
</body>
</html>