<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Record</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/School/records.css">

</head>
<body>

<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>
 
    <center>    
    <div class="main-content">
            <div class="section recent-clients">
                <h2>Edit A Student Record</h2>
                <form class="formcontent" >
                    <ul>
                        <li>
                            <label for="studentName">Student Name:</label>
                            <select id="studentName">
                                <option>Morty Smith</option>
                                <option>Rick Sanchez</option>
                                <option>Paul Hewmatt</option>
                                <option>Sheen Estevez</option>
                                <option>John Doe</option>
                            </select>
                        </li>
                        <li>
                            <label for="grade">Grade:</label>
                            <input type="text" id="grade" placeholder="Enter grade">
                        </li>
                        <li>
                            <label for="term">Term:</label>
                            <input type="text" id="term" placeholder="Enter term">
                        </li>
                        <li>
                            <label for="average">Average:</label>
                            <input type="number" id="average" placeholder="Enter average">
                        </li>
                        <li>
                            <label for="rank">Rank:</label>
                            <input type="number" id="rank" placeholder="Enter rank">
                        </li>
                        <li>
                        <label for="notes">Additional Notes:</label>
                        <textarea id="notes" name="notes"></textarea>
                        </li>
                    </ul>
                    <center>
            <button class="edit-button" type="submit"> Save </button>
            <button class="edit-button" type="button" onclick="window.location.href='<?php echo URLROOT ?>/School/Records'"> Cancel </button>
        </center>
                </form>
            </div>

        </div></center>

            <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'?>

</body>
</html>
