<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Application Details</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/financial_status.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/sidebar.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="header-content">
            <h1><i class="fas fa-file-alt"></i> Financial Aid Application Details</h1>
            <p>Review your application information</p>
        </div>
    </div>
    
    <div class="back-link-container">
        <a href="/TrackMaster/Student/financialStatus" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Financial Status
        </a>
    </div>

    <div class="main-content">
        <div class="section application-details">
            <div class="section-header">
                <h2><i class="fas fa-info-circle"></i> Application Information</h2>
                <div class="status-badge status-<?php echo strtolower($data['application']->application_status); ?>">
                    <?php echo $data['application']->application_status; ?>
                </div>
            </div>
            
            <div class="details-grid">
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-user-graduate"></i> Student Name:</span>
                    <span class="detail-value"><?php echo $data['application']->student_name; ?></span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-user"></i> Guardian Name:</span>
                    <span class="detail-value"><?php echo $data['application']->guardian_name; ?></span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-rupee-sign"></i> Annual Income:</span>
                    <span class="detail-value">₹<?php echo number_format($data['application']->annual_income, 2); ?></span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-calendar-alt"></i> Application Date:</span>
                    <span class="detail-value"><?php echo date('F d, Y', strtotime($data['application']->application_date)); ?></span>
                </div>
                
                <div class="detail-item full-width">
                    <span class="detail-label"><i class="fas fa-align-left"></i> Reason for Applying:</span>
                    <span class="detail-value reason-text"><?php echo nl2br($data['application']->reason_for_applying); ?></span>
                </div>
                
                <?php if(!empty($data['application']->additional_notes)): ?>
                <div class="detail-item full-width">
                    <span class="detail-label"><i class="fas fa-sticky-note"></i> Additional Notes:</span>
                    <span class="detail-value"><?php echo nl2br($data['application']->additional_notes); ?></span>
                </div>
                <?php endif; ?>
                
                <div class="detail-item full-width">
                    <span class="detail-label"><i class="fas fa-file-pdf"></i> Financial Report:</span>
                    <span class="detail-value">
                        <a href="<?php echo $data['application']->financial_report_path; ?>" target="_blank" class="document-link">
                            <i class="fas fa-external-link-alt"></i> View Document
                        </a>
                    </span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label"><i class="fas fa-clock"></i> Submission Date:</span>
                    <span class="detail-value"><?php echo date('F d, Y H:i', strtotime($data['application']->created_at)); ?></span>
                </div>
            </div>
        </div>
        
        <?php if($data['application']->application_status == 'Approved'): ?>
        <div class="section approval-details">
            <div class="section-header">
                <h2><i class="fas fa-check-circle"></i> Approval Information</h2>
            </div>
            <div class="approval-message">
                <i class="fas fa-info-circle"></i>
                <p>Your application has been approved! Please visit the Student Affairs Office with your ID card to collect your financial aid.</p>
            </div>
        </div>
        <?php elseif($data['application']->application_status == 'Rejected'): ?>
        <div class="section rejection-details">
            <div class="section-header">
                <h2><i class="fas fa-times-circle"></i> Application Status Information</h2>
            </div>
            <div class="rejection-message">
                <i class="fas fa-info-circle"></i>
                <p>We regret to inform you that your application has been rejected. For more information, please visit the Student Affairs Office.</p>
            </div>
        </div>
        <?php else: ?>
        <div class="section pending-details">
            <div class="section-header">
                <h2><i class="fas fa-clock"></i> Application Status Information</h2>
            </div>
            <div class="pending-message">
                <i class="fas fa-info-circle"></i>
                <p>Your application is currently under review. This process typically takes 3-5 business days. You will be notified once a decision has been made.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require 'footer.php'; ?>

</body>
</html>