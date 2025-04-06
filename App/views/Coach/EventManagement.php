<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Public/css/Coach/EventManagement.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
</head>
<body>
<?php require 'CoachNav.php'; ?>

    <div class="container">
        <!-- Left Side: Event Creation Form -->
        <div class="form-section">
            <h2>Create Event</h2>
            <form>
                <label for="event-name">Event Name:</label>
                <input type="text" id="event-name" name="event-name" placeholder="Enter event name">

                <label for="date">Date:</label>
                <input type="date" id="date" name="date">

                <label for="time-from">Time From:</label>
                <input type="time" id="time-from" name="time-from">

                <label for="time-to">Time To:</label>
                <input type="time" id="time-to" name="time-to">

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" placeholder="Enter event description"></textarea>

                <label for="venue">Venue:</label>
                <input type="text" id="venue" name="venue" placeholder="Enter venue">

                <button type="submit">Send Request</button>
            </form>
        </div>

        <!-- Right Side: Event List and Created Events Table -->
        <div class="table-section">
            <h2>Events</h2>
            <!-- Events Table -->
            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Session 25</td>
                        <td>Request Sned</td>
                        <td>
                            <button class="create-btn">Create</button>
                            <button class="edit-btn">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Session 26  </td>
                        <td>Approved</td>
                        <td>
                            <button class="create-btn">Create</button>
                            <button class="edit-btn">Delete</button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>

            <h2>Created Events</h2>
            <!-- Created Events Table -->
            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Time</th>
                        <th>Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Session 25</td>
                        <td>8:00 PM - 11:00 PM</td>
                        <td>S.Thomas College</td>
                    </tr>
                    <tr>
                        <td>Session 24</td>
                        <td>10:00 AM - 5:00 PM</td>
                        <td>S.Thomas College</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    <script src="../Public/js/Student/carousel.js"></script>
    <script src="../Public/js/Student/profile.js"></script>
    <script src="../Public/js/sidebar.js"></script>
    <script src="../Public/js/Student/calender.js"></script>
</body>