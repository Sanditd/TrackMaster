<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Coach Dashboard</title>
    <link rel="stylesheet" href="../Public/css/Coach/dashboard.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
    <link rel="stylesheet" href="../Public/css/sidebar.css">
    <link rel="stylesheet" href="../Public/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="header-content">
                <h1><i class="fas fa-cricket"></i> Cricket Coach Dashboard</h1>
                <div class="coach-info">
                    <p>Welcome, <strong>Anthony</strong> <span class="badge">Zonal Coach</span></p>
                    <div class="quick-stats">
                        <span><i class="fas fa-calendar-day"></i> <?php echo date('F j, Y'); ?></span>
                        <span><i class="fas fa-clock"></i> Last login: Today, 09:42 AM</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="stats-cards">
            <div class="card card-primary">
                <i class="fas fa-users"></i>
                <div class="card-content">
                    <span>Active Players</span>
                    <strong>25</strong>
                </div>
            </div>
            <div class="card card-secondary">
                <i class="fas fa-calendar-check"></i>
                <div class="card-content">
                    <span>Completed Sessions</span>
                    <strong>25/48</strong>
                </div>
            </div>
            <div class="card card-primary">
                <i class="fas fa-trophy"></i>
                <div class="card-content">
                    <span>Upcoming Matches</span>
                    <strong>3</strong>
                </div>
            </div>
            <div class="card card-secondary">
                <i class="fas fa-exclamation-triangle"></i>
                <div class="card-content">
                    <span>Injuries</span>
                    <strong>2</strong>
                </div>
            </div>
        </div>

        <div class="main-content">
            <!-- Top Row -->
            <div class="top-row">
                <div class="section top-performers">
                    <div class="section-header">
                        <h2><i class="fas fa-medal"></i> Top Performers</h2>
                        <select class="performance-filter">
                            <option>This Week</option>
                            <option>This Month</option>
                            <option>This Season</option>
                        </select>
                    </div>
                    <div class="player-grid">
                        <div class="player-card">
                            <div class="player-avatar">MS</div>
                            <div class="player-info">
                                <strong>Morty Smith</strong>
                                <span>Batsman</span>
                                <div class="player-stats">
                                    <span>Avg: 42.5</span>
                                    <span>SR: 128.6</span>
                                </div>
                            </div>
                            <div class="performance-badge">Top</div>
                        </div>
                        <!-- Repeat for other players -->
                    </div>
                </div>

                <div class="section quick-actions">
                    <div class="section-header">
                        <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
                    </div>
                    <div class="action-buttons">
                        <button class="action-btn"><i class="fas fa-plus"></i> New Session</button>
                        <button class="action-btn"><i class="fas fa-clipboard-list"></i> Log Match</button>
                        <button class="action-btn"><i class="fas fa-chart-line"></i> Add Stats</button>
                        <button class="action-btn"><i class="fas fa-bullhorn"></i> Team Announcement</button>
                    </div>
                </div>
            </div>

            <!-- Middle Row -->
            <div class="middle-row">
                <div class="section team-management">
                    <div class="section-header">
                        <h2><i class="fas fa-users"></i> Team Management</h2>
                        <button class="view-all">View All</button>
                    </div>
                    <div class="team-cards">
                        <div class="team-card">
                            <div class="team-header">
                                <h3>Team A</h3>
                                <span>15 Players</span>
                            </div>
                            <div class="team-progress">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 80%;"></div>
                                </div>
                                <span>80% Availability</span>
                            </div>
                            <div class="team-players">
                                <span class="player-tag">Batsmen: 5</span>
                                <span class="player-tag">Bowlers: 6</span>
                                <span class="player-tag">All-rounders: 4</span>
                            </div>
                        </div>
                        <!-- Repeat for other teams -->
                    </div>
                </div>

                <div class="section upcoming-sessions">
                    <div class="section-header">
                        <h2><i class="fas fa-calendar-alt"></i> Upcoming Sessions</h2>
                        <button class="view-all">View Calendar</button>
                    </div>
                    <div class="session-list">
                        <div class="session-item">
                            <div class="session-date">
                                <span class="day">07</span>
                                <span class="month">FEB</span>
                            </div>
                            <div class="session-details">
                                <strong>Batting Practice - Nets</strong>
                                <span>3:00 PM - 5:30 PM</span>
                                <span>Main Ground</span>
                            </div>
                            <div class="session-actions">
                                <button class="icon-btn"><i class="fas fa-edit"></i></button>
                                <button class="icon-btn"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <!-- Repeat for other sessions -->
                    </div>
                </div>
            </div>

            <!-- Bottom Row -->
            <div class="bottom-row">
                <div class="section activity-log">
                    <div class="section-header">
                        <h2><i class="fas fa-history"></i> Recent Activity</h2>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="activity-content">
                                <p>Updated Team A roster</p>
                                <span class="activity-time">9 minutes ago</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div class="activity-content">
                                <p>Created new practice session</p>
                                <span class="activity-time">2 hours ago</span>
                            </div>
                        </div>
                        <!-- Repeat for other activities -->
                    </div>
                </div>

                <div class="section performance-insights">
                    <div class="section-header">
                        <h2><i class="fas fa-chart-pie"></i> Performance Insights</h2>
                    </div>
                    <div class="insight-cards">
                        <div class="insight-card">
                            <div class="insight-header">
                                <i class="fas fa-bat"></i>
                                <h3>Batting Form</h3>
                            </div>
                            <div class="insight-content">
                                <div class="progress-circle" data-value="75">
                                    <svg>
                                        <circle class="bg" cx="40" cy="40" r="35"></circle>
                                        <circle class="progress" cx="40" cy="40" r="35"></circle>
                                    </svg>
                                    <div class="progress-text">75%</div>
                                </div>
                                <p>Team batting average improved by 12% this month</p>
                            </div>
                        </div>
                        <div class="insight-card">
                            <div class="insight-header">
                                <i class="fas fa-baseball-ball"></i>
                                <h3>Bowling Economy</h3>
                            </div>
                            <div class="insight-content">
                                <div class="progress-circle" data-value="68">
                                    <svg>
                                        <circle class="bg" cx="40" cy="40" r="35"></circle>
                                        <circle class="progress" cx="40" cy="40" r="35"></circle>
                                    </svg>
                                    <div class="progress-text">68%</div>
                                </div>
                                <p>3 bowlers under 5.0 economy rate</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

    <script src="../Public/js/Coach/dashboard.js"></script>
    <script src="../Public/js/sidebar.js"></script>
</body>
</html>