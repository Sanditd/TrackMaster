<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievements</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/achievements.css">

</head>
<body>

<?php include './../navbar.php'?>
<?php include './../sidebar.php'?>

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
                <form action="/TrackMaster/App/controllers/student/save" method="POST">  
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
                        <button class="edit-button" type="submit"> Add </button>
                        <button class="edit-button" type="submit" onclick="window.location.href='/TrackMaster/App/views/Student/student_achievements.php'" > Cancel </button>
                    </center>
                </form>
            </div>

            <div class="table-section">
                <h2>All Achievements</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Place/Rank</th>
                            <th>Level</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>08/11/2024</td>
                            <td>1st Place</td>
                            <td>Provincial</td>
                            <td>Cricket Tournament held at Welagedara Stadium</td>
                            <td><button type="submit" class="Edit-button" onclick="window.location.href='/TrackMaster/App/views/Student/edit_achievement.php'">Edit</button>
                                <button  type="submit" class="delete-button">Delete</button></td>
                            </td>
                        </tr>

                        <tr>
                            <td>08/11/2024</td>
                            <td>1st Place</td>
                            <td>Provincial</td>
                            <td>Cricket Tournament held at Welagedara Stadium</td>
                            <td><button class="Edit-button" onclick="window.location.href='/TrackMaster/App/views/Student/edit_achievement.php'">Edit</button>
                                <button class="delete-button">Delete</button></td>
                            </td>
                        </tr>

                        <tr>
                            <td>08/11/2024</td>
                            <td>1st Place</td>
                            <td>Provincial</td>
                            <td>Cricket Tournament held at Welagedara Stadium</td>
                            <td><button class="Edit-button" onclick="window.location.href='/TrackMaster/App/views/Student/edit_achievement.php'">Edit</button>
                                <button class="delete-button">Delete</button></td>
                            </td>
                        </tr>

                        <tr>
                            <td>08/11/2024</td>
                            <td>1st Place</td>
                            <td>Provincial</td>
                            <td>Cricket Tournament held at Welagedara Stadium</td>
                            <td><button class="Edit-button" onclick="window.location.href='/TrackMaster/App/views/Student/edit_achievement.php'">Edit</button>
                                <button class="delete-button">Delete</button></td>
                            </td>
                        </tr>

                    </tbody>
                </table>
    
            </div>
        </div>
    
    </div>

    <?php include './../footer.php'?>

    <script src="/TrackMaster/Public/js/Student/carousel.js"></script>
    <script src="/TrackMaster/Public/js/Student/achievements.js"></script>

</body>
</html>
