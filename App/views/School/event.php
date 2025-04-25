<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Requests | TrackMaster</title>
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

        /* Facilities Container */
        .facilities-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .facilities-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .facilities-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .facilities-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Facilities Table Section */
        .facilities-table-section {
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

        /* Flash Message Styles */
        .flash-message {
            padding: 15px;
            margin: 20px 0;
            border-radius: var(--border-radius);
            background-color: rgba(40, 167, 69, 0.1);
            border-left: 4px solid #28a745;
            color: #155724;
            text-align: center;
        }

        .no-requests {
            text-align: center;
            padding: 30px;
            color: var(--gray-color);
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .facilities-header {
                padding: 20px 15px;
            }
            
            .facilities-header h1 {
                font-size: 1.8rem;
            }
            
            .facilities-header p {
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
            
            .search-filter-section {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box, .filter-dropdown {
                min-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .facilities-header h1 {
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
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <?php require 'sidebar.php'; ?>
    
    <div class="facilities-container">
        <div class="facilities-header">
            <h1><i class="fas fa-building"></i> Facility Requests</h1>
            <p>Manage and respond to requests for sports facilities and equipment</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search requests..." id="requestSearch">
            </div>
            <div class="filter-dropdown">
                <select id="statusFilter">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="declined">Declined</option>
                </select>
            </div>
            <div class="filter-dropdown">
                <select id="dateFilter">
                    <option value="">All Dates</option>
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="thisWeek">This Week</option>
                    <option value="nextWeek">Next Week</option>
                </select>
            </div>
        </div>

        <!-- Facilities Table Section -->
        <div class="facilities-table-section">
            <div class="section-header">
                <h2><i class="fas fa-list"></i> Request List</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-calendar-alt"></i> Event Name</th>
                        <th><i class="fas fa-user"></i> Coach Name</th>
                        <th><i class="fas fa-clock"></i> Date and Time</th>
                        <th><i class="fas fa-building"></i> Facilities Required</th>
                        <th><i class="fas fa-tasks"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data['facilityRequests'])): ?>
                        <?php foreach($data['facilityRequests'] as $request): ?>
                        <tr>
                            <td><?php echo $request->event_name; ?></td>
                            <td><?php echo $request->coach_name; ?></td>
                            <td><?php echo $request->date . ' : ' . $request->start_time . ' - ' . $request->end_time; ?></td>
                            <td>
                                <form action="<?php echo ROOT; ?>/school/approveRequest" method="post" style="display:inline;">
                                    <input type="hidden" name="request_type" value="facility">
                                    <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                                    <button type="submit" class="action-btn approve-btn">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                
                                <form action="<?php echo ROOT; ?>/school/declineRequest" method="post" style="display:inline;">
                                    <input type="hidden" name="request_type" value="facility">
                                    <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>">
                                    <button type="submit" class="action-btn decline-btn">
                                        <i class="fas fa-times"></i> Decline
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="no-requests">No pending facility requests at this time</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($_SESSION['flash_message'])): ?>
        <div class="flash-message">
            <i class="fas fa-info-circle"></i> <?php echo $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?>
        </div>
        <?php endif; ?>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        // Simple search functionality
        document.getElementById('requestSearch').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const eventName = row.cells[0].textContent.toLowerCase();
                const coachName = row.cells[1].textContent.toLowerCase();
                const dateTime = row.cells[2].textContent.toLowerCase();
                
                if (eventName.includes(searchTerm) || coachName.includes(searchTerm) || dateTime.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

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