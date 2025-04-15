<!DOCTYPE html>
<html lang="en">

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$Success_message = $_SESSION['success_message'] ?? '';
$Error_message = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);




?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sports</title>
    <link rel="stylesheet" href="../../Public/css/Admin/sportManage.css">
    
    <link rel="stylesheet" href="../../Public/css/Admin/zoneManage.css">
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>
</head>

<body>

    <?php require_once 'adminNav.php' ?>
    <div class="container">
        <h1>Manage Sports</h1>

        <!-- Sports List -->
        <div class="sports-list">
            <h2>Sports</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sport Name</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data) && is_array($data)): ?>
                    <?php foreach ($data as $index => $sport): ?>
                    <?php if (is_array($sport)): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($sport['sport_name']) ?></td>
                        <td><?= htmlspecialchars($sport['sport_type']) ?></td>
                        <td>
                            <button class="view-btn">View</button>
                            <button class="edit-btn">Edit</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                    <?php elseif (is_object($sport)): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($sport->sport_name) ?></td>
                        <td><?= htmlspecialchars($sport->sport_type) ?></td>
                        <td>
                            <button class="view-btn"
                                onclick="viewSport(<?= $sport->sport_id ?>, '<?= $sport->sport_type ?>')">
                                View
                            </button>


                            <button class="edit-btn"
                                onclick="editSport(<?= htmlspecialchars(json_encode($sport->sport_id)) ?>, '<?= htmlspecialchars($sport->sport_type) ?>')">
                                Edit
                            </button>

                            <button class="delete-btn"
                                onclick="deleteSport(<?= htmlspecialchars(json_encode($sport->sport_id)) ?>)">
                                Delete
                            </button>

                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4">No sports available.</td>
                    </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

        <!-- Custom Alert Box -->
        <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()" id="customAlertBox button">OK</button>
        </div>
    </div>


</body>

<script>
    function updateTeamSport(sportId) {
        // Redirect to the updateTeamSport page with sport_id as a parameter
        window.location.href = "<?= ROOT ?>/admin/updateIndSport/" + sportId;
    }
    </script>

    <script>
    function goBackToManage() {
        window.location.href = "<?= ROOT ?>/admin/SportManage/adasd";
    }
    </script>


<script src="../../Public/js/Admin/formHandler.js"></script>

<script>
function viewSport(sport_id, sport_type) {
    // Safely encode ROOT from PHP
    const root = <?= json_encode(ROOT) ?>;

    // Determine the correct view based on the sport_type
    let view = '';
    if (sport_type === 'IndSport') {
        view = 'indSportView';
    } else if (sport_type === 'teamSport') {
        view = 'teamSportView';
    } else {
        // Fallback or error handling if needed
        console.error('Unknown sport type:', sport_type);
        return;
    }

    // Construct and redirect to the appropriate URL
    const url = `${root}/admin/${view}/${encodeURIComponent(sport_id)}`;
    window.location.href = url;
}


function editSport(sport_id, sport_type) {
    // Ensure the ROOT is properly encoded for use in JavaScript
    const root = <?= json_encode(ROOT) ?>; // Safely encode ROOT from PHP

    
    console.log('Sport ID:', sport_id);  // For debugging purposes
    console.log('Sport Type:', sport_type);  // For debugging purposes


    // Determine the URL based on the sport type
    let url = '';
    if (sport_type === 'IndSport') {
        url = `${root}/admin/updateIndSport/${encodeURIComponent(sport_id)}`;
    } else if (sport_type === 'teamSport') {
        url = `${root}/admin/updateTeamSport/${encodeURIComponent(sport_id)}`;
    } else {
        alert('Unknown sport type.');
        return; // Stop execution if the type is unknown
    }

    // Redirect to the appropriate view
    window.location.href = url;
}

function deleteSport(sport_id) {
    const root = <?= json_encode(ROOT) ?>; // Get root path from PHP
    const url = `${root}/admin/deleteSport/${encodeURIComponent(sport_id)}`;

    // Override the OK button action temporarily
    const okButton = document.querySelector('#customAlertBox button');
    const originalHandler = okButton.onclick; // Save existing handler

    // Set new handler
    okButton.onclick = function () {
        hideCustomAlert(); // Hide the alert first

        // Perform DELETE request
        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then((response) => {
            if (response.ok) {
                // Show success message and trigger reload after confirmation
                showCustomAlert("Sport deleted successfully.");
                // Override the OK button handler again after the message is shown
                okButton.onclick = function () {
                    location.reload(); // Reload the page after confirmation
                };
            } else {
                return response.text().then((text) => {
                    throw new Error(text || "Failed to delete the sport.");
                });
            }
        })
        .catch((error) => {
            console.error("Error deleting sport:", error);
            alert(`Error: ${error.message}`);
        });

        // Restore the original OK button behavior after execution
        okButton.onclick = originalHandler;
    };

    // Show custom confirmation message
    showCustomAlert("Are you sure you want to delete this sport?");
}


</script>


</html>