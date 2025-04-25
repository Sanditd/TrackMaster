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


$userActive = $loginModel->getAdminActivation($userId);

//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

//check user account active status
if ($userActive[0]->active != 1) {
    $_SESSION['error_message'] = 'Login Failed! Try Again.';
    session_unset();
    session_destroy();
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
    <!-- <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/form.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/dashboard.css"> -->
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/NotificatioView.css">
    <!-- <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/userManage.css"> -->
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>

    <!-- FullCalendar CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
</head>

<body>
<?php
    // Processing the notification data
    $notificationData = json_decode('{"success":1,"notifications":[{"n_id":13,"title":"New Admin Registration","description":"A new admin () has registered for System Admin","type":"Admin registration","toWhom":"","toAdmin":5,"active":0,"date":"2025-04-23 18:43:33"},{"n_id":11,"title":"New Admin Registration","description":"A new admin ( has registered for System Admin","type":"Admin registration","toWhom":"","toAdmin":5,"active":0,"date":"2025-04-23 18:31:44"},{"n_id":9,"title":"New Admin Registration","description":"A new admin ( has registered for System Admin","type":"Admin registration","toWhom":"","toAdmin":5,"active":0,"date":"2025-04-23 18:30:02"},{"n_id":7,"title":"New School Registration","description":"A new School (Sivali Central Collage ) has registered","type":"school registration","toWhom":"","toAdmin":5,"active":0,"date":"2025-04-23 18:12:13"},{"n_id":5,"title":"New School Registration","description":"A new School (Sivali Central Collage ) has registered","type":"school registration","toWhom":"","toAdmin":5,"active":0,"date":"2025-04-23 18:11:35"},{"n_id":4,"title":"New School Registration","description":"A new School (Kiriella Central ) has registered","type":"school registration","toWhom":"","toAdmin":5,"active":0,"date":"2025-04-23 12:07:48"},{"n_id":3,"title":"New School Registration","description":"A new School (Piliyandala Central ) has registered","type":"school registration","toWhom":"","toAdmin":5,"active":0,"date":"2025-04-22 23:26:36"}]}', true);
    
    // In production, you would use your $notifications variable instead
    $notifications = $notificationData['success'] ? $notificationData['notifications'] : [];
    ?>
    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>

    <div id="frame">
    <div class="notify-container">
        <div class="notify-header">
            <h1 class="notify-title">Notifications 
                <?php 
                // First check if notifications exists and is actually an array of objects
                $unreadCount = 0;
                if (isset($data) && isset($data['success']) && $data['success'] == 1 && isset($data['notifications'])) {
                    foreach ($data['notifications'] as $notification) {
                        if ($notification->active == 1) {
                            $unreadCount++;
                        }
                    }
                }
                if ($unreadCount > 0) {
                    echo "<span class='notify-badge'>$unreadCount</span>";
                }
                ?>
            </h1>
        </div>
        
        <div class="notify-list">
            <?php 
            // Check if notifications exist and are available
            $notifications = [];
            if (isset($data) && isset($data['success']) && $data['success'] == 1 && isset($data['notifications'])) {
                $notifications = $data['notifications'];
            }
            
            if (empty($notifications)): 
            ?>
                <div class="notify-empty">
                    <p>You have no notifications.</p>
                </div>
            <?php else: ?>
                <?php foreach ($notifications as $notification): ?>
                    <div class="notify-item <?php echo ($notification->active == 1) ? 'notify-item-unread' : ''; ?>">
                        <div class="notify-icon">
                            <?php if (isset($notification->type) && strpos(strtolower($notification->type), 'admin') !== false): ?>
                                👤
                            <?php elseif (isset($notification->type) && strpos(strtolower($notification->type), 'school') !== false): ?>
                                🏫
                            <?php else: ?>
                                🔔
                            <?php endif; ?>
                        </div>
                        
                        <div class="notify-content">
                            <div class="notify-item-title">
                                <?php echo isset($notification->title) ? htmlspecialchars($notification->title) : ''; ?>
                            </div>
                            <div class="notify-message">
                                <?php echo isset($notification->description) ? htmlspecialchars($notification->description) : ''; ?>
                            </div>
                            <div class="notify-timestamp">
                                <?php 
                                if (isset($notification->date)) {
                                    $timestamp = strtotime($notification->date);
                                    echo date('F j, Y, g:i a', $timestamp);
                                } else {
                                    echo 'Unknown date';
                                }
                                ?>
                            </div>
                        </div>
                        
                        <?php if ($notification->active == 1): ?>
                            <div class="notify-actions">
                            <form action="<?php echo ROOT ?>/NotificationController/markAsRead" method="POST">
                            <input type="hidden" name="notification_id"
                                            value="<?php echo htmlspecialchars($notification->n_id); ?>">
                                            <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                        <button class="notify-read-btn" type="submit">Mark as read</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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
