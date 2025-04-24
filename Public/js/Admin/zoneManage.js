// Province and District Data
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

// Chart instance
let sportsChart = null;

// Document ready function
document.addEventListener('DOMContentLoaded', function() {
    // Initialize search functionality
    initSearch();
    
    // Initialize the sport timeframe dropdown
    const sportTimeframe = document.getElementById('sportTimeframe');
    if (sportTimeframe) {
        sportTimeframe.addEventListener('change', function() {
            updateSportsChart();
        });
    }
    
    // Check for error or success messages
    checkForMessages();
});

// Update district dropdown based on selected province
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

// Initialize search functionality
function initSearch() {
    const searchInput = document.getElementById('zoneSearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const table = document.getElementById('zoneTable');
            const rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) { // Skip header row
                const zoneName = rows[i].querySelector('.zone-name')?.textContent.toLowerCase() || '';
                const province = rows[i].querySelector('.province-cell')?.textContent.toLowerCase() || '';
                const district = rows[i].querySelector('.district-cell')?.textContent.toLowerCase() || '';
                
                if (zoneName.includes(searchText) || province.includes(searchText) || district.includes(searchText)) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });
    }
}

// Show zone details in the details card
function showZoneDetailsInRow(zoneName, provinceName, districtName) {
    // Populate individual cells with the details
    document.getElementById('zoneProvince').textContent = provinceName;
    document.getElementById('zoneDistrict').textContent = districtName;
    document.getElementById('zoneName').textContent = zoneName;

    // Set the hidden input value for the delete form
    const deleteZoneNameInput = document.getElementById('deleteZoneName');
    deleteZoneNameInput.value = zoneName;

    // Show the details container and hide no selection message
    document.getElementById('zoneDetailsContainer').style.display = 'block';
    document.getElementById('noSelectionMessage').style.display = 'none';
    
    // Show chart container and hide no chart message
    document.getElementById('chartContainer').style.display = 'block';
    document.getElementById('noChartMessage').style.display = 'none';
    
    // Update the sports chart with the selected zone data
    updateSportsChart(zoneName);
}

// Update zone status via AJAX
function updateZoneStatus(zoneName, status) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/admin/updateZoneStatus', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle response from the backend
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    showCustomAlert(response.message);
                    // Reload the page to reflect changes
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showCustomAlert(response.message);
                }
            } catch (e) {
                showCustomAlert('An error occurred. Please try again.');
            }
        }
    };

    // Send data to the server
    xhr.send('zoneName=' + encodeURIComponent(zoneName) + '&status=' + status);
}

// Show custom alert box
function showCustomAlert(message) {
    document.getElementById('customAlertMessage').innerText = message;
    document.getElementById('customAlertOverlay').style.display = 'flex';
}

// Hide custom alert box
function hideCustomAlert() {
    document.getElementById('customAlertOverlay').style.display = 'none';
}

// Check for error or success messages from PHP
function checkForMessages() {
    const alertOverlay = document.getElementById('customAlertOverlay');
    if (alertOverlay && alertOverlay.style.display === 'flex') {
        // Alert is already showing from PHP variables
    }
}

// Generate mock sports data for the selected zone
function generateMockSportsData(zoneName) {
    // This would be replaced by actual API calls to get real data
    const sports = ['Football', 'Cricket', 'Basketball', 'Swimming', 'Tennis'];
    const timeframe = document.getElementById('sportTimeframe').value;
    
    let maxUsers;
    switch (timeframe) {
        case 'month':
            maxUsers = 200;
            break;
        case 'quarter':
            maxUsers = 500;
            break;
        case 'year':
            maxUsers = 1000;
            break;
        default:
            maxUsers = 200;
    }
    
    // Generate random data for each sport
    return sports.map(sport => {
        // Use zone name to generate consistent but different numbers for each zone
        const zoneHash = Array.from(zoneName).reduce((acc, char) => acc + char.charCodeAt(0), 0);
        const baseNumber = ((zoneHash % 10) + 1) * 10;
        
        return {
            sport: sport,
            users: Math.floor(Math.random() * maxUsers) + baseNumber
        };
    });
}

// Update sports chart with data for the selected zone
function updateSportsChart(zoneName) {
    // If no zone is selected, use the current one displayed
    if (!zoneName) {
        zoneName = document.getElementById('zoneName').textContent;
        if (!zoneName) return;
    }
    
    const data = generateMockSportsData(zoneName);
    const ctx = document.getElementById('sportsChart').getContext('2d');
    
    // Destroy existing chart if it exists
    if (sportsChart) {
        sportsChart.destroy();
    }
    
    // Create new chart
    sportsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(item => item.sport),
            datasets: [{
                label: 'Number of Users',
                data: data.map(item => item.users),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: `Sport Usage in ${zoneName}`,
                    font: {
                        size: 16
                    }
                },
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Users: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Users'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Sports'
                    }
                }
            }
        }
    });
}

// Function to export zone data as CSV
function exportZoneData() {
    const table = document.getElementById('zoneTable');
    if (!table) return;
    
    let csvContent = "data:text/csv;charset=utf-8,";
    
    // Add header row
    const headers = [];
    const headerCells = table.querySelectorAll('thead th');
    headerCells.forEach(cell => {
        headers.push(cell.textContent);
    });
    csvContent += headers.join(',') + '\n';
    
    // Add data rows
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach(row => {
        if (row.style.display !== 'none') {
            const rowData = [];
            const cells = row.querySelectorAll('td');
            cells.forEach(cell => {
                // Skip action column containing buttons
                if (!cell.querySelector('button')) {
                    rowData.push('"' + cell.textContent.replace(/"/g, '""') + '"');
                }
            });
            csvContent += rowData.join(',') + '\n';
        }
    });
    
    // Create download link
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', 'zone_data.csv');
    document.body.appendChild(link);
    
    // Trigger download
    link.click();
    
    // Clean up
    document.body.removeChild(link);
}

// Function to print zone details
function printZoneDetails() {
    const zoneName = document.getElementById('zoneName').textContent;
    if (!zoneName) {
        showCustomAlert('Please select a zone first');
        return;
    }
    
    // Create a new window for printing
    const printWindow = window.open('', '_blank');
    
    // Get zone data
    const provinceName = document.getElementById('zoneProvince').textContent;
    const districtName = document.getElementById('zoneDistrict').textContent;
    
    // Create print content
    const printContent = `
        <html>
        <head>
            <title>Zone Details: ${zoneName}</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                h1 { color: #333; }
                .details { margin: 20px 0; }
                .details div { margin: 10px 0; }
                .label { font-weight: bold; }
            </style>
        </head>
        <body>
            <h1>Zone Details: ${zoneName}</h1>
            <div class="details">
                <div><span class="label">Province:</span> ${provinceName}</div>
                <div><span class="label">District:</span> ${districtName}</div>
            </div>
            <p>Report generated on ${new Date().toLocaleDateString()}</p>
        </body>
        </html>
    `;
    
    // Write to the new window and print
    printWindow.document.write(printContent);
    printWindow.document.close();
    printWindow.onload = function() {
        printWindow.print();
    };
}

// Function to confirm delete
function confirmDelete(event) {
    event.preventDefault();
    const zoneName = document.getElementById('deleteZoneName').value;
    
    if (confirm(`Are you sure you want to delete the zone "${zoneName}"?`)) {
        document.getElementById('deleteZoneForm').submit();
    }
}

// Add event listeners for additional buttons
document.addEventListener('DOMContentLoaded', function() {
    const exportButton = document.getElementById('exportButton');
    if (exportButton) {
        exportButton.addEventListener('click', exportZoneData);
    }
    
    const printButton = document.getElementById('printButton');
    if (printButton) {
        printButton.addEventListener('click', printZoneDetails);
    }
    
    const deleteForm = document.getElementById('deleteZoneForm');
    if (deleteForm) {
        deleteForm.addEventListener('submit', confirmDelete);
    }
});