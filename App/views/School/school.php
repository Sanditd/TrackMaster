<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/School/school.css">

</head>
<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>
        
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>School Dashboard</h1><br>
            <p>Welcome, Anthony!</p>
        </div>

        <div class="stats-cards">
             <div class="card">Upcoming Events<br><strong>3</strong></div>
            <div class="card">Facility Requests<br><strong>3</strong></div>
            <div class="card">Session Going on<br><strong>2</strong></div>
            <div class="card">Extra Classes Requests <br><strong>2</strong></div>
        </div>

        <div class="main-content">
            <div class="section recent-clients">
                <h2> Student-list</h2>
                <ul>
                    <li>Morty Smith </li>
                    <li>Rick Sanchez </li>
                    <li>Paul Hewmatt </li>
                    <li>Sheen Estevez </li>
                    <li>John Does </li>
                </ul>
            </div>

            <div class="section activity-log">
                <h2>Calander</h2>
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
                    <div id="dates"></div>
                </div>
            
                <div id="noteModal" class="modal hidden">
                    <div class="modal-content">
                        <h3 id="noteTitle">Add Note</h3>
                        <textarea id="noteInput" placeholder="Write your note here..."></textarea>
                        <button id="saveNote">Save Note</button>
                        <button id="closeModal">Close</button>
                    </div>
                </div>

            </div></center>

            <div class="section quick-session">
                <h2 onclick="window.location.href='/TrackMaster/App/views/Event/event.php'" style="cursor: pointer; "> Facility Requests </h2>
                <ul>
                    <li>02/28 Ground <span> Cricket</span> </li>
                    <li>03/01 Indoor <span>Volleyball</span></li>
                    <li>03/01 Indoor <span>Table Tennis </span></li>
                
                </ul>
            </div>

            <div class="section upcoming-appointments">
                <h2>Extra Class Requestss</h2>
                <div class="appointment">
                <span>Grade 10 </span> Kamal Perera <br>
                <span>Grade 11 </span> Hashan Jayamal 24<br>
                               </div>
            </div>

           <div class="section activity-log">
                <h2>Study performance</h2>
                <ul>
                 
                    <li>Hashan<span>Average -  25%</span></li>
                    <li>Dimuth  <span>Average - 30%</span></li>
                </ul>
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

    <script src="/TrackMaster/Public/js/School/cal.js"></script>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>