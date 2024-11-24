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
                            <button class="view-btn">View</button>
                            <button class="edit-btn">Edit</button>
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

</html>