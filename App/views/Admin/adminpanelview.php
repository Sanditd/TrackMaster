<?php
//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

$userId = (int) $_SESSION['user_id'];

//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getAdminById($userId);

$userActive = $loginModel->getAdminActivation($userId);

//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}

//check user account active status
if ($userActive[0]->active != 1) {
    $_SESSION['error_message'] = 'Login Failed! Try Again.';
    session_unset();
    session_destroy();
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}


$Success_message = "";
$Error_message = "";

// Store success message separately
if (isset($_SESSION['success_message'])) {
    $Success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Store error message separately
if (isset($_SESSION['error_message'])) {
    $Error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Performance Dashboard</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/admindashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
   
    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
    <!-- Quick Stats -->
    <div class="quick-stats">
        <div class="stat-card">
            <i class="fas fa-users icon"></i>
            <span class="label">Total Players</span>
            <span class="value"><?php echo $data['countPlayers']; ?></span>
            <span class="change positive"><i class="fas fa-arrow-up"></i> New additions</span>
        </div>
        <div class="stat-card">
            <i class="fas fa-user-tie icon"></i>
            <span class="label">Total Coaches</span>
            <span class="value"><?php echo $data['countCoaches']; ?></span>
            <span class="change positive"><i class="fas fa-arrow-up"></i> New additions</span>
        </div>
        <div class="stat-card">
            <i class="fas fa-school icon"></i>
            <span class="label">Schools</span>
            <span class="value"><?php echo $data['countSchools']; ?></span>
            <span class="change positive"><i class="fas fa-arrow-up"></i> New additions</span>
        </div>
        <div class="stat-card">
            <i class="fas fa-map-marked-alt icon"></i>
            <span class="label">Zones</span>
            <span class="value"><?php echo $data['countZones'][0]->total; ?></span>
            <span class="change positive"><i class="fas fa-arrow-up"></i> New additions</span>
        </div>
        <div class="stat-card">
            <i class="fas fa-user icon"></i>
            <span class="label">Total Users</span>
            <span class="value"><?php echo $data['countUsers']; ?></span>
            <span class="change positive"><i class="fas fa-arrow-up"></i> New additions</span>
        </div>
    </div>
    
    <!-- Charts -->
    <div class="charts-container">
        <div class="chart-card">
            <h3>Zone Distribution</h3>
            <div class="chart-container">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
        <div class="chart-card">
            <h3>Schools per Zone</h3>
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
        </div>
        <div class="chart-card">
            <h3>User Distribution</h3>
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- User Tables -->
    <div class="performance-table">
        <h3>
            Recent Players
            <span class="view-all">View All</span>
        </h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Sport</th>
                    <th>School</th>
                    <th>Zone</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['players'] as $player): ?>
                <tr>
                    <td>
                        <?php 
                            // Find player name from users array
                            $playerName = "Unknown";
                            foreach($data['users'] as $user) {
                                if($user->user_id == $player->user_id) {
                                    $playerName = $user->firstname . ' ' . $user->lname;
                                    break;
                                }
                            }
                            echo $playerName;
                        ?>
                    </td>
                    <td>
                        <?php 
                            // Note: We don't have sports data in the provided array
                            // In a real scenario, you would look up the sport name
                            echo "Sport ID: " . $player->sport_id;
                        ?>
                    </td>
                    <td>
                        <?php 
                            // Find school name
                            $schoolName = "Unknown";
                            foreach($data['schools'] as $school) {
                                if($school->school_id == $player->school_id) {
                                    $schoolName = $school->school_name;
                                    break;
                                }
                            }
                            echo $schoolName;
                        ?>
                    </td>
                    <td>
                        <?php 
                            // Find zone name
                            $zoneName = "Unknown";
                            foreach($data['zones'] as $zone) {
                                if($zone->zoneId == $player->zone) {
                                    $zoneName = $zone->zoneName;
                                    break;
                                }
                            }
                            echo $zoneName;
                        ?>
                    </td>
                    <td><?php echo $player->role; ?></td>
                    <td><span class="badge badge-<?php echo ($player->statusus == 'Practicing') ? 'success' : 'warning'; ?>"><?php echo $player->statusus; ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="performance-table">
        <h3>
            Recent Coaches
            <span class="view-all">View All</span>
        </h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Sport</th>
                    <th>Zone</th>
                    <th>Type</th>
                    <th>Contact</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['coaches'] as $coach): 
                    // Find coach details from users array
                    $coachDetails = null;
                    foreach($data['users'] as $user) {
                        if($user->user_id == $coach->user_id) {
                            $coachDetails = $user;
                            break;
                        }
                    }
                ?>
                <tr>
                    <td>
                        <?php 
                            if($coachDetails) {
                                echo $coachDetails->firstname . ' ' . $coachDetails->lname;
                            } else {
                                echo "Unknown";
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            // Note: We don't have sports data in the provided array
                            // In a real scenario, you would look up the sport name
                            echo "Sport ID: " . $coach->sport_id; 
                        ?>
                    </td>
                    <td>
                        <?php 
                            $zoneName = "Unknown";
                            foreach($data['zones'] as $zone) {
                                if($zone->zoneId == $coach->zone) {
                                    $zoneName = $zone->zoneName;
                                    break;
                                }
                            }
                            echo $zoneName;
                        ?>
                    </td>
                    <td><?php echo $coach->coach_type; ?></td>
                    <td><?php echo $coachDetails ? $coachDetails->phonenumber : "N/A"; ?></td>
                    <td>
                        <?php if($coachDetails): ?>
                            <span class="badge badge-<?php echo ($coachDetails->active == 1) ? 'success' : 'danger'; ?>">
                                <?php echo ($coachDetails->active == 1) ? 'Active' : 'Inactive'; ?>
                            </span>
                        <?php else: ?>
                            <span class="badge badge-warning">Unknown</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="performance-table">
        <h3>
            Schools
            <span class="view-all">View All</span>
        </h3>
        <table>
            <thead>
                <tr>
                    <th>School Name</th>
                    <th>Zone</th>
                    <th>Province</th>
                    <th>District</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['schools'] as $school): 
                    // Find zone details
                    $zoneDetails = null;
                    foreach($data['zones'] as $zone) {
                        if($zone->zoneId == $school->zone) {
                            $zoneDetails = $zone;
                            break;
                        }
                    }
                ?>
                <tr>
                    <td><?php echo $school->school_name; ?></td>
                    <td>
                        <?php 
                            echo $zoneDetails ? $zoneDetails->zoneName : "Unknown";
                        ?>
                    </td>
                    <td><?php echo $zoneDetails ? $zoneDetails->provinceName : ($school->province ?: "N/A"); ?></td>
                    <td><?php echo $zoneDetails ? $zoneDetails->DisName : ($school->district ?: "N/A"); ?></td>
                    <td>
                        <?php
                            // Find school status from users array
                            $status = "Unknown";
                            $statusClass = "warning";
                            foreach($data['users'] as $user) {
                                if($user->user_id == $school->user_id) {
                                    $status = ($user->active == 1) ? "Active" : "Inactive";
                                    $statusClass = ($user->active == 1) ? "success" : "danger";
                                    break;
                                }
                            }
                        ?>
                        <span class="badge badge-<?php echo $statusClass; ?>">
                            <?php echo $status; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Admin Shortcuts -->
    <div class="shortcuts-container">
        <div class="shortcut-card">
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="label">Add Player</div>
        </div>
        <div class="shortcut-card">
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="label">Add Coach</div>
        </div>
        <div class="shortcut-card">
            <div class="icon">
                <i class="fas fa-school"></i>
            </div>
            <div class="label">Add School</div>
        </div>
        <div class="shortcut-card">
            <div class="icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="label">Manage Zones</div>
        </div>
        <div class="shortcut-card">
            <div class="icon">
                <i class="fas fa-futbol"></i>
            </div>
            <div class="label">Add Sport</div>
        </div>
        <div class="shortcut-card">
            <div class="icon">
                <i class="fas fa-file-export"></i>
            </div>
            <div class="label">Export Data</div>
        </div>
    </div>
    
    <!-- Latest Activity -->
    <div class="logs-container">
        <h3>
            Recent Registrations
            <span class="view-all">View All</span>
        </h3>
        <?php 
        // Sort users by registration date in descending order
        $users = $data['users'];
        usort($users, function($a, $b) {
            return strtotime($b->regDate) - strtotime($a->regDate);
        });
        
        // Display the 5 most recent registrations
        $count = 0;
        foreach($users as $user): 
            if($count >= 5) break;
            $count++;
            
            // Determine icon based on role
            $icon = 'fas fa-user';
            switch($user->role) {
                case 'player': $icon = 'fas fa-running'; break;
                case 'coach': $icon = 'fas fa-user-tie'; break;
                case 'school': $icon = 'fas fa-school'; break;
            }
        ?>
        <div class="log-item">
            <div class="log-icon">
                <i class="<?php echo $icon; ?>"></i>
            </div>
            <div class="log-content">
                <div class="log-title">
                    New <?php echo $user->role; ?> registered: 
                    <?php echo $user->firstname . ' ' . $user->lname; ?>
                    <?php echo ($user->active == 1) ? 
                        '<span class="badge badge-success">Active</span>' : 
                        '<span class="badge badge-danger">Inactive</span>'; ?>
                </div>
                <div class="log-time"><?php echo $user->regDate; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
    
    <script>
        // Prepare data for charts
        const zoneNames = [<?php 
            $zoneNamesArray = [];
            foreach($data['zones'] as $zone) {
                $zoneNamesArray[] = "'" . $zone->zoneName . "'";
            }
            echo implode(',', $zoneNamesArray); 
        ?>];
        
        // Count schools per zone
        const schoolsPerZone = {};
        <?php foreach($data['zones'] as $zone): ?>
            schoolsPerZone['<?php echo $zone->zoneId; ?>'] = 0;
        <?php endforeach; ?>
        
        <?php foreach($data['schools'] as $school): ?>
            if(schoolsPerZone['<?php echo $school->zone; ?>'] !== undefined) {
                schoolsPerZone['<?php echo $school->zone; ?>']++;
            }
        <?php endforeach; ?>
        
        const schoolsPerZoneData = Object.values(schoolsPerZone);
        
        // Pie Chart - Zone Distribution
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: zoneNames,
                datasets: [{
                    data: schoolsPerZoneData,
                    backgroundColor: [
                        '#3498db',
                        '#2ecc71',
                        '#e74c3c',
                        '#f39c12',
                        '#9b59b6'
                    ],
                    borderColor: [
                        '#fff',
                        '#fff',
                        '#fff',
                        '#fff',
                        '#fff'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        
        // Bar Chart - Schools per Zone
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: zoneNames,
                datasets: [{
                    label: 'Number of Schools',
                    data: schoolsPerZoneData,
                    backgroundColor: '#3498db',
                    borderColor: '#2980b9',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
        
        // Line Chart - User Distribution
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(lineCtx, {
            type: 'doughnut',
            data: {
                labels: ['Players', 'Coaches', 'Schools', 'Other Users'],
                datasets: [{
                    data: [
                        <?php echo $data['countPlayers']; ?>, 
                        <?php echo $data['countCoaches']; ?>, 
                        <?php echo $data['countSchools']; ?>, 
                        <?php echo $data['countUsers'] - $data['countPlayers'] - $data['countCoaches'] - $data['countSchools']; ?>
                    ],
                    backgroundColor: [
                        'rgba(52, 152, 219, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(155, 89, 182, 0.7)',
                        'rgba(243, 156, 18, 0.7)'
                    ],
                    borderColor: [
                        '#3498db',
                        '#2ecc71',
                        '#9b59b6',
                        '#f39c12'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>