<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard</title>
    <link rel="stylesheet" href="../../../Public/css/Parent/parent.css">
 
</head>
<body>
<?php include './../navbar.php'?>
<?php include 'sidebar.php'?>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Parent Dashboard</h1>
            <p>Welcome, Mr Thenuwara </p>
        </div>

        <div class="main-content">
            <div class="section recent-clients">
                   <h2>Player Profile</h2>
                <ul>
                   <div class="profile">
                    <li><strong>Name:</strong> Eraji Thenuwara</li>
                    <li><strong>Grade:</strong> 11</li>
                    <li><strong>School:</strong> Maliyadeva Collage, Kurunagala </li>
                    <li><strong>Sport:</strong> Cricket 
                </div>
              
                </ul>
            </div>

            <div class="section activity-log">
                <h2>Current Medical Status</h2>
                <ul>
                    <li><strong> Medical Conditions : </strong>None</li>
                    <li><strong> Medication : </strong>None</li>
                    <li><strong> Allergies : </strong>None</li>
                    <li><strong> Blood Type : </strong>A+</li>
                    <li><strong> Emergency Contact : </strong> 0712345678</li>
                   
                </ul>
                
            </div>



       <div class="section attended-appointments ">
 <h2>Recently Attended Sessions</h2>
                <div class="appointment">
                    <span>Nov 15 - 6.30 a.m.</span> Coaching Session 24<br>
                    <span>Nov 15 - 6.30 a.m.</span> Coaching Session 24<br>
                    <span>Nov 15 - 6.30 a.m.</span> Coaching Session 24<br>
                    <span>Nov 15 - 6.30 a.m.</span> Coaching Session 24<br>
                    <span>Nov 15 - 6.30 a.m.</span> Coaching Session 24<br>
                    <span>Nov 15 - 6.30 a.m.</span> Coaching Session 24<br>
                    <span>Nov 15 - 6.30 a.m.</span> Coaching Session 24<br>
                 </div>
                 <center><button class="edit-button">View Attendence</button></center>
            </div>


            <div class="section upcoming-appointments">
                <h2>Upcoming Sessions</h2>
                <div class="appointment">
                    <span>Nov 30 - 6.30 a.m.</span> Coaching Session 25<br>
                    <span>Nov 30 - 6.30 a.m.</span> Coaching Session 25<br>
                    <span>Nov 30 - 6.30 a.m.</span> Coaching Session 25<br>
                    <span>Nov 30 - 6.30 a.m.</span> Coaching Session 25<br>
                    <span>Nov 30 - 6.30 a.m.</span> Coaching Session 25<br>
                    <span>Nov 30 - 6.30 a.m.</span> Coaching Session 25<br>
                    <span>Nov 30 - 6.30 a.m.</span> Coaching Session 25<br>
                </div>
               
            </div>

            <div class="section coach-rating">
    <h2>Actions</h2>
    <center><div class="button-container">
    <div class="left-buttons">
    <button onclick="window.location.href='/TrackMaster/App/views/Parent/viewStudent.php';">View Student Profile</button>
    <button onclick="window.location.href='/TrackMaster/App/views/Parent/viewSchool.php';">View School Profile</button>
    <button onclick="window.location.href='/TrackMaster/App/views/Parent/viewCoach.php';">View Coach Profile</button>
</div>
<div class="right-buttons">
    <button onclick="window.location.href='/TrackMaster/App/views/Parent/studentAch.php';">View Student Achievements</button>
    <button onclick="window.location.href='/TrackMaster/App/views/Parent/studentRec.php';">View Student Records</button>
    <button onclick="window.location.href='/TrackMaster/App/views/Coach/PlayerPerformance.php';">View Student Performance</button>
        </div>
    </div></center>
</div>


<div class="section activity-log">
    <h2>Financial Status</h2>
    <ul>
        <li><strong> Financial Aid Status : </strong>Recieve Funds</li>
        <li><strong> Registration Number : </strong>24/M/90</li>
        <li><strong>Registration Date : </strong>2024-01-01</li>
       
    </ul>              
    
</div>

        </div>

        
    </div>
    </div>        
        

    </div>

  

    <?php include './../footer.php'?>
    
  

</body>