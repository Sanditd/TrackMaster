

const provinceDropdown = document.getElementById('provinceDropdown');
const districtDropdown = document.getElementById('districtDropdown');
const zoneDropdown = document.getElementById('zoneDropdown');
const tbody = document.getElementById('zoneTableBody');
const emptyState = document.getElementById('emptyState');
const assignmentTable = document.getElementById('assignmentTable');
const submitBtn = document.getElementById('submitBtn');
const summaryContainer = document.getElementById('summaryContainer');
const summaryContent = document.getElementById('summaryContent');
const step2 = document.getElementById('step2');
const step3 = document.getElementById('step3');

// Sport icons mapping
const sportIcons = {
    'Football': 'futbol',
    'Basketball': 'basketball-ball',
    'Cricket': 'cricket',
    'Tennis': 'table-tennis',
    'Swimming': 'swimming-pool',
    'Athletics': 'running',
    'Volleyball': 'volleyball-ball',
    'Hockey': 'hockey-puck',
    'Rugby': 'football-ball',
    'Badminton': 'shuttlecock',
    // Default for others
    'default': 'medal'
};

function getSportIcon(sportName) {
    const sportLower = sportName.toLowerCase();
    let iconName = 'medal'; // Default icon
    
    // Check if the sport name contains any of our defined sports
    Object.keys(sportIcons).forEach(sport => {
        if (sportLower.includes(sport.toLowerCase())) {
            iconName = sportIcons[sport];
        }
    });
    
    return `<i class="fas fa-${iconName} sport-icon"></i>`;
}

// Populate Province Dropdown
const provinces = [...new Set(zones.map(z => z.provinceName))];
provinces.sort().forEach(province => {
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
    emptyState.style.display = 'block';
    assignmentTable.style.display = 'none';
    submitBtn.style.display = 'none';
    summaryContainer.style.display = 'none';
    step2.classList.remove('active');
    step3.classList.remove('active');

    const selectedProvince = provinceDropdown.value;
    if (!selectedProvince) return;

    const districts = [...new Set(zones.filter(z => z.provinceName === selectedProvince).map(z => z.DisName))];
    districts.sort().forEach(district => {
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
    emptyState.style.display = 'block';
    assignmentTable.style.display = 'none';
    submitBtn.style.display = 'none';
    summaryContainer.style.display = 'none';
    step2.classList.remove('active');
    step3.classList.remove('active');

    const selectedProvince = provinceDropdown.value;
    const selectedDistrict = districtDropdown.value;
    if (!selectedDistrict) return;

    const filteredZones = zones.filter(z => z.provinceName === selectedProvince && z.DisName === selectedDistrict);
    filteredZones.sort((a, b) => a.zoneName.localeCompare(b.zoneName)).forEach(zone => {
        const opt = document.createElement('option');
        opt.value = zone.zoneId;
        opt.textContent = zone.zoneName;
        zoneDropdown.appendChild(opt);
    });
    zoneDropdown.disabled = false;
});

// Zone Change
zoneDropdown.addEventListener('change', function () {
    const selectedZoneId = this.value;
    if (selectedZoneId) {
        emptyState.style.display = 'none';
        assignmentTable.style.display = 'table';
        submitBtn.style.display = 'flex';
        step2.classList.add('active');
        renderZoneById(selectedZoneId);
        updateSummary();
    } else {
        emptyState.style.display = 'block';
        assignmentTable.style.display = 'none';
        submitBtn.style.display = 'none';
        summaryContainer.style.display = 'none';
        step2.classList.remove('active');
        step3.classList.remove('active');
    }
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

        const row = document.createElement('tr');
        
        // Zone cell
        const zoneCell = document.createElement('td');
        zoneCell.innerHTML = `<span class="zone-badge">${zone.zoneName}</span>`;
        row.appendChild(zoneCell);
        
        // Sport cell
        const sportCell = document.createElement('td');
        sportCell.innerHTML = `<span class="sport-name">${getSportIcon(sport.sport_name)} ${sport.sport_name}</span>`;
        row.appendChild(sportCell);
        
        // Coach selection cell
        const coachCell = document.createElement('td');
        const selectElement = document.createElement('select');
        selectElement.className = 'coach-select';
        selectElement.name = `coach_selection[${zone.zoneId}][${sportId}]`;
        selectElement.innerHTML = options;
        selectElement.addEventListener('change', updateSummary);
        coachCell.appendChild(selectElement);
        row.appendChild(coachCell);
        
        tbody.appendChild(row);
    });
}

// Update the assignment summary
function updateSummary() {
    const selects = Array.from(document.querySelectorAll('select[name^="coach_selection"]'));
    let summaryHTML = '';
    let hasAssignments = false;
    
    selects.forEach(select => {
        if (select.value) {
            hasAssignments = true;
            const name = select.getAttribute("name");
            const matches = name.match(/coach_selection\[(\d+)]\[(\d+)]/);
            
            if (!matches) return;
            
            const zoneId = matches[1];
            const sportId = matches[2];
            
            const zone = zones.find(z => z.zoneId == zoneId);
            const sport = sports.find(s => s.sport_id == sportId);
            const coachName = select.options[select.selectedIndex].text;
            
            if (zone && sport) {
                summaryHTML += `
                <div class="summary-item">
                    <i class="fas fa-check-circle summary-icon"></i>
                    <strong>${sport.sport_name}</strong> → ${coachName} in <em>${zone.zoneName}</em>
                </div>`;
            }
        }
    });
    
    if (hasAssignments) {
        summaryContent.innerHTML = summaryHTML;
        summaryContainer.style.display = 'block';
        step3.classList.add('active');
    } else {
        summaryContainer.style.display = 'none';
        step3.classList.remove('active');
    }
}

// Form Validation
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
        const zoneName = zones.find(z => z.zoneId == zoneId)?.zoneName || "Unknown Zone";
        const sportName = sports.find(s => s.sport_id == sportId)?.sport_name || "Unknown Sport";

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
        showCustomAlert("Please fix the following before submitting:\n\n" + errorMessages.join('\n'));
        return;
    }

    // Replace confirm with showCustomAlert
    const confirmMessage = "You selected:\n\n" + summary.join('\n') + "\n\nSubmit these assignments?";
    
    // Modify the customAlertBox to include a confirm and cancel button
    document.getElementById('customAlertMessage').innerHTML = confirmMessage;
    
    // Change the OK button to Yes/No buttons
    const okButton = document.querySelector('#customAlertBox button');
    okButton.textContent = 'No';
    okButton.style.marginLeft = '10px';
    
    // Add a Yes button that will submit the form
    const yesButton = document.createElement('button');
    yesButton.textContent = 'Yes';
    yesButton.style.marginRight = '10px';
    yesButton.onclick = function() {
        hideCustomAlert();
        form.submit();
    };
    
    // Insert the Yes button before the No button
    okButton.parentNode.insertBefore(yesButton, okButton);
    
    // Show the custom alert
    document.getElementById('customAlertOverlay').style.display = 'flex';
});

function showCustomAlert(message) {
    document.getElementById('customAlertMessage').textContent = message;
    document.getElementById('customAlertOverlay').style.display = 'flex';
}

function hideCustomAlert() {
    document.getElementById('customAlertOverlay').style.display = 'none';
}