<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Requests</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/School/event.css">
</head>
<body>
<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <center><h1>Facilities Requests</h1></center><br> 
    </div>
    <table class="event-list">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Coach Name</th>
                <th>Date and Time</th>
                <th>Action</th>
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
                            <button type="submit" class="btn approve-btn">Approve</button>
                        </form>
                        
                        <!-- Decline Form -->
                        <form action="<?php echo ROOT; ?>/school/declineRequest" method="post" style="display:inline;">
                            <input type="hidden" name="request_type" value="facility">
                            <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                            <button type="submit" class="btn decline-btn">Decline</button>
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

    
    <div class="dashboard-header">
        <center><h1>Extra Class Requests</h1></center><br> 
    </div>
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
                        <!-- Approve Form -->
                        <form action="<?php echo ROOT; ?>/school/approveRequest" method="post" style="display:inline;">
                            <input type="hidden" name="request_type" value="extraclass">
                            <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                            <button type="submit" class="btn approve-btn">Approve</button>
                        </form>
                        
                        <!-- Decline Form -->
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

<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>