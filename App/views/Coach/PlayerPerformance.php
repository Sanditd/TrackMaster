<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Public/css/Coach/BowlerPerformance.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
</head>
<body>
<?php require 'CoachNav.php'; ?>

    <div class="bowler-performance-container">
        <div class="bowler-performance-header">
            <h1>Sandith's Performance</h1>
        </div>

        <div class="stats-cards">
            <div class="card">Endurance<br><br>
                <div id="strengthCircle" class="circle">
                    <div class="inner-circle">
                      <p><span id="strengthValue">85</span></p>
                    </div>
                </div>
            </div>

            <div class="card">Speed<br><br>
                <div id="strengthCircle" class="circle">
                    <div class="inner-circle">
                      <p><span id="strengthValue">85</span></p>
                    </div>
                </div>
            </div>

            <div class="card">Strength<br><br>
                <div id="strengthCircle" class="circle">
                    <div class="inner-circle">
                      <p><span id="strengthValue">85</span></p>
                    </div>
                </div>
            </div>

            <div class="card">Attendance<br><br>
                <div id="attendanceCircle" class="circle">
                    <div class="inner-circle">
                      <p><span id="attendanceValue">95</span></p>
                    </div>
                </div>
            </div>
        </div>

    
                <div class="section recent-clients">
                    <header class="linechart-header">
                        <h1>Batting Averages Over Time (Last 20 games)</h1>
                      </header>
                    
                    
                      <div class="chart-container">
                        <canvas id="lineChart" width="600" height="400"></canvas>
                      </div>
                    
                      
                </div>

                

                <div class="section player-roles">
                    <header class="linechart-header">
                        <h1>Player Roles</h1>
                      </header>
                    
                      <div class="chart-container">
                        <canvas id="pieChart" width="300" height="300"></canvas>

                      </div>
                    
                      
                      
                </div>

                <div class="section player-roles">
                    <div class="header">
                        <h2>BATTING STATUS</h2>
                        
                    </div>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-label">Matches</span>
                            <span class="stat-value">229</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Innings</span>
                            <span class="stat-value">221</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Not Outs</span>
                            <span class="stat-value">37</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Runs</span>
                            <span class="stat-value">10943</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Strike Rate</span>
                            <span class="stat-value">89.34</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Batting Average</span>
                            <span class="stat-value">56.78</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Boundaries</span>
                            <span class="stat-value">350</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">High Score</span>
                            <span class="stat-value">183</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">50s</span>
                            <span class="stat-value">457</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">100s</span>
                            <span class="stat-value">27</span>
                        </div>
                    </div>
                </div>
            
                <div class="section player-roles">
                    <div class="header">
                        <h2>BOWLING STATS</h2>
                        
                    </div>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-label">Wickets Taken</span>
                            <span class="stat-value">150</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Economy Rate</span>
                            <span class="stat-value">4.85</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Bowling Average</span>
                            <span class="stat-value">28.4</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Strike Rate</span>
                            <span class="stat-value">32.8</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Dot Ball %</span>
                            <span class="stat-value">60%</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Best Figures</span>
                            <span class="stat-value">5/20</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Extras Given</span>
                            <span class="stat-value">45</span>
                        </div>
                    </div>
                </div>
            
                <div class="section player-roles">
                    <div class="header">
                        <h2>FIELDING STATS</h2>
                        
                    </div>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-label">Catches Taken</span>
                            <span class="stat-value">55</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Run-Outs</span>
                            <span class="stat-value">20</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Stumpings</span>
                            <span class="stat-value">15</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Dropped Chances</span>
                            <span class="stat-value">8</span>
                        </div>
                    </div>
                </div>


    
    
    <script src="../Public/js/Coach/BowlerPerformance.js"></script>
    <script src="../Public/js/sidebar.js"></script>
</body>
</html>