<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Sport</title>
    <link rel="stylesheet" href="../../Public/css/Admin/sportCreate.css">
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="../../Public/css/Admin/popupSport.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>
    <script src="../../Public/js/Admin/popUp.js"></script>
</head>

<body>
    <?php require_once "adminNav.php" ?>
    <div id="popup" class="popup-modal">
    <div class="popup-content">
        <h2>Select Sport Type</h2>
        <!-- Navigate to the addSportForm method for team sports -->
        <button id="teamSportBtn" ><a href="<?php echo ROOT ?>/admin/teamSportForm/asdad" >Team Sports</a></button>
        <!-- Navigate to the addindSportForm method for individual sports -->
        <button id="individualSportBtn" ><a href="<?php echo ROOT ?>/admin/addindSportForm/asdad" >Individual Sports</a></button>
        <!-- Close button -->
        <button id="close">
            <a href="<?php echo ROOT ?>/admin/dashboard/asdad" style="text-decoration: none; color: inherit;">Close</a>
        </button>
    </div>


</body>

</html>