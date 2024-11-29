<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete Schedule</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/schedule.css">
</head>

<body>
<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>

            <center><h1>Student Player Schedule</h1></center>

        <div class="main-content">

        <div class="section upcoming-appointments">
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
            
            <div class="section upcoming-appointments">
            <h2>Request Schedule Change</h2>
            <div class="form-container">
                        <form id="scheduleEditForm" class="schedule-form">
                            <label for="stu_name">Student Name:</label>
                            <input type="text" id="stu_name" required>

                            <label for="event_name">Event Name:</label>
                            <input type="text" id="event_name" required>

                            <label for="event_date">Event Date and Time:</label>
                            <input type="datetime-local" id="event_date" required>

                            <label for="event_location">Event Location:</label>
                            <input type="text" id="event_location" required>
                            
                            <label for="reschedule_reason">Reason for the Request:</label>
                            <textarea id="reschedule_reason" required></textarea>
                                
                            <button type="submit" class="view-more-btn">Submit Request</button>
                            <button type="submit" class="view-more-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentSchedule'">Cancel Request</button>
                        </form>
                    </div>
            </div>

            <div class="section upcoming-appointments">
            <h2>Request Extra Classes</h2>
            <div class="form-container">
                        <form id="scheduleExtraClassForm" class="schedule-form">
                            <label for="stu_name">Student Name:</label>
                            <input type="text" id="stu_name" required>

                            <label for="subject_name">  Subject Name:</label>
                            <input type="text" id="subject_name" required>

                            <label for="school_name">School:</label>
                            <input type="text" id="school_name" required>
                            
                            <label for="notes">Notes:</label>
                            <textarea id="notes" required></textarea>
                                
                            <button type="submit" class="view-more-btn">Submit Request</button>
                            <button type="submit" class="view-more-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentSchedule'">Cancel Request</button>
                        </form>
                    </div>
            </div>
            </div>

            <div class="section upcoming-appointments">
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
                 <button class="view-more-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentAttendance'"> View My Attendance</button>
            </div>
        
    </div>
</div>

<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'?>

    <script src="/TrackMaster/Public/js/Student/calender.js"></script>
</body>
</html>
