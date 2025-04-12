<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Performance Tracking | TrackMaster</title>
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

        /* Performance Grid */
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
        .team-card .card-icon {
            background: rgba(0, 38, 77, 0.1);
        }

        .player-card .card-icon {
            background: rgba(255, 165, 0, 0.1);
        }

        .update-team-card .card-icon {
            background: rgba(0, 128, 0, 0.1);
            color: #006400;
        }

        .update-player-card .card-icon {
            background: rgba(75, 0, 130, 0.1);
            color: #4b0082;
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

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        .search-btn, .submit-btn {
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

        .search-btn:hover, .submit-btn:hover {
            background: #cc8400;
        }

        .search-results {
            margin-top: 20px;
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #eee;
            border-radius: var(--border-radius);
        }

        .player-result {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            transition: var(--transition);
        }

        .player-result:last-child {
            border-bottom: none;
        }

        .player-result:hover {
            background: var(--light-color);
        }

        .player-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .player-info h4 {
            margin: 0;
            color: var(--primary-color);
            font-size: 1rem;
        }

        .player-info p {
            margin: 3px 0 0;
            font-size: 0.85rem;
            color: var(--gray-color);
        }

        .select-btn {
            background: transparent;
            border: 1px solid var(--secondary-color);
            color: var(--secondary-color);
            padding: 6px 12px;
            border-radius: var(--border-radius);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .select-btn:hover {
            background: var(--secondary-color);
            color: white;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .performance-header {
                padding: 20px 15px;
            }
            
            .performance-header h1 {
                font-size: 1.8rem;
            }
            
            .performance-header p {
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
        }

        @media (max-width: 480px) {
            .performance-header h1 {
                font-size: 1.6rem;
            }
            
            .card-content h2 {
                font-size: 1.2rem;
            }
            
            .card-content p {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="performance-container">
        <div class="performance-header">
            <h1><i class="fas fa-chart-line"></i> Cricket Performance Center</h1>
            <p>Track, analyze, and improve individual and team cricket performances with detailed statistics</p>
        </div>

        <div class="performance-grid">
            <!-- Team Performance Section -->
            <div class="performance-card team-card" onclick="window.location.href='<?php echo ROOT; ?>/coach/teamManagement'">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-content">
                    <h2>Team Performance</h2>
                    <p>View comprehensive team statistics, match results, and overall performance analytics across all formats.</p>
                    <div class="card-footer">
                        <span>Team Dashboard <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
            </div>

            <!-- Player Performance Section -->
            <div class="performance-card player-card" onclick="window.location.href='<?php echo ROOT; ?>/coach/playerperformance'">
                <div class="card-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-content">
                    <h2>Player Performance</h2>
                    <p>Analyze individual player statistics, track progress over time, and identify areas for improvement.</p>
                    <div class="card-footer">
                        <span>Player Analytics <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
            </div>

            <!-- Update Team Performance -->
            <div class="performance-card update-team-card" onclick="showUpdateTeamModal()">
                <div class="card-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="card-content">
                    <h2>Record Match</h2>
                    <p>Add new match results, team performance data, and match statistics for analysis.</p>
                    <div class="card-footer">
                        <span>Enter Match Data <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
            </div>

            <!-- Update Player Performance -->
            <div class="performance-card update-player-card" onclick="showPlayerSearchModal()">
                <div class="card-icon">
                    <i class="fas fa-running"></i>
                </div>
                <div class="card-content">
                    <h2>Update Player</h2>
                    <p>Record individual player achievements, match performances, and training metrics.</p>
                    <div class="card-footer">
                        <span>Select Player <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Player Search Modal -->
    <div id="playerSearchModal" class="performance-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('playerSearchModal')">&times;</span>
            <h3><i class="fas fa-search"></i> Find Player</h3>
            <form id="playerSearchForm" onsubmit="searchPlayer(event)">
                <div class="form-group">
                    <label for="playerSearch">Search by Name or ID</label>
                    <input type="text" id="playerSearch" placeholder="e.g. John Smith or P1001" required>
                </div>
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Search Players
                </button>
                <div class="search-results" id="searchResults">
                    <!-- Results will appear here -->
                    <div class="no-results">Enter a player name or ID to search</div>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Team Modal -->
    <div id="updateTeamModal" class="performance-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('updateTeamModal')">&times;</span>
            <h3><i class="fas fa-clipboard-check"></i> Record Team Performance</h3>
            <form id="teamPerformanceForm">
                <div class="form-group">
                    <label for="matchDate">Match Date</label>
                    <input type="date" id="matchDate" required>
                </div>
                <div class="form-group">
                    <label for="opponent">Opponent Team</label>
                    <input type="text" id="opponent" placeholder="Enter opponent team name" required>
                </div>
                <div class="form-group">
                    <label for="matchType">Match Format</label>
                    <select id="matchType" required>
                        <option value="">Select format</option>
                        <option value="test">Test Match</option>
                        <option value="odi">One Day International</option>
                        <option value="t20">T20</option>
                        <option value="practice">Practice Match</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i> Save Match Data
                </button>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalOverlay"></div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        // Enhanced JavaScript for modals and interactions
        function showPlayerSearchModal() {
            document.getElementById('playerSearchModal').classList.add('active');
            document.getElementById('modalOverlay').classList.add('active');
            document.getElementById('playerSearch').focus();
        }

        function showUpdateTeamModal() {
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('matchDate').value = today;
            
            document.getElementById('updateTeamModal').classList.add('active');
            document.getElementById('modalOverlay').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.getElementById('modalOverlay').classList.remove('active');
        }

        function searchPlayer(event) {
            event.preventDefault();
            const searchTerm = document.getElementById('playerSearch').value.trim();
            const resultsContainer = document.getElementById('searchResults');
            
            if (searchTerm.length < 2) {
                resultsContainer.innerHTML = '<div class="no-results">Please enter at least 2 characters</div>';
                return;
            }
            
            // Show loading state
            resultsContainer.innerHTML = '<div class="no-results"><i class="fas fa-spinner fa-spin"></i> Searching players...</div>';
            
            // Simulate API call with timeout
            setTimeout(() => {
                // Mock results - replace with actual API call
                const mockPlayers = [
                    {
                        id: 'P1001',
                        name: 'John Smith',
                        role: 'Batsman',
                        team: 'Team Blue',
                        avatar: '../Public/img/players/default.jpg'
                    },
                    {
                        id: 'P1002',
                        name: 'Michael Johnson',
                        role: 'Bowler',
                        team: 'Team Blue',
                        avatar: '../Public/img/players/default.jpg'
                    },
                    {
                        id: 'P1003',
                        name: 'David Warner',
                        role: 'All-rounder',
                        team: 'Team Red',
                        avatar: '../Public/img/players/default.jpg'
                    }
                ];
                
                const filteredPlayers = mockPlayers.filter(player => 
                    player.name.toLowerCase().includes(searchTerm.toLowerCase()) || 
                    player.id.toLowerCase().includes(searchTerm.toLowerCase())
                );
                
                if (filteredPlayers.length === 0) {
                    resultsContainer.innerHTML = '<div class="no-results">No players found matching your search</div>';
                    return;
                }
                
                let resultsHTML = '';
                filteredPlayers.forEach(player => {
                    resultsHTML += `
                        <div class="player-result">
                            <div class="player-info">
                                <img src="${player.avatar}" alt="${player.name}" width="40" height="40">
                                <div>
                                    <h4>${player.name}</h4>
                                    <p>${player.role} | ${player.team}</p>
                                </div>
                            </div>
                            <button class="select-btn" onclick="selectPlayer('${player.id}')">
                                Select <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    `;
                });
                
                resultsContainer.innerHTML = resultsHTML;
            }, 800);
        }

        function selectPlayer(playerId) {
            // Redirect to player performance update page with the player ID
            window.location.href = `<?php echo ROOT; ?>/coach/updatePlayerPerformance/${playerId}`;
        }

        // Close modal when clicking on overlay
        document.getElementById('modalOverlay').addEventListener('click', function() {
            document.querySelectorAll('.performance-modal.active').forEach(modal => {
                modal.classList.remove('active');
            });
            this.classList.remove('active');
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.performance-modal.active').forEach(modal => {
                    modal.classList.remove('active');
                });
                document.getElementById('modalOverlay').classList.remove('active');
            }
        });

        // Form submission for team performance
        document.getElementById('teamPerformanceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const matchDate = document.getElementById('matchDate').value;
            const opponent = document.getElementById('opponent').value;
            const matchType = document.getElementById('matchType').value;
            
            // Validate inputs
            if (!matchDate || !opponent || !matchType) {
                alert('Please fill in all required fields');
                return;
            }
            
            // Here you would typically make an AJAX call to save the data
            console.log('Submitting match data:', { matchDate, opponent, matchType });
            
            // Show success message
            alert('Match data saved successfully!');
            
            // Close the modal
            closeModal('updateTeamModal');
            
            // In a real app, you might refresh the team performance data
        });
    </script>
</body>
</html>