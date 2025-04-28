<?php
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

// Success and error messages
$Success_message = "";
$Error_message = "";

if (isset($_SESSION['success_message'])) {
    $Success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

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
    <title>Inactive Users Management</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/sportForm.css">
    <style>
    .container {
        max-width: 1200px;
        margin: 20 auto;
        padding: 20px;
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 30px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .table th {
        background-color: #f9fafb;
        font-size: 12px;
        text-transform: uppercase;
        color: #6b7280;
    }

    .table tr:hover {
        background-color: #f9fafb;
    }

    .btn {
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        border: none;
    }

    .btn-blue {
        background-color: #3b82f6;
        color: white;
    }

    .btn-green {
        background-color: #10b981;
        color: white;
    }

    .btn-red {
        background-color: #ef4444;
        color: white;
    }

    .btn-sm {
        padding: 4px 8px;
        font-size: 12px;
    }

    .flex {
        display: flex;
    }

    .flex-col {
        flex-direction: column;
    }

    .gap-4 {
        gap: 16px;
    }

    .mb-4 {
        margin-bottom: 16px;
    }

    .grid {
        display: grid;
    }

    .grid-cols-2 {
        grid-template-columns: repeat(2, 1fr);
    }

    .text-gray {
        color: #6b7280;
    }

    .font-medium {
        font-weight: 500;
    }

    .back-btn {
        display: flex;
        align-items: center;
        color: #3b82f6;
        text-decoration: none;
        margin-bottom: 16px;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 700px;
        width: 90%;
        position: relative;
    }

    .close-modal {
        position: absolute;
        right: 20px;
        top: 15px;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
        color: #6b7280;
    }

    .close-modal:hover {
        color: #111;
    }

    .user-details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }
    </style>
</head>

<body>
    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>

    <!-- User Details Modal -->
    <div id="userDetailsModal" class="modal">
        <div class="modal-content" style="margin-top: 100px;">
            <span class="close-modal" onclick="closeUserModal()">&times;</span>
            <h2>User Details</h2>
            <div id="userDetailsContent" class="user-details-grid" style="margin-top:30px">
                <!-- User details will be loaded here -->
            </div>
            <div class="modal-actions">
                <form id="activateUserForm" method="post" action="<?php echo ROOT ?>/admin/activeUser">
                    <input type="hidden" id="modal-user-id-activate" name="user_id" value="">
                    <input type="hidden" name="action" value="1">
                    <button type="submit" class="btn btn-green">Activate User</button>
                </form>

                <form id="rejectUserForm" method="post" action="<?php echo ROOT ?>/admin/rejectUser">
                    <input type="hidden" id="modal-user-id-reject" name="user_id" value="">
                    <input type="hidden" name="action" value="2">
                    <button type="submit" class="btn btn-red">Reject User</button>
                </form>
            </div>
        </div>
    </div>

    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>

    <div class="container">
        <h1>Inactive Users Management</h1>

        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($data['user']) && count($data['user']) > 0): ?>
                    <?php foreach ($data['user'] as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->firstname . ' ' . $user->lname); ?></td>
                        <td><?php echo htmlspecialchars($user->role); ?></td>
                        <td><?php echo htmlspecialchars($user->phonenumber); ?></td>
                        <td><?php echo htmlspecialchars($user->regDate); ?></td>
                        <td>
                            <div class="flex gap-4">
                                <button onclick="viewUserDetails(<?php echo htmlspecialchars(json_encode($user)); ?>)"
                                    class="btn btn-blue btn-sm" style="height: 43px;margin-top:20px">
                                    View
                                </button>

                                <form method="post" style="display:inline;"
                                    action="<?php echo ROOT ?>/admin/activeUser">
                                    <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                    <input type="hidden" name="action" value="1">
                                    <button type="submit" class="btn btn-green btn-sm">Activate</button>
                                </form>

                                <form method="post" style="display:inline;"
                                    action="<?php echo ROOT ?>/admin/rejectUser">
                                    <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                    <input type="hidden" name="action" value="2">
                                    <button type="submit" class="btn btn-red btn-sm">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No inactive users found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    // Modal functions
    function viewUserDetails(user) {
        // Create HTML content for user details
        let detailsHTML = `
            <div>
                <p class="text-gray">First Name</p>
                <p class="font-medium">${escapeHTML(user.firstname || '')}</p>
            </div>
            <div>
                <p class="text-gray">Last Name</p>
                <p class="font-medium">${escapeHTML(user.lname || '')}</p>
            </div>
            <div>
                <p class="text-gray">Role</p>
                <p class="font-medium">${escapeHTML(user.role || '')}</p>
            </div>
            <div>
                <p class="text-gray">Username</p>
                <p class="font-medium">${escapeHTML(user.username || '')}</p>
            </div>
            <div>
                <p class="text-gray">Email</p>
                <p class="font-medium">${escapeHTML(user.email || '')}</p>
            </div>
            <div>
                <p class="text-gray">Phone</p>
                <p class="font-medium">${escapeHTML(user.phonenumber || '')}</p>
            </div>
            <div>
                <p class="text-gray">Address</p>
                <p class="font-medium">${escapeHTML(user.address || '')}</p>
            </div>`;

        // Conditionally add fields if they exist
        if (user.age) {
            detailsHTML += `
            <div>
                <p class="text-gray">Age</p>
                <p class="font-medium">${escapeHTML(user.age)}</p>
            </div>`;
        }

        if (user.dob) {
            detailsHTML += `
            <div>
                <p class="text-gray">Date of Birth</p>
                <p class="font-medium">${escapeHTML(user.dob)}</p>
            </div>`;
        }

        if (user.province) {
            detailsHTML += `
            <div>
                <p class="text-gray">Province</p>
                <p class="font-medium">${escapeHTML(user.province)}</p>
            </div>`;
        }

        if (user.district) {
            detailsHTML += `
            <div>
                <p class="text-gray">District</p>
                <p class="font-medium">${escapeHTML(user.district)}</p>
            </div>`;
        }

        detailsHTML += `
            <div>
                <p class="text-gray">Registration Date</p>
                <p class="font-medium">${escapeHTML(user.regDate || '')}</p>
            </div>`;

        // Set content and show modal
        document.getElementById('userDetailsContent').innerHTML = detailsHTML;

        // Set user ID in the forms
        document.getElementById('modal-user-id-activate').value = user.user_id;
        document.getElementById('modal-user-id-reject').value = user.user_id;

        // Show the modal
        document.getElementById('userDetailsModal').style.display = 'block';
    }

    function closeUserModal() {
        document.getElementById('userDetailsModal').style.display = 'none';
    }

    // Helper function to escape HTML to prevent XSS
    function escapeHTML(str) {
        if (!str) return '';
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('userDetailsModal');
        if (event.target === modal) {
            closeUserModal();
        }
    }

    <?php if (!empty($Success_message)): ?>
    showCustomAlert('<?php echo $Success_message; ?>');
    <?php endif; ?>

    <?php if (!empty($Error_message)): ?>
    showCustomAlert('<?php echo $Error_message; ?>');
    <?php endif; ?>
    </script>

    <script id="error-message" type="application/json">
    <?= json_encode(trim($Error_message)); ?>
    </script>

    <script id="success-message" type="application/json">
    <?= json_encode(trim($Success_message)); ?>
    </script>

    <script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>
</body>
</body>

</html>