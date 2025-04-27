<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/profile.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Admin Profile</h1>
            <nav>
                <ul>
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="player-profile.html">Player</a></li>
                    <li><a href="school-profile.html">School</a></li>
                    <li><a href="coach-profile.html">Coach</a></li>
                    <li><a href="admin-profile.html">Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="container">
        <div class="profile-container">
            <div class="profile-sidebar">
                <div class="profile-header">
                    <h2>Admin User</h2>
                    <p>System Administrator</p>
                </div>
                <div class="profile-info">
                    <div class="info-group">
                        <div class="info-label">Username</div>
                        <div class="info-value">system_admin</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Email</div>
                        <div class="info-value">admin@system.com</div>
                    </div>
                    <div class="actions">
                        <button class="btn btn-danger">Suspend Admin</button>
                    </div>
                </div>
            </div>
            <div class="profile-content">
                <h2 class="section-title">Activity Log</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2023-04-12</td>
                            <td>08:00:15</td>
                            <td>Login</td>
                        </tr>
                        <tr>
                            <td>2023-04-12</td>
                            <td>08:15:22</td>
                            <td>Added new school</td>
                        </tr>
                        <tr>
                            <td>2023-04-12</td>
                            <td>09:30:44</td>
                            <td>Modified system settings</td>
                        </tr>
                        <tr>
                            <td>2023-04-12</td>
                            <td>10:45:36</td>
                            <td>Reset password for user johnsmith22</td>
                        </tr>
                        <tr>
                            <td>2023-04-12</td>
                            <td>11:15:12</td>
                            <td>Suspended user player123</td>
                        </tr>
                        <tr>
                            <td>2023-04-12</td>
                            <td>12:00:36</td>
                            <td>Logout</td>
                        </tr>
                        <tr>
                            <td>2023-04-15</td>
                            <td>09:12:05</td>
                            <td>Login</td>
                        </tr>
                        <tr>
                            <td>2023-04-15</td>
                            <td>09:30:18</td>
                            <td>Generated system report</td>
                        </tr>
                        <tr>
                            <td>2023-04-15</td>
                            <td>10:45:33</td>
                            <td>Updated tournament settings</td>
                        </tr>
                        <tr>
                            <td>2023-04-15</td>
                            <td>11:20:45</td>
                            <td>Logout</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>