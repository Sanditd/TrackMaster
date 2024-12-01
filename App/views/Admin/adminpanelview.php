<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Admin/adminDashboard.css">
 
</head>

<body>
    <?php require_once 'adminNav.php'?>

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
                        <tr>
                            <th rowspan="2">Sport Name</th>
                            <th rowspan="2">Sport Type</th>
                            <th colspan="2">Total Users</th>
                        </tr>

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

<script src="/TrackMaster/Public/js/Student/calender.js"></script>

</body>

</html>