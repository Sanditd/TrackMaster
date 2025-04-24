<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Management Dashboard</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/zoneManageNew.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>
    <!-- Chart.js for data visualization -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body>
    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>

    <div class="main-container">
        <div class="dashboard-header">
            <h1>Sport Management</h1>
            <p>View, edit, and manage sports across all categories</p>
        </div>

        <div class="t">
            <!-- Left Column - Sports List and Analytics -->
            <div class="content-section" style="width:100%">
                <!-- Sports List -->
                <div class="zones-table card">
                    <div class="section-header">
                        <h2>Manage Sports</h2>
                        <div class="filter-controls">
                            <input type="text" id="sportSearch" placeholder="Search sports..." class="search-input">
                        </div>
                    </div>

                    <?php if (!empty($data) && is_array($data)): ?>
                    <div class="table-container">
                        <table id="sportTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sport Name</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $index => $sport): ?>
                                <?php if (is_object($sport)): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td class="sport-name">
                                        <button class="zone-btn"
                                            onclick="showCharts('<?= htmlspecialchars($sport->sport_id) ?>')">
                                            <?= htmlspecialchars($sport->sport_name) ?>
                                        </button>
                                    </td>
                                    <td><?= htmlspecialchars($sport->sport_type) ?></td>
                                    <td>
                                        <div style="display: flex; gap: 8px;">
                                            <button class="primary-btn"
                                                onclick="viewSport(<?= $sport->sport_id ?>, '<?= $sport->sport_type ?>')">View</button>
                                            <button class="primary-btn"
                                                onclick="editSport(<?= htmlspecialchars(json_encode($sport->sport_id)) ?>, '<?= htmlspecialchars($sport->sport_type) ?>')">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php elseif (is_array($sport)): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td class="sport-name">
                                        <button class="zone-btn"
                                            onclick="showCharts('<?= htmlspecialchars($sport['sport_id']) ?>')">
                                            <?= htmlspecialchars($sport['sport_name']) ?>
                                        </button>
                                    </td>
                                    <td><?= htmlspecialchars($sport['sport_type']) ?></td>
                                    <td>
                                        <div style="display: flex; gap: 8px;">
                                            <button class="primary-btn"
                                                onclick="viewSport(<?= $sport['sport_id'] ?>, '<?= $sport['sport_type'] ?>')">View</button>
                                            <button class="primary-btn"
                                                onclick="editSport(<?= htmlspecialchars(json_encode($sport['sport_id'])) ?>, '<?= htmlspecialchars($sport['sport_type']) ?>')">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                    <?php else: ?>
                    <div class="no-data">
                        <p>No sports available</p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Player Growth Analytics -->
                <div class="analytics-section card" id="analyticsSection">
                    <h2>Player Growth Analytics</h2>
                    <div class="chart-container" id="chartContainer" style="display: none;">
                        <div class="chart-controls">
                            <select id="playerTimeframe">
                                <option value="month">Last Month</option>
                                <option value="quarter">Last Quarter</option>
                                <option value="year">Last Year</option>
                            </select>
                        </div>
                        <canvas id="playerGrowthChart"></canvas>
                    </div>
                    <div class="no-selection" id="noChartMessage">
                        <p>Select a sport to view player growth analytics</p>
                    </div>
                </div>

                <!-- Gender Distribution Chart -->
                <div class="analytics-section card">
                    <h2>Player Gender Distribution</h2>
                    <div class="chart-container" id="genderChartContainer" style="display: none;">
                        <canvas id="genderDistributionChart"></canvas>
                    </div>
                    <div class="no-selection" id="noGenderChartMessage">
                        <p>Select a sport to view gender distribution</p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Add Sport Only -->

        </div>
    </div>

    <!-- Custom Alert Box -->
    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <div class="alert-header">
                <h2>Notice</h2>
            </div>
            <div class="alert-body">
                <p id="customAlertMessage"></p>
            </div>
            <div class="alert-footer">
                <button onclick="hideCustomAlert()" class="alert-btn">OK</button>
            </div>
        </div>
    </div>

    <script>
    // Search functionality
    document.getElementById('sportSearch').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#sportTable tbody tr');

        rows.forEach(row => {
            const sportName = row.querySelector('.sport-name').textContent.toLowerCase();
            const sportType = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

            if (sportName.includes(searchTerm) || sportType.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Show charts when sport name is clicked
    function showCharts(sportId) {
        const chartContainer = document.getElementById('chartContainer');
        const noChartMessage = document.getElementById('noChartMessage');
        const genderChartContainer = document.getElementById('genderChartContainer');
        const noGenderChartMessage = document.getElementById('noGenderChartMessage');

        if (chartContainer) chartContainer.style.display = 'block';
        if (noChartMessage) noChartMessage.style.display = 'none';
        if (genderChartContainer) genderChartContainer.style.display = 'block';
        if (noGenderChartMessage) noGenderChartMessage.style.display = 'none';

        generatePlayerGrowthChart(sportId);
        generateGenderDistributionChart(sportId);
    }

    // Handle view sport logic
    function viewSport(sportId, sportType) {
        const root = '<?php echo ROOT ?>';

        let view = '';
        if (sportType === 'IndSport') {
            view = 'indSportView';
        } else if (sportType === 'teamSport') {
            view = 'teamSportView';
        } else {
            console.error('Unknown sport type:', sportType);
            return;
        }

        const url = `${root}/admin/${view}/${encodeURIComponent(sportId)}`;
        window.location.href = url;
    }

    // Handle edit sport logic
    function editSport(sportId, sportType) {
        const root = '<?php echo ROOT ?>';

        let url = '';
        if (sportType === 'IndSport') {
            url = `${root}/admin/updateIndSport/${encodeURIComponent(sportId)}`;
        } else if (sportType === 'teamSport') {
            url = `${root}/admin/updateTeamSport/${encodeURIComponent(sportId)}`;
        } else {
            showCustomAlert('Unknown sport type.');
            return;
        }

        window.location.href = url;
    }

    // Show custom alert
    function showCustomAlert(message) {
        document.getElementById('customAlertMessage').textContent = message;
        document.getElementById('customAlertOverlay').style.display = 'flex';
    }

    // Hide custom alert
    function hideCustomAlert() {
        document.getElementById('customAlertOverlay').style.display = 'none';
    }

    // Generate player growth chart
    function generatePlayerGrowthChart(sportId) {
        // Get the canvas element
        const ctx = document.getElementById('playerGrowthChart').getContext('2d');

        // Clear any existing chart
        if (window.playerGrowthChart) {
            window.playerGrowthChart.destroy();
        }

        // Generate mock data for player growth (in a real app, you'd fetch this from your server)
        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const data = {
            labels: labels,
            datasets: [{
                label: 'New Players',
                data: Array.from({
                    length: 12
                }, () => Math.floor(Math.random() * 50) + 10),
                borderColor: '#007BFF',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                tension: 0.4,
                fill: true
            }]
        };

        // Chart configuration
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of New Players'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Player Growth Over Time'
                    }
                }
            }
        };

        // Create the chart
        window.playerGrowthChart = new Chart(ctx, config);

        // Update the chart when the timeframe changes
        document.getElementById('playerTimeframe').addEventListener('change', function() {
            const timeframe = this.value;
            let newLabels = labels;
            let newData = data.datasets[0].data;

            if (timeframe === 'quarter') {
                newLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8',
                    'Week 9', 'Week 10', 'Week 11', 'Week 12'
                ];
                newData = Array.from({
                    length: 12
                }, () => Math.floor(Math.random() * 20) + 5);
            } else if (timeframe === 'year') {
                newLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                'Dec'];
                newData = Array.from({
                    length: 12
                }, () => Math.floor(Math.random() * 100) + 20);
            } else {
                newLabels = ['Day 1', 'Day 5', 'Day 10', 'Day 15', 'Day 20', 'Day 25', 'Day 30'];
                newData = Array.from({
                    length: 7
                }, () => Math.floor(Math.random() * 10) + 2);
            }

            window.playerGrowthChart.data.labels = newLabels;
            window.playerGrowthChart.data.datasets[0].data = newData;
            window.playerGrowthChart.update();
        });
    }

    // Generate gender distribution chart
    function generateGenderDistributionChart(sportId) {
        // Get the canvas element
        const ctx = document.getElementById('genderDistributionChart').getContext('2d');

        // Clear any existing chart
        if (window.genderDistributionChart) {
            window.genderDistributionChart.destroy();
        }

        // Generate mock data for gender distribution
        const data = {
            labels: ['Male', 'Female', 'Other'],
            datasets: [{
                data: [Math.floor(Math.random() * 70) + 30, Math.floor(Math.random() * 50) + 10, Math.floor(
                    Math.random() * 5)],
                backgroundColor: ['#007BFF', '#DC3545', '#FFC107'],
                hoverOffset: 4
            }]
        };

        // Chart configuration
        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Player Gender Distribution'
                    },
                    legend: {
                        position: 'right'
                    }
                }
            }
        };

        // Create the chart
        window.genderDistributionChart = new Chart(ctx, config);
    }
    </script>
</body>

</html>