<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Sport</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Admin/createSport.css">
</head>

<body>
    <?php require_once "adminNav.php" ?>

    <div class="container" id="popup" class="popup-modal">
    <div class="popup-content">
        <h2>Select Sport Type</h2>
        <button class="edit-button" id="teamSportBtn" onclick="window.location.href='<?php echo URLROOT ?>/admin/teamSportForm/asdad'">Team Sports</button>
        <button class="edit-button" id="individualSportBtn" onclick="window.location.href='<?php echo URLROOT ?>/admin/addindSportForm/asdad'">Individual Sports</button>
        <button class="back-button" id="close" onclick="window.location.href='<?php echo URLROOT ?>/admin/dashboard/asdad'">Back To Dashboard</button>
    </div> 
    </div>
    <script src="/TrackMaster/Public/js/Admin/popUp.js"></script>

</body>

</html>