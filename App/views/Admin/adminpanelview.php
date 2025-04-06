<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="../../Public/css/Admin/form.css">
    <link rel="stylesheet" href="../../Public/css/Admin/dashboard.css">
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="../../../Public/css/Admin/userManage.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>

    <!-- FullCalendar CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

    <link rel="stylesheet" href="/TrackMaster/Public/css/Admin/adminDashboard.css">
 

</head>

<body>
    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="main-content">

            <div class="section upcoming-appointments">
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

<<<<<<< HEAD
            <div class="user">
                <div id="topic">
                    User Engagement
                </div>

                <div>
                    <table class="ue">
                        <tr>
                            <th rowspan="2">Period</th>
                            <th colspan="4">New Users</th>
                            <th rowspan="2">Account Deletions</th>
                        </tr>

                        <tr>
                            <td>Coaches</td>
                            <td>Players</td>
                            <td>School</td>
                            <td>Parents</td>
                        </tr>

                        <tr>
                            <td><?= htmlspecialchars($data['signups']['month']) ?></td>
                            <td><?= htmlspecialchars($data['signups']['coaches']) ?></td>
                            <td><?= htmlspecialchars($data['signups']['players']) ?></td>
                            <td><?= htmlspecialchars($data['signups']['schools']) ?></td>
                            <td><?= htmlspecialchars($data['signups']['parents']) ?></td>
                            <td><?= htmlspecialchars($data['signups']['deletions']) ?></td>
                        </tr>

                    </table>
                </div>
            </div>

            <div class="alert">
                <div id="topic">
                    System Alert
=======
            <div id="noteModal" class="modal hidden">
                <div class="modal-content">
                    <h3 id="noteTitle">Add Note</h3>
                    <textarea id="noteInput" placeholder="Write your note here..."></textarea>
                    <button class="view-more-btn" id="saveNote">Save Note</button>
                    <button class="view-more-btn" id="closeModal">Close</button>
>>>>>>> origin/main
                </div>
            </div>
            </center>
            </div>

<<<<<<< HEAD

            <div class="req">
                <div id="topic">
                    Account Deletion Request
                </div>

                <table class="tg">
                    <thead>
=======
            <div class="section upcoming-appointments">
                <h2>System Alerts</h2>
                <ul>
                    <li><strong> Account Deletion Requests : </strong>4</li>
                    <li><strong> Report Generation Requests : </strong>6</li>
                    <li><strong> Help Requests : </strong>8</li>
                    <li><strong> Suspicious Activities : </strong>3</li>
                    <li><strong> System Maintanance Alerts : </strong> 0</li>
                    <li><strong> Fund Request Applications : </strong> 2</li>
                    <center><button class="view-more-btn">View All</button></center>
                </ul>
            </div>

            <div class="section upcoming-appointments">
                <h2>User Engagement</h2>
                <table class="ue">
                        <tr>
                            <th rowspan="2">Period</th>
                            <th colspan="4">New Users</th>
                            <th colspan="4">Total Users</th>
                        </tr>

                        <tr>
                            <td>Coaches</td>
                            <td>Players</td>
                            <td>School</td>
                            <td>Parents</td>
                            <td>Coaches</td>
                            <td>Players</td>
                            <td>School</td>
                            <td>Parents</td>
                        </tr>

                        <tr>
                            <td>June 2024</td>
                            <td>2</td>
                            <td>26</td>
                            <td>1</td>
                            <td>26</td>
                            <td>4</td>
                            <td>39</td>
                            <td>6</td>
                            <td>30</td>
                        </tr>

                        <tr>
                            <td>July 2024</td>
                            <td>2</td>
                            <td>26</td>
                            <td>1</td>
                            <td>26</td>
                            <td>4</td>
                            <td>39</td>
                            <td>6</td>
                            <td>30</td>
                        </tr>

                    </table>
            </div>
  
            <div class="section upcoming-appointments">
                <h2>Sport Management</h2>
                <table class="ue">
>>>>>>> origin/main
                        <tr>
                            <th rowspan="2">Sport Name</th>
                            <th rowspan="2">Sport Type</th>
                            <th colspan="2">Total Users</th>
                        </tr>
<<<<<<< HEAD
                    </thead>
                </table>
            </div>


            <div class="reminders">
                <div id="topic">Reminders</div>
            </div>

            <div class="calender">
                <div id="topic">Calendar</div>
                <div id="calendar"></div> <!-- Calendar will be rendered here -->
            </div>

            <div class="sports">
                <div id="topic">
                    Sport Engagement
                </div>
            </div>

            <div class="notification">
                <div id="topic">
                    Notifications
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Show month view
            events: [
                // Example events
                {
                    title: 'Meeting with Coach',
                    start: '2024-12-25T10:00:00',
                    end: '2024-12-25T12:00:00'
                },
                {
                    title: 'Training Session',
                    start: '2024-12-27T15:00:00',
                    end: '2024-12-27T16:30:00'
                }
            ],
            eventRender: function(info) {
                // Only show the date without event details inside the cell
                info.el.innerHTML = info.event.start.getDate(); // Display only the date in each cell
            },
            eventColor: '#FF5733', // Event color (for events with specific color)
            eventClassNames: ['event'],
            dayCellDidMount: function(info) {
                // Check if there's an event for this date
                var date = info.dateStr;
                var eventsOnThisDay = calendar.getEvents().filter(function(event) {
                    return event.startStr.split('T')[0] === date; // Compare the date part
                });

                if (eventsOnThisDay.length > 0) {
                    // Color the day if there's an event
                    info.el.style.backgroundColor = '#FFEB3B'; // Highlight color
                } else {
                    info.el.style.backgroundColor = ''; // No event, default background
                }
            },
            dateClick: function(info) {
                // Show event details when clicking on a date
                var clickedDate = info.dateStr;
                var eventsOnThisDay = calendar.getEvents().filter(function(event) {
                    return event.startStr.split('T')[0] === clickedDate;
                });

                if (eventsOnThisDay.length > 0) {
                    var eventDetails = eventsOnThisDay.map(function(event) {
                        return '<p>' + event.title + ' (' + event.start.toLocaleString() + ')</p>';
                    }).join('');
                    alert('Events on this date:\n\n' + eventDetails);
                } else {
                    alert('No events on this date.');
                }
            }
        });

        calendar.render();
    });
</script>
=======

                        <tr>
                            <td>Coaches</td>
                            <td>Players</td>
                        </tr>

                        <tr>
                            <td>Cricket</td>
                            <td>Team</td>
                            <td>3</td>
                            <td>40</td>
                        </tr>

                        <tr>
                            <td>Chess</td>
                            <td>Individual</td>
                            <td>2</td>
                            <td>24</td>
                        </tr>

                    </table>              
            </div>

        </div>
    </div>
</div>
>>>>>>> origin/main

<script src="/TrackMaster/Public/js/Student/calender.js"></script>

</body>
</html>
