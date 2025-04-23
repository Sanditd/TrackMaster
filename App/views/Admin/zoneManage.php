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
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/form.css"> -->
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/zoneManage.css">
    <script src="<?php echo ROOT?>/Public/js/Admin/sidebar.js"></script>

    <!-- FullCalendar CSS and JS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script> -->
</head>

<body>
    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>

    <div id="frame" style="margin-top: 100px; margin-left:100px">
        <div class="container">

            <div class="temp-container">
                <div id="signup-port">

                    <div class="temp2-container">
                        <div class="column">
                            <h3>Manage Zones</h3>
                            <br>
                            <?php if (!empty($data['zones'])): ?>
                            <table>
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
                                        <td rowspan="<?php echo $provinceRowspan; ?>">
                                            <?php echo htmlspecialchars($provinceName); ?>
                                        </td>
                                        <?php $isFirstProvinceRow = false; ?>
                                        <?php endif; ?>

                                        <!-- Display district name with rowspan -->
                                        <?php if ($zone === reset($zones)): ?>
                                        <td rowspan="<?php echo $districtRowspan; ?>">
                                            <?php echo htmlspecialchars($districtName); ?>
                                        </td>
                                        <?php endif; ?>

                                        <!-- Zone name button -->
                                        <td>
                                            <button
                                                style="background-color: transparent; border: none; text-decoration: none; color: inherit; cursor: pointer;"
                                                onclick="showZoneDetailsInRow('<?php echo htmlspecialchars($zone['zoneName']); ?>', '<?php echo htmlspecialchars($provinceName); ?>', '<?php echo htmlspecialchars($districtName); ?>')">
                                                <?php echo htmlspecialchars($zone['zoneName']); ?>
                                            </button>
                                        </td>


                                        <td>

                                            <!-- Activate/Deactivate button -->
                                            <?php if ($zone['active'] == 0): ?>
                                            <!-- Form to deactivate the zone -->
                                            <form action="<?php echo ROOT ?>/admin/updateZoneStatus" method="POST">
                                                <input type="hidden" name="zoneName"
                                                    value="<?php echo htmlspecialchars($zone['zoneName']); ?>">
                                                <input type="hidden" name="status" value="1">
                                                <button
                                                    style="background-color: #FF0000; border: none; text-decoration: none; color: inherit; cursor: pointer; padding:10px; border-radius: 6px;"
                                                    type="submit">
                                                    Deactive
                                                </button>
                                            </form>
                                            <?php else: ?>
                                            <!-- Form to activate the zone -->
                                            <form action="<?php echo ROOT ?>/admin/updateZoneStatus" method="POST">
                                                <input type="hidden" name="zoneName"
                                                    value="<?php echo htmlspecialchars($zone['zoneName']); ?>">
                                                <input type="hidden" name="status" value="0">
                                                <button
                                                    style="background-color: #007BFF; border: none; text-decoration: none; color: inherit; cursor: pointer; padding:10px; border-radius: 6px;"
                                                    type="submit">
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
                            <?php else: ?>
                            <p>No zones available</p>
                            <?php endif; ?>


                        </div>

                        <div class="column">
                            <h3>Add New Zone</h3>
                            <br>

                            <form action="<?php echo ROOT ?>/admin/addZone" method="post">


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
                                    <label for="zone">Zone</label>
                                    <input type="text" id="zone" name="zone" placeholder="Enter Zone" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" style="background-color:#007BFF;width:20%">Submit</button>
                                </div>

                            </form>
                            <br><br>

                            <div class="form-group">
                                <h4>View Zone</h4>
                                <br>
                                <table>
                                    <tbody>
                                        <tr id="zoneDetailsRow" style="display: none;">
                                            <td id="zoneProvince"></td> <!-- Province Name -->
                                            <td id="zoneDistrict"></td> <!-- District Name -->
                                            <td id="zoneName"></td> <!-- Zone Name -->
                                            <td>
                                                <form id="deleteZoneForm" action="<?php echo ROOT ?>/admin/deleteZone"
                                                    method="POST">
                                                    <input type="hidden" name="zoneName" id="deleteZoneName">
                                                    <button
                                                        style="background-color: #DC3545; border: none; text-decoration: none; color: #FFF; cursor: pointer; padding:10px; border-radius: 6px;"
                                                        type="submit" id="deleteButton">
                                                        Delete Zone
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>

                    </div>

                </div>
            </div>



        </div>
    </div>


    <!-- Custom Alert Box -->
    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>


</body>

<script>
const provinceDistricts = {
    Central: ["Kandy", "Matale", "Nuwara Eliya"],
    Eastern: ["Batticaloa", "Ampara", "Trincomalee"],
    Northern: ["Jaffna", "Kilinochchi", "Mannar", "Vavuniya", "Mullaitivu"],
    Southern: ["Galle", "Matara", "Hambantota"],
    Western: ["Colombo", "Gampaha", "Kalutara"],
    "North-central": ["Anuradhapura", "Polonnaruwa"],
    "North-western": ["Kurunegala", "Puttalam"],
    Sabaragamuwa: ["Ratnapura", "Kegalle"],
    Uva: ["Badulla", "Moneragala"]
};

function updateDistricts() {
    const province = document.getElementById("Province").value;
    const districtSelect = document.getElementById("District");

    // Clear previous options
    districtSelect.innerHTML = '<option value="" disabled selected>Select District</option>';

    // Populate districts
    if (province && provinceDistricts[province]) {
        provinceDistricts[province].forEach(district => {
            const option = document.createElement("option");
            option.value = district.replace(" ", "-");
            option.textContent = district;
            districtSelect.appendChild(option);
        });
    }
}

// Show the alert box
function showCustomAlert(message) {
    document.getElementById('customAlertMessage').innerText = message;
    document.getElementById('customAlertOverlay').style.display = 'flex';
}

// Hide the alert box
function hideCustomAlert() {
    document.getElementById('customAlertOverlay').style.display = 'none';
}

// Check for error or success message from PHP and display the alert
<?php if (!empty($data['errormsg']) || isset($_GET['error']) || isset($_GET['success'])): ?>
const alertMessage =
    <?php 
    echo json_encode(
        !empty($data['errormsg']) 
            ? $data['errormsg'] 
            : (!empty($_GET['error']) 
                ? htmlspecialchars($_GET['error']) 
                : htmlspecialchars($_GET['success']))
    ); 
    ?>;
showCustomAlert(alertMessage);
<?php endif; ?>


function updateZoneStatus(zoneName, status) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/admin/updateZoneStatus', true); // Adjust the URL according to your routing setup
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle response from the backend
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                alert(response.message); // Show success message
                // Optionally, you can also update the button or page content dynamically
                // For example, you can change the button to "Deactivate" if the zone is activated
                location.reload(); // Reload the page to reflect changes
            } else {
                alert(response.message); // Show error message
            }
        }
    };

    // Send data to the server
    xhr.send('zoneName=' + encodeURIComponent(zoneName) + '&status=' + status);
}


function showZoneDetailsInRow(zoneName, provinceName, districtName) {
    // Populate individual cells with the details
    document.getElementById('zoneProvince').textContent = provinceName;
    document.getElementById('zoneDistrict').textContent = districtName;
    document.getElementById('zoneName').textContent = zoneName;

    // Set the hidden input value for the delete form
    const deleteZoneNameInput = document.getElementById('deleteZoneName');
    deleteZoneNameInput.value = zoneName;

    // Show the row
    const detailsRow = document.getElementById('zoneDetailsRow');
    detailsRow.style.display = 'table-row';
}
</script>

</html>