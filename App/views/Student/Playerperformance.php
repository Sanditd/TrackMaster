<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Performance Tracking | TrackMaster</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/performance.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
<?php require 'navbar.php'?>
    
    <div class="performance-container">
        <div class="performance-header">
            <h1><i class="fas fa-cricket"></i> Player Performance Tracking</h1>
            <p>Comprehensive statistics and analysis for individual players</p>
        </div>
        
        <!-- Player Info Section -->
        <div class="player-info-section">
            <div class="player-avatar">
                <?php if (isset($data['player']) && !empty($data['player']->photo)): ?>
                   
                    <img src="<?php echo !empty($player->photo) ? 'data:image/jpeg;base64,'.base64_encode($player->photo) : URLROOT.'/Public/img/profile.jpeg' ?>" 
                         alt="Player Photo" 
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                <?php else: ?>
                    <i class="fas fa-user"></i>
                <?php endif; ?>
            </div>
            <div class="player-details">
                <h2>
                    <?php echo isset($data['player']) ? htmlspecialchars($data['player']->firstname . ' ' . ($data['player']->lname ?? '')) : 'N/A'; ?>
                </h2>
                <span class="player-role">
                    <i class="fas fa-running"></i> 
                    <?= !empty($data['player']->role) ? htmlspecialchars($data['player']->role) : 'Player' ?>
                </span>
                <div class="player-meta">
                    <div class="player-meta-item">
                        <i class="fas fa-id-card"></i> ID: <?= isset($data['player']) ? $data['player']->user_id : 'N/A' ?>
                    </div>
                    <?php if (isset($data['player']) && !empty($data['player']->age)): ?>
                        <div class="player-meta-item">
                            <i class="fas fa-birthday-cake"></i> Age: <?= $data['player']->age ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($data['stats']) && !empty($data['stats']->matches)): ?>
                        <div class="player-meta-item">
                            <i class="fas fa-trophy"></i> Matches: <?= $data['stats']->matches ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="quick-stats">
                    <?php if (isset($data['stats']) && isset($data['stats']->runs)): ?>
                        <div class="stat-item">
                            <span class="stat-value"><?= $data['stats']->runs ?></span>
                            <span class="stat-label">Total Runs</span>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($data['stats']) && isset($data['stats']->wickets)): ?>
                        <div class="stat-item">
                            <span class="stat-value"><?= $data['stats']->wickets ?></span>
                            <span class="stat-label">Wickets</span>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($data['stats']) && isset($data['stats']->batting_avg)): ?>
                        <div class="stat-item">
                            <span class="stat-value"><?= number_format($data['stats']->batting_avg, 2) ?></span>
                            <span class="stat-label">Batting Avg</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Stats Cards Grid -->
        <div class="stats-grid">
            <?php if (empty($data['stats']) || !isset($data['stats']->matches)): ?>
                <div class="stats-card">
                    <div class="stats-card-header">
                        <i class="fas fa-info-circle"></i> No Statistics Available
                    </div>
                    <div class="stats-card-body">
                        <p>No performance statistics have been recorded yet for this player.</p>
                    </div>
                </div>
            <?php else: ?>
                <!-- Batting Stats Card -->
                <div class="stats-card">
                    <div class="stats-card-header">
                        <i class="fas fa-baseball-bat"></i> Batting Statistics
                    </div>
                    <div class="stats-card-body">
                        <ul class="stats-list">
                            <?php if (!empty($data['stats']->innings)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-chart-line"></i> Innings</span>
                                    <span class="stats-value"><?= $data['stats']->innings ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->runs)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-running"></i> Total Runs</span>
                                    <span class="stats-value"><?= $data['stats']->runs ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->batting_avg)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-calculator"></i> Batting Average</span>
                                    <span class="stats-value"><?= number_format($data['stats']->batting_avg, 2) ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->strike_rate)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-bolt"></i> Strike Rate</span>
                                    <span class="stats-value"><?= number_format($data['stats']->strike_rate, 2) ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->boundaries)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-border-all"></i> Boundaries</span>
                                    <span class="stats-value"><?= $data['stats']->boundaries ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->high_score)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-medal"></i> High Score</span>
                                    <span class="stats-value"><?= $data['stats']->high_score ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->fifties)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-star-half-alt"></i> Fifties</span>
                                    <span class="stats-value"><?= $data['stats']->fifties ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->hundreds)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-star"></i> Hundreds</span>
                                    <span class="stats-value"><?= $data['stats']->hundreds ?></span>
                                </li>
                            <?php endif; ?>
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
                            <?php if (!empty($data['stats']->wickets)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-bowling-ball"></i> Wickets</span>
                                    <span class="stats-value"><?= $data['stats']->wickets ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->bowling_avg)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-calculator"></i> Bowling Average</span>
                                    <span class="stats-value"><?= number_format($data['stats']->bowling_avg, 2) ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->bowling_strike_rate)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-stopwatch"></i> Strike Rate</span>
                                    <span class="stats-value"><?= number_format($data['stats']->bowling_strike_rate, 2) ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->economy_rate)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-chart-line"></i> Economy Rate</span>
                                    <span class="stats-value"><?= number_format($data['stats']->economy_rate, 2) ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($data['stats']->best_bowling_figures)): ?>
                                <li>
                                    <span class="stats-label"><i class="fas fa-trophy"></i> Best Bowling</span>
                                    <span class="stats-value"><?= $data['stats']->best_bowling_figures ?></span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
<!-- Recent Performances Section -->
<?php if (!empty($data['performances'])): ?>
    <div class="performance-chart">
        <div class="chart-header">
            <h2><i class="fas fa-history"></i> Recent Match Performances</h2>
        </div>
        <div class="stats-card-body">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #00264d; color: white;">
                        <th style="padding: 10px; text-align: left;">Date</th>
                        <th style="padding: 10px; text-align: left;">Opponent</th>
                        <th style="padding: 10px; text-align: left;">Venue</th>
                        <th style="padding: 10px; text-align: center;">Runs</th>
                        <th style="padding: 10px; text-align: center;">Wickets</th>
                        <th style="padding: 10px; text-align: center;">Catches</th>
                        <th style="padding: 10px; text-align: center;">Result</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['performances'] as $performance): ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;">
                                <?= date('M d, Y', strtotime($performance->match_date)) ?>
                            </td>
                            <td style="padding: 10px;">
                                <?= isset($performance->opponent_team) ? htmlspecialchars($performance->opponent_team) : 'N/A' ?>
                            </td>
                            <td style="padding: 10px;">
                                <?= isset($performance->venue) ? htmlspecialchars($performance->venue) : 'N/A' ?>
                            </td>
                            <td style="padding: 10px; text-align: center;">
                                <?= $performance->runs_scored ?> (<?= $performance->balls_faced ?>b)
                                <?php if ($performance->fours > 0 || $performance->sixes > 0): ?>
                                    <br><small><?= $performance->fours ?>x4, <?= $performance->sixes ?>x6</small>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 10px; text-align: center;">
                                <?= $performance->wickets_taken ?>
                                <?php if ($performance->wickets_taken > 0): ?>
                                    <br><small><?= $performance->overs_bowled ?>ov, <?= $performance->runs_conceded ?>r</small>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 10px; text-align: center;">
                                <?= $performance->catches ?>
                            </td>
                            <td style="padding: 10px; text-align: center;">
                                <span style="color: <?= isset($performance->result) && $performance->result === 'won' ? 'green' : (isset($performance->result) && $performance->result === 'lost' ? 'red' : 'orange') ?>;">
                                    <?= isset($performance->result) ? ucfirst($performance->result) : 'N/A' ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="performance-chart">
        <div class="chart-header">
            <h2><i class="fas fa-history"></i> Recent Match Performances</h2>
        </div>
        <div class="stats-card-body">
            <p>No recent match performances available.</p>
        </div>
    </div>
<?php endif; ?>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="action-btn secondary-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Back
            </button>
        </div>
    </div>
    
    <div class="modal-overlay" id="modalOverlay"></div>
    
    <?php require 'footer.php'; ?>
</body>
</html>