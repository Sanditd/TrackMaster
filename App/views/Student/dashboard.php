<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | TrackMaster</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #00264d;
            --secondary-color: #ffa500;
            --light-color: #f8f9fa;
            --dark-color: #333;
            --gray-color: #666;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 38, 77, 0.1);
            --transition: all 0.3s ease;
            --success-color: #28a745;
            --error-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: var(--dark-color);
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Notification Styles */
        .notification {
            max-width: 600px;
            margin: 15px auto;
            padding: 15px;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            opacity: 1;
        }

        .notification.success {
            background: var(--success-color);
            color: white;
        }

        .notification.error {
            background: var(--error-color);
            color: white;
        }

        .notification p {
            margin: 0;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notification .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0.7;
            transition: var(--transition);
        }

        .notification .close-btn:hover {
            opacity: 1;
        }

        /* Fade out animation */
        .notification.fade-out {
            opacity: 0;
            transform: translateY(-10px);
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .dashboard-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .dashboard-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        .main-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .dashboard-section {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border: 1px solid rgba(0, 38, 77, 0.1);
            padding: 25px;
        }

        .dashboard-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 38, 77, 0.15);
        }

        .dashboard-section h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.4rem;
            position: relative;
            padding-bottom: 10px;
        }

        .dashboard-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .dashboard-section p {
            color: var(--gray-color);
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin: 20px;
        }

        .radio-input {
            display: none;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
            cursor: pointer;
            transition: var(--transition);
            background: var(--light-color);
        }

        .radio-label:hover {
            border-color: var(--secondary-color);
        }

        .radio-input:checked + .radio-label {
            background: rgba(255, 165, 0, 0.1);
            border-color: var(--secondary-color);
            color: var(--primary-color);
            font-weight: 600;
        }

        .radio-inner-circle {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid var(--gray-color);
            position: relative;
        }

        .radio-input:checked + .radio-label .radio-inner-circle {
            border-color: var(--secondary-color);
        }

        .radio-input:checked + .radio-label .radio-inner-circle::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--secondary-color);
        }

        .section-content {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .sports {
            background: var(--light-color);
            padding: 15px;
            border-radius: var(--border-radius);
            border-left: 4px solid var(--secondary-color);
        }

        .sports h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .btn:hover {
            background: #cc8400;
        }

        .btn-secondary {
            background: var(--light-color);
            color: var(--dark-color);
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #e6e6e6;
            border-color: #ccc;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 5em;
            font-weight: 900;
            color: #e10600;
            position: relative;
            transition: all 1s ease;
            text-align: center;
        }

        .container__star {
            transition: all .7s ease-in-out;
        }

        .first {
            position: absolute;
            top: 20px;
            left: 50px;
            transition: all .7s ease-in-out;
        }

        .svg-icon {
            position: absolute;
            fill: #e94822;
            z-index: 1;
        }

        .star-eight {
            background: #efd510;
            width: 150px;
            height: 150px;
            position: relative;
            text-align: center;
            animation: rot 3s infinite;
        }

        .star-eight::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 150px;
            width: 150px;
            background: #efd510;
            transform: rotate(135deg);
        }

        .container:hover .container__star {
            transform: rotateX(70deg) translateY(250px);
            box-shadow: 0px 0px 120px -100px #e4e727;
        }

        .container:hover .svg-icon {
            animation: grow 1s linear infinite;
        }

        @keyframes rot {
            0% { transform: rotate(0deg); }
            50% { transform: rotate(340deg); }
            100% { transform: rotate(0deg); }
        }

        @keyframes grow {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(-5deg); }
            75% { transform: rotate(5deg); }
            100% { transform: scale(1) rotate(0deg); }
        }

        .dashboard-section p strong {
            color: var(--primary-color);
            font-weight: 600;
        }

        .calendar-container {
            margin-bottom: 15px;
        }

        #calendar {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        #header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: var(--primary-color);
            color: white;
        }

        #header button {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 5px 10px;
        }

        #days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            background: var(--light-color);
            padding: 10px 0;
            font-weight: 600;
            color: var(--primary-color);
        }

        #dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 5px;
            padding: 10px;
        }

        #dates div {
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 50%;
            transition: var(--transition);
        }

        #dates div:hover {
            background: var(--light-color);
        }

        #dates .today {
            background: var(--secondary-color);
            color: white;
        }

        #dates .has-note {
            position: relative;
        }

        #dates .has-note::after {
            content: '';
            position: absolute;
            bottom: 5px;
            width: 5px;
            height: 5px;
            background: var(--secondary-color);
            border-radius: 50%;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .hidden {
            display: none;
        }

        .modal-content {
            background: white;
            padding: 25px;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 500px;
        }

        .modal-content h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        #noteInput {
            width: 100%;
            height: 150px;
            padding: 10px;
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
            margin-bottom: 15px;
            resize: none;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Custom Alert Modal Styles */
        #alertModal .modal-content {
            max-width: 400px;
            text-align: center;
        }

        #alertModal p {
            color: var(--gray-color);
            margin-bottom: 20px;
            line-height: 1.5;
        }

        #alertModal .modal-actions {
            justify-content: center;
        }

        @media (max-width: 768px) {
            .dashboard-header {
                padding: 20px 15px;
            }
            
            .dashboard-header h1 {
                font-size: 1.8rem;
            }
            
            .dashboard-header p {
                font-size: 1rem;
            }
            
            .main-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-header h1 {
                font-size: 1.6rem;
            }
            
            .dashboard-section h2 {
                font-size: 1.2rem;
            }
            
            .dashboard-section p {
                font-size: 0.95rem;
            }
            
            .radio-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'?>
    <?php require 'sidebar.php'?> 
    
    <div class="dashboard-container">
        <!-- Notification Section -->
        <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
            <div class="notification <?php echo htmlspecialchars($_SESSION['message_type']); ?>">
                <p>
                    <i class="fas <?php echo $_SESSION['message_type'] === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
                    <?php echo htmlspecialchars($_SESSION['message']); ?>
                </p>
                <button class="close-btn" onclick="closeNotification(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php
                // Clear the message after displaying it
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            ?>
        <?php endif; ?>

        <div class="dashboard-header">
            <h1><i class="fas fa-user-graduate"></i> Student Dashboard</h1>
          
        </div>

        <div class="main-content">
            <div class="dashboard-section">
                <h2>Current Training Status</h2>
                <form action="<?php echo URLROOT ?>/Student/updateStatus" method="POST">
                    <p><i class="fas fa-info-circle"></i> Update your current training status</p>
                    <div class="radio-group">
                        <input class="radio-input" name="status" id="radio1" type="radio" value="Practicing" <?php echo (isset($data['trainingStatus']) && $data['trainingStatus'] == 'Practicing') ? 'checked' : ''; ?>>
                        <label class="radio-label" for="radio1">
                            <span class="radio-inner-circle"></span>
                            <i class="fas fa-running"></i> Practicing
                        </label>

                        <input class="radio-input" name="status" id="radio2" type="radio" value="In a Meet" <?php echo (isset($data['trainingStatus']) && $data['trainingStatus'] == 'In a Meet') ? 'checked' : ''; ?>>
                        <label class="radio-label" for="radio2">
                            <span class="radio-inner-circle"></span>
                            <i class="fas fa-trophy"></i> In a Meet
                        </label>

                        <input class="radio-input" name="status" id="radio3" type="radio" value="At Rest" <?php echo (isset($data['trainingStatus']) && $data['trainingStatus'] == 'At Rest') ? 'checked' : ''; ?>>
                        <label class="radio-label" for="radio3">
                            <span class="radio-inner-circle"></span>
                            <i class="fas fa-bed"></i> At Rest
                        </label>

                        <input class="radio-input" name="status" id="radio4" type="radio" value="Injured" <?php echo (isset($data['trainingStatus']) && $data['trainingStatus'] == 'Injured') ? 'checked' : ''; ?>>
                        <label class="radio-label" for="radio4">
                            <span class="radio-inner-circle"></span>
                            <i class="fas fa-medkit"></i> Injured
                        </label>
                    <button class="btn" type="submit" style="margin-top: 15px;">
                        <i class="fas fa-save"></i> Save Status
                    </button>
                    </div>
                </form>
            </div>

            <div class="dashboard-section">
    <h2>Registered Sports</h2>
    <div class="section-content">
        <?php if (isset($data['sports']) && !empty($data['sports'])): ?>
            <?php foreach ($data['sports'] as $sport): ?>
                <?php
                    $icon = 'fa-running'; // default icon
                    $sportNameLower = strtolower($sport->sport_name);
                    if ($sportNameLower === 'cricket') {
                        $icon = 'fa-cricket';
                    } elseif ($sportNameLower === 'football') {
                        $icon = 'fa-futbol';
                    } elseif ($sportNameLower === 'basketball') {
                        $icon = 'fa-basketball-ball';
                    } elseif ($sportNameLower === 'swimming') {
                        $icon = 'fa-swimmer';
                    } elseif ($sportNameLower === 'tennis') {
                        $icon = 'fa-table-tennis';
                    }
                ?>
                <div class="sport-card">
                    <div class="sport-header">
                        <i class="fas <?php echo $icon; ?>"></i>
                        <h3><?php echo htmlspecialchars($sport->sport_name); ?></h3>
                    </div>
                    <div class="sport-actions">
                        <button class="btn btn-coach" onclick="window.location.href='<?php echo URLROOT ?>/Student/coachProfile?sport=<?php echo urlencode($sport->sport_name); ?>'">
                            <i class="fas fa-user-tie"></i> View Coach
                        </button>
                        <button class="btn btn-performance" onclick="window.location.href='<?php echo URLROOT ?>/Student/Playerperformance?sport=<?php echo urlencode($sport->sport_name); ?>'">
                            <i class="fas fa-chart-line"></i> Performance
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-sports">
                <p><i class="fas fa-info-circle"></i> No sports registered yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>


            <div class="dashboard-section">
                <h2>My Achievements</h2>
                <br><br>
                <div class="container">
                    <svg class="svg-icon" height="100" preserveAspectRatio="xMidYMid meet" viewBox="0 0 100 100" width="100" x="0" xmlns="http://www.w3.org/2000/svg" y="0">
                        <path d="M62.11,53.93c22.582-3.125,22.304-23.471,18.152-29.929-4.166-6.444-10.36-2.153-10.36-2.153v-4.166H30.099v4.166s-6.194-4.291-10.36,2.153c-4.152,6.458-4.43,26.804,18.152,29.929l5.236,7.777v8.249s-.944,4.597-4.833,4.986c-3.903,.389-7.791,4.028-7.791,7.374h38.997c0-3.347-3.889-6.986-7.791-7.374-3.889-.389-4.833-4.986-4.833-4.986v-8.249l5.236-7.777Zm7.388-24.818s2.833-3.097,5.111-1.347c2.292,1.75,2.292,15.86-8.999,18.138l3.889-16.791Zm-44.108-1.347c2.278-1.750,5.111,1.347,5.111,1.347l3.889,16.791c-11.291-2.278-11.291-16.388-8.999-18.138Z">
                        </path>
                    </svg>  
                    <div class="container__star">
                        <div class="star-eight"></div>
                    </div>
                </div>
                <br><br><br><br>
                <center>
                    <div class="action-buttons">
                        <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentAchievements'">
                            <i class="fas fa-medal"></i> View My Achievements
                        </button>
                    </div>
                </center>
            </div>

            <div class="dashboard-section">
                <h2>Current Medical Status</h2>
                <?php if (isset($data['currentStatus']['currentStatus']) && !empty($data['currentStatus']['currentStatus'])): ?>
                    <p><strong>Condition:</strong> <?php echo htmlspecialchars($data['currentStatus']['currentStatus']->medical_condition ?? 'N/A'); ?></p>
                    <p><strong>Medication:</strong> <?php echo htmlspecialchars($data['currentStatus']['currentStatus']->medication ?? 'N/A'); ?></p>
                    <p><strong>Notes:</strong> <?php echo htmlspecialchars($data['currentStatus']['currentStatus']->notes ?? 'N/A'); ?></p>
                    <p><strong>Last Updated:</strong> <?php echo !empty($data['currentStatus']['currentStatus']->date) ? date('d/m/Y', strtotime($data['currentStatus']['currentStatus']->date)) : 'N/A'; ?></p>
                    <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/medicalStatus'">
                        <i class="fas fa-first-aid"></i> Update Medical Status
                    </button>
                <?php else: ?>
                    <p>No medical status available.</p>
                    <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/medicalStatus'">
                        <i class="fas fa-first-aid"></i> Update Medical Status
                    </button>
                <?php endif; ?>
            </div>

            <div class="dashboard-section">
                <h2>My Calendar</h2>
                <div class="calendar-container">
                    <div id="calendar">
                        <div id="header">
                            <button id="prevMonth"><i class="fas fa-chevron-left"></i></button>
                            <span id="monthYear"></span>
                            <button id="nextMonth"><i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div id="days">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div id="dates"></div>
                    </div>

                    <div id="noteModal" class="modal hidden">
                        <div class="modal-content">
                            <h3 id="noteTitle"><i class="fas fa-sticky-note"></i> Add Note</h3>
                            <textarea id="noteInput" placeholder="Write your note here..."></textarea>
                            <div class="modal-actions">
                                <button class="btn" id="saveNote">
                                    <i class="fas fa-save"></i> Save Note
                                </button>
                                <button class="btn btn-secondary" id="closeModal">
                                    <i class="fas fa-times"></i> Close
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="alertModal" class="modal hidden">
                        <div class="modal-content">
                            <h3 id="alertTitle"><i class="fas fa-bell"></i> Notification</h3>
                            <p id="alertMessage"></p>
                            <div class="modal-actions">
                                <button class="btn" id="alertOk">
                                    <i class="fas fa-check"></i> OK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <p><i class="fas fa-info-circle"></i> Click on any date to add or view notes</p>
            </div>

            <div class="dashboard-section">
                <h2>Financial Status</h2>
                <div class="section-content">
                    <p><i class="fas fa-money-check-alt"></i> If you have any financial concerns, please reach out to the administration.</p>
                    <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/financialStatus'">
                        <i class="fas fa-wallet"></i> Apply for Financial Funds
                    </button> 
                </div>
            </div>
        </div>
    </div>

    <?php require 'footer.php'?>

    <script src="/TrackMaster/Public/js/Student/carousel.js"></script>
    <script>
        // Notification close function
        function closeNotification(button) {
            const notification = button.parentElement;
            notification.classList.add('fade-out');
            setTimeout(() => {
                notification.remove();
            }, 300); // Match the transition duration
        }

        // Auto-dismiss notifications after 5 seconds
        document.addEventListener('DOMContentLoaded', () => {
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.classList.add('fade-out');
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 5000); // 5 seconds
            });
        });

        // Calendar JavaScript
        const calendar = document.getElementById('calendar');
        const monthYear = document.getElementById('monthYear');
        const prevMonth = document.getElementById('prevMonth');
        const nextMonth = document.getElementById('nextMonth');
        const dates = document.getElementById('dates');
        const noteModal = document.getElementById('noteModal');
        const noteTitle = document.getElementById('noteTitle');
        const noteInput = document.getElementById('noteInput');
        const saveNote = document.getElementById('saveNote');
        const closeModal = document.getElementById('closeModal');
        const alertModal = document.getElementById('alertModal');
        const alertTitle = document.getElementById('alertTitle');
        const alertMessage = document.getElementById('alertMessage');
        const alertOk = document.getElementById('alertOk');

        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();
        let selectedDate = null;

        // Function to show custom alert
        function showAlert(message, title = 'Notification') {
            alertTitle.innerHTML = `<i class="fas fa-bell"></i> ${title}`;
            alertMessage.textContent = message;
            alertModal.classList.remove('hidden');
        }

        // Close alert modal
        alertOk.addEventListener('click', () => {
            alertModal.classList.add('hidden');
        });

        function renderCalendar() {
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();
            const today = new Date();
            const isCurrentMonth = currentMonth === today.getMonth() && currentYear === today.getFullYear();

            monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${currentYear}`;
            dates.innerHTML = '';

            // Add empty divs for days before the first day
            for (let i = 0; i < firstDay; i++) {
                dates.innerHTML += '<div></div>';
            }

            // Fetch notes for the current month
            fetch(`<?php echo URLROOT ?>/Student/getCalendarNotes/${currentMonth + 1}/${currentYear}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const notes = data.notes.reduce((acc, note) => {
                            acc[note.note_date] = note.note_text;
                            return acc;
                        }, {});

                        // Add date divs
                        for (let i = 1; i <= lastDate; i++) {
                            const date = new Date(currentYear, currentMonth, i);
                            const dateString = date.toISOString().split('T')[0];
                            const isToday = isCurrentMonth && i === today.getDate();
                            const hasNote = notes[dateString] ? 'has-note' : '';
                            dates.innerHTML += `<div class="${isToday ? 'today' : ''} ${hasNote}" data-date="${dateString}">${i}</div>`;
                        }

                        // Add click event listeners to dates
                        document.querySelectorAll('#dates div:not(:empty)').forEach(date => {
                            date.addEventListener('click', () => {
                                selectedDate = date.dataset.date;
                                noteInput.value = notes[selectedDate] || '';
                                noteTitle.textContent = `Note for ${new Date(selectedDate).toLocaleDateString()}`;
                                noteModal.classList.remove('hidden');
                            });
                        });
                    }
                });
        }

        prevMonth.addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            currentDate = new Date(currentYear, currentMonth, 1);
            renderCalendar();
        });

        nextMonth.addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            currentDate = new Date(currentYear, currentMonth, 1);
            renderCalendar();
        });

        saveNote.addEventListener('click', () => {
            const noteText = noteInput.value.trim();
            if (noteText && selectedDate) {
                fetch('<?php echo URLROOT ?>/Student/saveCalendarNote', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ note_date: selectedDate, note_text: noteText })
                })
                .then(response => response.json())
                .then(data => {
                    showAlert(data.message, data.success ? 'Success' : 'Error');
                    if (data.success) {
                        noteModal.classList.add('hidden');
                        renderCalendar();
                    }
                })
                .catch(error => {
                    console.error('Error saving note:', error);
                    showAlert('Failed to save note. Please try again.', 'Error');
                });
            } else {
                showAlert('Please enter a note and select a date.', 'Warning');
            }
        });

        closeModal.addEventListener('click', () => {
            noteModal.classList.add('hidden');
        });

        renderCalendar();
    </script>
</body>
</html>