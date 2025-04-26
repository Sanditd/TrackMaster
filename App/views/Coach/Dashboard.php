<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Dashboard | TrackMaster</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
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
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-description {
            color: var(--gray-color);
            margin-bottom: 15px;
            line-height: 1.5;
            font-size: 0.95rem;
        }
        .alert-badge {
            display: inline-flex;
            align-items: center;
            background: #ffecb3;
            color: #664d03;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.85rem;
            margin-bottom: 15px;
            gap: 5px;
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
            margin-top: 15px;
        }
        .btn:hover {
            background: #cc8400;
        }
        .status-counts {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .status-box {
            background: var(--light-color);
            padding: 10px;
            border-left: 4px solid var(--secondary-color);
            border-radius: var(--border-radius);
        }
        .calendar-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        .calendar-month {
            font-weight: bold;
            color: var(--primary-color);
        }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            text-align: center;
        }
        .calendar-day-header {
            font-weight: bold;
            color: var(--primary-color);
            padding: 5px;
            background: var(--light-color);
        }
        .calendar-day {
            height: 70px;
            background: white;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 5px;
            font-size: 0.9rem;
        }
        .calendar-date {
            font-weight: bold;
        }
        .calendar-event-indicator {
            margin-top: 5px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        .practice-indicator { background: var(--secondary-color); }
        .meeting-indicator { background: #28a745; }
        .match-indicator { background: #dc3545; }
        .session-stats {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .stat-box {
            display: flex;
            align-items: center;
            background: var(--light-color);
            padding: 10px;
            border-radius: var(--border-radius);
            gap: 15px;
        }
        .stat-icon {
            font-size: 1.5rem;
            color: var(--secondary-color);
        }
        .stat-details {
            display: flex;
            flex-direction: column;
        }
        .stat-value {
            font-weight: bold;
            color: var(--primary-color);
        }
        .stat-label {
            font-size: 0.9rem;
            color: var(--gray-color);
        }
        .recent-item {
            display: flex;
            gap: 10px;
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 0.95rem;
        }
        .recent-item:last-child {
            border-bottom: none;
        }
        .recent-item-icon {
            color: var(--primary-color);
            min-width: 20px;
        }
        .recent-item-content {
            flex: 1;
        }
        .recent-item-title {
            font-weight: 500;
            margin-bottom: 3px;
        }
        .recent-item-detail {
            color: var(--gray-color);
            font-size: 0.85rem;
        }
        .legend {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
            font-size: 0.8rem;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
        }

        /* Dashboard Styles */
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.dashboard-header {
    margin-bottom: 30px;
    text-align: center;
}

.dashboard-section {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 20px;
}

.dashboard-section h2 {
    margin-top: 0;
    color: #333;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

/* Team Status */
.status-counts {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 15px;
}

.status-box {
    background: #f5f5f5;
    padding: 10px 15px;
    border-radius: 5px;
    flex: 1;
    min-width: 120px;
    text-align: center;
}

.status-box strong {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

/* Calendar */
.calendar-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 15px 0;
}

.calendar-month {
    margin: 0 15px;
    font-weight: bold;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
    margin-bottom: 15px;
}

.calendar-day-header {
    text-align: center;
    font-weight: bold;
    padding: 5px;
    background: #f0f0f0;
}

.calendar-day {
    height: 60px;
    border: 1px solid #eee;
    padding: 5px;
    position: relative;
}

.calendar-date {
    font-weight: bold;
}

.calendar-event-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-50%);
}

.practice-indicator {
    background-color: #4CAF50;
}

.meeting-indicator {
    background-color: #2196F3;
}

.match-indicator {
    background-color: #F44336;
}

.legend {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 15px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Upcoming Events List */
.upcoming-events-list {
    margin-top: 20px;
}

.event-item {
    display: flex;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.event-date {
    min-width: 50px;
    font-weight: bold;
    color: #555;
}

.event-details {
    flex: 1;
}

.event-name {
    font-weight: bold;
}

.event-time-location {
    font-size: 0.9em;
    color: #666;
}

/* Medical Alerts */
.medical-alerts {
    margin: 15px 0;
}

.alert-item {
    display: flex;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.alert-date {
    min-width: 50px;
    font-weight: bold;
    color: #555;
}

.alert-details {
    flex: 1;
}

.player-name {
    font-weight: bold;
}

.condition {
    font-size: 0.9em;
    color: #666;
}

/* Schedule Requests */
.schedule-requests {
    margin: 15px 0;
}

.request-item {
    display: flex;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.request-date {
    min-width: 50px;
    font-weight: bold;
    color: #555;
}

.request-details {
    flex: 1;
}

.reason {
    font-size: 0.9em;
    color: #666;
    margin-top: 5px;
}

/* Stats Boxes */
.session-stats {
    display: flex;
    gap: 15px;
    margin-top: 15px;
}

.stat-box {
    flex: 1;
    display: flex;
    align-items: center;
    background: #f5f5f5;
    padding: 15px;
    border-radius: 5px;
}

.stat-icon {
    font-size: 24px;
    margin-right: 15px;
    color: #555;
}

.stat-value {
    font-size: 24px;
    font-weight: bold;
}

.stat-label {
    font-size: 14px;
    color: #666;
}

    </style>
</head>
<body>
<?php require 'CoachNav.php'; ?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1><i class="fas fa-chalkboard-teacher"></i> Coach Dashboard</h1>
    </div>

    <div class="main-content">

        <!-- Team Status Section -->
        <div class="dashboard-section">
            <h2><i class="fas fa-users"></i> Team Status</h2>
            <div class="status-counts">
                <div class="status-box"><strong>Practicing:</strong> <?= $data['teamStatus']->practicing ?? 0 ?></div>
                <div class="status-box"><strong>In a Meet:</strong> <?= $data['teamStatus']->in_meet ?? 0 ?></div>
                <div class="status-box"><strong>At Rest:</strong> <?= $data['teamStatus']->at_rest ?? 0 ?></div>
                <div class="status-box"><strong>Injured:</strong> <?= $data['teamStatus']->injured ?? 0 ?></div>
                <div class="status-box"><strong>Total Players:</strong> <?= $data['teamStatus']->total_players ?? 0 ?></div>
            </div>
        </div>

        <!-- Upcoming Events Section -->
        <div class="dashboard-section">
            <h2><i class="fas fa-calendar-alt"></i> Upcoming Events</h2>
            <div class="calendar-nav">
                <button class="btn" onclick="prevMonth()"><i class="fas fa-chevron-left"></i></button>
                <span id="calendar-month" class="calendar-month"><?= $data['currentMonth'] ?></span>
                <button class="btn" onclick="nextMonth()"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="calendar-grid" id="calendar-grid">
                <!-- Calendar days will be generated here by JavaScript -->
            </div>
            <div class="legend">
                <div class="legend-item">
                    <div class="calendar-event-indicator practice-indicator"></div>
                    <span>Practice</span>
                </div>
                <div class="legend-item">
                    <div class="calendar-event-indicator meeting-indicator"></div>
                    <span>Meeting</span>
                </div>
                <div class="legend-item">
                    <div class="calendar-event-indicator match-indicator"></div>
                    <span>Match</span>
                </div>
            </div>
            
            <!-- Upcoming Events List -->
            <div class="upcoming-events-list">
                <?php if (!empty($data['upcomingEvents'])): ?>
                    <?php foreach ($data['upcomingEvents'] as $event): ?>
                        <div class="event-item">
                            <div class="event-date">
                                <?= date('M j', strtotime($event->event_date)) ?>
                            </div>
                            <div class="event-details">
                                <div class="event-name"><?= htmlspecialchars($event->event_name) ?></div>
                                <div class="event-time-location">
                                    <?= date('g:i a', strtotime($event->time_from)) ?> - <?= date('g:i a', strtotime($event->time_to)) ?>
                                    at <?= htmlspecialchars($event->location) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No upcoming events scheduled.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Session Stats Section -->
        <div class="dashboard-section">
            <h2><i class="fas fa-chart-pie"></i> Session Stats</h2>
            <div class="session-stats">
                <div class="stat-box">
                    <i class="fas fa-tasks stat-icon"></i>
                    <div class="stat-details">
                        <div class="stat-value"><?= $data['sessionStats']['training_sessions'] ?? 0 ?></div>
                        <div class="stat-label">Completed Sessions</div>
                    </div>
                </div>
                <div class="stat-box">
                    <i class="fas fa-trophy stat-icon"></i>
                    <div class="stat-details">
                        <div class="stat-value"><?= $data['sessionStats']['matches_played'] ?? 0 ?></div>
                        <div class="stat-label">Matches Played</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medical History -->
        <div class="dashboard-section">
            <h2><i class="fas fa-briefcase-medical"></i> Player Medical History</h2>
            
            <?php if (!empty($data['medicalAlerts'])): ?>
                <div class="medical-alerts">
                    <?php foreach ($data['medicalAlerts'] as $alert): ?>
                        <div class="alert-item">
                            <div class="alert-date"><?= date('M j', strtotime($alert->date)) ?></div>
                            <div class="alert-details">
                                <div class="player-name"><?= htmlspecialchars($alert->player_name) ?></div>
                                <div class="condition"><?= htmlspecialchars($alert->medical_condition) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No recent medical alerts.</p>
            <?php endif; ?>
            
            <center><a href="<?= URLROOT ?>/coach/medicalRecords" class="btn">View All Medical Records <i class="fas fa-arrow-right"></i></a></center>
        </div>

        <!-- Schedule Change Requests -->
        <div class="dashboard-section">
            <h2><i class="fas fa-clock"></i> Schedule Change Requests</h2>
                
            <?php if (!empty($data['scheduleRequests'])): ?>
                <div class="schedule-requests">
                    <?php foreach ($data['scheduleRequests'] as $request): ?>
                        <div class="request-item">
                            <div class="request-date"><?= date('M j', strtotime($request->request_date)) ?></div>
                            <div class="request-details">
                                <div class="player-name"><?= htmlspecialchars($request->player_name) ?></div>
                                <div class="event-name"><?= htmlspecialchars($request->event_name) ?></div>
                                <div class="reason"><?= htmlspecialchars($request->reason) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No pending schedule change requests.</p>
            <?php endif; ?>
            
            <center><a href="<?= URLROOT ?>/coach/scheduleRequests" class="btn">View All Requests <i class="fas fa-arrow-right"></i></a></center>
        </div>

    </div>
</div>

<script>
    // Calendar JavaScript remains the same, but we'll enhance it to show real events
    const monthYear = document.getElementById('calendar-month');
    const calendarGrid = document.getElementById('calendar-grid');
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    // Convert PHP events to JavaScript
    const events = <?= json_encode($data['upcomingEvents']) ?>;

    function renderCalendar() {
        monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${currentYear}`;
        calendarGrid.innerHTML = '';

        // Add day headers
        for (const day of daysOfWeek) {
            const div = document.createElement('div');
            div.classList.add('calendar-day-header');
            div.textContent = day;
            calendarGrid.appendChild(div);
        }

        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();

        // Empty cells before first day
        for (let i = 0; i < firstDay; i++) {
            const div = document.createElement('div');
            calendarGrid.appendChild(div);
        }

        for (let i = 1; i <= lastDate; i++) {
            const dayDiv = document.createElement('div');
            dayDiv.classList.add('calendar-day');
            dayDiv.innerHTML = `<div class="calendar-date">${i}</div>`;

            // Check for events on this day
            const dayEvents = events.filter(event => {
                const eventDate = new Date(event.event_date);
                return eventDate.getDate() === i && 
                       eventDate.getMonth() === currentMonth && 
                       eventDate.getFullYear() === currentYear;
            });

            // Add indicators for each event type
            dayEvents.forEach(event => {
                const dot = document.createElement('div');
                
                if (event.event_type === 'scheduled') {
                    dot.classList.add('calendar-event-indicator', 'practice-indicator');
                } else if (event.event_type === 'request') {
                    dot.classList.add('calendar-event-indicator', 'meeting-indicator');
                } else if (event.event_name.toLowerCase().includes('match')) {
                    dot.classList.add('calendar-event-indicator', 'match-indicator');
                } else {
                    dot.classList.add('calendar-event-indicator', 'practice-indicator');
                }
                
                // Add tooltip
                dot.title = `${event.event_name}\n${event.time_from} - ${event.time_to}`;
                dayDiv.appendChild(dot);
            });

            calendarGrid.appendChild(dayDiv);
        }
    }

    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        currentDate = new Date(currentYear, currentMonth, 1);
        renderCalendar();
    }

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        currentDate = new Date(currentYear, currentMonth, 1);
        renderCalendar();
    }

    // Initial render
    renderCalendar();
</script>