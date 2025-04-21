<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Performance Tracking | TrackMaster</title>
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
            --light-gray: #e9ecef;
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

        /* Team Performance Container */
        .team-performance-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .team-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .team-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .team-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Dashboard Section */
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            text-align: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 38, 77, 0.15);
        }

        .stat-icon {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--gray-color);
            font-size: 0.9rem;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: var(--box-shadow);
        }

        .filter-title {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-color);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .filter-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
        }

        .filter-btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            margin-top: 24px;
        }

        .filter-btn:hover {
            background: #cc8400;
        }

        /* Match History Section */
        .matches-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
        }

        .section-title {
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-gray);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .match-table {
            width: 100%;
            border-collapse: collapse;
        }

        .match-table th, 
        .match-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }

        .match-table th {
            background-color: var(--light-color);
            color: var(--primary-color);
            font-weight: 600;
        }

        .match-table tr:hover {
            background-color: rgba(0, 38, 77, 0.03);
        }

        .result-tag {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }

        .result-won {
            background-color: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }

        .result-lost {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }

        .result-tie {
            background-color: rgba(255, 193, 7, 0.15);
            color: #ffc107;
        }

        .result-no-result {
            background-color: rgba(108, 117, 125, 0.15);
            color: #6c757d;
        }

        .match-score {
            font-weight: 500;
        }

        /* Performance Charts Section */
        .charts-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
        }

        .chart-title {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-area {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px dashed var(--light-gray);
            border-radius: var(--border-radius);
            color: var(--gray-color);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
        }

        .page-link {
            padding: 8px 12px;
            border: 1px solid var(--light-gray);
            color: var(--primary-color);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .page-link:hover, 
        .page-link.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Recent Form Section */
        .recent-form {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .form-indicator {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.7rem;
        }

        .form-win {
            background-color: #28a745;
        }

        .form-loss {
            background-color: #dc3545;
        }

        .form-tie {
            background-color: #ffc107;
            color: #212529;
        }

        .form-no-result {
            background-color: #6c757d;
        }

        /* Add Match Button */
        .add-match-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--secondary-color);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(255, 165, 0, 0.4);
            cursor: pointer;
            transition: var(--transition);
            font-size: 1.5rem;
            border: none;
        }

        .add-match-btn:hover {
            background: #cc8400;
            transform: translateY(-5px);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .dashboard-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .charts-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .team-header {
                padding: 20px 15px;
            }
            
            .team-header h1 {
                font-size: 1.8rem;
            }
            
            .team-header p {
                font-size: 1rem;
            }
            
            .stat-value {
                font-size: 1.5rem;
            }
            
            .filter-row {
                flex-direction: column;
                gap: 10px;
            }
            
            .filter-group {
                width: 100%;
            }
            
            .filter-btn {
                width: 100%;
                margin-top: 10px;
            }
            
            .match-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (max-width: 576px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .team-header h1 {
                font-size: 1.6rem;
            }
            
            .section-title {
                font-size: 1.2rem;
            }
            
            .add-match-btn {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }

            .win-rate-high {
            color: #28a745;
        }
        .win-rate-medium {
            color: #ffc107;
        }
        .win-rate-low {
            color: #dc3545;
        }

        }
    </style>
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="team-performance-container">
        <div class="team-header">
            <h1><i class="fas fa-shield-alt"></i> <?= htmlspecialchars($data['team']->team_name) ?> Performance Dashboard</h1>
            <p>Comprehensive analysis of your team's cricket performance and match history</p>
        </div>

        <!-- Statistics Overview -->
        <div class="dashboard-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-value <?= $data['stats']->win_percentage >= 60 ? 'win-rate-high' : ($data['stats']->win_percentage >= 40 ? 'win-rate-medium' : 'win-rate-low') ?>">
                    <?= $data['stats']->win_percentage ?>%
                </div>
                <div class="stat-label">Win Rate</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-value"><?= $data['stats']->total_matches ?></div>
                <div class="stat-label">Matches Played</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-cricket"></i>
                </div>
                <div class="stat-value"><?= number_format($data['stats']->avg_runs_scored, 1) ?></div>
                <div class="stat-label">Avg Runs per Match</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <div class="stat-value"><?= $data['stats']->total_matches > 0 ? number_format($data['stats']->total_wickets_taken / $data['stats']->total_matches, 1) : '0.0' ?></div>
                <div class="stat-label">Avg Wickets per Match</div>
            </div>
        </div>

        <!-- Match History Section -->
        <div class="matches-section">
            <h2 class="section-title"><i class="fas fa-history"></i> Match History</h2>
            <div class="table-responsive">
                <table class="match-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Opponent</th>
                            <th>Venue</th>
                            <th>Result</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['recentMatches'] as $match): ?>
                        <tr>
                            <td><?= date('Y-m-d', strtotime($match->match_date)) ?></td>
                            <td><?= htmlspecialchars($match->opponent_team) ?></td>
                            <td><?= htmlspecialchars($match->venue) ?></td>
                            <td>
                                <span class="result-tag result-<?= $match->result ?>">
                                    <?= ucfirst($match->result) ?>
                                </span>
                            </td>
                            <td class="match-score">
                                <?= $match->team_runs_scored ?>/<?= $match->team_wickets_lost ?> vs 
                                <?= $match->team_runs_conceded ?>/<?= $match->team_wickets_taken ?>
                            </td>
                             
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Show more matches button if there are more than 5 matches -->
            
        </div>
    </div>

    <!-- Add Match Button -->

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
</body>
</html>