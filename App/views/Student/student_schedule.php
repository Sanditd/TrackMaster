<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete Schedule</title>
    <link rel="stylesheet" href="/Public/css/Student/schedule.css">
</head>

<body>
    
        <!-- Main Content -->
        <div id="main">

            <div class="main-content">
                <div class="title">
                    <h2>STUDENT PLAYER SCHEDULE</h2>
                    <hr>
                </div>
    
                <div class="schedule-container">

                    <div class="schedule-section">
                        <div class="schedule_table">
                            <table id="schedule-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Event</th>
                                        <th>Time</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody id="schedule-body">
                                    <!-- Schedule rows will be populated here via JavaScript -->
                                </tbody>
                            </table>
                        </div>
                        <center><button class="view-more-btn"onclick="window.location.href='/App/views/attendance.html'">View My Attendance</button></center>
                    </div>
        
                    <div>
                        <div class="schedule-section calender">
                                        <div class="calendar-header">
                                            <button>&lt;</button>
                                            <span>August 2024</span>
                                            <button>&gt;</button>
                                        </div>
                                        <div class="calendar-grid">
                                            <div class="day">Sun</div>
                                            <div class="day">Mon</div>
                                            <div class="day">Tue</div>
                                            <div class="day">Wed</div>
                                            <div class="day">Thu</div>
                                            <div class="day">Fri</div>
                                            <div class="day">Sat</div>
                                            <!-- Days of the month -->
                                            <div class="date">1</div>
                                            <div class="date">2</div>
                                            <div class="date">3</div>
                                            <div class="date">4</div>
                                            <div class="date">5</div>
                                            <div class="date">6</div>
                                            <div class="date">7</div>
                                            <!-- More dates... -->
                                        </div>
                                
                        </div>
        
                        <div class="schedule-section notifications">
                            <center><h2>NOTIFICATIONS</h2></center>
                            <div class="notification">
                                <div class="notification-message">
                                    <section class="sender">
                                        <p>From System Admin ,</p>
                                    </section>
                                    <section class="message">
                                        <p>Your profile has been updated.</p>
                                    </section>
                                    <section class="notify-date">
                                        <p>2024/09/14 - 10:00 AM</p>
                                    </section>
                                </div>
        
                                <div class="notification-message">
                                    <section class="sender">
                                        <p>From Coach Mr.Perera ,</p>
                                    </section>
                                    <section class="message">
                                        <p>Your Performance was outstanding. Keep up the Good Game!!!!</p>
                                    </section>
                                    <section class="notify-date">
                                        <p>2024/09/15 - 08:00 AM</p>
                                    </section>
                                </div>
                            </div>
                            <center><button class="view-more-btn"onclick="window.location.href='/App/view/html/.html'">View All</button></center>
                        </div>
                    </div>
    
                </div>

                <div class="forms">
                    <div class="form-container">
                        <form id="scheduleEditForm" class="schedule-form">
                            <h3>REQUEST SCHEDULE CHANGE</h3>
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
                                
                            <button type="submit">Submit Request</button>
                        </form>
                    </div>

                    <div class="form-container">
                        <form id="scheduleExtraClassForm" class="schedule-form">
                            <h3>REQUEST EXTRA CLASSES</h3>
                            <label for="stu_name">Student Name:</label>
                            <input type="text" id="stu_name" required>

                            <label for="subject_name">  Subject Name:</label>
                            <input type="text" id="subject_name" required>

                            <label for="school_name">School:</label>
                            <input type="text" id="school_name" required>
                            
                            <label for="notes">Notes:</label>
                            <textarea id="notes" required></textarea>
                                
                            <button type="submit">Submit Request</button>
                        </form>
                    </div>
                </div>

            </div>


    <script src="/Public/js/Student/calender.js"></script>
    <script src="/Public/js/Student/schedule.js"></script>
</body>
</html>
