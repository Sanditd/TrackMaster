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

    <div class="intro">
        <center>
            <h1>Student Player Medical History</h1>
        </center>
    </div>   

    <div class="main-content">
        <div class="section upcoming-appointments">
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
            </div>
            <center><p>You can add notes to your Calendar by clicking on the date</p></center>
        </div> 

        <div class="section upcoming-appointments">
            <h2>Upcoming Sessions</h2>
            <div class="appointments-list">
                <div class="appointment-item">
                    <span class="appointment-date">Nov 30 - 6:30 a.m.</span> 
                    <span class="appointment-title">Coaching Session 25</span>
                </div>
                <div class="appointment-item">
                    <span class="appointment-date">Dec 3 - 7:00 a.m.</span> 
                    <span class="appointment-title">Coaching Session 26</span>
                </div>
                <div class="appointment-item">
                    <span class="appointment-date">Dec 7 - 6:30 a.m.</span> 
                    <span class="appointment-title">Coaching Session 27</span>
                </div>
                <div class="appointment-item">
                    <span class="appointment-date">Dec 10 - 7:00 a.m.</span> 
                    <span class="appointment-title">Coaching Session 28</span>
                </div>
                <div class="appointment-item">
                    <span class="appointment-date">Dec 14 - 6:30 a.m.</span> 
                    <span class="appointment-title">Coaching Session 29</span>
                </div>
            </div>
            <button class="view-more-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentAttendance'">View My Attendance</button>
        </div>  

        <div class="section upcoming-appointments">
            <h2>Request Schedule Change</h2>
            <div class="form-header">
                    <p>Fill out the form below to request changes to your training schedule</p>
                </div>
            <div class="form-container">
                <form id="scheduleEditForm" class="schedule-form">
                    <div class="form-group">
                        <label for="stu_name" class="required-field">Student Name:</label>
                        <input type="text" id="stu_name" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="event_name" class="required-field">Event Name:</label>
                        <input type="text" id="event_name" placeholder="e.g. Track Practice, Competition" required>
                    </div>

                    <div class="form-group">
                        <label for="event_date" class="required-field">Event Date and Time:</label>
                        <input type="datetime-local" id="event_date" required>
                    </div>

                    <div class="form-group">
                        <label for="event_location" class="required-field">Event Location:</label>
                        <input type="text" id="event_location" placeholder="Enter location details" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="reschedule_reason" class="required-field">Reason for the Request:</label>
                        <textarea id="reschedule_reason" placeholder="Please explain why you need to reschedule..." required></textarea>
                    </div>
                        
                    <div class="form-buttons">
                        <button type="submit" class="view-more-btn">Submit Request</button>
                        <button type="button" class="cancel-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentSchedule'">Cancel</button>
                    </div>
                </form>
                <div class="form-footer">
                    <p>All schedule change requests are subject to coach approval</p>
                </div>
            </div>
        </div>

        <div class="section upcoming-appointments">
            <h2>Request Extra Classes</h2>
            <div class="form-header">
                    <p>Need additional training or academic support? Request extra classes here</p>
            </div>
            <div class="form-container">
                
                <form id="scheduleExtraClassForm" class="schedule-form">
                    <div class="form-group">
                        <label for="extra_stu_name" class="required-field">Student Name:</label>
                        <input type="text" id="extra_stu_name" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="subject_name" class="required-field">Subject Name:</label>
                        <input type="text" id="subject_name" placeholder="e.g. Sprint Training, Mathematics" required>
                    </div>

                    <div class="form-group">
                        <label for="school_name" class="required-field">School:</label>
                        <input type="text" id="school_name" placeholder="Enter your school name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="notes" class="required-field">Notes:</label>
                        <textarea id="notes" placeholder="Provide details about what you need help with..." required></textarea>
                    </div>
                        
                    <div class="form-buttons">
                        <button type="submit" class="view-more-btn">Submit Request</button>
                        <button type="button" class="cancel-btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentSchedule'">Cancel</button>
                    </div>
                </form>
                <div class="form-footer">
                    <p>The School will review your request and respond within 48 hours</p>
                </div>
            </div>
        </div>
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

<?php require 'footer.php'; ?>

<script src="/TrackMaster/Public/js/Student/calender.js"></script>
</body>
</html>