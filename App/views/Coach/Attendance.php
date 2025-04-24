<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracking | TrackMaster</title>
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
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
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

        /* Attendance Container */
        .attendance-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .attendance-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .attendance-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .attendance-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Main Content */
        .attendance-content {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        /* Filter Section */
        .attendance-filters {
            padding: 20px;
            background-color: var(--light-color);
            border-bottom: 1px solid #eee;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            margin-bottom: 8px;
            color: var(--primary-color);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .filter-group select, 
        .filter-group input[type="date"] {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .filter-group select:focus, 
        .filter-group input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        .filter-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }

        .btn {
            padding: 10px 15px;
            border-radius: var(--border-radius);
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #cc8400;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--gray-color);
            color: var(--gray-color);
        }

        .btn-outline:hover {
            background-color: #f0f0f0;
        }

        /* Attendance Table */
        .attendance-table-container {
            padding: 20px;
            overflow-x: auto;
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        .attendance-table th {
            background-color: #f8f9fa;
            color: var(--primary-color);
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #eee;
        }

        .attendance-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: var(--dark-color);
        }

        .attendance-table tr:hover {
            background-color: #f8f9fa;
        }

        .attendance-table .player-name {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .player-image {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--primary-color);
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-present {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .status-absent {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        .status-late {
            background-color: rgba(255, 193, 7, 0.1);
            color: #856404;
        }

        /* Toggle Switches */
        .attendance-toggle {
            display: flex;
            gap: 15px;
        }

        .toggle-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .toggle-label {
            font-size: 0.85rem;
            margin-left: 8px;
            color: var(--gray-color);
        }

        .toggle-input {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }

        .toggle-slider {
            position: relative;
            display: inline-block;
            width: 36px;
            height: 20px;
            background-color: #ccc;
            border-radius: 20px;
            transition: var(--transition);
            cursor: pointer;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            border-radius: 50%;
            transition: var(--transition);
        }

        .toggle-input:checked + .toggle-slider {
            background-color: var(--success-color);
        }

        .toggle-input:checked + .toggle-slider:before {
            transform: translateX(16px);
        }

        .toggle-input.late:checked + .toggle-slider {
            background-color: var(--warning-color);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-top: 1px solid #eee;
            background-color: var(--light-color);
        }

        .attendance-count {
            display: flex;
            gap: 15px;
        }

        .count-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .count-present {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .count-absent {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        .count-late {
            background-color: rgba(255, 193, 7, 0.1);
            color: #856404;
        }

        .action-right .btn {
            padding: 12px 20px;
            font-weight: 600;
        }

        /* Attendance Notes */
        .notes-section {
            margin-top: 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            border: 1px solid rgba(0, 38, 77, 0.1);
            padding: 20px;
        }

        .notes-section h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.3rem;
            position: relative;
            padding-bottom: 10px;
        }

        .notes-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .notes-textarea {
            width: 100%;
            min-height: 120px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            resize: vertical;
            margin-bottom: 15px;
            transition: var(--transition);
        }

        .notes-textarea:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-color);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #ddd;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        /* Search Section */
        .search-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .search-section h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.3rem;
            position: relative;
            padding-bottom: 10px;
        }

        .search-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .search-container {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .search-input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .search-input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        .search-btn {
            padding: 12px 20px;
            background-color: var(--secondary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .search-btn:hover {
            background-color: #cc8400;
        }

        /* Player Attendance History */
        .player-attendance-history {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-top: 20px;
            padding: 20px;
            border: 1px solid rgba(0, 38, 77, 0.1);
            display: none;
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .history-header h3 {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin: 0;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th {
            background-color: #f8f9fa;
            color: var(--primary-color);
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #eee;
        }

        .history-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: var(--dark-color);
        }

        .history-table tr:hover {
            background-color: #f8f9fa;
        }

        .history-stats {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .history-stat {
            background-color: rgba(0, 38, 77, 0.05);
            padding: 15px;
            border-radius: var(--border-radius);
            flex: 1;
            min-width: 150px;
            text-align: center;
        }

        .history-stat h4 {
            color: var(--primary-color);
            margin-bottom: 5px;
            font-size: 1rem;
        }

        .history-stat p {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .attendance-header {
                padding: 20px 15px;
            }
            
            .attendance-header h1 {
                font-size: 1.8rem;
            }
            
            .attendance-filters {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .filter-actions {
                flex-direction: column;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 15px;
            }
            
            .attendance-count {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .search-container {
                flex-direction: column;
            }
            
            .history-stats {
                flex-direction: column;
                gap: 10px;
            }
            
            .history-stat {
                min-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .attendance-container {
                padding: 10px;
            }
            
            .attendance-header h1 {
                font-size: 1.6rem;
            }
            
            .attendance-table-container {
                padding: 10px;
            }
            
            .attendance-table th,
            .attendance-table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="attendance-container">
        <div class="attendance-header">
            <h1><i class="fas fa-clipboard-check"></i> Attendance Tracking</h1>
            <p>Record and track player attendance for training sessions and matches</p>
        </div>

        <!-- Main Attendance Content -->
        <div class="attendance-content">
            <!-- Filters Section -->
            <div class="attendance-filters">
                <div class="filter-group">
                    <label for="teamSelect"><i class="fas fa-users"></i> Select Team</label>
                    <select id="teamSelect">
                        <option value="">All Players</option>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?= $team->team_id ?>"><?= $team->team_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="sessionType"><i class="fas fa-clipboard-list"></i> Session Type</label>
                    <select id="sessionType">
                        <option value="training">Training Session</option>
                        <option value="match">Match Day</option>
                        <option value="fitness">Fitness Session</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="attendanceDate"><i class="fas fa-calendar-alt"></i> Date</label>
                    <input type="date" id="attendanceDate" value="<?= date('Y-m-d') ?>">
                </div>

                <div class="filter-group">
                    <label for="locationSelect"><i class="fas fa-map-marker-alt"></i> Location</label>
                    <select id="locationSelect">
                        <option value="main-ground">Main Ground</option>
                        <option value="practice-nets">Practice Nets</option>
                        <option value="gym">Gym Facility</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="filter-group">
                    <div class="filter-actions">
                        <button class="btn btn-primary" id="loadPlayers">
                            <i class="fas fa-sync-alt"></i> Load Players
                        </button>
                        <button class="btn btn-outline" id="clearFilters">
                            <i class="fas fa-times"></i> Clear
                        </button>
                    </div>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="attendance-table-container">
                <table class="attendance-table">
                    <thead>
                        <tr>
                            <th width="40%">Player Name</th>
                            <th width="15%">Player ID</th>
                            <th width="25%">Status</th>
                            <th width="20%">Mark Attendance</th>
                        </tr>
                    </thead>
                    <tbody id="playersList">
                        <tr>
                            <td colspan="4" class="empty-state">
                                <i class="fas fa-user-friends"></i>
                                <p>No players loaded yet</p>
                                <p>Select filters and click "Load Players" to begin</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons" style="display: none;" id="attendanceActions">
                <div class="attendance-count">
                    <div class="count-item count-present">
                        <i class="fas fa-check-circle"></i> Present: <span id="presentCount">0</span>
                    </div>
                    <div class="count-item count-absent">
                        <i class="fas fa-times-circle"></i> Absent: <span id="absentCount">0</span>
                    </div>
                    <div class="count-item count-late">
                        <i class="fas fa-clock"></i> Late: <span id="lateCount">0</span>
                    </div>
                </div>
                <div class="action-right">
                    <button class="btn btn-primary" id="saveAttendance">
                        <i class="fas fa-save"></i> Save Attendance
                    </button>
                </div>
            </div>
        </div>


        <!-- Search Player Section -->
        <div class="search-section">
            <h2><i class="fas fa-search"></i> Search Player Attendance</h2>
            <div class="search-container">
                <input type="text" class="search-input" id="playerSearch" placeholder="Search by player name or ID...">
                <button class="search-btn" id="searchPlayerBtn"><i class="fas fa-search"></i> Search</button>
            </div>
            
            <!-- Player Info Display (hidden by default) -->
            <div id="playerInfo" style="display: none;"></div>
        </div>

        <!-- Player Attendance History Section -->
        <div class="player-attendance-history" id="playerAttendanceHistory">
            <div class="history-header">
                <h3><i class="fas fa-history"></i> Attendance History</h3>
                <button class="btn btn-outline" id="closeHistory">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
            
            <div class="history-stats"></div>
            
            <div style="overflow-x: auto; margin-top: 20px;">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th width="25%">Date</th>
                            <th width="25%">Session Type</th>
                            <th width="25%">Location</th>
                            <th width="25%">Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            
            <div style="margin-top: 20px; text-align: center;">
                <button class="btn btn-outline">
                    <i class="fas fa-download"></i> Export Full History
                </button>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        // Define ROOT constant if not already defined
        const ROOT = '<?= URLROOT ?>';
        
        document.addEventListener('DOMContentLoaded', function() {
            // Load Players Button
            document.getElementById('loadPlayers').addEventListener('click', function() {
                const teamId = document.getElementById('teamSelect').value;
                const sessionType = document.getElementById('sessionType').value;
                const sessionDate = document.getElementById('attendanceDate').value;
                const location = document.getElementById('locationSelect').value;
                
                // Show loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                
                fetch(ROOT + '/coach/loadPlayers', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `team_id=${teamId}`
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button state
                    this.innerHTML = '<i class="fas fa-sync-alt"></i> Load Players';
                    
                    if (data.status === 'success') {
                        updatePlayersTable(data.players, teamId, sessionType, sessionDate, location);
                        document.getElementById('attendanceActions').style.display = 'flex';
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.innerHTML = '<i class="fas fa-sync-alt"></i> Load Players';
                    alert('An error occurred while loading players');
                });
            });
            
            // Clear Filters Button
            document.getElementById('clearFilters').addEventListener('click', function() {
                document.getElementById('teamSelect').value = '';
                document.getElementById('sessionType').value = 'training';
                document.getElementById('attendanceDate').value = new Date().toISOString().split('T')[0];
                document.getElementById('locationSelect').value = 'main-ground';
                
                // Reset the players table
                const tableBody = document.getElementById('playersList');
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="empty-state">
                            <i class="fas fa-user-friends"></i>
                            <p>No players loaded yet</p>
                            <p>Select filters and click "Load Players" to begin</p>
                        </td>
                    </tr>
                `;
                
                // Hide action buttons
                document.getElementById('attendanceActions').style.display = 'none';
            });
            
            // Save Attendance Button
            document.getElementById('saveAttendance').addEventListener('click', function() {
    const teamId = document.getElementById('teamSelect').value;
    const sessionType = document.getElementById('sessionType').value;
    const sessionDate = document.getElementById('attendanceDate').value;
    const location = document.getElementById('locationSelect').value;
    
    // Get current time for start/end time
    const now = new Date();
    const startTime = now.toTimeString().substring(0, 8);
    const endTime = new Date(now.getTime() + 60 * 60 * 1000).toTimeString().substring(0, 8); // +1 hour
    
    // Collect attendance data
    const attendanceData = [];
    const rows = document.querySelectorAll('#playersList tr');
    
    rows.forEach(row => {
        // Skip if it's the empty state row
        if (row.querySelector('.empty-state')) return;
        
        const playerId = row.querySelector('td:nth-child(2)').textContent;
        const presentCheckbox = row.querySelector('.toggle-input:not(.late)');
        const lateCheckbox = row.querySelector('.toggle-input.late');
        
        let status;
        let notes = '';
        
        if (presentCheckbox.checked && !lateCheckbox.checked) {
            status = 'present';
        } else if (presentCheckbox.checked && lateCheckbox.checked) {
            status = 'late';
            notes = 'Player arrived late';
        } else {
            status = 'absent';
            notes = 'Player absent';
        }
        
        attendanceData.push({
            player_id: playerId,
            status: status,
            notes: notes
        });
    });
    
    // Show loading state
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    
    fetch(ROOT + '/coach/saveAttendance', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `team_id=${teamId}&session_type=${sessionType}&session_date=${sessionDate}&start_time=${startTime}&end_time=${endTime}&location=${location}&attendance_data=${encodeURIComponent(JSON.stringify(attendanceData))}`
    })
    .then(response => {
        // First check if response is ok
        if (!response.ok) {
            throw new Error(`Server returned ${response.status}: ${response.statusText}`);
        }
        
        // Parse JSON response
        return response.json();
    })
    .then(data => {
        // Reset button state
        this.innerHTML = '<i class="fas fa-save"></i> Save Attendance';
        
        if (data.status === 'success') {
            alert('Attendance saved successfully!');
            // Optionally reset the form
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        this.innerHTML = '<i class="fas fa-save"></i> Save Attendance';
        alert('An error occurred while saving attendance');
    });
});
            
            // Search Player Button
            document.getElementById('searchPlayerBtn').addEventListener('click', function() {
                const searchTerm = document.getElementById('playerSearch').value.trim();
                
                if (searchTerm === '') {
                    alert('Please enter a player name or ID');
                    return;
                }
                
                // Show loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';
                
                fetch(ROOT + '/coach/searchPlayerAttendance', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `search_term=${encodeURIComponent(searchTerm)}`
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button state
                    this.innerHTML = '<i class="fas fa-search"></i> Search';
                    
                    if (data.status === 'success') {
                        displayPlayerAttendance(data.data);
                    } else if (data.status === 'not_found') {
                        alert(data.message);    
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.innerHTML = '<i class="fas fa-search"></i> Search';
                    alert('An error occurred while searching');
                });
            });
            
            // Close History Button
            document.getElementById('closeHistory').addEventListener('click', function() {
                document.getElementById('playerAttendanceHistory').style.display = 'none';
            });
            
            // Allow pressing Enter in search field
            document.getElementById('playerSearch').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    document.getElementById('searchPlayerBtn').click();
                }
            });
            
            // Helper function to update players table
            function updatePlayersTable(players, teamId, sessionType, sessionDate, location) {
                const tableBody = document.getElementById('playersList');
                tableBody.innerHTML = '';
                
                if (players.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="4" class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <p>No players found</p>
                                <p>Try different filters</p>
                            </td>
                        </tr>
                    `;
                    return;
                }
                
                players.forEach(player => {
                    const row = document.createElement('tr');
                    
                    // Player Name Column
                    const nameCell = document.createElement('td');
                    const initials = (player.firstname.charAt(0) + (player.lname ? player.lname.charAt(0) : '')).toUpperCase();
                    
                    nameCell.innerHTML = `
                        <div class="player-name">
                            <div class="player-image">${initials}</div>
                            <div>
                                <div>${player.firstname} ${player.lname || ''}</div>
                                <small class="text-muted">${player.player_role || player.role || 'Player'}</small>
                            </div>
                        </div>
                    `;
                    
                    // Player ID Column
                    const idCell = document.createElement('td');
                    idCell.textContent = player.player_id;
                    
                    // Status Column (default to present)
                    const statusCell = document.createElement('td');
                    statusCell.innerHTML = '<span class="status-badge status-present">Present</span>';
                    
                    // Attendance Toggle Column
                    const toggleCell = document.createElement('td');
                    toggleCell.innerHTML = `
                        <div class="attendance-toggle">
                            <div class="toggle-wrapper">
                                <input type="checkbox" id="present-${player.player_id}" class="toggle-input" checked>
                                <label class="toggle-slider" for="present-${player.player_id}"></label>
                                <span class="toggle-label">Present</span>
                            </div>
                            <div class="toggle-wrapper">
                                <input type="checkbox" id="late-${player.player_id}" class="toggle-input late">
                                <label class="toggle-slider" for="late-${player.player_id}"></label>
                                <span class="toggle-label">Late</span>
                            </div>
                        </div>
                    `;
                    
                    // Add event listeners to toggles
                    const presentCheckbox = toggleCell.querySelector(`#present-${player.player_id}`);
                    const lateCheckbox = toggleCell.querySelector(`#late-${player.player_id}`);
                    
                    presentCheckbox.addEventListener('change', function() {
                        if (!this.checked) {
                            lateCheckbox.checked = false;
                            lateCheckbox.disabled = true;
                            statusCell.innerHTML = '<span class="status-badge status-absent">Absent</span>';
                        } else {
                            lateCheckbox.disabled = false;
                            if (lateCheckbox.checked) {
                                statusCell.innerHTML = '<span class="status-badge status-late">Late</span>';
                            } else {
                                statusCell.innerHTML = '<span class="status-badge status-present">Present</span>';
                            }
                        }
                        updateCounts();
                    });
                    
                    lateCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            statusCell.innerHTML = '<span class="status-badge status-late">Late</span>';
                        } else {
                            statusCell.innerHTML = '<span class="status-badge status-present">Present</span>';
                        }
                        updateCounts();
                    });
                    
                    // Append cells to row
                    row.appendChild(nameCell);
                    row.appendChild(idCell);
                    row.appendChild(statusCell);
                    row.appendChild(toggleCell);
                    
                    // Append row to table
                    tableBody.appendChild(row);
                });
                
                // Update counts
                updateCounts();
            }
            
            // Helper function to update attendance counts
            function updateCounts() {
                let presentCount = 0;
                let absentCount = 0;
                let lateCount = 0;
                
                document.querySelectorAll('#playersList tr').forEach(row => {
                    // Skip if it's the empty state row
                    if (row.querySelector('.empty-state')) return;
                    
                    const presentCheckbox = row.querySelector('.toggle-input:not(.late)');
                    const lateCheckbox = row.querySelector('.toggle-input.late');
                    
                    if (!presentCheckbox.checked) {
                        absentCount++;
                    } else if (lateCheckbox.checked) {
                        lateCount++;
                    } else {
                        presentCount++;
                    }
                });
                
                document.getElementById('presentCount').textContent = presentCount;
                document.getElementById('absentCount').textContent = absentCount;
                document.getElementById('lateCount').textContent = lateCount;
            }
            
            // Helper function to display player attendance
            function displayPlayerAttendance(data) {
                const player = data.player;
                const history = data.history;
                const stats = data.stats;
                
                // Display player info
                const playerInfo = document.getElementById('playerInfo');
                const initials = (player.firstname.charAt(0) + (player.lname ? player.lname.charAt(0) : '')).toUpperCase();
                
                playerInfo.innerHTML = `
                    <div class="player-name" style="margin-bottom: 15px;">
                        <div class="player-image" style="width: 50px; height: 50px; font-size: 1.2rem;">${initials}</div>
                        <div style="margin-left: 10px;">
                            <h3 style="margin: 0; color: var(--primary-color);">${player.firstname} ${player.lname || ''}</h3>
                            <p style="margin: 5px 0 0; color: var(--gray-color);">Player ID: ${player.player_id} | ${player.role} | ${player.school_name || 'No school'}</p>
                        </div>
                    </div>
                `;
                playerInfo.style.display = 'block';
                
                // Display stats
                const historySection = document.getElementById('playerAttendanceHistory');
                const statsContainer = historySection.querySelector('.history-stats');
                const attendanceRate = stats.total_sessions > 0 
                    ? Math.round((stats.present_count / stats.total_sessions) * 100) 
                    : 0;
        
        statsContainer.innerHTML = `
            <div class="history-stat">
                <h4>Total Sessions</h4>
                <p>${stats.total_sessions || 0}</p>
            </div>
            <div class="history-stat">
                <h4>Present</h4>
                <p>${stats.present_count || 0}</p>
            </div>
            <div class="history-stat">
                <h4>Absent</h4>
                <p>${stats.absent_count || 0}</p>
            </div>
            <div class="history-stat">
                <h4>Late</h4>
                <p>${stats.late_count || 0}</p>
            </div>
            <div class="history-stat">
                <h4>Attendance Rate</h4>
                <p>${attendanceRate}%</p>
            </div>
        `;
        
        // Display history table
        const historyTable = historySection.querySelector('.history-table tbody');
        historyTable.innerHTML = '';
        
        if (history.length === 0) {
            historyTable.innerHTML = '<tr><td colspan="5" style="text-align: center;">No attendance records found</td></tr>';
        } else {
            history.forEach(record => {
                const row = document.createElement('tr');
                
                // Format status badge
                let statusBadge;
                switch (record.status) {
                    case 'present':
                        statusBadge = '<span class="status-badge status-present">Present</span>';
                        break;
                    case 'absent':
                        statusBadge = '<span class="status-badge status-absent">Absent</span>';
                        break;
                    case 'late':
                        statusBadge = '<span class="status-badge status-late">Late</span>';
                        break;
                    default:
                        statusBadge = '<span class="status-badge">Unknown</span>';
                }
                
                row.innerHTML = `
                    <td>${record.session_date}</td>
                    <td>${record.session_type}</td>
                    <td>${record.location}</td>
                    <td>${statusBadge}</td>
                    <td>${record.notes || ''}</td>
                `;
                
                historyTable.appendChild(row);
            });
        }
        
        // Show the history section
        historySection.style.display = 'block';
        historySection.scrollIntoView({ behavior: 'smooth' });
    }
});
    </script>
</body>
</html>