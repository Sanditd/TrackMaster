<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Public/css/Student/Dashboard_Stu.css">
</head>
<body>

    <?php require 'navbar.php'?>
    <?php require 'sidebar.php'?>
    <?php 
    
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}?>
    
   <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Student Dashboard</h1>
            <p>Welcome, Eraji!</p>
        </div>

        <div class="main-content">

            <div class="section upcoming-appointments">
                <h2>Upcoming Sessions</h2>
                <center>
                <div id="calendar">
                    <div id="header">
                        <button id="prevMonth">&lt;</button>
                        <span id="monthYear"></span>
                        <button id="nextMonth">&gt;</button>
                    </div>
                <div id="days">
                    <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                </div>
                <div id="dates"> </div>
            </div>

            <div id="noteModal" class="modal hidden">
                <div class="modal-content">
                    <h3 id="noteTitle">Add Note</h3>
                    <textarea id="noteInput" placeholder="Write your note here..."></textarea>
                    <button class="view-more-btn" id="saveNote">Save Note</button>
                    <button class="view-more-btn" id="closeModal">Close</button>
                </div>
            </div>
            </center>
            </div>

            <div class="section upcoming-appointments">
                <h2>Registered Sports</h2>
                <ul>
                    <li>Cricket</li>
                    <button class="view-more-btn" onclick="window.location.href='<?php echo ROOT ?>/Student/coachProfile'">View My Coach</button>
                    <button class="view-more-btn" onclick="window.location.href='<?php echo ROOT ?>/Student/PlayerPerformance'">Track My Performance</button>
                </ul>
            </div>

            <div class="section upcoming-appointments">
                <h2>Current Medical Status</h2>
                <ul>
                    <li><strong> Medical Conditions : </strong>None</li>
                    <li><strong> Medication : </strong>None</li>
                    <li><strong> Allergies : </strong>None</li>
                    <li><strong> Blood Type : </strong>A+</li>
                    <li><strong> Emergency Contact : </strong> 0712345678</li>
                    <center><button class="view-more-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/medicalStatus'">Update Medical History</button></center>
                </ul>
            </div>
            
            <div class="section upcoming-appointments">
                <h2>Financial Status</h2>
                <ul>
                    <li><strong> Financial Aid Status : </strong>Recieve Funds</li>
                    <li><strong> Registration Number : </strong>24/M/90</li>
                    <li><strong>Registration Date : </strong>2024-01-01</li>
                    <center><button class="view-more-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/financialStatus'">Update Financial Status</button></center>
                </ul>              
            </div>
            
        </div>

        <h2>Achievements</h2>
        <div class="dashboard-section achievements">
            <div class="carousel">
                <div class="carousel-inner" id="carouselAchievementsDashboard">
          
                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                </div>
                <button class="carousel-control prev" onclick="prevSlide()">❮</button>
                <button class="carousel-control next" onclick="nextSlide()">❯</button>
                <button class="view-more-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentAchievements'">View All Achievements</button>
            </div>
        </div>
        
    </div>
</div>

    <?php require 'footer.php'?>
    
    <script src="/TrackMaster/Public/js/Student/carousel.js"></script>
    <script src="/TrackMaster/Public/js/Student/calender.js"></script>



</body>
