<?php
//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];


//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getUserById($userId);


//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}
?>

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

                <div>

                <!-- Debugging: Print the $data array -->

                <form class="formcontent" method="POST" action="<?php echo URLROOT; ?>/School/saveEditedRecord">    
                <input type="hidden" id="player_id" name="player_id" value="<?php echo htmlspecialchars($data['player_id']); ?>" readonly>                    <ul>
                        <li>
                        <label for="studentName">Student Name:</label>
                        <input type="text" id="name" name="firstname" value="<?php echo htmlspecialchars($data['firstname']); ?>" disabled>                        
                        </li>
                        <li>
                            <label for="grade">Grade:</label>
                            <input type="text" id="grade" name="grade" value="<?php echo htmlspecialchars($data['grade']); ?>" placeholder="Enter grade">                            </li>
                        <li>
                            <label for="term">Term:</label>
                            <input type="text" id="term" name="term" value="<?php echo htmlspecialchars($data['term']); ?>" placeholder="Enter term">
                        </li>
                        <li>
                            <label for="average">Average:</label>
                            <input type="number" id="average" name="average" value="<?php echo htmlspecialchars($data['average']); ?>" placeholder="Enter average">                            </li>
                        <li>
                            <label for="rank">Rank:</label>
                            <input type="number" id="rank" name="rank" value="<?php echo htmlspecialchars($data['rank']); ?>" placeholder="Enter rank">                            </li>
                        <li>
                        <label for="notes">Additional Notes:</label>
                        <textarea id="notes" name="notes"><?php echo htmlspecialchars($data['notes']); ?></textarea>                        </li>
                    </ul>
                    <center>
            <button class="edit-button" type="submit"> Save </button>
            <button class="edit-button" type="submit"> Cancel </button>
            </center>
                </form>
            </div>

        </div></center>

            <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'?>

</body>
</html>