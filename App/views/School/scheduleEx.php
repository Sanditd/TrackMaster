<?php

?><?php
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
    <title>Extra Class Requests | TrackMaster</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/school/schedule.css">
    
</head>
<body>
    <?php require 'navbar.php'; ?>
    <?php require 'sidebar.php'; ?>
    
    <div class="extra-class-container">
        <div class="section-header">
            <h1><i class="fas fa-calendar-plus"></i> Extra Class Requests</h1>
            <p>Review and manage pending requests for extra classes</p>
            
        </div>

        <div class="table-section">
            <div class="table-header">
                <h2><i class="fas fa-list"></i> Pending Requests</h2>
            </div>
            <table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border-bottom: 1px solid #ccc; text-align: left;"><i class="fas fa-user"></i> Student Name</th>
            <th style="border-bottom: 1px solid #ccc; text-align: left;"><i class="fas fa-book"></i> Subject Name</th>
            <th style="border-bottom: 1px solid #ccc; text-align: left;"><i class="fas fa-sticky-note"></i> Reason</th>
            <th style="border-bottom: 1px solid #ccc; text-align: left;"><i class="fas fa-cogs"></i> Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['extraClassReq'])): ?>
            <?php foreach ($data['extraClassReq'] as $request): ?>
                <?php
                    $studentName = 'Unknown';
                    foreach ($data['players'] as $player) {
                        if ($player->player_id == $request->player_id) {
                            $studentName = htmlspecialchars($player->firstname . ' ' . $player->lname);
                            break;
                        }
                    }
                ?>
                <tr>
                    <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?php echo $studentName; ?></td>
                    <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?php echo htmlspecialchars($request->subject_name); ?></td>
                    <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?php echo htmlspecialchars($request->reason); ?></td>
                    <td style="border-bottom: 1px solid #ccc; padding: 8px;">
                        <?php if ($request->status == 'pending'): ?>
                        <form action="<?php echo ROOT; ?>/school/handleRequest" method="post" style="display:inline;">
    
    <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($request->id); ?>">

    <button type="submit" name="action" value="approve" class="action-btn approve-btn">
        <i class="fas fa-check"></i> Approve
    </button>

    <button type="submit" name="action" value="decline" class="action-btn decline-btn">
        <i class="fas fa-times"></i> Decline
    </button>
</form>

                            </form>
                        <?php else: ?>
                            <span style="color: green; font-weight: bold;"><?= ucfirst($request->status) ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="padding: 8px;" class="no-requests">
                    <i class="fas fa-info-circle"></i> No pending extra class requests
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

        </div>

        <div class="section-header">
            <h1><i class="fas fa-calendar-alt"></i> Schedule Extra Class</h1>
            <p>Create a new extra class and select students to attend</p>
        </div>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="message success">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_SESSION['success_message']) ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php elseif (isset($_SESSION['error_message'])): ?>
            <div class="message error">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_SESSION['error_message']) ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <div class="form-section">
            <div class="table-header">
                <h2><i class="fas fa-edit"></i> Class Details</h2>
            </div>
            <div class="form-content">
    <form method="post" action="<?php echo ROOT; ?>/school/scheduleEx">
        <div class="form-group">
            <div class="checkbox-container">
                <legend><i class="fas fa-users"></i> Select Players</legend>
                <div class="checkbox-grid">
                    <?php if (!empty($data['players'])): ?>
                        <?php foreach ($data['players'] as $player): ?>
                            <div class="checkbox-item">
                                <input type="checkbox" 
                                       id="player-<?= htmlspecialchars($player->player_id) ?>" 
                                       name="players[]" 
                                       value="<?= htmlspecialchars($player->player_id) ?>">
                                <label for="player-<?= htmlspecialchars($player->player_id) ?>">
                                    <?= htmlspecialchars($player->firstname . ' ' . $player->lname) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p><i class="fas fa-exclamation-circle"></i> No players available for selection.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="subject"><i class="fas fa-book"></i> Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Enter subject name" required>
        </div>
        
        <div class="form-group">
            <label for="description"><i class="fas fa-align-left"></i> Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Write a brief description of the class"></textarea>
        </div>
        
        <div class="form-group">
            <label for="date"><i class="fas fa-calendar-day"></i> Class Date</label>
            <input type="date" id="date" name="date" required>
        </div>
        
        <div class="form-group">
            <label for="venue"><i class="fas fa-map-marker-alt"></i> Venue</label>
            <input type="text" id="venue" name="venue" placeholder="Enter class venue" required>
        </div>

        <div class="btn-container">
            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i> Schedule Class
            </button>
        </div>
    </form>
</div>
                    </div>
                    </div>


    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('tbody tr');
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