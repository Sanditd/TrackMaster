<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Page</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Helpp.css">
</head>
<body>

<?php require 'C:/xampp/htdocs/TrackMaster/App/views/Student/navbar.php'?>
<?php require 'C:/xampp/htdocs/TrackMaster/App/views/Student/sidebar.php'?>

    <div id="main">
            <center>
            <h1>HELP for a Better Experience at Our Website</h1>
            </center>

        <section class="tabs">
        <p>Select Your Role :</p>
            <div class="tab-links">
                <button class="active" onclick="showTab('students')">Student</button>
                <button onclick="showTab('coaches')">Coach</button>
                <button onclick="showTab('parents')">Parent</button>
                <button onclick="showTab('schools')">School</button>
            </div>
        </section>

        <section id="students" class="topics">
            <h2>Frequently Asked Topics for Students</h2>
            <div class="topic-grid">
                <div class="topic">
                    <img src="../../Public/img/help/user.png" alt="User Management">
                    <p>User Management</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/track.jpeg" alt="Tracking History">
                    <p>Tracking History</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/ball1.jpeg" alt="Goal Setting">
                    <p>Goal Setting</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/activity1.png" alt="Activity Reports">
                    <p>Activity Reports</p>
                </div>
            </div>
        </section>

        <section id="coaches" class="topics" style="display: none;">
            <h2>Frequently Asked Topics for Coaches</h2>
            <div class="topic-grid">
                <div class="topic">
                    <img src="../../Public/img/help/team.png" alt="Team Management">
                    <p>Team Management</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/performance.png" alt="Performance Analysis">
                    <p>Performance Analysis</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/training.jpeg" alt="Training Programs">
                    <p>Training Programs</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/commu.png" alt="Communication with Students">
                    <p>Communication with Students</p>
                </div>
            </div>
        </section>

        <section id="parents" class="topics" style="display: none;">
            <h2>Frequently Asked Topics for Parents</h2>
            <div class="topic-grid">
                <div class="topic">
                    <img src="../../Public/img/help/progress.png" alt="Student Progress">
                    <p>Track Student Progress</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/notification.png" alt="Notifications">
                    <p>Activity Notifications</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/coach.jpg" alt="Communication">
                    <p>Communication with Coaches</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/payment.png" alt="Payments">
                    <p>Manage Payments</p>
                </div>
            </div>
        </section>

        <section id="schools" class="topics" style="display: none;">
            <h2>Frequently Asked Topics for Schools</h2>
            <div class="topic-grid">
                <div class="topic">
                    <img src="../../Public/img/help/report.jpg" alt="Reports">
                    <p>Generate Reports</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/school.jpeg" alt="School Programs">
                    <p>Manage School Programs</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/coordinate.png" alt="Coaches">
                    <p>Coordinate with Coaches</p>
                </div>
                <div class="topic">
                    <img src="../../Public/img/help/account.png" alt="Manage Accounts">
                    <p>Manage Accounts</p>
                </div>
            </div>
        </section>

        <div class="container">
        <section class="form-section">
                <h2>ADDITIONAL HELP</h2>
            <form id="helpContactForm" class="helpContactForm">

            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="role">Your Role</label>
            <select id="role" name="role">
                    <option value="student">Student</option>
                    <option value="coach">Coach</option>
                    <option value="parent">Parent</option>
                    <option value="school">School</option>
            </select>

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="description">Why do you need our help ?</label>
            <textarea id="description" name="description" rows="4" placeholder="Describe the issue in detail..."></textarea>

            <h3>We'll get back to you as soon as possible.</h3>
            <center><button type="submit">Submit</button></center>

            </form>           
        </section>
        </div>

        <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'?>

    <script>
        function showTab(tabId) {
            // Hide all sections
            document.getElementById('students').style.display = 'none';
            document.getElementById('coaches').style.display = 'none';
            document.getElementById('parents').style.display = 'none';
            document.getElementById('schools').style.display = 'none';
            
            // Show the selected section
            document.getElementById(tabId).style.display = 'block';

            // Remove active class from all buttons
            let buttons = document.querySelectorAll('.tab-links button');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Add active class to the clicked button
            event.target.classList.add('active');
        }
    </script>
</body>
</html>