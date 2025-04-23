<!DOCTYPE html>
<html lang="en">
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

//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/adminLogin');
    exit;
}
$Success_message = "";
$Error_message = "";

if (isset($_SESSION['success_message'])) {
    $Success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    $Error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$zones = $zones ?? [];
$sports = $sports ?? [];
$zonalSports = $zonalSports ?? [];
$users = $users ?? [];
$FromCoaches = $FromCoaches ?? [];

// Restructure zonalSports to [zoneId][sportId] => coachId
$formattedZonalSports = [];
foreach ($zonalSports as $zs) {
    $zid = $zs->zone_id;
    $sid = $zs->sport_id;
    $cid = $zs->coach_id;
    $formattedZonalSports[$zid][$sid] = $cid;
}
?>

<head>
    <meta charset="UTF-8">
    <title>Sport Assign</title>
    <link rel="stylesheet" href="<?= ROOT ?>/Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/Public/css/Admin/zoneManage.css">
    <script src="<?= ROOT ?>/Public/js/Admin/sidebar.js"></script>
    <style>
        .rounded-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 10px;
        }
        input, select, button {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            vertical-align: middle;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
<div id="customAlertOverlay">
    <div id="customAlertBox">
        <h2>Notice</h2>
        <p id="customAlertMessage"></p>
        <button onclick="hideCustomAlert()">OK</button>
    </div>
</div>

<div class="adminNav"><?php require_once 'adminNav.php' ?></div>

<div style="margin-top: 100px; margin-left:100px">
    <div class="container">
        <div class="temp-container">
            <div id="signup-port">
                <?php if ($Success_message): ?>
                    <!-- <div class="alert alert-success"><?= htmlspecialchars($Success_message) ?></div> -->
                <?php endif; ?>
                <?php if ($Error_message): ?>
                    <!-- <div class="alert alert-danger"><?= htmlspecialchars($Error_message) ?></div> -->
                <?php endif; ?>

                <div class="temp2-container">
                    <div class="column">
                        <label>Select Province:</label><br>
                        <select id="provinceDropdown" class="rounded-btn" style="width:300px; height:40px;">
                            <option value="">-- Select Province --</option>
                        </select>
                    </div>

                    <div class="column">
                        <label>Select District:</label><br>
                        <select id="districtDropdown" class="rounded-btn" style="width:300px; height:40px;" disabled>
                            <option value="">-- Select District --</option>
                        </select>
                    </div>

                    <div class="column">
                        <label>Select Zone:</label><br>
                        <select id="zoneDropdown" class="rounded-btn" style="width:300px; height:40px;" disabled>
                            <option value="">-- Select Zone --</option>
                        </select>
                    </div>
                </div>

                <br><br>

                <form id="zonalForm" method="post" action="<?= ROOT ?>/admin/zonalSport">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Zone Name</th>
                                <th>Sport</th>
                                <th>Select Coach</th>
                            </tr>
                        </thead>
                        <tbody id="zoneTableBody"></tbody>
                    </table>
                    <br>
                    <button type="submit" class="rounded-btn" style="width:20%;height:40px;">Save Selection</button>
                </form>
            </div>
            
        <!-- </div>
        user details <br>
        <?php print_r($users) ?>
        <br><br>
        coaches details <br>
        <?php print_r($FromCoaches) ?>
        <br><br>
        Sports details <br>
        <?php print_r($sports) ?>
        <br><br>
        zonal Sports details<br>
        <?php print_r($zonalSports) ?>
        <br><br>
        zones details<br>
        <?php print_r($zones) ?>
        <br><br> -->
    </div>
</div>

<script>
const zones = <?= json_encode($zones) ?>;
const sports = <?= json_encode($sports) ?>;
const coachesData = <?= json_encode($FromCoaches) ?>;
const users = <?= json_encode($users) ?>;
const zonalSports = <?= json_encode($formattedZonalSports) ?>;

const provinceDropdown = document.getElementById('provinceDropdown');
const districtDropdown = document.getElementById('districtDropdown');
const zoneDropdown = document.getElementById('zoneDropdown');
const tbody = document.getElementById('zoneTableBody');

// Populate Province Dropdown
const provinces = [...new Set(zones.map(z => z.provinceName))];
provinces.forEach(province => {
    const opt = document.createElement('option');
    opt.value = province;
    opt.textContent = province;
    provinceDropdown.appendChild(opt);
});

// Province Change
provinceDropdown.addEventListener('change', () => {
    districtDropdown.innerHTML = '<option value="">-- Select District --</option>';
    zoneDropdown.innerHTML = '<option value="">-- Select Zone --</option>';
    tbody.innerHTML = '';
    districtDropdown.disabled = true;
    zoneDropdown.disabled = true;

    const selectedProvince = provinceDropdown.value;
    if (!selectedProvince) return;

    const districts = [...new Set(zones.filter(z => z.provinceName === selectedProvince).map(z => z.DisName))];
    districts.forEach(district => {
        const opt = document.createElement('option');
        opt.value = district;
        opt.textContent = district;
        districtDropdown.appendChild(opt);
    });
    districtDropdown.disabled = false;
});

// District Change
districtDropdown.addEventListener('change', () => {
    zoneDropdown.innerHTML = '<option value="">-- Select Zone --</option>';
    tbody.innerHTML = '';
    zoneDropdown.disabled = true;

    const selectedProvince = provinceDropdown.value;
    const selectedDistrict = districtDropdown.value;
    if (!selectedDistrict) return;

    const filteredZones = zones.filter(z => z.provinceName === selectedProvince && z.DisName === selectedDistrict);
    filteredZones.forEach(zone => {
        const opt = document.createElement('option');
        opt.value = zone.zoneId;
        opt.textContent = `${zone.zoneName}`;
        zoneDropdown.appendChild(opt);
    });
    zoneDropdown.disabled = false;
});

// Zone Change
zoneDropdown.addEventListener('change', function () {
    const selectedZoneId = this.value;
    renderZoneById(selectedZoneId);
});

// Render Table Rows for a Zone
function renderZoneById(zoneId) {
    tbody.innerHTML = '';
    const zone = zones.find(z => z.zoneId == zoneId);
    if (!zone) return;

    const assignedCoaches = zonalSports[zoneId] || {};

    sports.forEach(sport => {
        const sportId = sport.sport_id;
        const assignedCoachId = assignedCoaches[sportId] || "";

        const coachObj = coachesData.find(c => parseInt(c.coach_id) === parseInt(assignedCoachId));
        const userId = coachObj ? coachObj.user_id : null;
        const userObj = users.find(u => u.user_id == userId);

        const assignedCoachName = userObj
            ? `${userObj.firstname} ${userObj.lname}`
            : (assignedCoachId ? `Unknown Coach (ID: ${assignedCoachId})` : "No Coach Assigned");

        const zoneCoaches = coachesData.filter(c => parseInt(c.zone) === parseInt(zone.zoneId));

        let options = `<option value="">-- Select Coach --</option>`;
        zoneCoaches.forEach(c => {
            const user = users.find(u => u.user_id == c.user_id);
            const fullName = user ? `${user.firstname} ${user.lname}` : `Unknown Coach (ID: ${c.coach_id})`;
            const selected = (c.coach_id == assignedCoachId) ? "selected" : "";
            options += `<option value="${c.coach_id}" ${selected}>${fullName}</option>`;
        });

        // Still show unknown coach if not in the list
        if (assignedCoachId && !zoneCoaches.some(c => c.coach_id == assignedCoachId)) {
            options += `<option value="${assignedCoachId}" selected>Unknown Coach (ID: ${assignedCoachId})</option>`;
        }

        let rowHTML = `<tr>
            <td style="font-weight: bold;">${zone.zoneName}</td>
            <td>${sport.sport_name}</td>`;

        if (assignedCoachId) {
            rowHTML += `
                <td>${assignedCoachName}</td>
                <td>
                    <select name="coach_selection[${zone.zoneId}][${sportId}]" style="width: 200px;">
                        ${options}
                    </select>
                </td>`;
        } else {
            rowHTML += `
                <td colspan="2">
                    <select name="coach_selection[${zone.zoneId}][${sportId}]" style="width: 200px;">
                        ${options}
                    </select>
                </td>`;
        }

        rowHTML += `</tr>`;
        tbody.insertAdjacentHTML('beforeend', rowHTML);
    });
}





// Form Validation
const form = document.getElementById('zonalForm');
form.addEventListener('submit', function (e) {
    e.preventDefault();

    const selects = Array.from(form.querySelectorAll('select[name^="coach_selection"]'));
    let isValid = true;
    let errorMessages = [];
    let summary = [];

    selects.forEach(select => {
        const value = select.value.trim();
        const name = select.getAttribute("name");
        const matches = name.match(/coach_selection\[(\d+)]\[(\d+)]/);

        if (!matches) return;

        const zoneId = matches[1];
        const sportId = matches[2];

        const row = select.closest('tr');
        const zoneName = row.children[0]?.textContent?.trim() ?? "Unknown Zone";
        const sportName = row.children[1]?.textContent?.trim() ?? "Unknown Sport";

        if (!value) {
            isValid = false;
            errorMessages.push(`Please select a coach for ${sportName} in ${zoneName}`);
        } else {
            const selectedOption = select.options[select.selectedIndex];
            const coachName = selectedOption ? selectedOption.text.trim() : "Unknown Coach";
            summary.push(`${sportName} ➝ ${coachName} (${zoneName})`);
        }
    });

    if (!isValid) {
        alert("Please fix the following before submitting:\n\n" + errorMessages.join('\n'));
        return;
    }

    const confirmMessage = "You selected:\n\n" + summary.join('\n') + "\n\nSubmit these assignments?";
    if (confirm(confirmMessage)) {
        form.submit();
    }
});
</script>


<script id="error-message" type="application/json"><?= json_encode(trim($Error_message)) ?></script>
<script id="success-message" type="application/json"><?= json_encode(trim($Success_message)) ?></script>
<script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const errorMessage = JSON.parse(document.getElementById('error-message').textContent);
    const successMessage = JSON.parse(document.getElementById('success-message').textContent);

    if (errorMessage) {
        showCustomAlert(errorMessage);
    }

    if (successMessage) {
        showCustomAlert(successMessage);
    }
});
</script>
</body>
</html>