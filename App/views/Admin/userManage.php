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
    <title>Manage Users</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/userManage.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/sportForm.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>
</head>

<body>
    <?php require_once 'adminNav.php' ?>

    <?php
// Make sure data is available
if (!isset($data)) {
    die("No data available");
}

// Extract user counts from data
$totalUsers = $data['countUsers'];
$totalPlayers = $data['countPlayers'];
$totalCoaches = $data['countCoaches'];
$totalSchools = $data['countSchools'];
$totalZones = isset($data['countZones'][0]->total) ? $data['countZones'][0]->total : 0;

// Helper function to get user status badge class
function getStatusBadgeClass($status) {
    if ($status === 1) {
        return 'admin-badge-green">Active';
    } elseif ($status === 0) {
        return 'admin-badge-orange">Pending';
    } else {
        return 'admin-badge-danger">Inactive';
    }
}

// Helper function to get avatar class based on role
function getAvatarClass($role) {
    switch ($role) {
        case 'player':
            return 'admin-avatar-player';
        case 'coach':
            return 'admin-avatar-coach';
        case 'school':
            return 'admin-avatar-school';
        default:
            return 'admin-avatar-player';
    }
}

// Helper function to get badge class based on role
function getBadgeClass($role) {
    switch ($role) {
        case 'player':
            return 'admin-badge-blue">Player';
        case 'coach':
            return 'admin-badge-green">Coach';
        case 'school':
            return 'admin-badge-orange">School';
        default:
            return 'admin-badge-blue">User';
    }
}

// Helper function to get user initials
function getUserInitials($firstname, $lname) {
    $firstInitial = !empty($firstname) ? substr($firstname, 0, 1) : '';
    $lastInitial = !empty($lname) ? substr($lname, 0, 1) : '';
    
    if (empty($lastInitial) && !empty($firstInitial)) {
        // For school names or other single names, use first two letters
        return substr($firstname, 0, 2);
    }
    
    return $firstInitial . $lastInitial;
}

// Get zone name by ID
function getZoneName($zoneId, $zones) {
    foreach ($zones as $zone) {
        if ($zone->zoneId == $zoneId) {
            return $zone->zoneName;
        }
    }
    return 'Unknown';
}

// Map users with their details
$userMap = [];
foreach ($data['users'] as $user) {
    $userMap[$user->user_id] = $user;
}

// Map players with their zone info
$playerZoneMap = [];
foreach ($data['players'] as $player) {
    $playerZoneMap[$player->user_id] = $player->zone;
}

// Map coaches with their zone info
$coachZoneMap = [];
foreach ($data['coaches'] as $coach) {
    $coachZoneMap[$coach->user_id] = $coach->zone;
}

// Map schools with their zone info
$schoolZoneMap = [];
foreach ($data['schools'] as $school) {
    $schoolZoneMap[$school->user_id] = $school->zone;
}
?>

  <!-- Custom Alert Box -->
  <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>

<div class="admin-container">
    <div class="admin-content">
        <div class="admin-header">
            <h1 class="admin-title">User Management</h1>
        </div>

        <div class="admin-cards">
            <div class="admin-card">
                <div class="admin-card-icon admin-card-player">
                    <i class="fas fa-running"></i>
                </div>
                <div class="admin-card-info">
                    <div class="admin-card-title">Total Players</div>
                    <div class="admin-card-value"><?php echo $totalPlayers; ?></div>
                    <div class="admin-card-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>12.5% from last month</span>
                    </div>
                </div>
            </div>
            <div class="admin-card">
                <div class="admin-card-icon admin-card-coach">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="admin-card-info">
                    <div class="admin-card-title">Total Coaches</div>
                    <div class="admin-card-value"><?php echo $totalCoaches; ?></div>
                    <div class="admin-card-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>5.2% from last month</span>
                    </div>
                </div>
            </div>
            <div class="admin-card">
                <div class="admin-card-icon admin-card-school">
                    <i class="fas fa-school"></i>
                </div>
                <div class="admin-card-info">
                    <div class="admin-card-title">Total Schools</div>
                    <div class="admin-card-value"><?php echo $totalSchools; ?></div>
                    <div class="admin-card-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>3.7% from last month</span>
                    </div>
                </div>
            </div>
            <div class="admin-card">
                <div class="admin-card-icon admin-card-zone">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="admin-card-info">
                    <div class="admin-card-title">Active Zones</div>
                    <div class="admin-card-value"><?php echo $totalZones; ?></div>
                    <div class="admin-card-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>2 new zones this month</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="<?php echo ROOT?>/admin/searchUSer" method="post">
        <div class="admin-search-bar">
            <h2 class="admin-search-title">Search Users</h2>
            <div class="admin-search-form">
                <div class="admin-form-group">
                    <label class="admin-form-label">Search Term</label>
                    <input type="text" class="admin-form-control" placeholder="Name" name="search_term" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">User Type</label>
                    <div class="admin-select-wrapper">
                        <select class="admin-form-control" name="user_type" placeholder='Select a type' required>
                            <option value="player">Players</option>
                            <option value="coach">Coaches</option>
                            <option value="school">Schools</option>
                        </select>
                    </div>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Zone</label>
                    <div class="admin-select-wrapper">
                        <select class="admin-form-control" name="zone_id" placeholder='Select a zone' required>
                            <?php foreach ($data['zones'] as $zone): ?>
                            <option value="<?php echo $zone->zoneId; ?>" ><?php echo $zone->zoneName; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="admin-search-buttons" style="margin-top:-20px">
                    <button class="admin-btn admin-btn-primary">Search</button>
                    <button class="admin-btn admin-btn-reset">Reset</button>
                </div>
            </div>
        </div>
        </form>

        <div class="admin-card-container">
            <div class="admin-chart-card">
                <h3 class="admin-chart-title">User Growth Trends</h3>
                <div class="admin-chart-container">
                    <canvas id="usersGrowthChart"></canvas>
                </div>
            </div>
            <div class="admin-chart-card">
                <div class="admin-zone-distribution">
                    <h3 class="admin-chart-title">Zone Distribution</h3>
                    <div class="admin-chart-container" style="height: 220px;">
                        <canvas id="zoneDistributionChart"></canvas>
                    </div>
                    <div class="admin-distribution-legends">
                        <?php 
                        $zoneColors = [
                            '34' => '#3498db', // Piliyandala
                            '35' => '#2ecc71', // Kiriella
                            '36' => '#f39c12', // Ratnapura
                            'other' => '#9b59b6'
                        ];
                        
                        $zoneCounts = [];
                        $totalZoneUsers = 0;
                        
                        // Count users per zone
                        foreach ($data['users'] as $user) {
                            $zoneId = null;
                            
                            if ($user->role === 'player' && isset($playerZoneMap[$user->user_id])) {
                                $zoneId = $playerZoneMap[$user->user_id];
                            } else if ($user->role === 'coach' && isset($coachZoneMap[$user->user_id])) {
                                $zoneId = $coachZoneMap[$user->user_id];
                            } else if ($user->role === 'school' && isset($schoolZoneMap[$user->user_id])) {
                                $zoneId = $schoolZoneMap[$user->user_id];
                            }
                            
                            if ($zoneId) {
                                if (!isset($zoneCounts[$zoneId])) {
                                    $zoneCounts[$zoneId] = 0;
                                }
                                $zoneCounts[$zoneId]++;
                                $totalZoneUsers++;
                            }
                        }
                        
                        // Display zone distribution legends
                        foreach ($data['zones'] as $zone) {
                            $count = isset($zoneCounts[$zone->zoneId]) ? $zoneCounts[$zone->zoneId] : 0;
                            $percentage = $totalZoneUsers > 0 ? round(($count / $totalZoneUsers) * 100) : 0;
                            $color = isset($zoneColors[$zone->zoneId]) ? $zoneColors[$zone->zoneId] : $zoneColors['other'];
                        ?>
                        <div class="admin-legend-item">
                            <div class="admin-legend-color" style="background-color: <?php echo $color; ?>;"></div>
                            <span><?php echo $zone->zoneName; ?> (<?php echo $percentage; ?>%)</span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-tab-nav">
            <div class="admin-tab-item active">
                <i class="fas fa-users admin-tab-icon"></i>All Users
                <span class="admin-tab-count active"><?php echo $totalUsers; ?></span>
            </div>
            <div class="admin-tab-item">
                <i class="fas fa-running admin-tab-icon"></i>Players
                <span class="admin-tab-count"><?php echo $totalPlayers; ?></span>
            </div>
            <div class="admin-tab-item">
                <i class="fas fa-user-tie admin-tab-icon"></i>Coaches
                <span class="admin-tab-count"><?php echo $totalCoaches; ?></span>
            </div>
            <div class="admin-tab-item">
                <i class="fas fa-school admin-tab-icon"></i>Schools
                <span class="admin-tab-count"><?php echo $totalSchools; ?></span>
            </div>
        </div>

        <div class="admin-zone-filters">
            <div class="admin-zone-filter active">All Zones</div>
            <?php foreach ($data['zones'] as $zone): ?>
            <div class="admin-zone-filter"><?php echo $zone->zoneName; ?></div>
            <?php endforeach; ?>
        </div>

        <div class="admin-table-wrapper">
            <div class="admin-table-header">
                <h3 class="admin-table-title">User List</h3>
                <div class="admin-table-actions">
                    <button class="admin-btn admin-btn-primary">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                </div>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Type</th>
                        <th>Zone</th>
                        <th>Status</th>
                        <th>Joined Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): 
                        // Determine zone
                        $zoneId = null;
                        if ($user->role === 'player' && isset($playerZoneMap[$user->user_id])) {
                            $zoneId = $playerZoneMap[$user->user_id];
                        } else if ($user->role === 'coach' && isset($coachZoneMap[$user->user_id])) {
                            $zoneId = $coachZoneMap[$user->user_id];
                        } else if ($user->role === 'school' && isset($schoolZoneMap[$user->user_id])) {
                            $zoneId = $schoolZoneMap[$user->user_id];
                        }
                        
                        $zoneName = $zoneId ? getZoneName($zoneId, $data['zones']) : 'N/A';
                    ?>
                    <tr>
                        <td>
                            <div class="admin-table-user">
                                <div class="admin-table-avatar <?php echo getAvatarClass($user->role); ?>">
                                    <?php echo getUserInitials($user->firstname, $user->lname); ?>
                                </div>
                                <div>
                                    <div class="admin-table-name"><?php echo $user->firstname . ' ' . $user->lname; ?></div>
                                    <div class="admin-table-email"><?php echo $user->email; ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="admin-badge <?php echo getBadgeClass($user->role); ?></span>
                        </td>
                        <td><?php echo $zoneName; ?></td>
                        <td>
                            <span class="admin-badge <?php echo getStatusBadgeClass($user->active); ?></span>
                        </td>
                        <td><?php echo $user->regDate; ?></td>
                        <td>
                            <button class="admin-action-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="admin-action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="admin-pagination">
                <div class="admin-pagination-item">
                    <i class="fas fa-angle-left"></i>
                </div>
                <div class="admin-pagination-item active">1</div>
                <div class="admin-pagination-item">2</div>
                <div class="admin-pagination-item">
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script>
    // User Growth Chart
    const usersGrowthCtx = document.getElementById('usersGrowthChart').getContext('2d');
    const usersGrowthChart = new Chart(usersGrowthCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Players',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, <?php echo $totalPlayers - 1; ?>, <?php echo $totalPlayers; ?>],
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Coaches',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, <?php echo $totalCoaches - 1; ?>, <?php echo $totalCoaches; ?>],
                    borderColor: '#2ecc71',
                    backgroundColor: 'rgba(46, 204, 113, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Schools',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, <?php echo $totalSchools - 2; ?>, <?php echo $totalSchools; ?>],
                    borderColor: '#f39c12',
                    backgroundColor: 'rgba(243, 156, 18, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Zone Distribution Chart
    const zoneDistributionCtx = document.getElementById('zoneDistributionChart').getContext('2d');
    
    // Calculate zone distribution
    <?php
    $zoneCounts = [];
    $zoneNames = [];
    $zoneColors = [];
    
    // Set predefined colors for zones
    $colorPalette = ['#3498db', '#2ecc71', '#f39c12', '#9b59b6', '#e74c3c', '#1abc9c'];
    
    foreach ($data['zones'] as $index => $zone) {
        $count = 0;
        
        // Count users in this zone
        foreach ($data['users'] as $user) {
            $userZoneId = null;
            if ($user->role === 'player' && isset($playerZoneMap[$user->user_id])) {
                $userZoneId = $playerZoneMap[$user->user_id];
            } else if ($user->role === 'coach' && isset($coachZoneMap[$user->user_id])) {
                $userZoneId = $coachZoneMap[$user->user_id];
            } else if ($user->role === 'school' && isset($schoolZoneMap[$user->user_id])) {
                $userZoneId = $schoolZoneMap[$user->user_id];
            }
            
            if ($userZoneId == $zone->zoneId) {
                $count++;
            }
        }
        
        $zoneCounts[] = $count;
        $zoneNames[] = $zone->zoneName;
        $zoneColors[] = $colorPalette[$index % count($colorPalette)];
    }
    ?>
    
    const zoneDistributionChart = new Chart(zoneDistributionCtx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($zoneNames); ?>,
            datasets: [{
                data: <?php echo json_encode($zoneCounts); ?>,
                backgroundColor: <?php echo json_encode($zoneColors); ?>,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            cutout: '70%'
        }
    });

    // Tab Navigation
    document.querySelectorAll('.admin-tab-item').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.admin-tab-item').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });

    // Zone Filters
    document.querySelectorAll('.admin-zone-filter').forEach(filter => {
        filter.addEventListener('click', function() {
            document.querySelectorAll('.admin-zone-filter').forEach(f => f.classList.remove('active'));
            filter.classList.add('active');
        });
    });
</script>

<script id="error-message" type="application/json">
<?= json_encode(trim($Error_message)); ?>
</script>

<script id="success-message" type="application/json">
<?= json_encode(trim($Success_message)); ?>
</script>


<script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>
</body>

</html>
