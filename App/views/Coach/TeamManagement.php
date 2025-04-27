<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Management | TrackMaster</title>
    <link rel="stylesheet" href="../Public/css/navbar.css">
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

        /* Container */
        .econtainer {
            max-width: 1200px;
            margin: 20px auto;
            padding: 30px;
        }

        /* Header Section */
        .team-management-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .team-management-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .team-management-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 25px;
        }

        .btn {
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
            text-decoration: none;
        }

        .btn:hover {
            background: #cc8400;
            transform: translateY(-2px);
        }

        .btn a {
            color: white;
            text-decoration: none;
        }

        .create-team {
            background-color: #28a745;
        }

        .create-team:hover {
            background-color: #218838;
        }

        .edit-team {
            background-color: #17a2b8;
        }

        .edit-team:hover {
            background-color: #138496;
        }

        .delete-team {
            background-color: #dc3545;
        }

        .delete-team:hover {
            background-color: #c82333;
        }

        .replace {
            background-color: #6c757d;
            padding: 8px 12px;
            font-size: 0.85rem;
        }

        .replace:hover {
            background-color: #5a6268;
        }

        /* Team Section */
        .team-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            overflow: hidden;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .team-name {
            background: var(--primary-color);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .team-title {
            font-size: 1.4rem;
            margin: 0;
        }

        .team-actions {
            display: flex;
            gap: 10px;
        }

        /* Team List */
        .team-list {
            padding: 0;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: rgba(0, 38, 77, 0.03);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            font-weight: 600;
            color: var(--primary-color);
        }

        tbody tr:hover {
            background-color: rgba(0, 38, 77, 0.02);
        }

        /* Player Image */
        .player-photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid var(--secondary-color);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .empty-state i {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 15px;
        }

        .empty-state p {
            font-size: 1.1rem;
            color: var(--gray-color);
            margin-bottom: 20px;
        }

        /* Confirmation Dialog */
        .confirmation-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            display: none;
        }

        .confirmation-dialog {
            background: white;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 400px;
            padding: 25px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
        }

        .confirmation-dialog h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .confirmation-dialog p {
            margin-bottom: 20px;
            line-height: 1.5;
            color: var(--gray-color);
        }

        .confirmation-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Notification System */
        #notification-container {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }

        .notification {
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 8px;
            min-width: 300px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .success-notification {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .error-notification {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .team-name {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .team-actions {
                width: 100%;
                justify-content: space-between;
            }

            th, td {
                padding: 10px;
            }

            .btn {
                padding: 8px 12px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .player-info span {
                display: block;
                margin-top: 5px;
            }

            .team-management-header h1 {
                font-size: 1.8rem;
            }

            .team-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="econtainer">
        <div class="team-management-header">
            <h1><i class="fas fa-users-gear"></i> Team Management</h1>
            <p>View, edit, and manage your cricket teams and player lineups</p>
        </div>
        
        <div class="action-buttons">
            <button id="createteam" class="btn create-team">
                <i class="fas fa-plus"></i>
                <a href="<?php echo ROOT; ?>/coach/creataddplayers">Create A Team</a>
            </button>
        </div>
    
        <?php if(empty($data['teams'])): ?>
            <div class="empty-state">
                <i class="fas fa-users-slash"></i>
                <p>No teams available. Get started by creating your first team.</p>
                <button class="btn create-team">
                    <i class="fas fa-plus"></i>
                    <a href="<?php echo ROOT; ?>/coach/creataddplayers">Create A Team</a>
                </button>
            </div>
        <?php else: ?>
            <?php foreach($data['teams'] as $team): ?>
                <div class="team-container">
                    <div class="team-name">
                        <h1 class="team-title"><i class="fas fa-users"></i> <?= $team->team; ?></h1>
                        <div class="team-actions">
                            <button class="btn edit-team">
                                <i class="fas fa-edit"></i>
                                <a href="<?= ROOT; ?>/Coach/editTeam/<?= $team->team_id; ?>">Edit Team</a>
                            </button>
                            <form method="POST" action="<?= ROOT; ?>/Coach/deleteTeam" onsubmit="return confirmDelete(<?= $team->team_id; ?>)">
                                <input type="hidden" name="teamId" value="<?= $team->team_id; ?>">
                                <button type="submit" class="btn delete-team">
                                    <i class="fas fa-trash"></i> Delete Team
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="team-list">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Contact Info</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($team->players as $player): ?>
                                    <tr>
                                        <td><?= $player->player_id; ?></td>
                                        <td>
                                            <img class="player-photo" src="data:image/jpeg;base64,<?= base64_encode($player->photo); ?>" alt="Player Photo">
                                        </td>
                                        <td><?= $player->name; ?></td>
                                        <td>
                                            <div class="player-info">
                                                <span><i class="fas fa-phone"></i> <?= $player->phonenumber; ?></span>
                                                <span><i class="fas fa-envelope"></i> <?= $player->email; ?></span>
                                            </div>
                                        </td>
                                        <td><span class="role-badge"><?= $player->role; ?></span></td>   
                                        <td>
                                            <button class="btn replace" onclick="replacePlayer(<?= $player->player_id; ?>, <?= $team->team_id; ?>)">
                                                <i class="fas fa-user-edit"></i> Replace
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Confirmation Dialog -->
    <div id="confirmationOverlay" class="confirmation-overlay">
        <div class="confirmation-dialog">
            <h3><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h3>
            <p>Are you sure you want to delete this team? This action cannot be undone.</p>
            <div class="confirmation-actions">
                <button id="cancelDelete" class="btn">Cancel</button>
                <button id="confirmDelete" class="btn delete-team">Delete</button>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notification-container"></div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

    <script src="../Public/js/sidebar.js"></script>
    <script>
        // Team deletion confirmation
        function confirmDelete(teamId) {
            if (!confirm('Are you sure you want to delete this team? This action cannot be undone.')) {
                return false;
            }
            return true;
        }

        function deleteTeam(teamId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/TrackMaster/Coach/deleteTeam', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        setTimeout(() => {
                            location.reload(); // Reload the page to reflect the deletion
                        }, 1500);
                    } else {
                        showNotification('error', response.message);
                    }
                } else {
                    showNotification('error', 'Unexpected error occurred. Please try again.');
                }
            };
            xhr.send(`teamId=${teamId}`);
        }

        function replacePlayer(playerId, teamId) {
            // This function would open a modal or redirect to a page for replacing the player
            window.location.href = `<?php echo ROOT; ?>/coach/replacePlayer/${teamId}/${playerId}`;
        }

        function showNotification(type, message) {
            // Create notification container if it doesn't exist
            let notificationContainer = document.getElementById('notification-container');
            if (!notificationContainer) {
                notificationContainer = document.createElement('div');
                notificationContainer.id = 'notification-container';
                document.body.appendChild(notificationContainer);
            }

            // Create the notification
            const notification = document.createElement('div');
            notification.className = `notification ${type === 'success' ? 'success-notification' : 'error-notification'}`;
            
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
                <i class="fas fa-times" style="cursor: pointer;"></i>
            `;

            // Add the notification to the container
            notificationContainer.appendChild(notification);

            // Close button functionality
            notification.querySelector('.fa-times').addEventListener('click', function() {
                notificationContainer.removeChild(notification);
            });

            // Remove the notification after 5 seconds
            setTimeout(() => {
                if (notification.parentNode === notificationContainer) {
                    notificationContainer.removeChild(notification);
                }
            }, 5000);
        }

        // Style the role badges based on player role
        document.addEventListener('DOMContentLoaded', function() {
            const roleBadges = document.querySelectorAll('.role-badge');
            
            roleBadges.forEach(badge => {
                const role = badge.textContent.toLowerCase();
                badge.style.padding = '4px 10px';
                badge.style.borderRadius = '12px';
                badge.style.fontSize = '0.85rem';
                badge.style.fontWeight = '600';
                
                if (role.includes('batsman')) {
                    badge.style.backgroundColor = 'rgba(220, 53, 69, 0.1)';
                    badge.style.color = '#dc3545';
                } else if (role.includes('bowler')) {
                    badge.style.backgroundColor = 'rgba(40, 167, 69, 0.1)';
                    badge.style.color = '#28a745';
                } else if (role.includes('all')) {
                    badge.style.backgroundColor = 'rgba(255, 193, 7, 0.1)';
                    badge.style.color = '#ffc107';
                } else if (role.includes('wicket')) {
                    badge.style.backgroundColor = 'rgba(13, 110, 253, 0.1)';
                    badge.style.color = '#0d6efd';
                } else {
                    badge.style.backgroundColor = 'rgba(108, 117, 125, 0.1)';
                    badge.style.color = '#6c757d';
                }
            });
        });
    </script>
</body>
</html>