<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard | TrackMaster</title>
    <link rel="stylesheet" href="../Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base Styles */
        :root {
            --primary-color: #00264d;
            --secondary-color: #ffa500;
            --light-color: #f8f9fa;
            --dark-color: #333;
            --gray-color: #666;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 38, 77, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: var(--dark-color);
        }

        /* Dashboard Container */
        .dashboard-container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
            
        }

        /* Header Section */
        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            position: relative;
        }

        .dashboard-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .dashboard-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Stats Cards */
        .stats-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            border:black;
        }
        
        .card {
            flex: 1;
            background: #002C5F(--primary-color);
            color: black;
            padding: 20px;
            text-align: center;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            font-weight: bold;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card i {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .card strong {
            font-size: 2rem;
            display: block;
            margin-top: 5px;
        }

        /* Main Content Grid */
        .main-content {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        /* Sections */
        .section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
        }

        .section h2 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 5px;
            display: inline-block;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Icon base styling */
        .fas, .far {
            margin-right: 8px;
            width: 20px;
            text-align: center;
        }

        /* Student List */
        .recent-clients ul {
            list-style: none;
        }

        .recent-clients li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .recent-clients li:before {
            content: "\f007";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color:  #002C5F(--secondary-color);
            margin-right: 10px;
        }

        .recent-clients li:last-child {
            border-bottom: none;
        }

        /* Calendar */
        #calendar {
            background: white;
            border-radius: var(--border-radius);
            box-shadow:  #002C5F(--box-shadow);
            overflow: hidden;
            width: 100%;
        }

        #header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--primary-color);
            color: white;
            padding: 15px;
        }

        #header button {
            background: none;
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
        }

        #days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            background: var(--light-color);
            padding: 2px 0;
            text-align: center;
            font-weight: bold;
            color: var(--primary-color);
        }

        #dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
        }

        #dates div {
            padding: 10px;
            border: 1px solid #eee;
            cursor: pointer;
            transition: var(--transition);
        }

        #dates div:hover {
            background: rgba(0, 38, 77, 0.05);
        }

        #dates div.current {
            background: var(--secondary-color);
            color: white;
            font-weight: bold;
        }

        /* Facility Requests */
        .quick-session ul {
            list-style: none;
        }

        .quick-session li {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .quick-session li:before {
            content: "\f1ad";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color:  #002C5F(--secondary-color);
            margin-right: 10px;
        }

        .quick-session li span {
            background: var(--secondary-color);
            color: white;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        /* Extra Class Requests */
        .upcoming-appointments .appointment {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .upcoming-appointments .appointment span {
    font-weight: bold;
    color: var(--primary-color);
    display: inline-flex;
    align-items: center;
    gap: 5px;
}


        .profile-button {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            margin-top: 15px;
            cursor: pointer;
            font-weight: bold;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
        }

        .profile-button:hover {
            background: var(--primary-color);
        }

        /* Study Performance */
        .activity-log ul {
            list-style: none;
        }

        .activity-log li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .activity-log li:before {
            content: "\f19d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: dc3545(--secondary-color);
            margin-right: 10px;
        }

        .activity-log li span {
            color: var(--secondary-color);
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Upcoming Sessions */
        .upcoming-appointments .appointment span {
            display: inline-flex;
            width: 70px;
            align-items: center;
            gap: 5px;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .main-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-cards {
                flex-direction: column;
            }
            
            .dashboard-header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
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
                    <span><i class="fas fa-graduation-cap"></i> Grade 10</span> Kamal Perera<br>
                    <span><i class="fas fa-graduation-cap"></i> Grade 11</span> Hashan Jayamal
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
                    <li>Hashan<span><i class="fas fa-percentage"></i> Average - 25%</span></li>
                    <li>Dimuth<span><i class="fas fa-percentage"></i> Average - 30%</span></li>
                </ul>
            </div>

            <div class="section upcoming-appointments">
                <h2><i class="fas fa-calendar-check"></i> Upcoming Sessions</h2>
                <div class="appointment">
                    <span><i class="far fa-calendar"></i> Jan 31</span> Coaching Session 25<br>
                    <span><i class="far fa-calendar"></i> Feb 07</span> Coaching Session 24<br>
                </div>
            </div>
        </div>
    </div>

    <script src="/TrackMaster/Public/js/School/cal.js"></script>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>