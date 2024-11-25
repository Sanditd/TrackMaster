<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Achievement</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/achievements.css">

</head>
<body>

    <?php include './../navbar.php'?>
    <?php include './../sidebar.php'?>
 
    <center>    
    <div class="edit-section">
            <div class="form-section">
                <h2>> Edit My Achievement</h2>
                <form>  
                    <label for="place"> Place/Rank : </label> 
                    <textarea id="description" required></textarea>  

                    <label for="level">Level :</label>
                    <input type="radio" id="level1" name="level" value="zonal" required> Zonal Level </br>
                    <input type="radio" id="level2" name="level" value="provincial" required> Provincial Level</br>
                    <input type="radio" id="level3" name="level" value="national" required> National Level</br>
           
                    <label for="description">Description :</label>
                    <textarea id="description"></textarea>

                    <label for="date">Date :</label>
                    <input type="date" id="date" required>
                       
                    <center>
                        <button class="edit-button" type="submit"> Save Changes </button>
                        <button class="edit-button" type="submit" onclick="window.location.href='/App/views/Student/student_achievements.html'" > Cancel </button>
                    </center>
                </form>
            </div></center>

            <?php include './../footer.php'?>

    <script src="/Public/js/Student/achievements.js"></script>

</body>
</html>
