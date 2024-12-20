<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/School/schoolStudentData.css">

</head>
<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>
        
    <div class="dashboard-container">
        <div class="dashboard-header">
          <center>  <h1>Student Records</h1><br> </center>
        </div>

    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Grade</th>
                <th>Sport</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Eraji Thenuwara</td>
                <td>11-A</td>
                <td>Cricket</td>
                <td>
                    <button class="view-more-btn" onclick="window.location.href='<?php echo URLROOT ?>/School/viewStudent'">View Profile</button>
                    <button>View Attendance</button>
                    <button class="view-more-btn"onclick="window.location.href='<?php echo URLROOT ?>/Student/PlayerPerformance'">View Performance</button>
               
                </td>
            </tr>
            <tr>
                <td>Hashini Chamlka</td>
                <td>11-B</td>
                <td>Cricket</td>
                <td>
                    <button>View Profile</button>
                    <button>View Attendance</button>
                    <button>View Performance</button>
                   
                </td>
            </tr>
            <tr>
                <td>Janith Induwara</td>
                <td>11-A</td>
                <td>Cricket</td>
                <td>
                    <button>View Profile</button>
                    <button>View Attendance</button>
                    <button>View Performance</button>
                
            </tr>
        </tbody>
</table>
    </div>
    <center><button class="view-more-btn">Add a New Student</button><center>
    <br>   
    
    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>
