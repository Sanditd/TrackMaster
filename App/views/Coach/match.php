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
      margin: 30px auto;
      padding: 20px;
    }

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
      font-size: 2rem;
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

    .performance-form {
      background: white;
      padding: 25px;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
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

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: var(--border-radius);
      font-size: 1rem;
      transition: var(--transition);
    }

    .form-group input:focus,
    .form-group select:focus {
      border-color: var(--secondary-color);
      outline: none;
      box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
    }

    .submit-btn {
      background: var(--secondary-color);
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: var(--border-radius);
      cursor: pointer;
      font-weight: 600;
      transition: var(--transition);
      width: 100%;
      margin-top: 10px;
    }

    .submit-btn:hover {
      background: #cc8400;
    }

    .player-block {
      border: 1px solid #ddd;
      padding: 20px;
      margin-bottom: 25px;
      border-radius: var(--border-radius);
      background: #fefefe;
    }

    .player-block h4 {
      margin-bottom: 15px;
      color: var(--primary-color);
    }

    .remove-btn {
      background: transparent;
      color: red;
      font-weight: 600;
      border: none;
      cursor: pointer;
      float: right;
      margin-top: -10px;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .performance-header h1 {
        font-size: 1.6rem;
      }
    }
  </style>
</head>
<body>


  <div class="performance-container">
    <div class="performance-header">
      <h1><i class="fas fa-cricket"></i> Record Match Performance</h1>
      <p>Enter match details and track performance of your team and players.</p>
    </div>

    <form class="performance-form" id="matchForm" method="POST" action="/TrackMaster/coach/saveMatch">

      <!-- Match Info -->
      <h3 style="margin-bottom: 15px; color: var(--primary-color);">Match Information</h3>
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

      <!-- Team Performance -->
      <h3 style="margin: 30px 0 15px; color: var(--primary-color);">Team Performance</h3>
     
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
      <div class="form-group">
  <label>Runs Given</label>
  <input type="number" name="runs_given" /> <!-- Changed from total_runs -->
</div>
<div class="form-group">
  <label>Wickets Taken</label>
  <input type="number" name="wickets_taken" /> <!-- Changed from wickets_lost -->
</div>
<div class="form-group">
  <label>Overs Bowled</label>
  <input type="text" name="overs_bowled" /> <!-- Changed from overs_played -->
</div>
<div class="form-group">
  <label>Catches Taken</label>
  <input type="number" name="catches_taken" /> <!-- Changed from overs_played -->
</div>

      <!-- Player Stats -->
      <h3 style="margin: 40px 0 20px; color: var(--primary-color);">Individual Player Stats</h3>
      <div id="playersContainer"></div>
      <button type="button" class="submit-btn" onclick="addPlayer()">+ Add Player</button>

      <button type="submit" class="submit-btn">Save Match Record</button>
    </form>
  </div>

  <script>
let playerIndex = 0;
let availablePlayers = [];

// Fetch players when team is selected
document.querySelector('select[name="myteam"]').addEventListener('change', function() {
    fetchPlayers(this.value);
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
      <button type="button" class="remove-btn" onclick="this.parentElement.remove()">Remove</button>
      <div class="form-group">
        <label>Player</label>
        <select name="players[${playerIndex}][player_id]" required>
          ${playerOptions}
        </select>
      </div>
      <div class="form-group"><label>Runs Scored</label>
        <input type="number" name="players[${playerIndex}][runs]" />
      </div>
      <div class="form-group"><label>Balls Faced</label>
        <input type="number" name="players[${playerIndex}][ballsFaced]" />
      </div>
      <div class="form-group"><label>Fours</label>
        <input type="number" name="players[${playerIndex}][fours]" />
      </div>
      <div class="form-group"><label>Sixes</label>
        <input type="number" name="players[${playerIndex}][sixes]" />
      </div>
      <div class="form-group"><label>Wickets Taken</label>
        <input type="number" name="players[${playerIndex}][wickets]" />
      </div>
      <div class="form-group"><label>Overs Bowled</label>
        <input type="text" name="players[${playerIndex}][oversBowled]" />
      </div>
      <div class="form-group"><label>Runs Conceded</label>
        <input type="number" name="players[${playerIndex}][runsConceded]" />
      </div>
      <div class="form-group"><label>Catches Taken</label>
        <input type="number" name="players[${playerIndex}][catches]" />
      </div>
    `;

    container.appendChild(block);
    playerIndex++;
  }

  // Optionally add the first block on load
  // window.onload = () => fetchPlayers(document.getElementById('teamSelect').value);
</script>

</body>
</html>
