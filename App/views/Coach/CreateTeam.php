<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team | TrackMaster</title>
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

        /* Container */
        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .dashboard-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
        }

        /* Section Styling */
        .section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            transition: var(--transition);
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .section h3 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 1.4rem;
            position: relative;
            padding-bottom: 10px;
        }

        .section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        /* Form Elements */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        input:focus, select:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        .btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
            text-align: center;
            font-size: 1rem;
        }

        .btn:hover {
            background: #cc8400;
        }

        .btn.compare-players {
            margin-top: 15px;
        }

        /* Player List */
        .player-list {
            list-style: none;
            margin-top: 15px;
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #eee;
            border-radius: var(--border-radius);
        }

        .player-list li {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .player-list li:last-child {
            border-bottom: none;
        }

        .player-list li:hover {
            background: var(--light-color);
        }

        /* Player Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }

        .player-card {
            background: var(--light-color);
            border-radius: var(--border-radius);
            padding: 20px;
            border: 1px solid #eee;
            position: relative;
            transition: var(--transition);
        }

        .player-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--box-shadow);
        }

        .player-card h4 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .player-card p {
            margin: 5px 0;
            color: var(--gray-color);
        }

        .player-card .btn.add-player {
            margin-top: 15px;
            width: 100%;
        }

        /* Hidden Class */
        .hidden {
            display: none;
        }

        /* Notification Container */
        #notification-container {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-header {
                padding: 20px 15px;
            }
            
            .dashboard-header h1 {
                font-size: 1.8rem;
            }
            
            .section {
                padding: 20px 15px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .dashboard-header h1 {
                font-size: 1.6rem;
            }
            
            .section h3 {
                font-size: 1.2rem;
            }
            
            .btn {
                font-size: 0.95rem;
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <?php require 'CoachNav.php'; ?>
    
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1><i class="fas fa-users-gear"></i> Create Team</h1>
            <p>Build and manage your cricket team by selecting the best players based on performance stats</p>
        </div>
        
        <div class="main-content">
            <!-- Create Team Form Section -->
            <div class="section">
                <h3>Team Information</h3>
                <form id="createTeamForm">
                    <div>
                        <label for="teamName">Team Name</label>
                        <input type="text" id="teamName" name="teamName" placeholder="Enter team name" required>
                    </div>
                    
                    <div>
                        <label for="numPlayers">Number of Players</label>
                        <input type="number" id="numPlayers" name="numPlayers" placeholder="Enter number of players" required min="1" max="15">
                    </div>
                    
                    <button type="button" class="btn create-team" onclick="createTeamAndShowPlayerFilter()">
                        <i class="fas fa-plus-circle"></i> Create Team & Select Players
                    </button>
                </form>
            </div>

            <!-- Player Filter Section -->
            <div class="section hidden" id="playerFilterSection">
                <h3>Player Selection</h3>
                <div>
                    <label for="filterBy">Filter Players By Role</label>
                    <select id="filterBy" name="filterBy" onchange="filterPlayers()">
                        <option value="" disabled selected>Please select a role</option>
                        <option value="batsman">Batsman (Ordered by Batting Avg)</option>
                        <option value="bowler">Bowler (Ordered by Bowling Avg)</option>
                        <option value="allrounder">Allrounders</option>
                        <option value="wicketkeeper">Wicketkeeper (Ordered by Batting Avg)</option>
                    </select>
                </div>

                <div>
                    <label for="genderFilter">Filter by Gender</label>
                    <select id="genderFilter" name="genderFilter" onchange="filterPlayers()">
                        <option value="" disabled selected>Please select a gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <ul id="playerList" class="player-list">
                    <!-- Player list will be populated here -->
                </ul>
                
                <button type="button" class="btn compare-players" onclick="comparePlayers()">
                    <i class="fas fa-balance-scale"></i> Compare Selected Players
                </button>
            </div>

            <!-- Selected Players Stats Section -->
            <div class="section hidden" id="selectedPlayersStats">
                <h3>Player Comparison</h3>
                <div id="teamProgress" class="team-progress">
                    <p>Team Progress: <span id="playerCount">0</span>/<span id="maxPlayers">0</span> players selected</p>
                    <div class="progress-bar">
                        <div class="progress" id="progressBar" style="width: 0%"></div>
                    </div>
                </div>
                <div id="statsContainer" class="stats-grid">
                    <!-- Player stats cards will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'?>

    <script>
        let currentTeamId = null;
        let currentPlayerCount = 0;
        let maxPlayerCount = 0;

        function createTeamAndShowPlayerFilter() {        
            const teamName = document.getElementById('teamName').value;
            const numPlayers = document.getElementById('numPlayers').value;

            if (!teamName || numPlayers <= 0) {
                showNotification('error', 'Please provide a valid team name and number of players.');
                return;
            }

            maxPlayerCount = parseInt(numPlayers);
            document.getElementById('maxPlayers').textContent = maxPlayerCount;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'createTeam', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        currentTeamId = response.teamId; 
                        showNotification('success', 'Team created successfully! Now select players.');
                        document.getElementById('playerFilterSection').classList.remove('hidden');
                    } else {
                        showNotification('error', 'Error creating team: ' + response.message);
                    }
                }
            };
            xhr.send(`teamName=${teamName}&numPlayers=${numPlayers}`);
        } 

        function filterPlayers() {
            const role = document.getElementById('filterBy').value;
            const gender = document.getElementById('genderFilter').value;

            if (!role || !gender) {
                showNotification('error', 'Please select both role and gender filters.');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'filterPlayers', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const players = response.players;
                    displayPlayerList(players);
                }
            };
            xhr.send(`role=${role}&gender=${gender}`);
        }

        function comparePlayers() {
            // Get all selected players
            const selectedPlayers = [];
            const checkboxes = document.querySelectorAll('input[name="selectedPlayers"]:checked');
            checkboxes.forEach(checkbox => {
                selectedPlayers.push(checkbox.value);
            });

            // If no players are selected, alert the user
            if (selectedPlayers.length === 0) {
                showNotification('error', 'Please select at least one player to compare.');
                return;
            }

            // Fetch selected players' stats
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'getPlayerStats', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        displaySelectedPlayersStats(response.players);
                    } else {
                        showNotification('error', 'Error fetching player stats: ' + response.message);
                    }
                }
            };
            xhr.send(`playerIds=${selectedPlayers.join(',')}`);
        }

        function displaySelectedPlayersStats(players) {
            const statsContainer = document.getElementById('statsContainer');
            statsContainer.innerHTML = ''; // Clear previous results

            players.forEach(player => {
                const playerCard = document.createElement('div');
                playerCard.classList.add('player-card');

                playerCard.innerHTML = `
                    <h4>${player.firstname}</h4>
                    <p><strong>ID:</strong> ${player.player_id}</p>
                    <p><strong>Role:</strong> ${player.role}</p>
                    <p><strong>Gender:</strong> ${player.gender}</p>
                    <div class="stats-details">
                        <p><strong>Matches:</strong> ${player.matches}</p>
                        <p><strong>Batting Avg:</strong> ${player.batting_avg || 'N/A'}</p>
                        <p><strong>Strike Rate:</strong> ${player.strike_rate || 'N/A'}</p>
                        <p><strong>Fifties:</strong> ${player.fifties || 'N/A'}</p>
                        <p><strong>Hundreds:</strong> ${player.hundreds || 'N/A'}</p>
                        <p><strong>Wickets:</strong> ${player.wickets || 'N/A'}</p>
                        <p><strong>Bowling Avg:</strong> ${player.bowling_avg || 'N/A'}</p>
                        <p><strong>Bowling SR:</strong> ${player.bowling_strike_rate || 'N/A'}</p>
                        <p><strong>Economy Rate:</strong> ${player.economy_rate || 'N/A'}</p>
                    </div>
                    <button type="button" class="btn add-player" onclick="addPlayerToTeam(${player.player_id})">
                        <i class="fas fa-user-plus"></i> Add to Team
                    </button>
                `;
                
                statsContainer.appendChild(playerCard);
            });

            // Show the selected players' stats section
            document.getElementById('selectedPlayersStats').classList.remove('hidden');
        }

        function displayPlayerList(players) {
            const playerList = document.getElementById('playerList');
            playerList.innerHTML = ''; // Clear previous results

            if (players.length === 0) {
                playerList.innerHTML = '<li class="no-results">No players found matching your criteria</li>';
                return;
            }

            players.forEach(player => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <input type="checkbox" id="player_${player.user_id}" name="selectedPlayers" value="${player.user_id}">
                    <div>
                        <strong>${player.firstname}</strong>
                        <span class="player-stats">
                            Batting Avg: ${player.batting_avg || 'N/A'}, Bowling Avg: ${player.bowling_avg || 'N/A'}
                        </span>
                    </div>
                `;
                playerList.appendChild(li);
            });
        }

        function addPlayerToTeam(playerId) {
            if (currentPlayerCount >= maxPlayerCount) {
                showNotification('error', 'Player limit reached! You cannot add more players.');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/TrackMaster/Coach/addPlayerToTeam', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        currentPlayerCount++;
                        updateTeamProgress();
                        showNotification('success', response.message);
                        
                        // Disable the button that was clicked
                        const clickedButton = event.target.closest('.btn.add-player');
                        if (clickedButton) {
                            clickedButton.disabled = true;
                            clickedButton.innerHTML = '<i class="fas fa-check"></i> Added';
                            clickedButton.style.backgroundColor = '#28a745';
                        }
                    } else {
                        showNotification('error', response.message);
                    }
                } else {
                    showNotification('error', 'Unexpected error occurred.');
                }
            };
            xhr.send(`teamId=${currentTeamId}&playerId=${playerId}`);
        }

        function updateTeamProgress() {
            document.getElementById('playerCount').textContent = currentPlayerCount;
            const progressPercentage = (currentPlayerCount / maxPlayerCount) * 100;
            document.getElementById('progressBar').style.width = `${progressPercentage}%`;
            
            if (currentPlayerCount === maxPlayerCount) {
                showNotification('success', 'Team is complete! All player slots filled.');
            }
        }

        function showNotification(type, message) {
            // Create a notification container if it doesn't exist
            let notificationContainer = document.getElementById('notification-container');
            if (!notificationContainer) {
                notificationContainer = document.createElement('div');
                notificationContainer.id = 'notification-container';
                notificationContainer.style.position = 'fixed';
                notificationContainer.style.top = '10px';
                notificationContainer.style.right = '10px';
                notificationContainer.style.zIndex = '1000';
                document.body.appendChild(notificationContainer);
            }

            // Create the notification
            const notification = document.createElement('div');
            notification.style.marginBottom = '10px';
            notification.style.padding = '15px';
            notification.style.borderRadius = '8px';
            notification.style.backgroundColor = type === 'success' ? '#d4edda' : '#f8d7da';
            notification.style.color = type === 'success' ? '#155724' : '#721c24';
            notification.style.borderLeft = type === 'success' ? '4px solid #28a745' : '4px solid #dc3545';
            notification.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            notification.style.minWidth = '300px';
            notification.style.display = 'flex';
            notification.style.alignItems = 'center';
            notification.style.justifyContent = 'space-between';

            // Add icon and message
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
                <i class="fas fa-times" style="cursor: pointer;"></i>
            `;

            // Add the notification to the container
            notificationContainer.appendChild(notification);

            // Close button functionality
            notification.querySelector('.fa-times').addEventListener('click', function() {
                notificationContainer.removeChild(notification);
            });

            // Remove the notification after 5 seconds
            setTimeout(() => {
                if (notification.parentNode === notificationContainer) {
                    notificationContainer.removeChild(notification);
                }
            }, 5000);
        }
    </script>

    <script src="../Public/js/sidebar.js"></script>
</body>
</html>