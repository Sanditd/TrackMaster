<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/School/records.css">

</head>
<body>
<?php include 'navbar.php'?>
<?php include 'sidebar.php'?>
    
        
    <div class="dashboard-container">
        <div class="dashboard-header">
           <center> <h1>Acedemic records </h1> </center><br> 
        </div>
            <div class="records">
                <form class="formcontent" onsubmit="" >
                      <div class="points">
                    <ul>
                        <li>
                        <label for="name">Student Name:</label>
                        <input type="text" id="grade" value="Eraji Thenuwara" readonly>
                        </li>
                        <li>
                            <label for="grade">Grade:</label>
                            <input type="text" id="grade" value="11-B" readonly>
                        </li>
                        <li>
                            <label for="term">Term:</label>
                            <input type="text" id="term" value="3rd"readonly>
                        </li>
                        <li>
                            <label for="average">Average:</label>
                            <input type="number" id="average" value="50"readonly>
                        </li>
                        <li>
                            <label for="rank">Rank:</label>
                            <input type="number" id="rank" value="30"readonly>
                        </li>
                    </ul>
                   
                </form>
            </div>
</div>
</div>
<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>