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
    <title>Student Records | TrackMaster</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/TrackMaster/Public/css/school/schoolStudentData.css">
    
</head>

<body>
<?php require 'navbar.php'?>

    <div class="students-container">
        <div class="students-header">
            <h1><i class="fas fa-user-graduate"></i> Student Records</h1>
            <p>View and manage all student information, academic records, and sports performance</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search for students..." id="studentSearch">
            </div>
        </div>

        <!-- Students Table Section -->
        <div class="students-table-section">
            <div class="section-header">
                <h2><i class="fas fa-list"></i> Student List</h2>
            </div>
            <table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Grade</th>
            <th>Sport</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
// Preprocess records into a map for quick lookup
$recordsByPlayer = [];
foreach ($data['records'] as $record) {
    if (!isset($recordsByPlayer[$record->player_id])) {
        $recordsByPlayer[$record->player_id] = $record;
    }
}
?>

<?php foreach ($data['players'] as $player): ?>
    <?php
        // Get grade from matching record
        $grade = isset($recordsByPlayer[$player->player_id]) 
            ? htmlspecialchars($recordsByPlayer[$player->player_id]->grade)
            : 'N/A';

        // Get sport name from sport_id
        $sportName = '';
        foreach ($data['sports'] as $sport) {
            if ($sport->Sport_id == $player->sport_id) {
                $sportName = $sport->sport_name;
                break;
            }
        }
    ?>
    <tr>
        <td><?= htmlspecialchars($player->firstname . ' ' . $player->lname) ?></td>
        <td><?= $grade ?></td>
        <td><?= htmlspecialchars($sportName) ?></td>
        <td>
            <form method="post" action="<?= URLROOT ?>/app/views/school/studentProfile.php">
                <input type="hidden" name="player_id" value="<?= $player->player_id ?>">
                <button type="submit" class="action-btn view-profile-btn">
                    <i class="fas fa-id-card"></i> View Profile
                </button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>

</table>


        </div>


    </div>

    <!-- Add Student Modal -->
    <div id="addStudentModal" class="student-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h3><i class="fas fa-user-plus"></i> Add New Student</h3>
            <form id="addStudentForm">
                <div class="form-group">
                    <label for="studentName">Full Name:</label>
                    <input type="text" id="studentName" placeholder="Enter student's full name" required>
                </div>
                <div class="form-group">
                    <label for="studentGrade">Grade:</label>
                    <select id="studentGrade" required>
                        <option value="">-- Select Grade --</option>
                        <option value="11-A">11-A</option>
                        <option value="11-B">11-B</option>
                        <option value="12-A">12-A</option>
                        <option value="12-B">12-B</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="studentSport">Sport:</label>
                    <select id="studentSport" required>
                        <option value="">-- Select Sport --</option>
                        <option value="Cricket">Cricket</option>
                        <option value="Football">Football</option>
                        <option value="Basketball">Basketball</option>
                        <option value="Swimming">Swimming</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="studentEmail">Email:</label>
                    <input type="email" id="studentEmail" placeholder="Enter student's email">
                </div>
                <div class="form-group">
                    <label for="studentPhone">Phone Number:</label>
                    <input type="tel" id="studentPhone" placeholder="Enter student's phone number">
                </div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i> Save Student
                </button>
            </form>
        </div>
    </div>
    <div class="modal-overlay" id="modalOverlay"></div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

    <script>
    // Function to show add student modal
    function showAddStudentModal() {
        document.getElementById('addStudentModal').classList.add('active');
        document.getElementById('modalOverlay').classList.add('active');
    }

    // Function to close modal
    function closeModal() {
        document.getElementById('addStudentModal').classList.remove('active');
        document.getElementById('modalOverlay').classList.remove('active');
    }

    // Handle form submission
    document.getElementById('addStudentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would normally handle the form submission with AJAX
        alert('Student added successfully!');
        closeModal();
    });

    // Simple search functionality
    document.getElementById('studentSearch').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const grade = row.cells[1].textContent.toLowerCase();
            const sport = row.cells[2].textContent.toLowerCase();

            if (name.includes(searchTerm) || grade.includes(searchTerm) || sport.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Filter by sport
    document.getElementById('sportFilter').addEventListener('change', function() {
        filterTable();
    });

    // Filter by grade
    document.getElementById('gradeFilter').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const sportFilter = document.getElementById('sportFilter').value.toLowerCase();
        const gradeFilter = document.getElementById('gradeFilter').value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const grade = row.cells[1].textContent.toLowerCase();
            const sport = row.cells[2].textContent.toLowerCase();

            const matchesSport = sportFilter === '' || sport === sportFilter;
            const matchesGrade = gradeFilter === '' || grade === gradeFilter;

            if (matchesSport && matchesGrade) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Add hover effects for table rows
    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseover', function() {
                this.style.backgroundColor = 'rgba(255, 165, 0, 0.05)';
            });
            row.addEventListener('mouseout', function() {
                this.style.backgroundColor = '';
            });
        });
    });
    </script>

<script>
// Complete replacement for all search-related code
document.addEventListener('DOMContentLoaded', function() {
    // Clear any existing event listeners by cloning and replacing the search input
    const searchInput = document.getElementById('studentSearch');
    const newSearchInput = searchInput.cloneNode(true);
    searchInput.parentNode.replaceChild(newSearchInput, searchInput);
    
    // Add our single search event listener
    newSearchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('tbody tr');
        
        console.log("Searching for:", searchTerm); // Debug output
        
        rows.forEach(row => {
            const nameCell = row.cells[0];
            const fullName = nameCell ? nameCell.textContent.toLowerCase().trim() : '';
            const grade = row.cells[1].textContent.toLowerCase().trim();
            const sport = row.cells[2].textContent.toLowerCase().trim();
            
            console.log("Checking:", fullName); // Debug output
            
            // Show row if the search term matches any part of the name, grade, or sport
            if (fullName.includes(searchTerm) || grade.includes(searchTerm) || sport.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Keep the hover effects separate
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseover', function() {
            this.style.backgroundColor = 'rgba(255, 165, 0, 0.05)';
        });
        row.addEventListener('mouseout', function() {
            this.style.backgroundColor = '';
        });
    });
    
    // Filter functions - keep these if needed
    if (document.getElementById('sportFilter')) {
        document.getElementById('sportFilter').addEventListener('change', filterTable);
    }
    
    if (document.getElementById('gradeFilter')) {
        document.getElementById('gradeFilter').addEventListener('change', filterTable);
    }
    
    function filterTable() {
        const sportFilter = document.getElementById('sportFilter')?.value.toLowerCase() || '';
        const gradeFilter = document.getElementById('gradeFilter')?.value.toLowerCase() || '';
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const grade = row.cells[1].textContent.toLowerCase();
            const sport = row.cells[2].textContent.toLowerCase();

            const matchesSport = sportFilter === '' || sport === sportFilter;
            const matchesGrade = gradeFilter === '' || grade === gradeFilter;

            if (matchesSport && matchesGrade) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
});
</script>

</body>

</html>