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
            --warning-color: #ffc107;
            --info-color: #17a2b8;
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
            text-align: center;
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
            text-decoration: none;
        }
        .btn:hover {
            background: #cc8400;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(204, 132, 0, 0.2);
        }
        .btn-container {
            margin-top: 20px;
            text-align: center;
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
        
        /* ---- ENHANCED MEDICAL ALERTS SECTION ---- */
        .medical-alerts {
            margin: 15px 0;
        }
        
        .medical-alert-counter {
            background: var(--light-color);
            padding: 12px;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
            text-align: center;
            border-left: 4px solid var(--error-color);
        }
        
        .medical-alert-counter span {
            font-weight: bold;
            font-size: 1.2rem;
            color: var(--error-color);
        }
        
        .alert-item {
            display: flex;
            margin-bottom: 15px;
            background: #fff;
            border-radius: var(--border-radius);
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: var(--transition);
        }
        
        .alert-item:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .alert-status {
            width: 8px;
            background: var(--error-color);
        }
        
        .alert-status.critical {
            background: var(--error-color);
        }
        
        .alert-status.moderate {
            background: var(--warning-color);
        }
        
        .alert-status.minor {
            background: var(--info-color);
        }
        
        .alert-content {
            padding: 15px;
            display: flex;
            flex: 1;
        }
        
        .alert-date {
            min-width: 50px;
            text-align: center;
            font-weight: bold;
            color: var(--primary-color);
            background: rgba(0, 38, 77, 0.05);
            padding: 8px;
            border-radius: var(--border-radius);
            margin-right: 15px;
            font-size: 0.9rem;
            height: fit-content;
            line-height: 1.3;
        }
        
        .alert-date .day {
            font-size: 1.1rem;
            display: block;
        }
        
        .alert-date .month {
            text-transform: uppercase;
            font-size: 0.75rem;
        }
        
        .alert-details {
            flex: 1;
        }
        
        .player-name {
            font-weight: bold;
            font-size: 1.05rem;
            margin-bottom: 5px;
            color: var(--primary-color);
        }
        
        .condition {
            color: var(--gray-color);
            margin-bottom: 8px;
            line-height: 1.4;
        }
        
        .alert-tag {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 5px;
        }
        
        .tag-critical {
            background: rgba(220, 53, 69, 0.1);
            color: var(--error-color);
        }
        
        .tag-moderate {
            background: rgba(255, 193, 7, 0.1);
            color: #856404;
        }
        
        .tag-minor {
            background: rgba(23, 162, 184, 0.1);
            color: var(--info-color);
        }
        
        .medical-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            justify-content: center;
        }
        
        .btn-medical {
            padding: 12px 18px;
        }
        
        .btn-medical-records {
            background: var(--primary-color);
        }
        
        .btn-medical-records:hover {
            background: #003b73;
        }
        
        .empty-alert-message {
            padding: 20px;
            text-align: center;
            color: var(--gray-color);
            background: var(--light-color);
            border-radius: var(--border-radius);
            margin: 15px 0;
        }
        
        /* ---- ENHANCED SCHEDULE REQUESTS SECTION ---- */
        .schedule-requests {
            margin: 15px 0;
        }
        
        .schedule-counter {
            background: var(--light-color);
            padding: 12px;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
            text-align: center;
            border-left: 4px solid var(--info-color);
        }
        
        .schedule-counter span {
            font-weight: bold;
            font-size: 1.2rem;
            color: var(--info-color);
        }
        
        .request-item {
            display: flex;
            margin-bottom: 15px;
            background: #fff;
            border-radius: var(--border-radius);
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: var(--transition);
        }
        
        .request-item:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .request-status {
            width: 8px;
            background: var(--info-color);
        }
        
        .request-status.pending {
            background: var(--warning-color);
        }
        
        .request-status.approved {
            background: var(--success-color);
        }
        
        .request-status.denied {
            background: var(--error-color);
        }
        
        .request-content {
            padding: 15px;
            display: flex;
            flex: 1;
        }
        
        .request-date {
            min-width: 50px;
            text-align: center;
            font-weight: bold;
            color: var(--primary-color);
            background: rgba(0, 38, 77, 0.05);
            padding: 8px;
            border-radius: var(--border-radius);
            margin-right: 15px;
            font-size: 0.9rem;
            height: fit-content;
            line-height: 1.3;
        }
        
        .request-date .day {
            font-size: 1.1rem;
            display: block;
        }
        
        .request-date .month {
            text-transform: uppercase;
            font-size: 0.75rem;
        }
        
        .request-details {
            flex: 1;
        }
        
        .request-event {
            font-weight: 500;
            margin-top: 5px;
            color: var(--primary-color);
        }
        
        .reason {
            font-style: italic;
            color: var(--gray-color);
            margin-top: 8px;
            line-height: 1.4;
            background: rgba(0,0,0,0.02);
            padding: 8px;
            border-radius: 4px;
            border-left: 3px solid #ddd;
        }
        
        .request-tag {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 5px;
        }
        
        .tag-pending {
            background: rgba(255, 193, 7, 0.1);
            color: #856404;
        }
        
        .tag-approved {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }
        
        .tag-denied {
            background: rgba(220, 53, 69, 0.1);
            color: var(--error-color);
        }
        
        .schedule-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            justify-content: center;
        }
        
        .btn-schedule {
            padding: 12px 18px;
        }
        
        .btn-schedule-requests {
            background: var(--info-color);
        }
        
        .btn-schedule-new {
            background: var(--success-color);
        }
        
        .btn-schedule-requests:hover {
            background: #138496;
        }
        
        .btn-schedule-new:hover {
            background: #218838;
        }
        
        .empty-request-message {
            padding: 20px;
            text-align: center;
            color: var(--gray-color);
            background: var(--light-color);
            border-radius: var(--border-radius);
            margin: 15px 0;
        }
        
        /* Action buttons for items */
        .item-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }
        
        .item-action-btn {
            background: var(--light-color);
            border: none;
            padding: 3px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8rem;
            color: var(--gray-color);
            transition: var(--transition);
        }
        
        .item-action-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .bottom-sections {
  display: flex;
  flex-wrap: wrap;
  gap: 25px;
  margin-top: 20px;
}

.bottom-sections .dashboard-section {
  flex: 1;
  min-width: 280px;
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
        
        </div>
        <div class="bottom-sections">
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

        <!-- ENHANCED Medical History -->
        <!-- Player Medical History Section -->
<div class="dashboard-section">
  <h2><i class="fas fa-briefcase-medical"></i> Player Medical Updadtes</h2>

  <?php if (!empty($data['medicalAlerts'])): ?>
    <div class="medical-alerts" style="display: flex; flex-direction: column; gap: 15px; margin-top: 15px;">
      <?php foreach ($data['medicalAlerts'] as $alert): ?>
        <div class="alert-item" style="display: flex; background: rgba(255, 0, 0, 0.02); border: 1px solid #eee; padding: 15px; border-radius: 8px; align-items: center; transition: all 0.3s ease;">
          <div class="alert-date" style="font-weight: bold; color: #00264d; background: #f8f9fa; padding: 10px; border-radius: 8px; margin-right: 20px; min-width: 70px; text-align: center;">
            <?= date('M j', strtotime($alert->date)) ?>
          </div>
          <div class="alert-details" style="flex: 1;">
            <div class="player-name" style="font-weight: bold; color: #00264d;"><?= htmlspecialchars($alert->player_name) ?></div>
            <div class="condition" style="font-size: 0.9rem; color: #666; margin-top: 5px;"><?= htmlspecialchars($alert->medical_condition) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>No recent medical alerts.</p>
  <?php endif; ?>

  <div style="display: flex; justify-content: center; margin-top: 20px;">
    <a href="<?= URLROOT ?>/coach/medicalRecords" class="btn" style="padding: 12px 20px; font-size: 1rem; font-weight: bold; text-transform: uppercase;">
      View All Medical Records <i class="fas fa-arrow-right"></i>
    </a>
  </div>
</div>

<!-- Schedule Change Requests Section -->
<div class="dashboard-section">
  <h2><i class="fas fa-clock"></i> Schedule Change Requests</h2>

  <?php if (!empty($data['scheduleRequests'])): ?>
    <div class="schedule-requests" style="display: flex; flex-direction: column; gap: 15px; margin-top: 15px;">
      <?php foreach ($data['scheduleRequests'] as $request): ?>
        <div class="request-item" style="display: flex; background: rgba(0, 102, 255, 0.02); border: 1px solid #eee; padding: 15px; border-radius: 8px; align-items: center; transition: all 0.3s ease;">
          <div class="request-date" style="font-weight: bold; color: #00264d; background: #f8f9fa; padding: 10px; border-radius: 8px; margin-right: 20px; min-width: 70px; text-align: center;">
            <?= date('M j', strtotime($request->request_date)) ?>
          </div>
          <div class="request-details" style="flex: 1;">
            <div class="player-name" style="font-weight: bold; color: #00264d;"><?= htmlspecialchars($request->player_name) ?></div>
            <div class="event-name" style="font-size: 0.95rem; font-weight: 500; color: #ffa500;"><?= htmlspecialchars($request->event_name) ?></div>
            <div class="reason" style="font-size: 0.85rem; color: #666; margin-top: 8px;"><?= htmlspecialchars($request->reason) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>No pending schedule change requests.</p>
  <?php endif; ?>

  <div style="display: flex; justify-content: center; margin-top: 20px;">
    <a href="<?= URLROOT ?>/coach/scheduleRequests" class="btn" style="padding: 12px 20px; font-size: 1rem; font-weight: bold; text-transform: uppercase;">
      View All Requests <i class="fas fa-arrow-right"></i>
    </a>
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