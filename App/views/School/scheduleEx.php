<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Extra Class Request</title>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/css/style.css">
   <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/School/schedule.css">
    
</head>
<body><!-- First Dashboard Section for Requests -->
<div class="dashboard-section">
    <div class="dashboard-header">
        <center><h1>Extra Class Requests</h1></center><br>
    </div> 

    <div class="request-form">
        <table class="event-list">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Subject Name</th>
                    <th>Notes</th>
                    <th>Actions</th>
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
                                <button type="submit" class="btn approve-btn">Approve</button>
                            </form>
                            
                            <form action="<?php echo ROOT; ?>/school/declineRequest" method="post" style="display:inline;">
                                <input type="hidden" name="request_type" value="extraclass">
                                <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                                <button type="submit" class="btn decline-btn">Decline</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="no-requests">No pending extra class requests</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Second Dashboard Section for Scheduling -->
<div class="dashboard-section">
    <div class="dashboard-header">
        <center><h1>Schedule Extra</h1></center><br>
    </div> 

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success"><?= $_SESSION['success_message'] ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php elseif (isset($_SESSION['error_message'])): ?>
        <div class="message error"><?= $_SESSION['error_message'] ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <form method="post" action="<?php echo ROOT; ?>/school/scheduleEx">
        <div class="form-group">
            <fieldset>
                <legend>Select Players</legend>
                <?php if (!empty($players)): ?>
                    <?php foreach ($players as $player): ?>
                        <label>
                            <input type="checkbox" name="players[]" value="<?= htmlspecialchars($player->name) ?>">
                            <?= htmlspecialchars($player->name) ?>
                        </label>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No players available for selection.</p>
                <?php endif; ?>
            </fieldset>
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Enter subject" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Write a brief description"></textarea>
        </div>

        <div class="form-group">
            <label for="date">Class Date</label>
            <input type="date" id="date" name="date" required>
        </div>

        <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" id="venue" name="venue" placeholder="Enter class venue" required>
        </div>

        <div class="form-actions">
            <button type="submit">Submit Request</button>
        </div>
    </form>
</div>
                </body>
                </html>