<?php
//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

$userId = (int) $_SESSION['user_id'];

//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getAdminById($userId);

$userActive = $loginModel->getAdminActivation($userId);

//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

//check user account active status
if ($userActive[0]->active != 1) {
    $_SESSION['error_message'] = 'Login Failed! Try Again.';
    session_unset();
    session_destroy();
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

$Success_message = "";
$Error_message = "";

// Store success message separately
if (isset($_SESSION['success_message'])) {
    $Success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Store error message separately
if (isset($_SESSION['error_message'])) {
    $Error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Activity Log</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/adminActivity.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/sportForm.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>

</head>
<body>

<div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>


    <div class="container">
        <div class="header-actions">
            <h1>Admin Activity Log</h1>
            
        </div>
        
        
        
        <table id="activityTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Admin User</th>
                    <th>Activity Details</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Check if there are activities to display
                if (!empty($data['adminActivity'])): 
                    
                    // Get the list of admin users for reference
                    $adminList = [];
                    foreach ($data['admin'] as $admin) {
                        $adminList[$admin->admin_id] = $admin->username;
                    }
                    
                    // Loop through activities
                    foreach ($data['adminActivity'] as $activity): 
                        // Split date and time for formatting
                        $dateTimeParts = explode(' ', $activity->date);
                        $date = $dateTimeParts[0];
                        $time = $dateTimeParts[1];
                        
                        // Get admin username
                        $adminUsername = isset($adminList[$activity->admin_Id]) 
                            ? $adminList[$activity->admin_Id] 
                            : 'Unknown';
                ?>
                <tr>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $time; ?></td>
                    <td><?php echo $adminUsername; ?></td>
                    <td><?php echo $activity->act_desc; ?></td>
                </tr>
                <?php 
                    endforeach;
                else: 
                ?>
                <tr>
                    <td colspan="4" class="no-results">No activity records found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <?php
        // Pagination logic
        $totalItems = count($data['adminActivity']);
        $itemsPerPage = 10; // You can change this value
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalPages = ceil($totalItems / $itemsPerPage);
        
        if ($totalPages > 1):
        ?>
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
            <a href="?page=<?php echo $currentPage - 1; ?><?php echo http_build_query($_GET); ?>">
                <button>Previous</button>
            </a>
            <?php endif; ?>
            
            <?php 
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $startPage + 4);
            
            for ($i = $startPage; $i <= $endPage; $i++): 
            ?>
            <a href="?page=<?php echo $i; ?><?php echo http_build_query($_GET); ?>">
                <button <?php echo ($i == $currentPage) ? 'class="active"' : ''; ?>><?php echo $i; ?></button>
            </a>
            <?php endfor; ?>
            
            <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo $currentPage + 1; ?><?php echo http_build_query($_GET); ?>">
                <button>Next</button>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
    // Export to CSV function
    document.getElementById('exportBtn').addEventListener('click', function() {
        window.location.href = 'export_activity_log.php';
    });
    
    // Set default dates if not already set
    window.addEventListener('DOMContentLoaded', function() {
        const dateFrom = document.getElementById('date-from');
        const dateTo = document.getElementById('date-to');
        
        if (!dateFrom.value) {
            // Set default to 7 days ago
            const sevenDaysAgo = new Date();
            sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);
            dateFrom.value = sevenDaysAgo.toISOString().split('T')[0];
        }
        
        if (!dateTo.value) {
            // Set default to today
            const today = new Date();
            dateTo.value = today.toISOString().split('T')[0];
        }
        
        // Set form values from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        
        if (urlParams.has('admin_id')) {
            document.getElementById('admin-user').value = urlParams.get('admin_id');
        }
        
        if (urlParams.has('activity_type')) {
            document.getElementById('activity-type').value = urlParams.get('activity_type');
        }
    });
    </script>
</body>
</html>