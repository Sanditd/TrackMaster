<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Record Match Performance</title> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
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

    .performance-container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 15px;
    }

    .performance-header {
      text-align: center;
      margin-bottom: 20px;
      padding: 15px;
      background: var(--primary-color);
      color: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
    }

    .performance-header h1 {
      font-size: 1.8rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-bottom: 5px;
    }

    .performance-header p {
      font-size: 1rem;
      opacity: 0.9;
    }

    .performance-form {
      background: white;
      padding: 20px;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
    }

    .section-title {
      margin: 15px 0;
      color: var(--primary-color);
      padding-bottom: 5px;
      border-bottom: 2px solid var(--secondary-color);
    }

    .form-row {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-bottom: 10px;
    }

    .form-group {
      flex: 1 1 200px;
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: var(--primary-color);
      font-weight: 500;
      font-size: 0.9rem;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #ddd;
      border-radius: var(--border-radius);
      font-size: 0.95rem;
      transition: var(--transition);
    }

    .form-group input:focus,
    .form-group select:focus {
      border-color: var(--secondary-color);
      outline: none;
      box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
    }

    .btn {
      background: var(--secondary-color);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: var(--border-radius);
      cursor: pointer;
      font-weight: 600;
      transition: var(--transition);
    }

    .btn:hover {
      background: #cc8400;
    }

    .btn-block {
      display: block;
      width: 100%;
      margin-top: 10px;
    }

    .btn-add {
      background: var(--primary-color);
      margin-bottom: 20px;
    }

    .btn-add:hover {
      background: #003d7a;
    }

    .player-block {
      border: 1px solid #ddd;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: var(--border-radius);
      background: #fefefe;
      position: relative;
    }

    .player-block h4 {
      margin-bottom: 10px;
      color: var(--primary-color);
      font-size: 1rem;
    }

    .remove-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: transparent;
      color: #ff3333;
      border: none;
      cursor: pointer;
      font-size: 1.2rem;
    }

    .stats-container {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }
    
    .batting-stats, .bowling-stats {
      flex: 1 1 300px;
      padding: 8px;
      background: #f9f9f9;
      border-radius: var(--border-radius);
    }

    .team-stats-container {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }

    .team-batting, .team-bowling {
      flex: 1 1 300px;
      padding: 10px;
      background: #f9f9f9;
      border-radius: var(--border-radius);
    }

    .accordion-header {
      background: var(--primary-color);
      color: white;
      padding: 10px 15px;
      border-radius: var(--border-radius);
      margin-bottom: 15px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .accordion-content {
      display: none;
      padding: 0 10px;
    }

    .accordion-content.active {
      display: block;
    }

    .tab-container {
      margin-bottom: 20px;
    }

    .tab-buttons {
      display: flex;
      overflow-x: auto;
      margin-bottom: 15px;
    }

    .tab-btn {
      padding: 8px 16px;
      background: #e0e0e0;
      border: none;
      cursor: pointer;
      border-right: 1px solid #ccc;
    }

    .tab-btn.active {
      background: var(--primary-color);
      color: white;
    }

    .tab-btn:first-child {
      border-radius: var(--border-radius) 0 0 var(--border-radius);
    }

    .tab-btn:last-child {
      border-radius: 0 var(--border-radius) var(--border-radius) 0;
      border-right: none;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
        gap: 0;
      }
      
      .performance-header h1 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

<?php require 'CoachNav.php'; ?>
  <div class="performance-container">
    <div class="performance-header">
      <h1><i class="fas fa-cricket"></i> Record Match Performance</h1>
      <p>Enter match details and track performance of your team and players.</p>
    </div>

    <form class="performance-form" id="matchForm" method="POST" action="/TrackMaster/coach/saveMatch">
      <div class="tab-container">
        <div class="tab-buttons">
          <button type="button" class="tab-btn active" onclick="openTab('match-details')">Match Details</button>
          <button type="button" class="tab-btn" onclick="openTab('team-stats')">Team Stats</button>
          <button type="button" class="tab-btn" onclick="openTab('player-stats')">Player Stats</button>
        </div>

        <!-- Match Details Tab -->
        <div id="match-details" class="tab-content active">
          <h3 class="section-title">Match Information</h3>
          <div class="form-row">
            <div class="form-group">
              <label>Select Team</label>
              <select name="myteam" required>
                <option value="">-- Select Team --</option>
                <?php foreach ($data['teams'] as $team): ?>
                  <option value="<?= $team->team_id ?>"><?= htmlspecialchars($team->team_name) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Opponent Team</label>
              <input type="text" name="opponent" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Date</label>
              <input type="date" name="match_date" required />
            </div>
            <div class="form-group">
              <label>Venue</label>
              <input type="text" name="venue" />
            </div>
            <div class="form-group">
              <label>Match Result</label>
              <select name="result" required>
                <option value="">-- Select Result --</option>
                <option value="won">Won</option>
                <option value="lost">Lost</option>
                <option value="tie">Tie</option>
                <option value="no result">No Result</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Team Stats Tab -->
        <div id="team-stats" class="tab-content">
          <h3 class="section-title">Team Performance</h3>
          <div class="team-stats-container">
            <div class="team-batting">
              <h4>Batting</h4>
              <div class="form-row">
                <div class="form-group">
                  <label>Total Runs</label>
                  <input type="number" name="total_runs" />
                </div>
                <div class="form-group">
                  <label>Wickets Lost</label>
                  <input type="number" name="wickets_lost" />
                </div>
                <div class="form-group">
                  <label>Overs Played</label>
                  <input type="text" name="overs_played" />
                </div>
              </div>
            </div>
            <div class="team-bowling">
              <h4>Bowling & Fielding</h4>
              <div class="form-row">
                <div class="form-group">
                  <label>Runs Given</label>
                  <input type="number" name="runs_given" />
                </div>
                <div class="form-group">
                  <label>Wickets Taken</label>
                  <input type="number" name="wickets_taken" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Overs Bowled</label>
                  <input type="text" name="overs_bowled" />
                </div>
                <div class="form-group">
                  <label>Catches Taken</label>
                  <input type="number" name="catches_taken" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Player Stats Tab -->
        <div id="player-stats" class="tab-content">
          <h3 class="section-title">Individual Player Stats</h3>
          <div id="playersContainer"></div>
          <button type="button" class="btn btn-add" onclick="addPlayer()">+ Add Player</button>
        </div>
      </div>

      <button type="submit" class="btn btn-block">Save Match Record</button>
    </form>
  </div>

  <script>
    let playerIndex = 0;
    let availablePlayers = [];

    // Tab functionality
    function openTab(tabId) {
      const tabs = document.querySelectorAll('.tab-content');
      const buttons = document.querySelectorAll('.tab-btn');
      
      tabs.forEach(tab => {
        tab.classList.remove('active');
      });
      
      buttons.forEach(button => {
        button.classList.remove('active');
      });
      
      document.getElementById(tabId).classList.add('active');
      event.currentTarget.classList.add('active');
    }

    // Fetch players when team is selected
    document.querySelector('select[name="myteam"]').addEventListener('change', function() {
      fetchPlayers(this.value);
      // Switch to player stats tab automatically
      openTab('player-stats');
    });

    function fetchPlayers(teamId) {
      if (!teamId) return;

      fetch(`/TrackMaster/coach/teamPlayers/${teamId}`) 
        .then(res => res.json())
        .then(data => {
          availablePlayers = data;
          document.getElementById('playersContainer').innerHTML = '';
          playerIndex = 0;
          if (data.length > 0) {
            addPlayer();
          } else {
            alert('No players found for this team');
          }
        })
        .catch(err => console.error('Error loading players:', err));
    }

    function addPlayer() {
      if (availablePlayers.length === 0) {
        alert('Please select a team first');
        return;
      }

      const container = document.getElementById('playersContainer');
      const block = document.createElement('div');
      block.classList.add('player-block');

      let playerOptions = `<option value="">-- Select Player --</option>`;
      availablePlayers.forEach(player => {
        playerOptions += `<option value="${player.player_id}">${player.player_name}</option>`;
      });

      block.innerHTML = `
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        <div class="form-group">
          <label>Player</label>
          <select name="players[${playerIndex}][player_id]" required>
            ${playerOptions}
          </select>
        </div>
        <div class="stats-container">
          <div class="batting-stats">
            <h4>Batting</h4>
            <div class="form-row">
              <div class="form-group">
                <label>Runs</label>
                <input type="number" name="players[${playerIndex}][runs]" />
              </div>
              <div class="form-group">
                <label>Balls</label>
                <input type="number" name="players[${playerIndex}][ballsFaced]" />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>4s</label>
                <input type="number" name="players[${playerIndex}][fours]" />
              </div>
              <div class="form-group">
                <label>6s</label>
                <input type="number" name="players[${playerIndex}][sixes]" />
              </div>
            </div>
          </div>
          <div class="bowling-stats">
            <h4>Bowling & Fielding</h4>
            <div class="form-row">
              <div class="form-group">
                <label>Wickets</label>
                <input type="number" name="players[${playerIndex}][wickets]" />
              </div>
              <div class="form-group">
                <label>Overs</label>
                <input type="text" name="players[${playerIndex}][oversBowled]" />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Runs Given</label>
                <input type="number" name="players[${playerIndex}][runsConceded]" />
              </div>
              <div class="form-group">
                <label>Catches</label>
                <input type="number" name="players[${playerIndex}][catches]" />
              </div>
            </div>
          </div>
        </div>
      `;

      container.appendChild(block);
      playerIndex++;
    }
  </script>
</body>
</html>