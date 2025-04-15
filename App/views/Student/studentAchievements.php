<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievements</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/achievements.css">
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            width: 60%;
            max-width: 600px;
            animation: modalopen 0.5s;
        }

        @keyframes modalopen {
            from {opacity: 0; transform: translateY(-60px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-modal:hover,
        .close-modal:focus {
            color: #000;
            text-decoration: none;
        }

        .add-achievement-btn {
            background-color: #ffa500;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin: 20px auto;
            display: block;
            transition: all 0.3s ease-in-out;
        }

        .add-achievement-btn:hover {
            background-color: #cc8400;
            transform: scale(1.05);
        }

        .modal .form-section {
            width: 100%;
            padding: 15px;
            border: none;
        }

        /* Delete confirmation modal */
        .confirm-modal {
            display: none;
            position: fixed;
            z-index: 1010;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.7);
        }

        .confirm-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            width: 40%;
            max-width: 400px;
            text-align: center;
            animation: modalopen 0.5s;
        }

        .confirm-modal-title {
            margin-bottom: 20px;
            color: #00264d;
        }

        .confirm-modal-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .confirm-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .confirm-yes {
            background-color: #ff0000;
            color: white;
        }

        .confirm-no {
            background-color: #ccc;
            color: #333;
        }
    </style>
</head>
<body>

<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>
<?php 
    // echo $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}?>

    <div id="main">
        <div class="title">
            <h1>Student Player Achievements</h1>
        </div>

        <center>
    <div class="achievements-section">
        <div class="carousel">
            <div class="carousel-inner" id="carouselAchievementsDashboard">
                <?php if (!empty($data['achievements'])): ?>
                    <?php foreach ($data['achievements'] as $index => $achievement): ?>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="/TrackMaster/Public/img/Student/achievements.png" alt="Achievement">
                                <div class="level-badge level-<?php echo htmlspecialchars($achievement->level); ?>">
                                    <?php echo ucfirst(htmlspecialchars($achievement->level)); ?>
                                </div>
                            </div>
                            <div class="content-container">
                                <h3><?php echo htmlspecialchars($achievement->place); ?></h3>
                                <p><?php echo htmlspecialchars($achievement->description); ?></p>
                                <div class="achievement-year">
                                    <?php echo htmlspecialchars(date('Y', strtotime($achievement->date))); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="carousel-item">
                        <div class="content-container">
                            <p>No achievements available.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <button class="carousel-control prev" onclick="prevSlide()">❮</button>
            <button class="carousel-control next" onclick="nextSlide()">❯</button>
            
            <div class="carousel-dots">
                <?php for($i = 0; $i < ceil(count($data['achievements']) / 3); $i++): ?>
                    <div class="carousel-dot <?php echo $i === 0 ? 'active' : ''; ?>" onclick="goToSlide(<?php echo $i; ?>)"></div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</center>

<button class="add-achievement-btn" onclick="openAchievementModal()">
    <svg aria-hidden="true" stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M11 4H4C3.44772 4 3 4.44772 3 5V19C3 19.5523 3.44772 20 4 20H18C18.5523 20 19 19.5523 19 19V12" stroke-linejoin="round" stroke-linecap="round"></path>
        <path d="M17.5 3.5C18.3284 2.67157 19.6716 2.67157 20.5 3.5C21.3284 4.32843 21.3284 5.67157 20.5 6.5L12 15L8 16L9 12L17.5 3.5Z" stroke-linejoin="round" stroke-linecap="round"></path>
    </svg>
    ADD NEW ACHIEVEMENT
</button>

        <div class="container">
            <div class="table-section" style="grid-column: 1 / span 2;">
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
                                    <button class="Edit-button" onclick="location.href='<?php echo URLROOT.'Student/editAchievement/'.$achievement->achievement_id ?>'">Edit</button>
                                    <button class="delete-button" onclick="openDeleteConfirmModal('<?php echo $achievement->achievement_id; ?>')">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>           
        </div>   
    </div>

    <!-- Add Achievement Modal -->
    <div id="achievementModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeAchievementModal()">&times;</span>
            <div class="form-section">
                <h2>Add a New Achievement</h2>
                <form action="<?php echo ROOT?>/student/saveAchievement" method="POST">  
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
                    
                    <label for="place">Place/Rank:</label> 
                    <textarea id="place" name="place" required></textarea>  

                    <label for="level">Level:</label>
                    <input type="radio" id="level1" name="level" value="zonal" required> Zonal Level </br>
                    <input type="radio" id="level2" name="level" value="provincial" required> Provincial Level</br>
                    <input type="radio" id="level3" name="level" value="national" required> National Level</br>
           
                    <label for="description">Description:</label>
                    <textarea id="description" name="description"></textarea>

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                       
                    <center>
                        <button class="edit-button" type="submit">Add</button>
                        <button class="edit-button" type="button" onclick="closeAchievementModal()">Cancel</button>
                    </center>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="confirm-modal">
        <div class="confirm-modal-content">
            <h3 class="confirm-modal-title">Confirm Deletion</h3>
            <p>Are you sure you want to delete this achievement?</p>
            <p>This action cannot be undone.</p>
            
            <div class="confirm-modal-buttons">
                <form id="deleteForm" action="" method="POST">
                    <button type="submit" class="confirm-btn confirm-yes">Yes, Delete</button>
                </form>
                <button class="confirm-btn confirm-no" onclick="closeDeleteConfirmModal()">Cancel</button>
            </div>
        </div>
    </div>

    <?php require 'footer.php'?>

    <script src="/TrackMaster/Public/js/Student/carousel.js"></script>
    <script>
        function openAchievementModal() {
            document.getElementById("achievementModal").style.display = "block";
        }

        function closeAchievementModal() {
            document.getElementById("achievementModal").style.display = "none";
        }

        // Delete confirmation functionality
        function openDeleteConfirmModal(achievementId) {
            const deleteForm = document.getElementById("deleteForm");
            deleteForm.action = "<?php echo URLROOT; ?>/Student/deleteAchievement/" + achievementId;
            document.getElementById("deleteConfirmModal").style.display = "block";
        }

        function closeDeleteConfirmModal() {
            document.getElementById("deleteConfirmModal").style.display = "none";
        }

        // Close modals when clicking outside of them
        window.onclick = function(event) {
            const addModal = document.getElementById("achievementModal");
            const deleteModal = document.getElementById("deleteConfirmModal");
            
            if (event.target == addModal) {
                addModal.style.display = "none";
            } else if (event.target == deleteModal) {
                deleteModal.style.display = "none";
            }
        }
    </script>
    <script src="/TrackMaster/Public/js/Student/achievements.js"></script>
</body>
</html>