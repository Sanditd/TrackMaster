<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Achievement</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/achievements.css">

</head>
<body>

<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>
 
    <center>    
    <div class="edit-section">
    <div class="form-section">
    <h2>Edit Achievement</h2>
    <form action="<?php echo URLROOT; ?>/Student/editAchievement/<?php echo $data['id']; ?>" method="POST">  
        <label for="place"> Place/Rank : </label> 
        <textarea id="place" name="place" required><?php echo $data['place']; ?></textarea>  

        <label for="level">Level :</label>
        <input type="radio" id="level1" name="level" value="zonal" <?php echo ($data['level'] == 'zonal') ? 'checked' : ''; ?> required> Zonal Level </br>
        <input type="radio" id="level2" name="level" value="provincial" <?php echo ($data['level'] == 'provincial') ? 'checked' : ''; ?> required> Provincial Level</br>
        <input type="radio" id="level3" name="level" value="national" <?php echo ($data['level'] == 'national') ? 'checked' : ''; ?> required> National Level</br>

        <label for="description">Description :</label>
        <textarea id="description" name="description"><?php echo $data['description']; ?></textarea>

        <label for="date">Date :</label>
        <input type="date" id="date" name="date" value="<?php echo $data['date']; ?>" required>

        <center>
            <button class="edit-button" type="submit"> Save </button>
            <button class="edit-button" type="button" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentAchievements'"> Cancel </button>
        </center>
    </form>
</div>
            </div></center>

            <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'?>

    <script src="/Public/js/Student/achievements.js"></script>

</body>
</html>
