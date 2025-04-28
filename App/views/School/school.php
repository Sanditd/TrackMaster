
<?php
//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];


//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getUserById($userId);


//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

//check user account active status
// if ($userActive[0]->active != 1) {
//     $_SESSION['error_message'] = 'Login Failed! Try Again.';
//     session_unset();
//     session_destroy();
//     header('Location: ' . ROOT . '/loginController/login');
//     exit;
// }


$Success_message = "";
$Error_message = "";

// Store success message separately
if (isset($_SESSION['success_message'])) {
    $Success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Store error message separately
if (isset($_SESSION['error_message'])) {
    $Error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

?>


<!DOCTYPE html>
<html lang="en">


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard | TrackMaster</title>

    <link rel="stylesheet" href="../Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link rel="stylesheet" href="../Public/css/school/school.css">
  
</head>


    
<body>
    <?php require 'navbar.php'; ?>
    

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1><i class="fas fa-tachometer-alt"></i> School Dashboard</h1>
            <p><i class="fas fa-user"></i> Welcome, <?php echo $username ?>!</p>
        </div>

        

        <div class="main-content">
            <div class="section recent-clients">
                <h2><i class="fas fa-user-graduate"></i> Student-list</h2>
                <ul>
                    <?php foreach ($data['players'] as $player): ?>
                    <li><?= htmlspecialchars($player->firstname . ' ' . $player->lname) ?></li>
                    <?php endforeach; ?>
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

                <div id="noteModal" class="modal hidden">
                    <div class="modal-content">
                        <h3 id="noteTitle"><i class="fas fa-edit"></i> Add Note</h3>
                        <textarea id="noteInput" placeholder="Write your note here..."></textarea>
                        <button id="saveNote"><i class="fas fa-save"></i> Save Note</button>
                        <button id="closeModal"><i class="fas fa-times"></i> Close</button>
                    </div>
                </div>
            </div>


            <!-- onclick="window.location.href='/TrackMaster/App/views/Event/event.php'" -->

          



            <div class="section quick-session">
                <h2  style="cursor: pointer;">
                    <i class="fas fa-building"></i> Facility Requests
                </h2>
                <table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border-bottom: 1px solid #ccc; text-align: left;">Event</th>
            <th style="border-bottom: 1px solid #ccc; text-align: left;">Date</th>
            <th style="border-bottom: 1px solid #ccc; text-align: left;">Time</th>
            <th style="border-bottom: 1px solid #ccc; text-align: left;">Facility</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['facilityReq'] as $req): ?>
            <tr>
                <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?php echo htmlspecialchars($req->event_name); ?></td>
                <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?php echo htmlspecialchars($req->event_date); ?></td>
                <td style="border-bottom: 1px solid #ccc; padding: 8px;">
                    <?php echo date('H:i', strtotime($req->time_from)) . ' - ' . date('H:i', strtotime($req->time_to)); ?>
                </td>
                <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?php echo htmlspecialchars($req->facilities_required); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

            </div>


            <div class="section upcoming-appointments">
    <h2><i class="fas fa-clock"></i> Extra Class Requests</h2>
    <table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border-bottom: 1px solid #ccc; text-align: left;">Student Name</th>
            <th style="border-bottom: 1px solid #ccc; text-align: left;">Grade</th>
            <th style="border-bottom: 1px solid #ccc; text-align: left;">Subject</th>
            <th style="border-bottom: 1px solid #ccc; text-align: left;">Reason</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['extraClassReq'] as $req): ?>
            <?php
                $playerName = 'Unknown';
                $grade = 'N/A';
                foreach ($data['players'] as $player) {
                    if ($player->player_id == $req->player_id) {
                        $playerName = htmlspecialchars($player->firstname . ' ' . $player->lname);
                        $grade = 'Grade ' . ($player->sport_id == 36 ? '10' : ($player->sport_id == 37 ? '11' : 'N/A'));
                        break;
                    }
                }
            ?>
            <tr>
                <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?= $playerName ?></td>
                <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?= $grade ?></td>
                <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?= htmlspecialchars($req->subject_name) ?></td>
                <td style="border-bottom: 1px solid #ccc; padding: 8px;"><?= htmlspecialchars($req->reason) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<center>
                    <button class="profile-button"
                        onclick="window.location.href='<?php echo URLROOT ?>/school/scheduleEx'">
                        <i class="fas fa-plus-circle"></i> View Extra Class Requests
                    </button>
                </center>

</div>



            </div>

    </div>

    <script src="/TrackMaster/Public/js/School/cal.js"></script>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>

</html>