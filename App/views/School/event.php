<?php
//Check if session user ID exists
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message']='Invalid Login! Please login again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$username = (string) $_SESSION['username'];


//Load required model file if not already loaded
 require_once __DIR__ . '/../../model/loginPage.php';
 // Adjust path as needed

// Create login model instance
$loginModel = new loginPage();

$user = $loginModel->getUserById($userId);


//If user does not exist in DB, destroy session and redirect
if (!$user) {
    session_unset();
    session_destroy();
    $_SESSION['error_message']='Login Failed! Try Again.';
    header('Location: ' . ROOT . '/loginController/login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Requests | TrackMaster</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Public/css/school/event.css">
</head>

<body>
<?php require 'navbar.php'?>

    <div class="facilities-container">
        <div class="facilities-header">
            <h1><i class="fas fa-building"></i> Facility Requests</h1>
            <p>Manage and respond to requests for sports facilities and equipment</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search requests..." id="requestSearch">
            </div>
            <div class="filter-dropdown">
                <select id="statusFilter">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="declined">Declined</option>
                </select>
            </div>
            <div class="filter-dropdown">
                <select id="dateFilter">
                    <option value="">All Dates</option>
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="thisWeek">This Week</option>
                    <option value="nextWeek">Next Week</option>
                </select>
            </div>
        </div>

        <div class="facilities-table-section">
            <div class="section-header">
                <h2><i class="fas fa-list"></i> Request List</h2>
                
            </div>
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-calendar-alt"></i> Event Name</th>
                        <th><i class="fas fa-user"></i> Coach Name</th>
                        <th><i class="fas fa-clock"></i> Date and Time</th>
                        <th><i class="fas fa-building"></i> Facilities Required</th>
                        <th><i class="fas fa-tasks"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['facilityReq'] as $index => $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event->event_name) ?></td>

                        <td>
                            <?php
                       
                        $coach = isset($data['coaches'][$index]) ? $data['coaches'][$index] : null;
                        echo $coach ? htmlspecialchars($coach->firstname . ' ' . $coach->lname) : 'N/A';
                    ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($event->event_date) ?>
                            (<?= date('h:i A', strtotime($event->time_from)) ?> -
                            <?= date('h:i A', strtotime($event->time_to)) ?>)
                        </td>

                        <td><?= htmlspecialchars($event->facilities_required) ?></td>

                        <td>
                            <form method="post" action="<?= ROOT ?>/School/approveRequest">
                                <input type="hidden" name="request_id"
                                    value="<?= htmlspecialchars($event->request_id ?? '') ?>">
                                <select name="status" onchange="this.form.submit()" class="status-dropdown">
                                    <option disabled <?= empty($event->status) ? 'selected' : '' ?>>Update Status
                                    </option>
                                    <option value="Pending"
                                        <?= ($event->status ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Approved"
                                        <?= ($event->status ?? '') === 'Approved' ? 'selected' : '' ?>>Approved</option>
                                    <option value="Rejected"
                                        <?= ($event->status ?? '') === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                </select>
                            </form>

                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

        <?php if (!empty($_SESSION['flash_message'])): ?>
        <div class="flash-message">
            <i class="fas fa-info-circle"></i>
            <?php echo $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?>
        </div>
        <?php endif; ?>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

    <script>

document.addEventListener('DOMContentLoaded', function() {
    const requestSearch = document.getElementById('requestSearch');
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');
    const requestRows = document.querySelectorAll('tbody tr');
    
    requestSearch.addEventListener('input', filterRequests);
    statusFilter.addEventListener('change', filterRequests);
    dateFilter.addEventListener('change', filterRequests);
    
    function filterRequests() {
        const searchTerm = requestSearch.value.toLowerCase();
        const statusValue = statusFilter.value.toLowerCase();
        const dateValue = dateFilter.value;
        
        requestRows.forEach(row => {
            const eventName = row.cells[0].textContent.toLowerCase();
            const coachName = row.cells[1].textContent.toLowerCase();
            const dateTimeText = row.cells[2].textContent.toLowerCase();
            const facilitiesRequired = row.cells[3].textContent.toLowerCase();
            const statusElement = row.cells[4].querySelector('select');
            const currentStatus = statusElement ? statusElement.value.toLowerCase() : '';
            
            const matchesSearch = eventName.includes(searchTerm) || 
                                 coachName.includes(searchTerm) || 
                                 dateTimeText.includes(searchTerm) || 
                                 facilitiesRequired.includes(searchTerm);
            
            const matchesStatus = statusValue === '' || currentStatus === statusValue;
            
            let matchesDate = true;
            if (dateValue !== '') {
                const eventDate = new Date(dateTimeText.split('(')[0].trim());
                const today = new Date();
                today.setHours(0, 0, 0, 0); 
                
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1);
                
                const weekStart = new Date(today);
                weekStart.setDate(weekStart.getDate() - weekStart.getDay());
                
                const weekEnd = new Date(weekStart);
                weekEnd.setDate(weekEnd.getDate() + 6);
                
                const nextWeekStart = new Date(weekEnd);
                nextWeekStart.setDate(nextWeekStart.getDate() + 1);
                
                const nextWeekEnd = new Date(nextWeekStart);
                nextWeekEnd.setDate(nextWeekEnd.getDate() + 6);
                
                switch (dateValue) {
                    case 'today':
                        matchesDate = eventDate.toDateString() === today.toDateString();
                        break;
                    case 'tomorrow':
                        matchesDate = eventDate.toDateString() === tomorrow.toDateString();
                        break;
                    case 'thisWeek':
                        matchesDate = eventDate >= weekStart && eventDate <= weekEnd;
                        break;
                    case 'nextWeek':
                        matchesDate = eventDate >= nextWeekStart && eventDate <= nextWeekEnd;
                        break;
                }
            }
            
           
            if (matchesSearch && matchesStatus && matchesDate) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
      
        const visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])');
        const noResultsRow = document.getElementById('no-results-row');
        
        if (visibleRows.length === 0) {
            
            if (!noResultsRow) {
                const tbody = document.querySelector('tbody');
                const tr = document.createElement('tr');
                tr.id = 'no-results-row';
                const td = document.createElement('td');
                td.colSpan = 5;
                td.textContent = 'No matching requests found.';
                td.style.textAlign = 'center';
                tr.appendChild(td);
                tbody.appendChild(tr);
            } else {
                noResultsRow.style.display = '';
            }
        } else if (noResultsRow) {
            noResultsRow.style.display = 'none';
        }
    }
});
    </script>

    <script>
   
    document.getElementById('requestSearch').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const eventName = row.cells[0].textContent.toLowerCase();
            const coachName = row.cells[1].textContent.toLowerCase();
            const dateTime = row.cells[2].textContent.toLowerCase();

            if (eventName.includes(searchTerm) || coachName.includes(searchTerm) || dateTime.includes(
                    searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseover', function() {
                this.style.backgroundColor = 'rgba(255, 165, 0, 0.05)';
            });
            row.addEventListener('mouseout', function() {
                this.style.backgroundColor = '';
            });
        });
    });
    </script>
</body>

</html>