<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/userManage.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>
</head>

<body>
    <?php require_once 'adminNav.php' ?>
    <div class="container">
        <!-- Left Section: Search and Update User -->
        <div class="left-section">
            <!-- Search Section -->
            <div class="search-section">
                <h2>Search Users</h2>
                <form id="searchForm">
                    <input type="text" name="searchQuery" placeholder="Search by Name, Username, Mobile, or Email" required>
                    <button type="submit">Search</button>
                </form>
            </div>

            <!-- User Information Section -->
            <div class="user-info-section">
                <h2>Update User Information</h2>
                <form id="userForm">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number:</label>
                        <input type="text" id="mobile" name="mobile" placeholder="Enter Mobile Number">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter Email">
                    </div>
                    <button type="submit">Update Information</button>
                </form>
            </div>
        </div>

        <!-- Right Section: User Details and Activity -->
        <div class="right-section">
            <!-- User Activity Section -->
            <div class="user-activity-section">
                <h2>User Activity</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-11-15</td>
                            <td>Logged in</td>
                        </tr>
                        <tr>
                            <td>2024-11-14</td>
                            <td>Updated Profile</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
