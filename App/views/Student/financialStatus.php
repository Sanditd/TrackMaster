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

        <div class="title">
            <h1>Student Player Financial Information</h1>
        </div>
    <div id="main"> 
        <div class="current">
            <h2>Current Financial Status</h2>
            <p><strong> Last updated : </strong>2021-03-24</p>
            <p><strong> Status : </strong>None</p>
            <p><strong> Registration Number (if Recieve Funds) : </strong>None</p>
            <p><strong> Registered Date : </strong> None</p>
            <p><strong> Notes: </strong>None</p>
        </div>

        <div class="container">
            <div class="form-section">
                <h2>Apply For Financial Funds</h2>
                <form>    
                    <label for="studentName">Student Name:</label>
                    <input type="text" id="studentName" name="studentName" required>
                
                    <label for="guardianName">Guardian Name:</label>
                    <input type="text" id="guardianName" name="guardianName" required>
                
                    <label for="annualIncome">Annual Income (Rs.) :</label>
                    <input type="text" id="annualIncome" name="annualIncome" required>
                
                    <label for="reason">Reason for Applying:</label>
                    <textarea id="reason" name="reason" required></textarea>
                                                        
                    <label for="notes">Additional Notes:</label>
                    <textarea id="notes" name="notes"></textarea>

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>

                    <label for="financialReports">Upload Financial Reports (PDF):</label>
                    <input type="file" id="financialReports" name="financialReports" accept=".pdf" required>
    
                    <center><button class="edit-button" type="submit">Submit the Application</button></center>
                </form>
            </div>           
        </div>
    </div>

    <?php require 'footer.php'; ?>
 
    <script src="/TrackMaster/Public/js/Student/financial_status.js"></script>
</body>
</html>
