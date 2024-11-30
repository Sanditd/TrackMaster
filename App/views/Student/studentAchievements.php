<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievements</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/achievements.css">

</head>
<body>

<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>
<?php 
// if (!isset($_SESSION['user_id'])) {
//     header('Location: ' . ROOT . '/loginController/login');
//     exit;
// }
?>

    <div id="main">
        <div class="title">
            <h1>Student Player Achievements</h1>
        </div>
 
        <center><div class="achievements-section">
            <div class="carousel">
                <div class="carousel-inner" id="carouselAchievementsDashboard">
          
                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                    <div class="carousel-item ">
                        <div class="image-container">
                            <img src="/TrackMaster/Public/img/Student/achievements.png">
                        </div>
                        <div class="content-container">
                            <h3>Place/Rank</h3>
                            <i><h3>Level</h3></i>
                            <p>Date (Year)</p>
                            <p>Description of achievement 1.</p>
                        </div>
                    </div>

                </div>
                <button class="carousel-control prev" onclick="prevSlide()">❮</button>
                <button class="carousel-control next" onclick="nextSlide()">❯</button>
            </div>
        </div>
        </center>

        <div class="container">
            
            <div class="form-section">
                <h2>Add a New Achievement</h2>
                <form action="<?php echo ROOT?>/student/saveAchievement" method="POST">  
                    <label for="place"> Place/Rank : </label> 
                    <textarea id="description"  name="place" required></textarea>  

                    <label for="level">Level :</label>
                    <input type="radio" id="level1" name="level" value="zonal" required> Zonal Level </br>
                    <input type="radio" id="level2" name="level" value="provincial" required> Provincial Level</br>
                    <input type="radio" id="level3" name="level" value="national" required> National Level</br>
           
                    <label for="description">Description :</label>
                    <textarea id="description" name="description"></textarea>

                    <label for="date">Date :</label>
                    <input type="date" id="date" name="date" required>
                       
                    <center>
                        <button class="edit-button" type="submit"> Add </button>
                        <button class="edit-button" type="submit" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentAchievements'"> Cancel </button>
                    </center>
                </form>
            </div>

           
            <div class="table-section">
                    <h2>All Achievements</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Place/Rank</th>
                                <th>Level</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['achievements'] as $achievement): ?>
                                <tr>
                                    <td><?php echo $achievement->place; ?></td>
                                    <td><?php echo $achievement->level; ?></td>
                                    <td><?php echo $achievement->description; ?></td>
                                    <td><?php echo $achievement->date; ?></td>
                                    <td>
                                        <a href="<?php echo URLROOT; ?>/Student/editAchievement/<?php echo $achievement->achievement_id; ?>">Edit</a>
                                        <form action="<?php echo URLROOT; ?>/Student/deleteAchievement/<?php echo $achievement->achievement_id; ?>" method="POST" style="display:inline;">
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>           
        </div>   
    </div>

    <?php require 'footer.php'?>

    <script src="/TrackMaster/Public/js/Student/carousel.js"></script>
    <script src="/TrackMaster/Public/js/Student/achievements.js"></script>

</body>
</html>
