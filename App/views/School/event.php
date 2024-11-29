<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Event Requests</title>
    <link rel="stylesheet" href="../../../Public/css/Event/event.css">
    <script>
        function handleRequest(action, eventName) {
            alert(`You have ${action} the request for the event: ${eventName}`);
        }
    </script>
</head>
<body>
<?php include './../navbar.php'?>
<?php include 'sidebar.php'?>

<div class="dashboard-container">
        <div class="dashboard-header">
           <center> <h1>Facilities Requests</h1> </center><br> 
        </div>

<table class="event-list">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Coach Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Football Championship</td>
                <td>Coach John Doe</td>
                <td>
                    <button class="btn approve-btn" onclick="handleRequest('approved', 'Football Championship')">Approve</button>
                    <button class="btn decline-btn" onclick="handleRequest('declined', 'Football Championship')">Decline</button>
                </td>
            </tr>
            <tr>
                <td>Basketball Tournament</td>
                <td>Coach Jane Smith</td>
                <td>
                    <button class="btn approve-btn" onclick="handleRequest('approved', 'Basketball Tournament')">Approve</button>
                    <button class="btn decline-btn" onclick="handleRequest('declined', 'Basketball Tournament')">Decline</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="dashboard-container">
        <div class="dashboard-header">
           <center> <h1>School Event Requests</h1> </center><br> 
        </div>
    <table class="event-list">
        <thead>
            <tr>
                <th>Class Name</th>
                <th>Instructor Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mathematics Revision</td>
                <td>Instructor Mark Allen</td>
                <td>
                    <button class="btn approve-btn" onclick="handleRequest('approved', 'Mathematics Revision')">Approve</button>
                    <button class="btn decline-btn" onclick="handleRequest('declined', 'Mathematics Revision')">Decline</button>
                </td>
            </tr>
            <tr>
                <td>Physics Lab</td>
                <td>Instructor Emma Taylor</td>
                <td>
                    <button class="btn approve-btn" onclick="handleRequest('approved', 'Physics Lab')">Approve</button>
                    <button class="btn decline-btn" onclick="handleRequest('declined', 'Physics Lab')">Decline</button>
                </td>
            </tr>
        </tbody>
    </table>
    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>
