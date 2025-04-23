<?php 

//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

$userId = (int) $_SESSION['user_id'];

//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getAdminById($userId);




//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/form.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/dashboard.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <!-- <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/userManage.css"> -->
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>

    <!-- FullCalendar CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
</head>

<body>
    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>

    <div id="frame">
        <div class="container">

  
            <div class="chart">
                <div id="topic">
                    Matrix
                    <?php print_r($unreadCount)?>

                </div>
            </div>

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
                </div>

                <table class="tg">
                    <thead>
                        <tr>
                            <td class="tg-0lax">
                                2024.06.30 | 08.30
                            </td>
                            <td class="tg-req">
                                <div id="tg-con">Account delete req</div>
                            </td>
                            <td>
                                <div id="tg-button"><button>View</button></div>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>


            <div class="req">
                <div id="topic">
                    Account Deletion Request
                </div>

                <table class="tg">
                    <thead>
                        <tr>
                            <td class="tg-0lax">
                                2024.06.30 | 08.30
                            </td>
                            <td class="tg-req">
                                <div id="tg-con">Player : Charitha Sudewa</div>
                            </td>
                            <td>
                                <div id="tg-button"><button>View</button></div>
                            </td>
                        </tr>
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


</body>
</html>
