<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Athletics Performance Tracking | TrackMaster</title>
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

            /* Athletics Container */
            .athletics-container {
                max-width: 1200px;
                margin: 20px auto;
                padding: 20px;
            }

            /* Header Section */
            .athletics-header {
                text-align: center;
                margin-bottom: 30px;
                padding: 25px;
                background: var(--primary-color);
                color: white;
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
            }

            .athletics-header h1 {
                font-size: 2.2rem;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
            }

            .athletics-header p {
                font-size: 1.1rem;
                opacity: 0.9;
                max-width: 700px;
                margin: 0 auto;
            }

            /* Performance Cards Grid */
            .performance-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 25px;
                margin-top: 20px;
            }

            /* Performance Cards */
            .performance-card {
                background: white;
                border-radius: var(--border-radius);
                overflow: hidden;
                box-shadow: var(--box-shadow);
                transition: var(--transition);
                cursor: pointer;
                display: flex;
                flex-direction: column;
                height: 100%;
                border: 1px solid rgba(0, 38, 77, 0.1);
            }

            .performance-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 38, 77, 0.15);
            }

            .card-icon {
                height: 120px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--light-color);
                color: var(--primary-color);
                font-size: 3rem;
                padding: 20px;
            }

            .card-content {
                padding: 25px;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

            .card-content h2 {
                color: var(--primary-color);
                margin-bottom: 15px;
                font-size: 1.4rem;
                position: relative;
                padding-bottom: 10px;
            }

            .card-content h2::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 50px;
                height: 3px;
                background: var(--secondary-color);
            }

            .card-content p {
                color: var(--gray-color);
                margin-bottom: 20px;
                line-height: 1.5;
                flex-grow: 1;
            }

            .card-footer {
                margin-top: auto;
                text-align: right;
            }

            .card-footer span {
                color: var(--secondary-color);
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                transition: var(--transition);
            }

            .performance-card:hover .card-footer span {
                color: #cc8400;
                transform: translateX(5px);
            }

            /* Card Color Variants */
            .sprint-100m-card .card-icon {
                background: rgba(0, 38, 77, 0.1);
            }

            .sprint-200m-card .card-icon {
                background: rgba(255, 165, 0, 0.1);
            }

            .sprint-400m-card .card-icon {
                background: rgba(0, 128, 0, 0.1);
                color: #006400;
            }

            .update-performance-card .card-icon {
                background: rgba(75, 0, 130, 0.1);
                color: #4b0082;
            }

            /* Stats Display Panel */
            .stats-panel {
                background: white;
                border-radius: var(--border-radius);
                padding: 25px;
                margin-top: 30px;
                box-shadow: var(--box-shadow);
                display: none;
            }

            .stats-panel.active {
                display: block;
            }

            .stats-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 15px;
                border-bottom: 1px solid #eee;
            }

            .stats-header h2 {
                color: var(--primary-color);
                font-size: 1.6rem;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .close-stats {
                background: none;
                border: none;
                color: var(--gray-color);
                font-size: 1.5rem;
                cursor: pointer;
                transition: var(--transition);
            }

            .close-stats:hover {
                color: var(--primary-color);
            }

            .stat-boxes {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                margin-bottom: 25px;
            }

            .stat-box {
                background: var(--light-color);
                border-radius: var(--border-radius);
                padding: 15px;
                text-align: center;
                transition: var(--transition);
            }

            .stat-box:hover {
                transform: translateY(-3px);
                box-shadow: var(--box-shadow);
            }

            .stat-title {
                color: var(--gray-color);
                font-size: 0.9rem;
                margin-bottom: 8px;
            }

            .stat-value {
                color: var(--primary-color);
                font-size: 1.8rem;
                font-weight: 600;
            }

            .stat-subtitle {
                color: var(--secondary-color);
                font-size: 0.85rem;
                margin-top: 5px;
            }

            /* Time History Section */
            .time-history {
                margin-top: 25px;
            }

            .time-history h3 {
                color: var(--primary-color);
                margin-bottom: 15px;
                font-size: 1.3rem;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .history-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
                box-shadow: var(--box-shadow);
                border-radius: var(--border-radius);
                overflow: hidden;
            }

            .history-table th, 
            .history-table td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #eee;
            }

            .history-table th {
                background: var(--primary-color);
                color: white;
                font-weight: 500;
            }

            .history-table tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .history-table tr:hover {
                background-color: #f1f1f1;
            }

            /* Modal Styles */
            .performance-modal {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: white;
                border-radius: var(--border-radius);
                box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
                width: 90%;
                max-width: 500px;
                z-index: 1001;
                display: none;
            }

            .performance-modal.active {
                display: block;
            }

            .modal-content {
                padding: 25px;
                position: relative;
            }

            .close-modal {
                position: absolute;
                top: 15px;
                right: 15px;
                font-size: 1.5rem;
                cursor: pointer;
                color: var(--gray-color);
                transition: var(--transition);
            }

            .close-modal:hover {
                color: var(--primary-color);
            }

            .modal-content h3 {
                color: var(--primary-color);
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 1.3rem;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                color: var(--primary-color);
                font-weight: 500;
            }

            .form-control {
                width: 100%;
                padding: 12px 15px;
                border: 1px solid #ddd;
                border-radius: var(--border-radius);
                font-size: 1rem;
                transition: var(--transition);
            }

            .form-control:focus {
                border-color: var(--secondary-color);
                outline: none;
                box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
            }

            .submit-btn {
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
                width: 100%;
                justify-content: center;
            }

            .submit-btn:hover {
                background: #cc8400;
            }

            .modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                display: none;
            }

            .modal-overlay.active {
                display: block;
            }

            /* Progress Chart */
            .progress-chart {
                margin-top: 30px;
                background: white;
                border-radius: var(--border-radius);
                padding: 20px;
                box-shadow: var(--box-shadow);
            }

            .chart-container {
                height: 300px;
                width: 100%;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .athletics-header {
                    padding: 20px 15px;
                }
                
                .athletics-header h1 {
                    font-size: 1.8rem;
                }
                
                .athletics-header p {
                    font-size: 1rem;
                }
                
                .performance-grid {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }
                
                .card-icon {
                    height: 100px;
                    font-size: 2.5rem;
                }
                
                .card-content {
                    padding: 20px;
                }
                
                .modal-content {
                    padding: 20px 15px;
                }

                .stat-boxes {
                    grid-template-columns: 1fr 1fr;
                }

                .chart-container {
                    height: 250px;
                }
            }

            @media (max-width: 480px) {
                .athletics-header h1 {
                    font-size: 1.6rem;
                }
                
                .card-content h2 {
                    font-size: 1.2rem;
                }
                
                .card-content p {
                    font-size: 0.95rem;
                }

                .stat-boxes {
                    grid-template-columns: 1fr;
                }

                .history-table th, 
                .history-table td {
                    padding: 10px 8px;
                    font-size: 0.9rem;
                }
            }
        </style>
    </head>
    <body>
        <?php require 'CoachNav.php'; ?>

        <div class="athletics-container">
            <div class="athletics-header">
                <h1><i class="fas fa-running"></i> Athletics Performance Center</h1>
                <p>Track, analyze, and improve sprint performances with detailed statistics for 100m, 200m, and 400m events</p>
            </div>

            <div class="performance-grid">
                <!-- 100m Performance Card -->
                <div class="performance-card sprint-100m-card">
                    <div class="card-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="card-content">
                        <h2>100m Sprint</h2>
                        <p>View detailed performance metrics, average times, and progress history for 100m sprint events.</p>
                        <div class="card-footer">
                            <span>View Performance <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>

                <!-- 200m Performance Card -->
                <div class="performance-card sprint-200m-card">
                    <div class="card-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <div class="card-content">
                        <h2>200m Sprint</h2>
                        <p>Analyze 200m sprint statistics, track improvements, and view historical performance data.</p>
                        <div class="card-footer">
                            <span>View Performance <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>

                <!-- 400m Performance Card -->
                <div class="performance-card sprint-400m-card">
                    <div class="card-icon">
                        <i class="fas fa-stopwatch"></i>
                    </div>
                    <div class="card-content">
                        <h2>400m Sprint</h2>
                        <p>Track 400m performance metrics including average times, personal bests, and improvement rates.</p>
                        <div class="card-footer">
                            <span>View Performance <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Update Performance Card -->
                <div class="performance-card update-performance-card" onclick="showUpdateModal()">
                    <div class="card-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="card-content">
                        <h2>Add New Time</h2>
                        <p>Record a new sprint time for any distance to update performance data and track progress.</p>
                        <div class="card-footer">
                            <span>Add Time <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Panel (Initially Hidden) -->
            <div id="statsPanel" class="stats-panel">
                <div class="stats-header">
                    <h2><i id="statsPanelIcon" class="fas fa-bolt"></i> <span id="statsPanelTitle">100m Sprint Performance</span></h2>
                    <button class="close-stats" onclick="closeStatsPanel()">&times;</button>
                </div>

                <div class="stat-boxes">
                    <div class="stat-box">
                        <div class="stat-title">Average Time</div>
                        <div id="averageTime" class="stat-value">11.82s</div>
                        <div class="stat-subtitle">Last 5 attempts</div>
                    </div>
                    
                    <div class="stat-box">
                        <div class="stat-title">Personal Best</div>
                        <div id="personalBest" class="stat-value">11.34s</div>
                        <div class="stat-subtitle">All time</div>
                    </div>
                    
                    <div class="stat-box">
                        <div class="stat-title">Recent Trend</div>
                        <div id="recentTrend" class="stat-value">-0.12s</div>
                        <div class="stat-subtitle">Improvement</div>
                    </div>
                    
                    <div class="stat-box">
                        <div class="stat-title">Total Records</div>
                        <div id="totalRecords" class="stat-value">24</div>
                        <div class="stat-subtitle">Logged times</div>
                    </div>
                </div>

                <div class="progress-chart">
                    <h3><i class="fas fa-chart-line"></i> Performance Trend</h3>
                    <div class="chart-container">
                        <!-- Chart would be rendered here via JavaScript -->
                        <img src="/api/placeholder/800/300" alt="Performance trend chart" style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--border-radius);">
                    </div>
                </div>

                <div class="time-history">
                    <h3><i class="fas fa-history"></i> Time History</h3>
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time (s)</th>
                                <th>Location</th>
                                <th>Conditions</th>
                            </tr>
                        </thead>
                        <tbody id="timeHistoryBody">
                            <!-- Sample data - would be dynamically populated -->
                            <tr>
                                <td>April 22, 2025</td>
                                <td>11.56</td>
                                <td>Main Track</td>
                                <td>Clear</td>
                            </tr>
                            <tr>
                                <td>April 18, 2025</td>
                                <td>11.62</td>
                                <td>Main Track</td>
                                <td>Windy</td>
                            </tr>
                            <tr>
                                <td>April 15, 2025</td>
                                <td>11.75</td>
                                <td>Indoor Track</td>
                                <td>Controlled</td>
                            </tr>
                            <tr>
                                <td>April 10, 2025</td>
                                <td>11.89</td>
                                <td>Main Track</td>
                                <td>Clear</td>
                            </tr>
                            <tr>
                                <td>April 5, 2025</td>
                                <td>11.94</td>
                                <td>Main Track</td>
                                <td>Cloudy</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Update Performance Modal -->
        <<div id="updateModal" class="performance-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('updateModal')">&times;</span>
            <h3><i class="fas fa-plus-circle"></i> Add New Sprint Time</h3>
            <form id="updatePerformanceForm">
                <div class="form-group">
                    <label for="name">Select Player:</label>
                    <select id="name" class="form-control" required>
                        <option value="">-- Select Player --</option>
                        <?php foreach($data['players'] as $player): ?>
                            <option value="<?php echo $player->player_id; ?>">
                                <?php echo htmlspecialchars($player->firstname . ' ' . $player->lname); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sprintDistance">Select Distance:</label>
                    <select id="sprintDistance" class="form-control" required>
                        <option value="">-- Select Distance --</option>
                        <?php foreach($data['events'] as $event): ?>
                            <option value="<?php echo $event->event_id; ?>">
                                <?php echo htmlspecialchars($event->event_name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="sprintTime">Time (seconds):</label>
                    <input type="number" id="sprintTime" class="form-control" step="0.01" min="9" max="60" placeholder="e.g. 11.56" required>
                </div>

                <div class="form-group">
                    <label for="sprintTime">Time (seconds):</label>
                    <input type="number" id="sprintTime" class="form-control" step="0.01" min="9" max="60" placeholder="e.g. 11.56" required>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i> Save Time
                </button>
            </form>
        </div>
    </div>

    <!-- Player Selection Modal -->
<div id="playerSelectModal" class="performance-modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('playerSelectModal')">&times;</span>
        <h3><i class="fas fa-users"></i> Select Player</h3>
        <div class="form-group">
            <label for="playerSelect">Choose Player:</label>
            <select id="playerSelect" class="form-control" required>
                <option value="">-- Select Player --</option>
                <?php foreach($data['players'] as $player): ?>
                    <option value="<?php echo $player->player_id; ?>">
                        <?php echo htmlspecialchars($player->firstname . ' ' . $player->lname); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button onclick="proceedToPerformance()" class="submit-btn">
            <i class="fas fa-arrow-right"></i> View Performance
        </button>
    </div>
</div>

        <div class="modal-overlay" id="modalOverlay"></div>

        <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
        
       
    </body>
    </html>