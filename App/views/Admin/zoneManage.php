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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zone Management Dashboard</title>
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
            <h1>Zone Management</h1>
            <p>View, filter, and manage zones across provinces and districts</p>
        </div>
        
        <div class="dashboard-content">
            <!-- Left Column - Zone List and Analytics -->
            <div class="content-section">
                <!-- Zone List -->
                <div class="zones-table card">
                    <div class="section-header">
                        <h2>Manage Zones</h2>
                        <div class="filter-controls">
                            <input type="text" id="zoneSearch" placeholder="Search zones..." class="search-input">
                        </div>
                    </div>
                    
                    <?php if (!empty($data['zones'])): ?>
                    <div class="table-container">
                        <table id="zoneTable">
                            <thead>
                                <tr>
                                    <th>Province</th>
                                    <th>District</th>
                                    <th>Zone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['zones'] as $provinceName => $districts): ?>
                                <?php 
                                // Calculate rowspan for province, which is the sum of all district counts
                                $provinceRowspan = array_sum(array_map('count', $districts));
                                $isFirstProvinceRow = true;
                                ?>
                                <?php foreach ($districts as $districtName => $zones): ?>
                                <?php 
                                // Calculate rowspan for district, which is the count of zones in the district
                                $districtRowspan = count($zones); 
                                ?>
                                <?php foreach ($zones as $zone): ?>
                                <tr>
                                    <!-- Only display province name on the first row of each province -->
                                    <?php if ($isFirstProvinceRow): ?>
                                    <td rowspan="<?php echo $provinceRowspan; ?>" class="province-cell">
                                        <?php echo htmlspecialchars($provinceName); ?>
                                    </td>
                                    <?php $isFirstProvinceRow = false; ?>
                                    <?php endif; ?>

                                    <!-- Display district name with rowspan -->
                                    <?php if ($zone === reset($zones)): ?>
                                    <td rowspan="<?php echo $districtRowspan; ?>" class="district-cell">
                                        <?php echo htmlspecialchars($districtName); ?>
                                    </td>
                                    <?php endif; ?>

                                    <!-- Zone name button -->
                                    <td class="zone-name">
                                        <button class="zone-btn"
                                            onclick="showZoneDetailsInRow('<?php echo htmlspecialchars($zone['zoneName']); ?>', '<?php echo htmlspecialchars($provinceName); ?>', '<?php echo htmlspecialchars($districtName); ?>')">
                                            <?php echo htmlspecialchars($zone['zoneName']); ?>
                                        </button>
                                    </td>

                                    <td class="status-cell">
                                        <!-- Activate/Deactivate button -->
                                        <?php if ($zone['active'] == 0): ?>
                                        <!-- Form to activate the zone -->
                                        <form action="<?php echo ROOT ?>/admin/updateZoneStatus" method="POST">
                                            <input type="hidden" name="zoneName"
                                                value="<?php echo htmlspecialchars($zone['zoneName']); ?>">
                                            <input type="hidden" name="status" value="1">
                                            <button class="status-btn inactive" type="submit">
                                                Inactive
                                            </button>
                                        </form>
                                        <?php else: ?>
                                        <!-- Form to deactivate the zone -->
                                        <form action="<?php echo ROOT ?>/admin/updateZoneStatus" method="POST">
                                            <input type="hidden" name="zoneName"
                                                value="<?php echo htmlspecialchars($zone['zoneName']); ?>">
                                            <input type="hidden" name="status" value="0">
                                            <button class="status-btn active" type="submit">
                                                Active
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="no-data">
                        <p>No zones available</p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Sport Usage Analytics -->
                <div class="analytics-section card" id="analyticsSection">
                    <h2>Sport Usage Analytics</h2>
                    <div class="chart-container" id="chartContainer" style="display: none;">
                        <div class="chart-controls">
                            <select id="sportTimeframe">
                                <option value="month">Last Month</option>
                                <option value="quarter">Last Quarter</option>
                                <option value="year">Last Year</option>
                            </select>
                        </div>
                        <canvas id="sportsChart"></canvas>
                    </div>
                    <div class="no-selection" id="noChartMessage">
                        <p>Select a zone to view sport usage analytics</p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Add Zone & Zone Details -->
            <div class="content-section zone-actions">
                <!-- Add New Zone -->
                <div class="add-zone card" style="margin-top: -20px;">
                    <h2>Add New Zone</h2>
                    <form action="<?php echo ROOT ?>/admin/addZone" method="post" class="zone-form">
                        <div class="form-group">
                            <label for="Province">Province</label>
                            <select id="Province" name="Province" required onchange="updateDistricts()">
                                <option value="" disabled selected>Select Province</option>
                                <option value="Central">Central Province</option>
                                <option value="Eastern">Eastern Province</option>
                                <option value="Northern">Northern Province</option>
                                <option value="Southern">Southern Province</option>
                                <option value="Western">Western Province</option>
                                <option value="North-central">North Central Province</option>
                                <option value="North-western">North Western Province</option>
                                <option value="Sabaragamuwa">Sabaragamuwa Province</option>
                                <option value="Uva">Uva Province</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="District">District</label>
                            <select id="District" name="District" required>
                                <option value="" disabled selected>Select District</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="zone">Zone Name</label>
                            <input type="text" id="zone" name="zone" placeholder="Enter Zone" required>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="primary-btn">Add Zone</button>
                        </div>
                    </form>
                </div>

                <!-- Zone Details -->
                <div class="zone-details card" id="zoneDetailsCard">
                    <h2>Zone Details</h2>
                    <div class="zone-info-container" id="zoneDetailsContainer" style="display: none;">
                        <div class="zone-info">
                            <div class="info-group">
                                <label>Province:</label>
                                <span id="zoneProvince"></span>
                            </div>
                            <div class="info-group">
                                <label>District:</label>
                                <span id="zoneDistrict"></span>
                            </div>
                            <div class="info-group">
                                <label>Zone:</label>
                                <span id="zoneName"></span>
                            </div>
                            <div class="zone-actions">
                                <form id="deleteZoneForm" action="<?php echo ROOT ?>/admin/deleteZone" method="POST">
                                    <input type="hidden" name="zoneName" id="deleteZoneName">
                                    <button class="danger-btn" type="submit" id="deleteButton">
                                        Delete Zone
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="no-selection" id="noSelectionMessage">
                        <p>Select a zone from the table to view details</p>
                    </div>
                </div>
            </div>
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

    <script src="<?php echo ROOT?>/Public/js/Admin/zoneManage.js"></script>
</body>
</html>