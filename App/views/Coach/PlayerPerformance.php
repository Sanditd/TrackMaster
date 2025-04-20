<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Performance Tracking | TrackMaster</title>
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

        /* Performance Container */
        .performance-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .performance-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .performance-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .performance-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Player Info Section */
        .player-info-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: var(--box-shadow);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        .player-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--primary-color);
            border: 3px solid var(--secondary-color);
        }

        .player-details {
            flex: 1;
            min-width: 250px;
        }

        .player-details h2 {
            color: var(--primary-color);
            margin-bottom: 5px;
            font-size: 1.8rem;
        }

        .player-details .player-role {
            display: inline-block;
            padding: 5px 12px;
            background: rgba(255, 165, 0, 0.1);
            color: var(--secondary-color);
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .player-meta {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .player-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-color);
        }

        .quick-stats {
            display: flex;
            gap: 15px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .stat-item {
            background: var(--light-color);
            padding: 8px 15px;
            border-radius: var(--border-radius);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 100px;
        }

        .stat-value {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--gray-color);
        }

        /* Stats Cards Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stats-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .stats-card-header {
            padding: 15px 20px;
            background: var(--primary-color);
            color: white;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stats-card-body {
            padding: 20px;
        }

        .stats-list {
            list-style: none;
        }

        .stats-list li {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .stats-list li:last-child {
            border-bottom: none;
        }

        .stats-label {
            color: var(--gray-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stats-value {
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Performance Chart Section */
        .performance-chart {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            margin-bottom: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-header h2 {
            color: var(--primary-color);
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-filters {
            display: flex;
            gap: 15px;
        }

        .chart-filter {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            background: white;
            cursor: pointer;
            transition: var(--transition);
        }

        .chart-filter.active {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .chart-container {
            height: 300px;
            background: var(--light-color);
            border-radius: var(--border-radius);
            position: relative;
        }

        .chart-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-color);
            padding: 20px;
            text-align: center;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .action-btn {
            padding: 12px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: var(--transition);
        }

        .primary-btn {
            background: var(--secondary-color);
            color: white;
            border: none;
        }

        .primary-btn:hover {
            background: #cc8400;
        }

        .secondary-btn {
            background: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .secondary-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Modal Styles */
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

        .performance-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
            z-index: 1001;
            display: none;
            max-height: 90vh;
            overflow-y: auto;
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

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-col {
            flex: 1;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .player-avatar {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }
            
            .player-details h2 {
                font-size: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .action-btn {
                width: 100%;
                justify-content: center;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar would be included here -->
    
    <div class="performance-container">
        <div class="performance-header">
            <h1><i class="fas fa-cricket"></i> Player Performance Tracking</h1>
            <p>Comprehensive statistics and analysis for individual cricket players</p>
        </div>
        
        <!-- Player Info Section -->
        <div class="player-info-section">
            <div class="player-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="player-details">
                <h2>Virat Kohli</h2>
                <span class="player-role"><i class="fas fa-running"></i> Batsman</span>
                <div class="player-meta">
                    <div class="player-meta-item">
                        <i class="fas fa-id-card"></i> ID: 1
                    </div>
                    <div class="player-meta-item">
                        <i class="fas fa-trophy"></i> Matches: 22
                    </div>
                </div>
                <div class="quick-stats">
                    <div class="stat-item">
                        <span class="stat-value">164</span>
                        <span class="stat-label">Total Runs</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">42</span>
                        <span class="stat-label">Wickets</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">82.00</span>
                        <span class="stat-label">Batting Avg</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stats Cards Grid -->
        <div class="stats-grid">
            <!-- Batting Stats Card -->
            <div class="stats-card">
                <div class="stats-card-header">
                    <i class="fas fa-baseball-bat"></i> Batting Statistics
                </div>
                <div class="stats-card-body">
                    <ul class="stats-list">
                        <li>
                            <span class="stats-label"><i class="fas fa-chart-line"></i> Innings</span>
                            <span class="stats-value">2</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-running"></i> Total Runs</span>
                            <span class="stats-value">164</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-calculator"></i> Batting Average</span>
                            <span class="stats-value">82.00</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-bolt"></i> Strike Rate</span>
                            <span class="stats-value">86.32</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-border-all"></i> Boundaries</span>
                            <span class="stats-value">13</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-medal"></i> High Score</span>
                            <span class="stats-value">100</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-star-half-alt"></i> Fifties</span>
                            <span class="stats-value">1</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-star"></i> Hundreds</span>
                            <span class="stats-value">1</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bowling Stats Card -->
            <div class="stats-card">
                <div class="stats-card-header">
                    <i class="fas fa-baseball"></i> Bowling Statistics
                </div>
                <div class="stats-card-body">
                    <ul class="stats-list">
                        <li>
                            <span class="stats-label"><i class="fas fa-bowling-ball"></i> Wickets</span>
                            <span class="stats-value">42</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-calculator"></i> Bowling Average</span>
                            <span class="stats-value">1.52</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-stopwatch"></i> Strike Rate</span>
                            <span class="stats-value">3.91</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-chart-line"></i> Economy Rate</span>
                            <span class="stats-value">4.85</span>
                        </li>
                        <li>
                            <span class="stats-label"><i class="fas fa-trophy"></i> Best Bowling</span>
                            <span class="stats-value">4/30</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
    
    
    
    <div class="modal-overlay" id="modalOverlay"></div>
    
    <!-- Footer would be included here -->

</body>
</html>