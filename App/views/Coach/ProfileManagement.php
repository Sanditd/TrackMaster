<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Player Profile | TrackMaster</title>
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

        /* Share Profile Container */
        .share-profile-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .share-profile-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .share-profile-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .share-profile-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Form Container */
        .form-container {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(0, 38, 77, 0.1);
            padding: 30px;
        }

        .form-container h2 {
            color: var(--primary-color);
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
            font-size: 1.5rem;
        }

        .form-container h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-color);
            font-weight: 500;
        }

        .form-group select, 
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group select:focus, 
        .form-group textarea:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Stats Group Styles */
        .stats-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
            padding: 20px;
            background-color: var(--light-color);
            border-radius: var(--border-radius);
            border: 1px solid #eee;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white;
            padding: 15px;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .stat-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-item span {
            color: var(--gray-color);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .stat-item strong {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        /* Button Styles */
        .form-group button {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            width: 100%;
            justify-content: center;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group button:hover {
            background: #cc8400;
            transform: translateY(-2px);
        }

        .form-group button:active {
            transform: translateY(0);
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group button i {
            font-size: 1.1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .share-profile-header {
                padding: 20px 15px;
            }
            
            .share-profile-header h1 {
                font-size: 1.8rem;
            }
            
            .share-profile-container {
                padding: 15px;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .stats-group {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .share-profile-header h1 {
                font-size: 1.6rem;
            }
            
            .form-container h2 {
                font-size: 1.3rem;
            }
            
            .stats-group {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="share-profile-container">
        <div class="share-profile-header">
            <h1><i class="fas fa-share-alt"></i> Share Player Profile</h1>
            <p>Share player statistics and performance data with other coaches</p>
        </div>

        <div class="form-container">
            <h2><i class="fas fa-user-plus"></i> Player Profile Sharing</h2>
            <form id="shareProfileForm">
                <!-- Select Coach -->
                <div class="form-group">
                    <label for="selectCoach"><i class="fas fa-user-tie"></i> Select Coach</label>
                    <select id="selectCoach" required>
                        <option value="" disabled selected>-- Select a coach --</option>
                        <option value="Coach1">Coach 1</option>
                        <option value="Coach2">Coach 2</option>
                        <option value="Coach3">Coach 3</option>
                    </select>
                </div>
                
                <!-- Select Player -->
                <div class="form-group">
                    <label for="selectPlayer"><i class="fas fa-user-cog"></i> Select Player</label>
                    <select id="selectPlayer" onchange="populateStats()" required>
                        <option value="" disabled selected>-- Select a player --</option>
                        <option value="Player1">Player 1</option>
                        <option value="Player2">Player 2</option>
                        <option value="Player3">Player 3</option>
                    </select>
                </div>

                <!-- Player Stats -->
                <h3 style="color: var(--primary-color); margin-bottom: 10px;"><i class="fas fa-chart-line"></i> Player Statistics</h3>
                <div class="stats-group" id="playerStats">
                    <div class="stat-item">
                        <span>Runs</span>
                        <strong id="runs">-</strong>
                    </div>
                    <div class="stat-item">
                        <span>Wickets</span>
                        <strong id="wickets">-</strong>
                    </div>
                    <div class="stat-item">
                        <span>Batting Avg</span>
                        <strong id="battingAvg">-</strong>
                    </div>
                    <div class="stat-item">
                        <span>Bowling Avg</span>
                        <strong id="bowlingAvg">-</strong>
                    </div>
                    <div class="stat-item">
                        <span>Batting SR</span>
                        <strong id="battingSR">-</strong>
                    </div>
                    <div class="stat-item">
                        <span>Bowling SR</span>
                        <strong id="bowlingSR">-</strong>
                    </div>
                    <div class="stat-item">
                        <span>Economy</span>
                        <strong id="economyRate">-</strong>
                    </div>
                    <div class="stat-item">
                        <span>Matches</span>
                        <strong id="matches">-</strong>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description"><i class="fas fa-comment-dots"></i> Description</label>
                    <textarea id="description" placeholder="Add notes about player strengths, areas for improvement, or other relevant information..." required></textarea>
                </div>

                <!-- Share Button -->
                <div class="form-group">
                    <button type="submit"><i class="fas fa-share-square"></i> Share Player Profile</button>
                </div>
            </form>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        // Function to populate player stats when a player is selected
        function populateStats() {
            const player = document.getElementById('selectPlayer').value;
            
            // Demo data - in production this would come from your database
            const playerStats = {
                'Player1': {
                    runs: 1250,
                    wickets: 15,
                    battingAvg: 42.8,
                    bowlingAvg: 28.5,
                    battingSR: 138.6,
                    bowlingSR: 26.2,
                    economyRate: 6.5,
                    matches: 24
                },
                'Player2': {
                    runs: 876,
                    wickets: 32,
                    battingAvg: 29.2,
                    bowlingAvg: 22.1,
                    battingSR: 112.4,
                    bowlingSR: 18.5,
                    economyRate: 5.2,
                    matches: 18
                },
                'Player3': {
                    runs: 1560,
                    wickets: 8,
                    battingAvg: 52.0,
                    bowlingAvg: 38.7,
                    battingSR: 145.8,
                    bowlingSR: 35.6,
                    economyRate: 7.8,
                    matches: 32
                }
            };
            
            if (player && playerStats[player]) {
                const stats = playerStats[player];
                document.getElementById('runs').textContent = stats.runs;
                document.getElementById('wickets').textContent = stats.wickets;
                document.getElementById('battingAvg').textContent = stats.battingAvg;
                document.getElementById('bowlingAvg').textContent = stats.bowlingAvg;
                document.getElementById('battingSR').textContent = stats.battingSR;
                document.getElementById('bowlingSR').textContent = stats.bowlingSR;
                document.getElementById('economyRate').textContent = stats.economyRate;
                document.getElementById('matches').textContent = stats.matches;
                
                // Add animation effect
                const statItems = document.querySelectorAll('.stat-item');
                statItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.transform = 'translateY(-5px)';
                        setTimeout(() => {
                            item.style.transform = 'translateY(0)';
                        }, 300);
                    }, index * 50);
                });
            } else {
                // Reset stats if no player selected
                document.getElementById('runs').textContent = '-';
                document.getElementById('wickets').textContent = '-';
                document.getElementById('battingAvg').textContent = '-';
                document.getElementById('bowlingAvg').textContent = '-';
                document.getElementById('battingSR').textContent = '-';
                document.getElementById('bowlingSR').textContent = '-';
                document.getElementById('economyRate').textContent = '-';
                document.getElementById('matches').textContent = '-';
            }
        }

        // Handle form submission
        document.getElementById('shareProfileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const coach = document.getElementById('selectCoach').value;
            const player = document.getElementById('selectPlayer').value;
            const description = document.getElementById('description').value;
            
            if (!coach || !player || !description) {
                alert('Please fill in all fields');
                return;
            }
            
            // Show success message (in production, this would send data to server)
            alert(`Profile for ${player} has been shared with ${coach} successfully!`);
            
            // Reset form
            this.reset();
            populateStats();
        });
    </script>
</body>
</html>