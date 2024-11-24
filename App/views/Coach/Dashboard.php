<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Public/css/Coach/dashboard.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Coach Dashboard</h1>
            <p>Welcome, Anthony!</p>
        </div>

        <div class="stats-cards">
            <div class="card">Students<br><strong>25</strong></div>
            <div class="card">Completed Sessions<br><strong>25</strong></div>
            <div class="card">Total Session Per Year<br><strong>48</strong></div>
            <div class="card">Current Salary<br><strong>$650.00</strong></div>
        </div>

        <div class="main-content">
            <div class="section recent-clients">
                <h2>Top 5 Players Of The Week</h2>
                <ul>
                    <li>Morty Smith </li>
                    <li>Rick Sanchez </li>
                    <li>Paul Hewmatt </li>
                    <li>Sheen Estevez </li>
                    <li>John Does </li>
                </ul>
            </div>

            <div class="section activity-log">
                <h2>Activity Log</h2>
                <ul>
                    <li>Team Updated<span>9 minutes ago</span></li>
                    <li>Event Created <span>2 hours ago</span></li>
                    <li>View Performancce - Smith <span>1 day ago</span></li>
                </ul>
            </div>

            <div class="section quick-session">
                <h2>Current Team</h2>
                <ul>
                    <li>Morty Smith <span>Batsman</span></li>
                    <li>Rick Sanchez <span>Batsman(wk)</span></li>
                    <li>Paul Hewmatt <span>Batsman</span></li>
                    <li>Sheen Estevez <span>Batsman</span></li>
                    <li>John Does <span>Batsman</span></li>
                    <li>Morty Smith <span>All-Rounder</span></li>
                    <li>Rick Sanchez <span>All-Rounder</span></li>
                    <li>Paul Hewmatt <span>All-Rounder</span></li>
                    <li>Sheen Estevez <span>Bowler</span></li>
                    <li>John Does <span>Bowler</span></li>
                    <li>John Does <span>Bowler</span></li>
                </ul>
            </div>

            <div class="section upcoming-appointments">
                <h2>Recently Attended Sessions</h2>
                <div class="appointment">
                <span>Jan 31</span> Coaching Session 25<br>
                <span>Feb 07</span> Coaching Session 24<br>
                <span>Feb 07</span> Coaching Session 24<br>
                <span>Feb 07</span> Coaching Session 24<br>
                <span>Feb 07</span> Coaching Session 24<br>
                <span>Feb 07</span> Coaching Session 24<br>
                <span>Feb 07</span> Coaching Session 24<br>
                <span>Feb 07</span> Coaching Session 24<br>
                </div>
            </div>

            <div class="section coach-rating">
                <h2>Coach Rating</h2>
                <p>⭐ 3.15</p>
            </div>

            <div class="section upcoming-appointments">
                <h2>Upcoming Sessions</h2>
                <div class="appointment">
                    <span>Jan 31</span> Coaching Session 25<br>
                    <span>Feb 07</span> Coaching Session 24<br>
                </div>
            </div>

        </div>
    </div>


    <script src="../Public/js/Student/carousel.js"></script>
    <script src="../Public/js/Student/profile.js"></script>
    <script src="../Public/js/sidebar.js"></script>
    <script src="../Public/js/Student/calender.js"></script>

</body>