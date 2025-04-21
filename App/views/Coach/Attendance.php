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
            display: none; /* Initially hidden */
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

        /* Responsive Adjustments */
        @media (max-width: 768px) {
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
                        <option value="">All Teams</option>
                        <option value="1">Under-19 Team</option>
                        <option value="2">Senior Team</option>
                        <option value="3">Women's Team</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="sessionType"><i class="fas fa-clipboard-list"></i> Session Type</label>
                    <select id="sessionType">
                        <option value="training">Training Session</option>
                        <option value="match">Match Day</option>
                        <option value="fitness">Fitness Session</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="attendanceDate"><i class="fas fa-calendar-alt"></i> Date</label>
                    <input type="date" id="attendanceDate" value="2025-04-21">
                </div>

                <div class="filter-group">
                    <label for="locationSelect"><i class="fas fa-map-marker-alt"></i> Location</label>
                    <select id="locationSelect">
                        <option value="main-ground">Main Ground</option>
                        <option value="practice-nets">Practice Nets</option>
                        <option value="gym">Gym Facility</option>
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
                            <td>
                                <div class="player-name">
                                    <div class="player-image">JS</div>
                                    <div>
                                        <div>John Smith</div>
                                        <small class="text-muted">Batsman</small>
                                    </div>
                                </div>
                            </td>
                            <td>P001</td>
                            <td><span class="status-badge status-present">Present</span></td>
                            <td>
                                <div class="attendance-toggle">
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="present-P001" class="toggle-input" checked>
                                        <label class="toggle-slider" for="present-P001"></label>
                                        <span class="toggle-label">Present</span>
                                    </div>
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="late-P001" class="toggle-input late">
                                        <label class="toggle-slider" for="late-P001"></label>
                                        <span class="toggle-label">Late</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="player-name">
                                    <div class="player-image">RP</div>
                                    <div>
                                        <div>Rahul Patel</div>
                                        <small class="text-muted">All-rounder</small>
                                    </div>
                                </div>
                            </td>
                            <td>P002</td>
                            <td><span class="status-badge status-late">Late</span></td>
                            <td>
                                <div class="attendance-toggle">
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="present-P002" class="toggle-input" checked>
                                        <label class="toggle-slider" for="present-P002"></label>
                                        <span class="toggle-label">Present</span>
                                    </div>
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="late-P002" class="toggle-input late" checked>
                                        <label class="toggle-slider" for="late-P002"></label>
                                        <span class="toggle-label">Late</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="player-name">
                                    <div class="player-image">SK</div>
                                    <div>
                                        <div>Sarah Khan</div>
                                        <small class="text-muted">Bowler</small>
                                    </div>
                                </div>
                            </td>
                            <td>P003</td>
                            <td><span class="status-badge status-absent">Absent</span></td>
                            <td>
                                <div class="attendance-toggle">
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="present-P003" class="toggle-input">
                                        <label class="toggle-slider" for="present-P003"></label>
                                        <span class="toggle-label">Present</span>
                                    </div>
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="late-P003" class="toggle-input late" disabled>
                                        <label class="toggle-slider" for="late-P003"></label>
                                        <span class="toggle-label">Late</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="player-name">
                                    <div class="player-image">MJ</div>
                                    <div>
                                        <div>Michael Johnson</div>
                                        <small class="text-muted">Wicket-keeper</small>
                                    </div>
                                </div>
                            </td>
                            <td>P004</td>
                            <td><span class="status-badge status-present">Present</span></td>
                            <td>
                                <div class="attendance-toggle">
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="present-P004" class="toggle-input" checked>
                                        <label class="toggle-slider" for="present-P004"></label>
                                        <span class="toggle-label">Present</span>
                                    </div>
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="late-P004" class="toggle-input late">
                                        <label class="toggle-slider" for="late-P004"></label>
                                        <span class="toggle-label">Late</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="player-name">
                                    <div class="player-image">AL</div>
                                    <div>
                                        <div>Anita Lee</div>
                                        <small class="text-muted">Batsman</small>
                                    </div>
                                </div>
                            </td>
                            <td>P005</td>
                            <td><span class="status-badge status-present">Present</span></td>
                            <td>
                                <div class="attendance-toggle">
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="present-P005" class="toggle-input" checked>
                                        <label class="toggle-slider" for="present-P005"></label>
                                        <span class="toggle-label">Present</span>
                                    </div>
                                    <div class="toggle-wrapper">
                                        <input type="checkbox" id="late-P005" class="toggle-input late">
                                        <label class="toggle-slider" for="late-P005"></label>
                                        <span class="toggle-label">Late</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <div class="attendance-count">
                    <div class="count-item count-present">
                        <i class="fas fa-check-circle"></i> Present: <span id="presentCount">4</span>
                    </div>
                    <div class="count-item count-absent">
                        <i class="fas fa-times-circle"></i> Absent: <span id="absentCount">1</span>
                    </div>
                    <div class="count-item count-late">
                        <i class="fas fa-clock"></i> Late: <span id="lateCount">1</span>
                    </div>
                </div>
                <div class="action-right">
                    <button class="btn btn-primary" id="saveAttendance">
                        <i class="fas fa-save"></i> Save Attendance
                    </button>
                </div>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="notes-section">
            <h2><i class="fas fa-sticky-note"></i> Session Notes</h2>
            <textarea class="notes-textarea" id="sessionNotes" placeholder="Add notes about the session, player performances or reasons for absence..."></textarea>
            <button class="btn btn-primary" id="saveNotes">
                <i class="fas fa-save"></i> Save Notes
            </button>
        </div>

           <!-- New Search Player Section -->
           <div class="search-section">
            <h2><i class="fas fa-search"></i> Search Player Attendance</h2>
            <div class="search-container">
                <input type="text" class="search-input" id="playerSearch" placeholder="Search by player name or ID...">
                <button class="search-btn" id="searchPlayerBtn"><i class="fas fa-search"></i> Search</button>
            </div>
            
            <!-- Player Info Display (hidden by default) -->
            <div id="playerInfo" style="display: none;">
                <div class="player-name" style="margin-bottom: 15px;">
                    <div class="player-image" style="width: 50px; height: 50px; font-size: 1.2rem;">JS</div>
                    <div style="margin-left: 10px;">
                        <h3 style="margin: 0; color: var(--primary-color);">John Smith</h3>
                        <p style="margin: 5px 0 0; color: var(--gray-color);">Player ID: P001 | Batsman | Under-19 Team</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Player Attendance History Section -->
        <div class="player-attendance-history" id="playerAttendanceHistory">
            <div class="history-header">
                <h3><i class="fas fa-history"></i> Attendance History</h3>
                <button class="btn btn-outline" id="closeHistory">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
            
            <div class="history-stats">
                <div class="history-stat">
                    <h4>Total Sessions</h4>
                    <p>24</p>
                </div>
                <div class="history-stat">
                    <h4>Present</h4>
                    <p>20</p>
                </div>
                <div class="history-stat">
                    <h4>Absent</h4>
                    <p>3</p>
                </div>
                <div class="history-stat">
                    <h4>Late</h4>
                    <p>1</p>
                </div>
                <div class="history-stat">
                    <h4>Attendance Rate</h4>
                    <p>83%</p>
                </div>
            </div>
            
            <div style="overflow-x: auto; margin-top: 20px;">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th width="20%">Date</th>
                            <th width="20%">Session Type</th>
                            <th width="20%">Location</th>
                            <th width="20%">Status</th>
                            <th width="20%">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2025-04-20</td>
                            <td>Training</td>
                            <td>Main Ground</td>
                            <td><span class="status-badge status-present">Present</span></td>
                            <td>Full participation</td>
                        </tr>
                        <tr>
                            <td>2025-04-18</td>
                            <td>Match</td>
                            <td>City Stadium</td>
                            <td><span class="status-badge status-present">Present</span></td>
                            <td>Played full match</td>
                        </tr>
                        <tr>
                            <td>2025-04-15</td>
                            <td>Training</td>
                            <td>Practice Nets</td>
                            <td><span class="status-badge status-late">Late</span></td>
                            <td>Arrived 15 mins late</td>
                        </tr>
                        <tr>
                            <td>2025-04-12</td>
                            <td>Fitness</td>
                            <td>Gym Facility</td>
                            <td><span class="status-badge status-absent">Absent</span></td>
                            <td>Injured - doctor's note</td>
                        </tr>
                        <tr>
                            <td>2025-04-10</td>
                            <td>Training</td>
                            <td>Main Ground</td>
                            <td><span class="status-badge status-present">Present</span></td>
                            <td>Good performance</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div style="margin-top: 20px; text-align: center;">
                <button class="btn btn-outline">
                    <i class="fas fa-download"></i> Export Full History
                </button>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="notes-section">
            <!-- ... (keep existing notes section) ... -->
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        // ... (keep all existing JavaScript) ...

        // New Search Player Functionality
        document.getElementById('searchPlayerBtn').addEventListener('click', function() {
            const searchTerm = document.getElementById('playerSearch').value.trim();
            
            if (searchTerm === '') {
                alert('Please enter a player name or ID');
                return;
            }
            
            // Show loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';
            
            // Simulate API call
            setTimeout(() => {
                // Reset button state
                this.innerHTML = '<i class="fas fa-search"></i> Search';
                
                // Show player info (in a real app, this would come from the API)
                document.getElementById('playerInfo').style.display = 'block';
                
                // Show attendance history
                document.getElementById('playerAttendanceHistory').style.display = 'block';
                
                // Scroll to history section
                document.getElementById('playerAttendanceHistory').scrollIntoView({
                    behavior: 'smooth'
                });
            }, 1000);
        });
        
        // Close history section
        document.getElementById('closeHistory').addEventListener('click', function() {
            document.getElementById('playerAttendanceHistory').style.display = 'none';
        });
        
        // Allow pressing Enter in search field
        document.getElementById('playerSearch').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('searchPlayerBtn').click();
            }
        });
    </script>
</body>
</html>