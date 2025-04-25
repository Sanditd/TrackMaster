<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Financial Application</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/financial_status.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/sidebar.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="header-content">
            <h1><i class="fas fa-file-invoice-dollar"></i> Financial Application Details</h1>
            <p>Details of your financial aid application</p>
        </div>
    </div>

    <?php if(isset($_SESSION['message'])): ?>
    <div class="status-message status-<?php echo htmlspecialchars($_SESSION['message_type'] ?? 'error'); ?>">
        <?php echo htmlspecialchars($_SESSION['message']); ?>
    </div>
    <?php 
        unset($_SESSION['message']); 
        unset($_SESSION['message_type']); 
    endif; ?>

    <div class="main-content">
        <?php if (!isset($data['application'])): ?>
            <div class="status-message status-error">
                Error: Application data not found.
            </div>
        <?php else: ?>
        <div class="top-row">
            <div class="section application-details">
                <div class="section-header">
                    <h2><i class="fas fa-info-circle"></i> Application Information</h2>
                </div>
                <div class="overview-content">
                    <div class="application-info-grid">
                        <div class="info-group">
                            <label><i class="fas fa-user-graduate"></i> Student Name:</label>
                            <span><?php echo htmlspecialchars($data['application']->student_name); ?></span>
                        </div>
                        <div class="info-group">
                            <label><i class="fas fa-user"></i> Guardian Name:</label>
                            <span><?php echo htmlspecialchars($data['application']->guardian_name); ?></span>
                        </div>
                        <div class="info-group">
                            <label><i class="fas fa-rupee-sign"></i> Annual Income:</label>
                            <span>Rs.<?php echo htmlspecialchars(number_format($data['application']->annual_income, 2)); ?></span>
                        </div>
                        <div class="info-group">
                            <label><i class="fas fa-calendar-alt"></i> Application Date:</label>
                            <span><?php echo htmlspecialchars(date('M d, Y', strtotime($data['application']->application_date))); ?></span>
                        </div>
                        <div class="info-group full-width">
                            <label><i class="fas fa-align-left"></i> Reason for Applying:</label>
                            <p><?php echo htmlspecialchars($data['application']->reason); ?></p>
                        </div>
                        <div class="info-group full-width">
                            <label><i class="fas fa-sticky-note"></i> Additional Notes:</label>
                            <p><?php echo htmlspecialchars($data['application']->notes ?: 'No additional notes provided'); ?></p>
                        </div>
                        <div class="info-group">
                            <label><i class="fas fa-check-circle"></i> Status:</label>
                            <span class="status-badge status-<?php echo strtolower(htmlspecialchars($data['application']->application_status)); ?>">
                                <?php echo htmlspecialchars($data['application']->application_status); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="action-buttons">
            <a href="<?php echo URLROOT; ?>/Student/financialStatus" class="reset-button">
                <i class="fas fa-arrow-left"></i> Back to Financial Status
            </a>
        </div>
    </div>
</div>

<style>
.application-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    padding: 1.5rem;
}

.info-group {
    display: flex;
    flex-direction: column;
}

.info-group label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

.info-group span, .info-group p {
    background: #f8f9fa;
    padding: 0.75rem;
    border-radius: 4px;
    color: #34495e;
}

.info-group.full-width {
    grid-column: 1 / -1;
}

.info-group p {
    margin: 0;
    line-height: 1.5;
}

.status-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 12px;
    font-weight: 500;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
}

.status-approved {
    background-color: #d4edda;
    color: #155724;
}

.status-rejected {
    background-color: #f8d7da;
    color: #721c24;
}

.action-buttons {
    margin-top: 2rem;
    text-align: right;
}

.reset-button {
    background-color: #6c757d;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.reset-button:hover {
    background-color: #5a6268;
}
</style>

</body>
</html>