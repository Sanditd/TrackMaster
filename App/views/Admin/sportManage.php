<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sports</title>
    <link rel="stylesheet" href="../../Public/css/Admin/sportManage.css">
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
                        <td><?= htmlspecialchars($sport['sportName']) ?></td>
                        <td><?= htmlspecialchars($sport['sportType']) ?></td>
                        <td>
                            <button class="view-btn">View</button>
                            <button class="edit-btn">Edit</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                    <?php elseif (is_object($sport)): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($sport->sportName) ?></td>
                        <td><?= htmlspecialchars($sport->sportType) ?></td>
                        <td>
                        <button 
                class="view-btn" 
                onclick="viewSport(<?= htmlspecialchars(json_encode($sport->sportId)) ?>)">
        
                View
            </button>
            <button class="edit-btn" 
    onclick="editSport(<?= htmlspecialchars(json_encode($sport->sportId)) ?>, '<?= htmlspecialchars($sport->sportType) ?>')">
    Edit
</button>

                            <button class="delete-btn">Delete</button>
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
</body>

<script>
    function viewSport(sportId) {
    // Ensure the ROOT is properly encoded for use in JavaScript
    const root = <?= json_encode(ROOT) ?>; // Safely encode ROOT from PHP
    
    // Construct the URL dynamically based on the required format
    const url = `${root}/admin/sportView/${encodeURIComponent(sportId)}`;
    
    // Redirect the browser to the constructed URL
    window.location.href = url;
}

function editSport(sportId, sportType) {
    // Ensure the ROOT is properly encoded for use in JavaScript
    const root = <?= json_encode(ROOT) ?>; // Safely encode ROOT from PHP
    
    // Determine the URL based on the sport type
    let url = '';
    if (sportType === 'Individual Sport') {
        url = `${root}/admin/indsportEdit/${encodeURIComponent(sportId)}`;
    } else if (sportType === 'teamSport') {
        url = `${root}/admin/teamSportEdit/${encodeURIComponent(sportId)}`;
    } else {
        alert('Unknown sport type.');
        return; // Stop execution if the type is unknown
    }
    
    // Redirect to the appropriate view
    window.location.href = url;
}

</script>


</html>