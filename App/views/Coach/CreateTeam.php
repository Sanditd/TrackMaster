<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team</title>
    <link rel="stylesheet" href="../Public/css/Coach/CreateTeam.css">
    <link rel="stylesheet" href="../Public/css/navbar.css">
</head>
<body>
    <?php require 'CoachNav.php'; ?>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Create Team</h1>
        </div>
        <div class="main-content">
            <div class="section">
                <form id="createTeamForm">
                    <label for="teamName">Team Name:</label>
                    <input type="text" id="teamName" name="teamName" placeholder="Enter team name" required>
                    
                    <label for="numPlayers">Number of Players:</label>
                    <input type="number" id="numPlayers" name="numPlayers" placeholder="Enter number of players" required>
                    
                    <button type="button" class="btn create-team" onclick="createTeamAndShowPlayerFilter()">Create & Add Player</button>
                </form>
            </div>

            <!-- Player Filter Section -->
            <div class="section hidden" id="playerFilterSection">
                <label for="filterBy">Filter Players By:</label>
                <select id="filterBy" name="filterBy" onchange="filterPlayers()">
                    <option value="" disabled selected>Please select a role</option>
                    <option value="batsman">Batsman (Ordered by Batting Avg)</option>
                    <option value="bowler">Bowler (Ordered by Bowling Avg)</option>
                    <option value="allrounder">Allrounders</option>
                    <option value="wicketkeeper">Wicketkeeper (Ordered by Batting Avg)</option>
                </select>

                <label for="genderFilter">Filter by Gender:</label>
                <select id="genderFilter" name="genderFilter" onchange="filterPlayers()">
                    <option value="" disabled selected>Please select a gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <ul id="playerList" class="player-list"></ul>
                <button type="button" class="btn compare-players" onclick="comparePlayers()">Compare Players</button>
            </div>

            <!-- Selected Players Stats Section -->
            <div class="section hidden" id="selectedPlayersStats">
                <h3>Selected Players' Stats</h3>
                <div id="statsContainer" class="stats-grid"></div>
            </div>
        </div>
    </div>

    <script>
    let currentTeamId = null;

    function createTeamAndShowPlayerFilter() {        
        const teamName = document.getElementById('teamName').value;
        const numPlayers = document.getElementById('numPlayers').value;

        if (!teamName || numPlayers <= 0) {
            alert('Please provide a valid team name and number of players.');
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'createTeam', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    currentTeamId = response.teamId; 
                    alert('Team created successfully');
                    document.getElementById('playerFilterSection').classList.remove('hidden'); // Show player filter section
                } else {
                    alert('Error creating team: ' + response.message);
                }
            }
        };
        xhr.send(`teamName=${teamName}&numPlayers=${numPlayers}`);
    }

    function filterPlayers() {
        const roleFilter = document.getElementById('filterBy').value;
        const genderFilter = document.getElementById('genderFilter').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'filterPlayers', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const players = JSON.parse(xhr.responseText);
                updatePlayerList(players);
            }
        };
        xhr.send(`role=${roleFilter}&gender=${genderFilter}`);
    }

    function updatePlayerList(players) {
        const playerList = document.getElementById('playerList');
        playerList.innerHTML = '';

        players.forEach(player => {
            const li = document.createElement('li');
            li.innerHTML = `
                <input type="checkbox" name="player" value="${player.player_id}"> 
                ${player.name} - Matches: ${player.matches}, Batting Avg: ${player.batting_avg}, Bowling Avg: ${player.bowling_avg}`;
            playerList.appendChild(li);
        });
    }

    function comparePlayers() {
        const selectedPlayers = document.querySelectorAll('input[name="player"]:checked');
        const selectedPlayerIds = Array.from(selectedPlayers).map(player => player.value);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'comparePlayers', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const players = JSON.parse(xhr.responseText);
                displayPlayerStats(players);
            }
        };
        xhr.send(`selectedPlayers=${JSON.stringify(selectedPlayerIds)}`);
    }

    function displayPlayerStats(players) {
        const statsContainer = document.getElementById('statsContainer');
        const selectedPlayersStats = document.getElementById('selectedPlayersStats');
        statsContainer.innerHTML = '';

        players.forEach(player => {
            const playerStatsContainer = document.createElement('div');
            playerStatsContainer.classList.add('player-stats-container');
            playerStatsContainer.innerHTML = `
                <h4>${player.name}</h4>
                <p>Matches: ${player.matches}</p>
                <p>Batting Average: ${player.batting_avg}</p>
                <p>Strike Rate: ${player.strike_rate}</p>
                <p>50s: ${player.fifties}, 100s: ${player.hundreds}</p>
                <p>Wickets Taken: ${player.wickets}</p>
                <p>Bowling Average: ${player.bowling_avg}</p>
                <p>Bowling Strike Rate: ${player.bowling_strike_rate}</p>
                <p>Economy Rate: ${player.economy_rate}</p>
                <button type="button" class="btn add-player" onclick="addPlayerToTeam(${player.player_id})">Add Player</button>`;
            statsContainer.appendChild(playerStatsContainer);
        });

        selectedPlayersStats.classList.remove('hidden');
    }

    function addPlayerToTeam(playerId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'addPlayerToTeam', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert('Player added to team successfully');
                } else {
                    alert('Error adding player to team: ' + response.message);
                }
            }
        };
        xhr.send(`teamId=${currentTeamId}&playerId=${playerId}`);
    }
    </script>

    <script src="../Public/js/sidebar.js"></script>
</body>
</html>
