<!DOCTYPE html>
<html lang="en">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$Success_message = $_SESSION['success_message'] ?? '';
$Error_message = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);

$zones = $zones ?? [];
$sports = $sports ?? [];
$zonalSports = $zonalSports ?? [];
$coaches = $coaches ?? [];
?>

<head>
    <meta charset="UTF-8">
    <title>Sport Assign</title>
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="../../Public/css/Admin/zoneManage.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>
    <style>
    .rounded-btn {
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 10px;
    }

    input,
    select,
    button {
        margin: 5px 0;
        
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        vertical-align: middle;
        text-align: center;
        padding: 10px;
    }
    </style>
</head>

<body>
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
                            <select id="districtDropdown" class="rounded-btn" style="width:300px; height:40px;"
                                disabled>
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

                    <!-- Table -->
                    <form method="post" action="submit_zonal_sports.php">
                        <table border="1" style="width:99%; border-collapse:collapse;">
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
            </div>
        </div>
    </div>

    <script>
    const zones = <?= json_encode($zones) ?>;
    const sports = <?= json_encode($sports) ?>;
    const zonalSports = <?= json_encode($zonalSports) ?>;
    const coaches = <?= json_encode($coaches) ?>;

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

    // On Province Change
    provinceDropdown.addEventListener('change', () => {
        districtDropdown.innerHTML = '<option value="">-- Select District --</option>';
        zoneDropdown.innerHTML = '<option value="">-- Select Zone --</option>';
        tbody.innerHTML = '';
        districtDropdown.disabled = true;
        zoneDropdown.disabled = true;

        const selectedProvince = provinceDropdown.value;
        if (!selectedProvince) return;

        const districts = [...new Set(zones.filter(z => z.provinceName === selectedProvince).map(z => z
            .DisName))];
        districts.forEach(district => {
            const opt = document.createElement('option');
            opt.value = district;
            opt.textContent = district;
            districtDropdown.appendChild(opt);
        });
        districtDropdown.disabled = false;
    });

    // On District Change
    districtDropdown.addEventListener('change', () => {
        zoneDropdown.innerHTML = '<option value="">-- Select Zone --</option>';
        tbody.innerHTML = '';
        zoneDropdown.disabled = true;

        const selectedProvince = provinceDropdown.value;
        const selectedDistrict = districtDropdown.value;
        if (!selectedDistrict) return;

        const filteredZones = zones.filter(z => z.provinceName === selectedProvince && z.DisName ===
            selectedDistrict);
        filteredZones.forEach(zone => {
            const opt = document.createElement('option');
            opt.value = zone.zoneId;
            opt.textContent = `${zone.zoneName}`;
            zoneDropdown.appendChild(opt);
        });
        zoneDropdown.disabled = false;
    });

    // On Zone Change
    zoneDropdown.addEventListener('change', function() {
        const selectedZoneId = this.value;
        renderZoneById(selectedZoneId);
    });

    function renderZoneById(zoneId) {
        tbody.innerHTML = '';
        const zone = zones.find(z => z.zoneId == zoneId);
        if (!zone) return;

        const rows = sports.map(sport => {
            const zoneCoaches = coaches.filter(coach => coach.zone == zone.zoneId);
            const options = zoneCoaches.map(coach => `
                    <option value="${coach.user_id}">${coach.firstname} ${coach.lname}</option>
                `).join('');

            return `
                    <tr>
                        <td style="font-weight: bold;">${zone.zoneName}</td>
                        <td>
                            <label >
                                
                                ${sport.sport_name}
                            </label>
                        </td>
                        <td>
                            <select name="coach_selection[${zone.zoneId}][${sport.sport_id}]" style="width: 200px;">
                                <option value="">-- Select Coach --</option>
                                ${options}
                            </select>
                        </td>
                    </tr>
                `;
        }).join('');

        tbody.innerHTML = rows;
    }
    </script>

</body>

</html>