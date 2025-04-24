<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Requests</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/School/event.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <center><h1><i class="fas fa-tachometer-alt"></i> Facilities Requests</h1></center><br> 
    </div>
    <table class="event-list">
        <thead>
            <tr>
                <th><i class="fas fa-calendar-check"></i> Event Name</th>
                <th><i class="fas fa-user"></i> Coach Name</th>
                <th><i class="fas fa-clock"></i> Date and Time</th>
                <th><i class="fas fa-tasks"></i> Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($data['facilityRequests'])): ?>
                <?php foreach($data['facilityRequests'] as $request): ?>
                <tr>
                    <td><?php echo $request->event_name; ?></td>
                    <td><?php echo $request->coach_name; ?></td>
                    <td><?php echo $request->date . ' : ' . $request->start_time . ' - ' . $request->end_time; ?></td>
                    <td>
                        <!-- Approve Form -->
                        <form action="<?php echo ROOT; ?>/school/approveRequest" method="post" style="display:inline;">
                            <input type="hidden" name="request_type" value="facility">
                            <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                            <button type="submit" class="btn approve-btn"><i class="fas fa-check"></i> Approve</button>
                        </form>
                        
                        <!-- Decline Form -->
                        <form action="<?php echo ROOT; ?>/school/declineRequest" method="post" style="display:inline;">
                            <input type="hidden" name="request_type" value="facility">
                            <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                            <button type="submit" class="btn decline-btn"><i class="fas fa-times"></i> Decline</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="no-requests">No pending facility requests</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (!empty($_SESSION['flash_message'])): ?>
    <div class="flash-message">
        <?php echo $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?>
    </div>
    <?php endif; ?>
</div>

<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>
