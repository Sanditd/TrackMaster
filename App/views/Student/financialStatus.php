<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Status</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/financial_status.css">
</head>
<body>

<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>

<div id="main"> 

    <div class="intro">
        <center>
            <h1>Student Player Financial Information</h1>
        </center>
    </div>

    <div class="content">
        <div class="current info-card">
            <div class="card-body">
            <img src="/TrackMaster/Public/img/Student/finance.jpeg" alt="Financial Status" class="financial-status-image">
            </div>
            <div class="card-body">
            <p>TrackMaster provides financial assistance to students in need. Please fill out the form below to apply for financial funds.</p>
            <p class="special-note"><i class="fas fa-exclamation-circle"></i> Note: Ensure all information is accurate and complete.</p>
            <p class="special-note"><i class="fas fa-exclamation-circle"></i> Please Note that Funds will be received Only after Your Application Is approved.</p>
            </div>
        </div>
    </div>

    <div class="content">                      
            <div class="card-body">
                <div class="form-section">
                    <div class="form-header">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <h2>Apply For Financial Funds</h2>
                </div>
            
                <form id="fundApplication" method="post" action="submit_application.php" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="studentName"><i class="fas fa-user-graduate"></i> Student Name</label>
                            <input type="text" id="studentName" name="studentName" placeholder="Enter your full name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="guardianName"><i class="fas fa-user"></i> Guardian Name</label>
                            <input type="text" id="guardianName" name="guardianName" placeholder="Enter guardian's full name" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="annualIncome"><i class="fas fa-rupee-sign"></i> Annual Income (Rs.)</label>
                        <input type="number" id="annualIncome" name="annualIncome" placeholder="Enter annual household income" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="reason"><i class="fas fa-align-left"></i> Reason for Applying</label>
                        <textarea id="reason" name="reason" placeholder="Describe your reason for requesting financial support" required></textarea>
                    </div>
                                                        
                    <div class="form-group">
                        <label for="notes"><i class="fas fa-sticky-note"></i> Additional Notes</label>
                        <textarea id="notes" name="notes" placeholder="Any additional information you would like to provide"></textarea>
                    </div>

                    <div class="form-group">
                            <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
                            <input type="date" id="date" name="date" required>
                    </div>

                    <div class="form-group file-input-container">
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
                    
                    <div class="button-container">
                        <button class="reset-button" type="reset"><i class="fas fa-undo"></i> Clear Form</button>
                        <button class="submit-button" type="submit"><i class="fas fa-paper-plane"></i> Submit Application</button>
                    </div>
                </form>
            </div>
    </div>

    <div id="applicationStatus" class="status-message">
        <!-- Status messages will appear here after form submission -->
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
                showErrorMessage('Please enter a valid annual income amount');
                return;
            }
            
            if (fileInput.files[0] && fileInput.files[0].size > 5 * 1024 * 1024) {
                event.preventDefault();
                showErrorMessage('File size exceeds 5MB limit');
                return;
            }
        });
        
        // Reset file input display when form is reset
        form.addEventListener('reset', function() {
            fileChosen.textContent = 'No file chosen';
            fileChosen.classList.remove('file-selected');
        });
        
        function showErrorMessage(message) {
            const statusDiv = document.getElementById('applicationStatus');
            statusDiv.textContent = message;
            statusDiv.className = 'status-message status-error';
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                statusDiv.style.display = 'none';
                setTimeout(() => {
                    statusDiv.className = 'status-message';
                    statusDiv.style.display = '';
                }, 500);
            }, 5000);
        }
    });
</script>

</body>
</html>