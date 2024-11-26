<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Performance Table</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/School/schoolStudentlData.css">
</head>
<body>
<?php include './../navbar.php'?>
<?php include 'sidebar.php'?>

<div class="dashboard-container">
        <div class="dashboard-header">
           <center> <h1>Student data table </h1> </center><br> 

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
                <td>Basketball</td>
                <td>
                    <button>View Profile</button>
                    <button>View Attendance</button>
                    <button>View Performance</button>
                    <button>View Marks</button>
                </td>
            </tr>
            <tr>
                <td>Hashini Chamlka</td>
                <td>11-B</td>
                <td>Swimming</td>
                <td>
                    <button>View Profile</button>
                    <button>View Attendance</button>
                    <button>View Performance</button>
                    <button>View Marks</button>
                </td>
            </tr>
            <tr>
                <td>Janith Induwara</td>
                <td>11-A</td>
                <td>Soccer</td>
                <td>
                    <button>View Profile</button>
                    <button>View Attendance</button>
                    <button>View Performance</button>
                    <button>View Marks</button>
                </td>
            </tr>
        </tbody>
    </table>
    
    <?php include './../footer.php'?>
</body>
</html>
