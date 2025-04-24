<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard | TrackMaster</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/school/school.css">
<body>
    <?php require 'navbar.php'; ?>
    <?php require 'sidebar.php'; ?>
        
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1><i class="fas fa-tachometer-alt"></i> School Dashboard</h1>
            <p><i class="fas fa-user"></i> Welcome, Anthony!</p>
        </div>

        <div class="stats-cards">
            <div class="card">
                <i class="fas fa-calendar-day"></i>
                Upcoming Events<br>
                <strong>3</strong>
            </div>
            <div class="card">
                <i class="fas fa-clipboard-list"></i>
                Facility Requests<br>
                <strong>3</strong>
            </div>
            <div class="card">
                <i class="fas fa-chalkboard-teacher"></i>
                Session Going on<br>
                <strong>2</strong>
            </div>
            <div class="card">
                <i class="fas fa-book-open"></i>
                Extra Classes Requests<br>
                <strong>2</strong>
            </div>
        </div>

        <div class="main-content">
            <div class="section recent-clients">
                <h2><i class="fas fa-user-graduate"></i> Student-list</h2>
                <ul>
                    <li>Morty Smith</li>
                    <li>Rick Sanchez</li>
                    <li>Paul Hewmatt</li>
                    <li>Sheen Estevez</li>
                    <li>John Does</li>
                </ul>
            </div>

            <div class="section activity-log">
                <h2><i class="far fa-calendar-alt"></i> Calendar</h2>
                <div id="calendar">
                    <div id="header">
                        <button id="prevMonth"><i class="fas fa-chevron-left"></i></button>
                        <span id="monthYear"></span>
                        <button id="nextMonth"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    <div id="days">
                        <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                    </div>
                    <div id="dates"></div>
                </div>
            
                <div id="noteModal" class="modal hidden">
                    <div class="modal-content">
                        <h3 id="noteTitle"><i class="fas fa-edit"></i> Add Note</h3>
                        <textarea id="noteInput" placeholder="Write your note here..."></textarea>
                        <button id="saveNote"><i class="fas fa-save"></i> Save Note</button>
                        <button id="closeModal"><i class="fas fa-times"></i> Close</button>
                    </div>
                </div>
            </div>

          


            <div class="section quick-session">
                <h2 onclick="window.location.href='/TrackMaster/App/views/Event/event.php'" style="cursor: pointer;">
                    <i class="fas fa-building"></i> Facility Requests
                </h2>
                <ul>
                    <li>02/28 Ground <span><i class="fas fa-baseball-ball"></i> Cricket</span></li>
                    <li>03/01 Indoor <span><i class="fas fa-volleyball-ball"></i> Volleyball</span></li>
                    <li>03/01 Indoor <span><i class="fas fa-table-tennis"></i> Table Tennis</span></li>
                </ul>
            </div>

            <div class="section upcoming-appointments">
    <h2><i class="fas fa-clock"></i> Extra Class Requests</h2>
    <div class="appointment">
        <div class="request-item">
            <span><i class="fas fa-graduation-cap"></i> Grade 10</span> Kamal Perera
        </div>
        <div class="request-item">
            <span><i class="fas fa-graduation-cap"></i> Grade 11</span> Hashan Jayamal
        </div>
    </div>
    <center>
        <button class="profile-button" onclick="window.location.href='<?php echo URLROOT ?>/school/scheduleEx'">
            <i class="fas fa-plus-circle"></i> Schedule Extra Class
        </button>
    </center>
</div>
<div class="section activity-log">
    <h2><i class="fas fa-chart-bar"></i> Study performance</h2>
    <ul>
        <?php foreach ($performance as $student): ?>
            <li>
                <?= htmlspecialchars($student['name']) ?>
                <span><i class="fas fa-percentage"></i> Average - <?= htmlspecialchars($student['average']) ?>%</span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="section upcoming-appointments">
    <h2><i class="fas fa-calendar-check"></i> Upcoming Sessions</h2>
    <div class="appointment">
        <?php foreach ($sessions as $session): ?>
            <span><i class="far fa-calendar"></i> <?= date('M d', strtotime($session['session_date'])) ?></span>
            <?= htmlspecialchars($session['session_name']) ?><br>
        <?php endforeach; ?>
    </div>
</div>

    </div>

    <script src="/TrackMaster/Public/js/School/cal.js"></script>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>