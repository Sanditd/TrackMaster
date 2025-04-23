<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Extra Class Request</title>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/css/style.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/school/schedule.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>

<!-- First Dashboard Section for Requests -->
<div class="dashboard-section">
    <div class="dashboard-header">
        <center><h1><i class="fas fa-calendar-plus"></i> Extra Class Requests</h1></center><br>
    </div> 

    <div class="request-form">
        <table class="event-list">
            <thead>
                <tr>
                    <th><i class="fas fa-user"></i> Student Name</th>
                    <th><i class="fas fa-book"></i> Subject Name</th>
                    <th><i class="fas fa-sticky-note"></i> Notes</th>
                    <th><i class="fas fa-cogs"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($data['extraClassRequests'])): ?>
                    <?php foreach($data['extraClassRequests'] as $request): ?>
                    <tr>
                        <td><?php echo $request->student_name; ?></td>
                        <td><?php echo $request->subject_name; ?></td>
                        <td><?php echo $request->notes; ?></td>
                        <td>
                            <form action="<?php echo ROOT; ?>/school/approveRequest" method="post" style="display:inline;">
                                <input type="hidden" name="request_type" value="extraclass">
                                <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                                <button type="submit" class="btn approve-btn"><i class="fas fa-check-circle"></i> Approve</button>
                            </form>
                            
                            <form action="<?php echo ROOT; ?>/school/declineRequest" method="post" style="display:inline;">
                                <input type="hidden" name="request_type" value="extraclass">
                                <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                                <button type="submit" class="btn decline-btn"><i class="fas fa-times-circle"></i> Decline</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="no-requests"><i class="fas fa-info-circle"></i> No pending extra class requests</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Second Dashboard Section for Scheduling -->
<div class="dashboard-section">
    <div class="dashboard-header">
        <center><h1><i class="fas fa-calendar-alt"></i> Schedule Extra</h1></center><br>
    </div> 

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success"><i class="fas fa-check-circle"></i> <?= $_SESSION['success_message'] ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php elseif (isset($_SESSION['error_message'])): ?>
        <div class="message error"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error_message'] ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <form method="post" action="<?php echo ROOT; ?>/school/scheduleEx">
        <div class="form-group">
            <fieldset>
                <legend><i class="fas fa-users"></i> Select Players</legend>
                <?php if (!empty($players)): ?>
                    <?php foreach ($players as $player): ?>
                        <label>
                            <input type="checkbox" name="players[]" value="<?= htmlspecialchars($player->name) ?>">
                            <?= htmlspecialchars($player->name) ?>
                        </label>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p><i class="fas fa-exclamation-circle"></i> No players available for selection.</p>
                <?php endif; ?>
            </fieldset>
        </div>

        <div class="form-group">
            <label for="subject"><i class="fas fa-book"></i> Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Enter subject" required>
        

        
            <label for="description"><i class="fas fa-align-left"></i> Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Write a brief description"></textarea>
      

     
            <label for="date"><i class="fas fa-calendar-day"></i> Class Date</label>
            <input type="date" id="date" name="date" required>
        

        
            <label for="venue"><i class="fas fa-map-marker-alt"></i> Venue</label>
            <input type="text" id="venue" name="venue" placeholder="Enter class venue" required>
        </div>

        <div class="form-actions">
            <button type="submit"><i class="fas fa-paper-plane"></i> Submit Request</button>
        </div>
    </form>
</div>
<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>
