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
    <title>Extra Class Requests | TrackMaster</title>
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

        /* Extra Class Container */
        .extra-class-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .section-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .section-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .section-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Table Section */
        .table-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .table-header {
            background: var(--primary-color);
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-header h2 {
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

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            font-weight: 600;
            color: var(--primary-color);
        }

        th i, td i {
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

        .approve-btn {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .approve-btn:hover {
            background-color: #28a745;
            color: white;
        }

        .decline-btn {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .decline-btn:hover {
            background-color: #dc3545;
            color: white;
        }

        /* Form Section */
        .form-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .form-content {
            padding: 25px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-color);
            font-weight: 500;
        }

        .form-group label i {
            margin-right: 8px;
            color: var(--secondary-color);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Checkbox Styles */
        .checkbox-container {
            background: #f9f9f9;
            padding: 20px;
            border-radius: var(--border-radius);
            border: 1px solid #eee;
            margin-bottom: 20px;
        }

        .checkbox-container legend {
            padding: 0 10px;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .checkbox-container legend i {
            margin-right: 8px;
            color: var(--secondary-color);
        }

        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--secondary-color);
        }

        /* Submit Button */
        .submit-btn {
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
            transition: var(--transition);
            font-size: 1rem;
        }

        .submit-btn:hover {
            background: #cc8400;
            transform: translateY(-2px);
        }

        .btn-container {
            text-align: center;
            margin-top: 10px;
        }

        /* Message Styles */
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: var(--border-radius);
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .success {
            background-color: rgba(40, 167, 69, 0.1);
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .error {
            background-color: rgba(220, 53, 69, 0.1);
            border-left: 4px solid #dc3545;
            color: #721c24;
        }

        .no-requests {
            text-align: center;
            padding: 30px;
            color: var(--gray-color);
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .section-header {
                padding: 20px 15px;
            }
            
            .section-header h1 {
                font-size: 1.8rem;
            }
            
            .section-header p {
                font-size: 1rem;
            }
            
            th, td {
                padding: 12px 10px;
            }
            
            .action-btn {
                padding: 8px 12px;
                font-size: 0.85rem;
                margin-bottom: 5px;
            }
            
            .checkbox-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .section-header h1 {
                font-size: 1.6rem;
            }
            
            th, td {
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
            
            .checkbox-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <?php require 'sidebar.php'; ?>
    
    <div class="extra-class-container">
        <!-- First Section - Extra Class Requests -->
        <div class="section-header">
            <h1><i class="fas fa-calendar-plus"></i> Extra Class Requests</h1>
            <p>Review and manage pending requests for extra classes</p>
        </div>

        <div class="table-section">
            <div class="table-header">
                <h2><i class="fas fa-list"></i> Pending Requests</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-user"></i> Student Name</th>
                        <th><i class="fas fa-book"></i> Subject Name</th>
                        <th><i class="fas fa-sticky-note"></i> Notes</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['extraClassRequests'])): ?>
                        <?php foreach ($data['extraClassRequests'] as $request): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($request->student_name); ?></td>
                            <td><?php echo htmlspecialchars($request->subject_name); ?></td>
                            <td><?php echo htmlspecialchars($request->notes); ?></td>
                            <td>
                                <form action="<?php echo ROOT; ?>/school/approveRequest" method="post" style="display:inline;">
                                    <input type="hidden" name="request_type" value="extraclass">
                                    <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($request->request_id); ?>">
                                    <button type="submit" class="action-btn approve-btn">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                
                                <form action="<?php echo ROOT; ?>/school/declineRequest" method="post" style="display:inline;">
                                    <input type="hidden" name="request_type" value="extraclass">
                                    <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($request->request_id); ?>">
                                    <button type="submit" class="action-btn decline-btn">
                                        <i class="fas fa-times"></i> Decline
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="no-requests"><i class="fas fa-info-circle"></i> No pending extra class requests</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Second Section - Schedule Extra Class -->
        <div class="section-header">
            <h1><i class="fas fa-calendar-alt"></i> Schedule Extra Class</h1>
            <p>Create a new extra class and select students to attend</p>
        </div>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="message success">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_SESSION['success_message']) ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php elseif (isset($_SESSION['error_message'])): ?>
            <div class="message error">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_SESSION['error_message']) ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <div class="form-section">
            <div class="table-header">
                <h2><i class="fas fa-edit"></i> Class Details</h2>
            </div>
            <div class="form-content">
                <form method="post" action="<?php echo ROOT; ?>/school/scheduleEx">
                    <div class="form-group">
                        <div class="checkbox-container">
                            <legend><i class="fas fa-users"></i> Select Players</legend>
                            <div class="checkbox-grid">
                                <?php if (!empty($players)): ?>
                                    <?php foreach ($players as $player): ?>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="player-<?= htmlspecialchars($player->user_id) ?>" name="players[]" value="<?= htmlspecialchars($player->user_id) ?>">
                                            <label for="player-<?= htmlspecialchars($player->user_id) ?>"><?= htmlspecialchars($player->firstname . ' ' . $player->lastname) ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p><i class="fas fa-exclamation-circle"></i> No players available for selection.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject"><i class="fas fa-book"></i> Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Enter subject name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description"><i class="fas fa-align-left"></i> Description</label>
                        <textarea id="description" name="description" rows="4" placeholder="Write a brief description of the class"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="date"><i class="fas fa-calendar-day"></i> Class Date</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="venue"><i class="fas fa-map-marker-alt"></i> Venue</label>
                        <input type="text" id="venue" name="venue" placeholder="Enter class venue" required>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> Schedule Class
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
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
</body>
</html>