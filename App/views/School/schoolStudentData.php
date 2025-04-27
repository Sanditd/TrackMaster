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
    <style>
    /* Base Styles */
    :root {
        --primary-color: #00264d;
        --secondary-color: #ffa500;
        --light-color: #f8f9fa;
        --dark-color: #333;
        --gray-color: #666;
        --border-radius: 8px;
        --box-shadow: 0 4px 12px rgba(0, 38, 77, 0.1);
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f4f4f9;
        color: var(--dark-color);
    }

    /* Students Container */
    .students-container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
    }

    /* Header Section */
    .students-header {
        text-align: center;
        margin-bottom: 30px;
        padding: 25px;
        background: var(--primary-color);
        color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
    }

    .students-header h1 {
        font-size: 2.2rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .students-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Students Table Section */
    .students-table-section {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .section-header {
        background: var(--primary-color);
        color: white;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-header h2 {
        font-size: 1.4rem;
        margin: 0;
    }

    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background-color: rgba(0, 38, 77, 0.05);
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        font-weight: 600;
        color: var(--primary-color);
    }

    th i,
    td i {
        margin-right: 8px;
        color: var(--secondary-color);
    }

    tr:hover {
        background-color: rgba(0, 38, 77, 0.02);
    }

    /* Button Styles */
    .action-btn {
        padding: 10px 15px;
        margin: 0 5px 5px 0;
        border-radius: var(--border-radius);
        border: none;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
        font-size: 0.9rem;
    }

    .view-profile-btn {
        background-color: rgba(0, 123, 255, 0.1);
        color: #0077cc;
    }

    .view-profile-btn:hover {
        background-color: #0077cc;
        color: white;
    }

    .view-attendance-btn {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .view-attendance-btn:hover {
        background-color: #28a745;
        color: white;
    }

    .view-performance-btn {
        background-color: rgba(255, 165, 0, 0.1);
        color: var(--secondary-color);
    }

    .view-performance-btn:hover {
        background-color: var(--secondary-color);
        color: white;
    }

    .add-student-btn {
        background: var(--secondary-color);
        color: white;
        padding: 12px 25px;
        border-radius: var(--border-radius);
        border: none;
        cursor: pointer;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
        transition: var(--transition);
        font-size: 1rem;
    }

    .add-student-btn:hover {
        background: #cc8400;
        transform: translateY(-2px);
    }

    .btn-container {
        text-align: center;
        margin: 20px 0;
    }

    /* Search and Filter Section */
    .search-filter-section {
        background: white;
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: var(--box-shadow);
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
    }

    .search-box {
        flex: 1;
        min-width: 300px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 12px 15px 12px 40px;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
    }

    .search-box input:focus {
        border-color: var(--secondary-color);
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-color);
    }

    .filter-dropdown {
        min-width: 200px;
    }

    .filter-dropdown select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
        background-color: white;
    }

    .filter-dropdown select:focus {
        border-color: var(--secondary-color);
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
    }

    /* Modal Styles */
    .student-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border-radius: var(--border-radius);
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 500px;
        z-index: 1001;
        display: none;
    }

    .student-modal.active {
        display: block;
    }

    .modal-content {
        padding: 25px;
        position: relative;
    }

    .close-modal {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--gray-color);
        transition: var(--transition);
    }

    .close-modal:hover {
        color: var(--primary-color);
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: none;
    }

    .modal-overlay.active {
        display: block;
    }

    /* Form Styles for Modal */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--primary-color);
        font-weight: 500;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: var(--secondary-color);
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
    }

    .submit-btn {
        background: var(--secondary-color);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
        width: 100%;
        justify-content: center;
        margin-top: 10px;
    }

    .submit-btn:hover {
        background: #cc8400;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .students-header {
            padding: 20px 15px;
        }

        .students-header h1 {
            font-size: 1.8rem;
        }

        .students-header p {
            font-size: 1rem;
        }

        th,
        td {
            padding: 12px 10px;
        }

        .action-btn {
            padding: 8px 12px;
            font-size: 0.85rem;
            margin-bottom: 5px;
        }

        .search-filter-section {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box,
        .filter-dropdown {
            min-width: 100%;
        }
    }

    @media (max-width: 480px) {
        .students-header h1 {
            font-size: 1.6rem;
        }

        th,
        td {
            padding: 10px 8px;
            font-size: 0.9rem;
        }

        td {
            display: flex;
            flex-direction: column;
        }

        .action-btn {
            width: 100%;
            margin-right: 0;
        }
    }
    </style>
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
            <form method="post" action="<?= URLROOT ?>/Session/setPlayerSession">
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