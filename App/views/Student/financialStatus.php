<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Financial Status</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/financial_status.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/sidebar.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="header-content">
            <h1><i class="fas fa-money-bill-wave"></i> Student Financial Status</h1>
            <p>To Provide Financial Aids for Students with Financial Insecurities</p>
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

    <div class="stats-cards">
        <div class="card card-primary">
            <i class="fas fa-hand-holding-usd"></i>
            <div class="card-content">
                <span>Financial Aid Status</span>
                <strong><?php echo htmlspecialchars($data['status'] ?? 'Not Applied'); ?></strong>
            </div>
        </div>
        <div class="card card-secondary">
            <i class="fas fa-hourglass-half"></i>
            <div class="card-content">
                <span>Estimated Application Processing Time</span>
                <strong>3-5 days</strong>
            </div>
        </div>
    </div>

    <div class="main-content">
        <!-- Top Row -->
        <div class="top-row">
            <div class="section financial-overview">
                <div class="section-header">
                    <h2><i class="fas fa-info-circle"></i> Financial Aid Overview</h2>
                </div>
                <div class="overview-content">
                    <div class="overview-text">
                        <p>TrackMaster provides financial assistance to students in need. Please fill out the form below to apply for financial funds.</p>
                        <div class="alert-info">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Ensure all information is accurate and complete.</p>
                        </div>
                        <div class="alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Please note that funds will be received only after your application is approved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Previous Applications Section -->
        <?php if(!empty($data['applications'] ?? [])): ?>
        <div class="middle-row">
            <div class="section previous-applications">
                <div class="section-header">
                    <h2><i class="fas fa-history"></i> Your Previous Applications</h2>
                </div>
                <div class="applications-list">
                    <table class="applications-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['applications'] as $application): ?>
                            <tr>
                                <td><?php echo htmlspecialchars(date('M d, Y', strtotime($application->application_date))); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo strtolower(htmlspecialchars($application->application_status)); ?>">
                                        <?php echo htmlspecialchars($application->application_status); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/Student/viewApplication/<?php echo htmlspecialchars($application->id); ?>" class="action-button view-button">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Application Form -->
        <div class="middle-row">
            <div class="section application-form">
                <div class="section-header">
                    <h2><i class="fas fa-file-invoice-dollar"></i> Apply For Financial Funds</h2>
                </div>
                <form id="fundApplication" method="post" action="<?php echo URLROOT; ?>/Student/submitApplication" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($data['csrf_token'] ?? ''); ?>">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="studentName"><i class="fas fa-user-graduate"></i> Student Name</label>
                            <input type="text" id="studentName" name="studentName" placeholder="Enter your full name" required
                                   value="<?php echo isset($_POST['studentName']) ? htmlspecialchars($_POST['studentName']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="guardianName"><i class="fas fa-user"></i> Guardian Name</label>
                            <input type="text" id="guardianName" name="guardianName" placeholder="Enter guardian's full name" required
                                   value="<?php echo isset($_POST['guardianName']) ? htmlspecialchars($_POST['guardianName']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="annualIncome"><i class="fas fa-rupee-sign"></i> Annual Income (Rs.)</label>
                            <input type="number" id="annualIncome" name="annualIncome" placeholder="Enter annual household income" required
                                   min="0" step="0.01"
                                   value="<?php echo isset($_POST['annualIncome']) ? htmlspecialchars($_POST['annualIncome']) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
                            <input type="date" id="date" name="date" required
                                   value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : date('Y-m-d'); ?>">
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="reason"><i class="fas fa-align-left"></i> Reason for Applying</label>
                            <textarea id="reason" name="reason" placeholder="Describe your reason for requesting financial support" required><?php 
                                echo isset($_POST['reason']) ? htmlspecialchars($_POST['reason']) : ''; 
                            ?></textarea>
                        </div>
                                                        
                        <div class="form-group full-width">
                            <label for="notes"><i class="fas fa-sticky-note"></i> Additional Notes</label>
                            <textarea id="notes" name="notes" placeholder="Any additional information you would like to provide"><?php 
                                echo isset($_POST['notes']) ? htmlspecialchars($_POST['notes']) : ''; 
                            ?></textarea>
                        </div>

                        <div class="form-group full-width file-input-container">
                            <label for="financialReports"><i class="fas fa-file-pdf"></i> Upload Financial Reports</label>
                            <div class="file-upload">
                                <input type="file" id="financialReports" name="financialReports" accept=".pdf" required>
                                <label for="financialReports" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i> Choose PDF File
                                </label>
                                <span id="file-chosen">No file chosen</span>
                            </div>
                            <small class="file-hint"><i class="fas fa-info-circle"></i> Please upload documents in PDF format only (Max size: 5MB)</small>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="reset-button" type="reset"><i class="fas fa-undo"></i> Reset Form</button>
                        <button class="submit-button" type="submit"><i class="fas fa-paper-plane"></i> Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('fundApplication');
        const fileInput = document.getElementById('financialReports');
        const fileChosen = document.getElementById('file-chosen');
        
        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').value = today;
        
        // Update file input display
        fileInput.addEventListener('change', function() {
            if(this.files[0]) {
                fileChosen.textContent = this.files[0].name;
                fileChosen.classList.add('file-selected');
            } else {
                fileChosen.textContent = 'No file chosen';
                fileChosen.classList.remove('file-selected');
            }
        });
        
        // Form validation
        form.addEventListener('submit', function(event) {
            const annualIncome = document.getElementById('annualIncome').value;
            
            if (isNaN(annualIncome) || annualIncome <= 0) {
                event.preventDefault();
                showMessage('Please enter a valid annual income amount', 'error');
                return;
            }
            
            if (fileInput.files[0] && fileInput.files[0].size > 5 * 1024 * 1024) {
                event.preventDefault();
                showMessage('File size exceeds 5MB limit', 'error');
                return;
            }
        });
        
        // Reset file input display when form is reset
        form.addEventListener('reset', function() {
            fileChosen.textContent = 'No file chosen';
            fileChosen.classList.remove('file-selected');
        });
        
        function showMessage(message, type) {
            const statusDiv = document.createElement('div');
            statusDiv.className = 'status-message status-' + type;
            statusDiv.textContent = message;
            
            // Insert after dashboard header
            const dashboardHeader = document.querySelector('.dashboard-header');
            dashboardHeader.parentNode.insertBefore(statusDiv, dashboardHeader.nextSibling);
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                statusDiv.style.opacity = '0';
                setTimeout(() => {
                    statusDiv.remove();
                }, 500);
            }, 5000);
        }
    });
</script>
</body>
</html>