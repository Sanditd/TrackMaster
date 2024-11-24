<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/medical_status.css">

</head>
<body>

    <?php include './../navbar.php'?>
    <?php include './../sidebar.php'?>

    <div id="main">
        <div class="title">
            <h1>Student Player Medical Information</h1>
        </div>
  
           <center><div class="current">
                <h2>Current Medical Status</h2>
                <p><strong>Last updated : </strong>2021-03-24</p>
                <p><strong> Medical Conditions : </strong>None</p>
                <p><strong> Medication : </strong>None</p>
                <p><strong> Notes: </strong>None</p>
            </div></center>

        <div class="container">
            
            <div class="form-section">
                <h2>Update The Current Medical Status</h2>
                <form>    
                    <label for="date">Date:</label>
                    <input type="date" id="date" required><br>
    
                    <label for="condition">Medical Condition:</label>
                    <input type="text" id="condition" placeholder="Enter the Ongoing Medical Condition" required><br>

                    <label for="medication">Medication:</label>
                    <textarea id="medication" placeholder="Enter the Given Medications" required></textarea><br> <!-- Changed ID -->

                    <label for="notes">Notes:</label>
                    <textarea id="notes" placeholder="Enter Additional Notes" required></textarea><br>
    
                    <label for="report">Upload Medical Report (PDF):</label>
                    <input type="file" id="report" accept=".pdf" required><br>
    
                    <center><button class="edit-button" type="submit">Submit</button></center>
                </form>
            </div>

            <div class="table-section">
                <h2>Medical History</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date Updated</th>
                            <th>Medical Condition</th>
                            <th>Medication</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>08/11/2024</td>
                            <td>Sprained Ankale</td>
                            <td>Strong Pain killers</td>
                            <td>Reported by Dr. Smith and was adviced to bed rest.</td>
                        </tr>

                        <tr>
                            <td>08/11/2024</td>
                            <td>Sprained Ankale</td>
                            <td>Strong Pain killers</td>
                            <td>Reported by Dr. Smith and was adviced to bed rest.</td>
                        </tr>

                        <tr>
                            <td>08/11/2024</td>
                            <td>Sprained Ankale</td>
                            <td>Strong Pain killers</td>
                            <td>Reported by Dr. Smith and was adviced to bed rest.</td>
                        </tr>

                        <tr>
                            <td>08/11/2024</td>
                            <td>Sprained Ankale</td>
                            <td>Strong Pain killers</td>
                            <td>Reported by Dr. Smith and was adviced to bed rest.</td>
                        </tr>

                    </tbody>
                </table>
    
            </div>
        </div>
    
    </div>

    <?php include './../footer.php'?>
    
    <script src="/TrackMaster/Public/js/Student/medical_status.js"></script>

</body>
</html>
