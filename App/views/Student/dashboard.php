<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/Dashboard_Stu.css">
</head>

<body>
    <?php require 'navbar.php'?>
    <?php require 'sidebar.php'?> 
    
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Student Dashboard</h1>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></p>
        </div>

        <div class="main-content">
            <!-- Status Section -->
            <div class="dashboard-section">
                <p><i>Update Your Status...</i></p>
                <div class="radio-group">
                    <input class="radio-input" name="radio-group" id="radio1" type="radio">
                    <label class="radio-label" for="radio1">
                    <span class="radio-inner-circle"></span>
                    Practicing
                    </label>
                    
                    <input class="radio-input" name="radio-group" id="radio2" type="radio">
                    <label class="radio-label" for="radio2">
                    <span class="radio-inner-circle"></span>
                    In a Meet
                    </label>
                    
                    <input class="radio-input" name="radio-group" id="radio3" type="radio">
                    <label class="radio-label" for="radio3">
                    <span class="radio-inner-circle"></span>
                    At Rest
                    </label>

                    <input class="radio-input" name="radio-group" id="radio4" type="radio">
                    <label class="radio-label" for="radio4">
                    <span class="radio-inner-circle"></span>
                    Injured
                    </label>
                </div>
            </div>

            <!-- Sports Section -->
            <div class="dashboard-section">
                <h2>Registered Sports</h2>
                <div class="section-content">
                        <div class="sports">
                            <h3>Cricket</h3>
                            <button class="btn" onclick="window.location.href='<?php echo ROOT ?>/Student/coachProfile'">View My Coach</button>
                            <button class="btn" onclick="window.location.href='<?php echo ROOT ?>/Student/PlayerPerformance'">Track My Performance</button>
                        </div>
                        <div class="sports">
                            <h3>Athletics</h3>
                            <button class="btn" onclick="window.location.href='<?php echo ROOT ?>/Student/coachProfile'">View My Coach</button>
                            <button class="btn" onclick="window.location.href='<?php echo ROOT ?>/Student/PlayerPerformance'">Track My Performance</button>
                        </div>
                </div>
            </div>

            <!-- Achievement Section -->
            <div class="dashboard-section">
                <div class="container">
                <svg class="svg-icon" height="100" preserveAspectRatio="xMidYMid meet" viewBox="0 0 100 100" width="100" x="0" xmlns="http://www.w3.org/2000/svg" y="0">
                    <path d="M62.11,53.93c22.582-3.125,22.304-23.471,18.152-29.929-4.166-6.444-10.36-2.153-10.36-2.153v-4.166H30.099v4.166s-6.194-4.291-10.36,2.153c-4.152,6.458-4.43,26.804,18.152,29.929l5.236,7.777v8.249s-.944,4.597-4.833,4.986c-3.903,.389-7.791,4.028-7.791,7.374h38.997c0-3.347-3.889-6.986-7.791-7.374-3.889-.389-4.833-4.986-4.833-4.986v-8.249l5.236-7.777Zm7.388-24.818s2.833-3.097,5.111-1.347c2.292,1.75,2.292,15.86-8.999,18.138l3.889-16.791Zm-44.108-1.347c2.278-1.75,5.111,1.347,5.111,1.347l3.889,16.791c-11.291-2.278-11.291-16.388-8.999-18.138Z">
                    </path>
                </svg>  
                <div class="container__star">
                    
                    <div class="star-eight"></div>
                </div>
  
            <div></div>
            </div>
            <div class="action-buttons">
                    <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentAchievements'">View My Achievements</button>
            </div>
            </div>

            <!-- Medical Section -->
            <div class="dashboard-section">
                <h2>Current Medical Status</h2>
                <div class="section-content">
                            <h3>Medical Conditions:</h3>
                            <p>None</p>
                            <h3>Medications:</h3>
                            <p>None</p>
                            <br>
                        <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/medicalStatus'">Update Medical Status</button>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="dashboard-section">
                <div class="calendar-container">
                    <div id="calendar">
                        <div id="header">
                            <button id="prevMonth">&lt;</button>
                            <span id="monthYear"></span>
                            <button id="nextMonth">&gt;</button>
                        </div>
                        <div id="days">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div id="dates"></div>
                    </div>

                    <div id="noteModal" class="modal hidden">
                        <div class="modal-content">
                            <h3 id="noteTitle">Add Note</h3>
                            <textarea id="noteInput" placeholder="Write your note here..."></textarea>
                            <div class="modal-actions">
                                <button class="btn" id="saveNote">Save Note</button>
                                <button class="btn btn-secondary" id="closeModal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <center><p>You can Add notes to your Calender by clicking on the Date</p></center>
            </div>

            <!-- Financial Section -->
            <div class="dashboard-section">
                <h2>Financial Status</h2>
                <div class="section-content">
                            <h3>Financial Aid Status:</h3>
                            <p>Receive Funds</p>
                            <br>
                            <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/financialStatus'">Update Financial Status</button> 
                </div>
            </div>
        </div>

    </div>

    <?php require 'footer.php'?>

    <script src="/TrackMaster/Public/js/Student/carousel.js"></script>
    <script src="/TrackMaster/Public/js/Student/calender.js"></script>
</body>
</html>