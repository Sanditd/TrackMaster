<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Event Requests</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/School/event.css">

</head>
<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>

<div class="dashboard-container">
        <div class="dashboard-header">
           <center> <h1>Facilities Requests</h1> </center><br> 
        </div>

<table class="event-list">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Coach Name</th>
                <th>Date and Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Cricket Championship</td>
                <td>Coach John Doe</td>
                <td>2024-09-15 : 9.00 a.m. - 12.30 p.m.</td>
                <td>
                    <button class="btn approve-btn">Approve</button>
                    <button class="btn decline-btn">Decline</button>
                </td>
            </tr>
            <tr>
                <td>Cricket Championship</td>
                <td>Coach John Doe</td>
                <td>2024-09-15 : 9.00 a.m. - 12.30 p.m.</td>
                <td>
                    <button class="btn approve-btn">Approve</button>
                    <button class="btn decline-btn">Decline</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="dashboard-container">
        <div class="dashboard-header">
           <center> <h1>Extra Class Requests</h1> </center><br> 
        </div>
    <table class="event-list">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Subject Name</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Eraji Thenuwara</td>
                <td>Mathematics</td>
                <td>Revision needed for yesterday double periods</td>
                <td>
                    <button class="btn approve-btn" >Approve</button>
                    <button class="btn decline-btn" >Decline</button>
                </td>
            </tr>
            <tr>
                <td>Eraji Thenuwara</td>
                <td>Science</td>
                <td>Revision needed for today missed class</td>
                <td>
                    <button class="btn approve-btn" >Approve</button>
                    <button class="btn decline-btn" >Decline</button>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>
