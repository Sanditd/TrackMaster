<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievements</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/achievements.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

<?php require 'navbar.php'?>
<?php 
    // echo $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}?>

    <div id="main">
    <center><div class="title">
                <h1><i class="fas fa-medal"></i> Student Achievements</h1>
                <p>Track and manage your sports accomplishments and milestones</p>
            </div></center>

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

<button class="btn add-achievement-btn" onclick="openAchievementModal()">
        <i class="fas fa-plus-circle"></i> Add New Achievement
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
                                    <button class="Edit-button" onclick="location.href='<?php echo URLROOT.'Student/editAchievement/'.$achievement->achievement_id ?>'"><i class="fas fa-edit"></i></button>
                                    <button class="delete-button" onclick="openDeleteConfirmModal('<?php echo $achievement->achievement_id; ?>')"><i class="fas fa-trash-alt"></i></button>
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
        <span class="close-modal" onclick="closeAchievementModal()"><i class="fas fa-times"></i></span>
        <h3><i class="fas fa-trophy"></i> Add New Achievement</h3>
        <form action="<?php echo ROOT?>/student/saveAchievement" method="POST">  
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
            
            <div class="form-group">
                <label for="place"><i class="fas fa-medal"></i> Place/Rank:</label> 
                <input type="text" id="place" name="place" required placeholder="E.g., First Place, Gold Medal">
            </div>

            <div class="form-group">
                <label><i class="fas fa-layer-group"></i> Achievement Level:</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="level1" name="level" value="zonal" required>
                        <label for="level1">Zonal</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="level2" name="level" value="provincial" required>
                        <label for="level2">Provincial</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="level3" name="level" value="national" required>
                        <label for="level3">National</label>
                    </div>
                </div>
            </div>
   
            <div class="form-group">
                <label for="description"><i class="fas fa-align-left"></i> Description:</label>
                <textarea id="description" name="description" placeholder="Describe your achievement..."></textarea>
            </div>

            <div class="form-group">
                <label for="date"><i class="fas fa-calendar-alt"></i> Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
               
            <div class="form-actions">
                <button class="btn" type="submit">
                    <i class="fas fa-save"></i> Save Achievement
                </button>
                <button class="btn btn-secondary" type="button" onclick="closeAchievementModal()">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="modal">
    <div class="modal-content confirm-modal-content">
        <h3><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h3>
        <p>Are you sure you want to delete this achievement?</p>
        <p class="warning-text">This action cannot be undone.</p>
        
        <div class="form-actions">
            <form id="deleteForm" action="" method="POST">
                <button type="submit" class="btn delete-confirm-btn">
                    <i class="fas fa-trash-alt"></i> Yes, Delete
                </button>
            </form>
            <button class="btn btn-secondary" onclick="closeDeleteConfirmModal()">
                <i class="fas fa-times"></i> Cancel
            </button>
        </div>
    </div>
</div>
    <?php require 'footer.php'?>

    <script src="/TrackMaster/Public/js/Student/carousel.js"></script>
    <script>
// Modal functions
function openAchievementModal() {
        document.getElementById("achievementModal").style.display = "flex";
    }

    function closeAchievementModal() {
        document.getElementById("achievementModal").style.display = "none";
    }

    function openDeleteConfirmModal(achievementId) {
        const deleteForm = document.getElementById("deleteForm");
        deleteForm.action = "<?php echo URLROOT; ?>/Student/deleteAchievement/" + achievementId;
        document.getElementById("deleteConfirmModal").style.display = "flex";
    }

    function closeDeleteConfirmModal() {
        document.getElementById("deleteConfirmModal").style.display = "none";
    }

    // Close modals when clicking outside
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