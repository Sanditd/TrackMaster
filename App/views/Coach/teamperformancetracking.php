    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Team Performance Tracker</title>
    <style>
        :root {
        --primary: #00264d;
        --accent: #ffa500;
        --bg: #f4f4f9;
        --white: #fff;
        --radius: 10px;
        --shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        body {
        font-family: 'Segoe UI', sans-serif;
        background: var(--bg);
        color: #333;
        margin: 0;
        padding: 20px;
        }

        h1 {
        color: var(--primary);
        text-align: center;
        margin-bottom: 30px;
        }

        .filter-bar {
        max-width: 700px;
        margin: 0 auto 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        }

        select {
        padding: 8px 12px;
        border-radius: var(--radius);
        border: 1px solid #ccc;
        font-size: 1rem;
        }

        .match-table {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        border-collapse: collapse;
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        }

        .match-table thead {
        background: var(--primary);
        color: var(--white);
        }

        .match-table th,
        .match-table td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #eee;
        }

        .match-table tbody tr:hover {
        background: #f1f1f1;
        }

        .status-won {
        color: green;
        font-weight: bold;
        }

        .status-lost {
        color: red;
        font-weight: bold;
        }

        .status-tie {
        color: #444;
        font-weight: bold;
        }

        .no-data {
        text-align: center;
        color: var(--accent);
        padding: 40px;
        font-size: 1.1rem;
        }

        @media (max-width: 768px) {
        .match-table th,
        .match-table td {
            font-size: 0.9rem;
        }
        }
    </style>
    </head>
    <body>

    <h1>Team Performance Tracker</h1>

    <div class="filter-bar">
        <label for="filter">Filter: </label>
        <select id="filter">
        <option value="all">All</option>
        <option value="won">Won</option>
        <option value="lost">Lost</option>
        <option value="tie">Tie</option>
        </select>
    </div>

    <table class="match-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Opponent</th>
            <th>Venue</th>
            <th>Result</th>
            <th>Runs</th>
            <th>Wickets</th>
            <th>Overs</th>
        </tr>
        </thead>
        <tbody id="matchData">
        <!-- Match rows will be added here from backend -->
        <tr>
            <td colspan="7" class="no-data">No match data available. Connect to backend.</td>
        </tr>
        </tbody>
    </table>

    <script>
        // For future dynamic data from backend (via AJAX/Fetch or PHP)
        document.getElementById('filter').addEventListener('change', function () {
        // Placeholder for filter functionality
        alert('Filtering will work once backend is connected.');
        });
    </script>

    </body>
    </html>
