<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Dashboard | TrackMaster</title>
    <link rel="stylesheet" href="../Public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base Styles */
        :root {
            --primary-color: #00264d;
            --secondary-color: #ffa500;
            --light-color: #f8f9fa;
            --dark-color: #333;
            --gray-color: #666;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 38, 77, 0.1);
            --transition: all 0.3s ease;
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

        /* Dashboard Container */
        .dashboard-container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            position: relative;
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

        .last-login {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Dashboard Grid Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 25px;
            margin-top: 20px;
        }

        /* Quick Actions */
        .quick-actions {
            grid-column: span 3;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .actions-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .actions-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--light-color);
            border: none;
            color: var(--primary-color);
            padding: 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            width: 100%;
            text-align: left;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .action-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .action-btn i {
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }

        /* Today's Schedule */
        .todays-schedule {
            grid-column: span 6;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .schedule-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .schedule-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .weather-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            color: var(--gray-color);
        }

        .weather-info i {
            color: var(--secondary-color);
            font-size: 1.5rem;
        }

        .schedule-list {
            list-style: none;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .schedule-item:last-child {
            border-bottom: none;
        }

        .schedule-time {
            width: 80px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .schedule-dot {
            width: 12px;
            height: 12px;
            background: var(--secondary-color);
            border-radius: 50%;
            margin: 0 15px;
        }

        .practice-dot {
            background: var(--secondary-color);
        }

        .match-dot {
            background: var(--danger-color);
        }

        .meeting-dot {
            background: var(--info-color);
        }

        .schedule-details {
            flex-grow: 1;
        }

        .schedule-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .schedule-location {
            font-size: 0.9rem;
            color: var(--gray-color);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .schedule-actions {
            display: flex;
            gap: 10px;
        }

        .schedule-btn {
            background: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 5px 10px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .schedule-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Team Status */
        .team-status {
            grid-column: span 3;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .status-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .status-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .status-counts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .status-box {
            background: var(--light-color);
            padding: 15px;
            border-radius: var(--border-radius);
            text-align: center;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .status-label {
            font-size: 0.9rem;
            color: var(--gray-color);
            margin-bottom: 5px;
        }

        .status-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .status-total {
            grid-column: span 2;
            background: rgba(0, 38, 77, 0.05);
            padding: 15px;
            border-radius: var(--border-radius);
            text-align: center;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        /* Calendar */
        .upcoming-events {
            grid-column: span 6;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .events-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .events-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .calendar-btn {
            background: transparent;
            border: none;
            color: var(--gray-color);
            cursor: pointer;
            font-size: 1rem;
            transition: var(--transition);
        }

        .calendar-btn:hover {
            color: var(--primary-color);
        }

        .calendar-month {
            font-weight: 600;
            color: var(--primary-color);
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        .calendar-day-header {
            text-align: center;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.9rem;
            padding: 5px 0;
        }

        .calendar-day {
            aspect-ratio: 1/1;
            background: var(--light-color);
            border-radius: var(--border-radius);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 5px;
            position: relative;
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .calendar-day:hover {
            background: rgba(0, 38, 77, 0.05);
        }

        .calendar-date {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .calendar-event-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-top: 2px;
        }

        .practice-indicator {
            background: var(--secondary-color);
        }

        .match-indicator {
            background: var(--danger-color);
        }

        .meeting-indicator {
            background: var(--info-color);
        }

        .current-day {
            background: rgba(255, 165, 0, 0.2);
            border: 1px solid var(--secondary-color);
        }

        /* Session Stats */
        .session-stats {
            grid-column: span 3;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .stats-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .stats-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .stat-box {
            background: var(--light-color);
            padding: 15px;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 165, 0, 0.2);
            color: var(--secondary-color);
            border-radius: var(--border-radius);
            font-size: 1.5rem;
        }

        .stat-details {
            flex-grow: 1;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--gray-color);
        }

        /* Player Medical History */
        .medical-history {
            grid-column: span 6;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .medical-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .medical-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .view-all-btn {
            background: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 8px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.9rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .view-all-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .medical-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .medical-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .medical-item:last-child {
            border-bottom: none;
        }

        .medical-player-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .medical-info {
            flex-grow: 1;
        }

        .medical-player-name {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .medical-issue {
            font-size: 0.95rem;
            margin-bottom: 5px;
        }

        .medical-date {
            font-size: 0.85rem;
            color: var(--gray-color);
        }

        .medical-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            align-self: flex-start;
        }

        .status-active {
            background: rgba(40, 167, 69, 0.2);
            color: var(--success-color);
        }

        .status-injured {
            background: rgba(220, 53, 69, 0.2);
            color: var(--danger-color);
        }

        .status-recovering {
            background: rgba(255, 193, 7, 0.2);
            color: var(--warning-color);
        }

        /* Financial Requests */
        .financial-requests {
            grid-column: span 6;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .financial-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .financial-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .financial-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .request-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .request-item:last-child {
            border-bottom: none;
        }

        .request-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 165, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary-color);
            font-size: 1.2rem;
        }

        .request-details {
            flex-grow: 1;
        }

        .request-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .request-player {
            font-size: 0.95rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .request-date {
            font-size: 0.85rem;
            color: var(--gray-color);
        }

        .request-amount {
            font-weight: bold;
            color: var(--primary-color);
        }

        .request-buttons {
            display: flex;
            gap: 8px;
        }

        .approve-btn {
            background: transparent;
            border: 1px solid var(--success-color);
            color: var(--success-color);
            padding: 5px 10px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.85rem;
            transition: var(--transition);
        }

        .approve-btn:hover {
            background: var(--success-color);
            color: white;
        }

        .reject-btn {
            background: transparent;
            border: 1px solid var(--danger-color);
            color: var(--danger-color);
            padding: 5px 10px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.85rem;
            transition: var(--transition);
        }

        .reject-btn:hover {
            background: var(--danger-color);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: repeat(6, 1fr);
            }

            .quick-actions {
                grid-column: span 2;
            }

            .todays-schedule {
                grid-column: span 4;
            }

            .team-status {
                grid-column: span 2;
            }

            .upcoming-events {
                grid-column: span 4;
            }

            .session-stats {
                grid-column: span 2;
            }

            .medical-history, .financial-requests {
                grid-column: span 3;
            }
        }

        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .quick-actions, .team-status {
                grid-column: span 2;
            }

            .todays-schedule, .upcoming-events {
                grid-column: span 4;
            }

            .session-stats, .medical-history, .financial-requests {
                grid-column: span 4;
            }
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .quick-actions, .todays-schedule, .team-status, .upcoming-events, .session-stats, .medical-history, .financial-requests {
                grid-column: span 1;
            }

            .dashboard-header {
                padding: 20px 15px;
            }
            
            .dashboard-header h1 {
                font-size: 1.8rem;
            }
            
            .dashboard-header p {
                font-size: 1rem;
            }

            .last-login {
                position: static;
                margin-top: 10px;
                text-align: center;
            }

            .status-counts {
                grid-template-columns: 1fr;
            }
            
            .status-total {
                grid-column: span 1;
            }
            
            .calendar-grid {
                grid-template-columns: repeat(4, 1fr);
            }
            
            .calendar-day-header:nth-child(n+5),
            .calendar-day:nth-child(n+29) {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .dashboard-header h1 {
                font-size: 1.6rem;
            }
            
            .schedule-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .schedule-time {
                width: auto;
            }
            
            .schedule-dot {
                display: none;
            }
            
            .schedule-actions {
                width: 100%;
                justify-content: space-between;
                margin-top: 10px;
            }
            
            .request-item, .medical-item {
                flex-direction: column;
            }
            
            .request-buttons {
                width: 100%;
                justify-content: space-between;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
<?php $this->view('Coach/CoachNav', [
        'sport_id' => $data['sport_id'] ?? 0,
        'coach_name' => $data['coach_name'] ?? 'Coach'
    ]); ?>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1><i class="fas fa-tachometer-alt"></i> Coach Dashboard</h1>
            <p>Monitor team activity, schedule sessions, and track player performance</p>
            <div class="last-login">Last login: Today, 08:15 AM</div>
        </div>

        <div class="dashboard-grid">
            <!-- Quick Actions Section -->
            <div class="quick-actions">
                <div class="actions-header">
                    <i class="fas fa-bolt"></i>
                    <h2>Quick Actions</h2>
                </div>
                <div class="action-buttons">
                    <button class="action-btn">
                        <i class="fas fa-calendar-plus"></i>
                        Create Training Session
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-clipboard-check"></i>
                        Log Attendance
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-user-plus"></i>
                        Add New Player
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-chart-line"></i>
                        Performance Report
                    </button>
                </div>
            </div>

            <!-- Today's Schedule Section -->
            <div class="todays-schedule">
                <div class="schedule-header">
                    <h2><i class="fas fa-calendar-day"></i> Today's Schedule</h2>
                    <div class="weather-info">
                        <i class="fas fa-sun"></i>
                        <span>28°C, Sunny</span>
                    </div>
                </div>
                <ul class="schedule-list">
                    <li class="schedule-item">
                        <div class="schedule-time">09:00 AM</div>
                        <div class="schedule-dot practice-dot"></div>
                        <div class="schedule-details">
                            <div class="schedule-title">Batting Practice</div>
                            <div class="schedule-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Main Cricket Ground
                            </div>
                        </div>
                        <div class="schedule-actions">
                            <button class="schedule-btn">Details</button>
                            <button class="schedule-btn">Record</button>
                        </div>
                    </li>
                    <li class="schedule-item">
                        <div class="schedule-time">01:00 PM</div>
                        <div class="schedule-dot meeting-dot"></div>
                        <div class="schedule-details">
                            <div class="schedule-title">Team Strategy Meeting</div>
                            <div class="schedule-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Conference Room
                            </div>
                        </div>
                        <div class="schedule-actions">
                            <button class="schedule-btn">Details</button>
                            <button class="schedule-btn">Notes</button>
                        </div>
                    </li>
                    <li class="schedule-item">
                        <div class="schedule-time">04:30 PM</div>
                        <div class="schedule-dot match-dot"></div>
                        <div class="schedule-details">
                            <div class="schedule-title">Practice Match</div>
                            <div class="schedule-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Main Cricket Ground
                            </div>
                        </div>
                        <div class="schedule-actions">
                            <button class="schedule-btn">Details</button>
                            <button class="schedule-btn">Record</button>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Team Status Section -->
            <div class="team-status">
                <div class="status-header">
                    <i class="fas fa-users"></i>
                    <h2>Team Status</h2>
                </div>
                <div class="status-counts">
                    <div class="status-box">
                        <div class="status-label">Active</div>
                        <div class="status-value">18</div>
                    </div>
                    <div class="status-box">
                        <div class="status-label">Injured</div>
                        <div class="status-value">3</div>
                    </div>
                    <div class="status-box">
                        <div class="status-label">On Leave</div>
                        <div class="status-value">1</div>
                    </div>
                    <div class="status-box">
                        <div class="status-label">Training</div>
                        <div class="status-value">16</div>
                    </div>
                    <div class="status-total">
                        <div class="status-label">Total Players</div>
                        <div class="status-value">22</div>
                    </div>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="upcoming-events">
                <div class="events-header">
                    <h2><i class="fas fa-calendar-alt"></i> Upcoming Events</h2>
                    <div class="calendar-nav">
                        <button class="calendar-btn"><i class="fas fa-chevron-left"></i></button>
                        <div class="calendar-month">April 2025</div>
                        <button class="calendar-btn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="calendar-grid">
                    <div class="calendar-day-header">Sun</div>
                    <div class="calendar-day-header">Mon</div>
                    <div class="calendar-day-header">Tue</div>
                    <div class="calendar-day-header">Wed</div>
                    <div class="calendar-day-header">Thu</div>
                    <div class="calendar-day-header">Fri</div>
                    <div class="calendar-day-header">Sat</div>
                    
                    <!-- Week 1 -->
                    <!-- Week 1 -->
                    <div class="calendar-day">
                        <div class="calendar-date">1</div>
                        <div class="calendar-event-indicator practice-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">2</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">3</div>
                        <div class="calendar-event-indicator meeting-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">4</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">5</div>
                        <div class="calendar-event-indicator practice-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">6</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">7</div>
                        <div class="calendar-event-indicator match-indicator"></div>
                    </div>
                    
                    <!-- Week 2 -->
                    <div class="calendar-day">
                        <div class="calendar-date">8</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">9</div>
                        <div class="calendar-event-indicator practice-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">10</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">11</div>
                        <div class="calendar-event-indicator meeting-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">12</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">13</div>
                        <div class="calendar-event-indicator practice-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">14</div>
                    </div>
                    
                    <!-- Week 3 -->
                    <div class="calendar-day">
                        <div class="calendar-date">15</div>
                        <div class="calendar-event-indicator match-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">16</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">17</div>
                        <div class="calendar-event-indicator practice-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">18</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">19</div>
                        <div class="calendar-event-indicator meeting-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">20</div>
                    </div>
                    <div class="calendar-day current-day">
                        <div class="calendar-date">21</div>
                        <div class="calendar-event-indicator practice-indicator"></div>
                        <div class="calendar-event-indicator match-indicator"></div>
                    </div>
                    
                    <!-- Week 4 -->
                    <div class="calendar-day">
                        <div class="calendar-date">22</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">23</div>
                        <div class="calendar-event-indicator practice-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">24</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">25</div>
                        <div class="calendar-event-indicator match-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">26</div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">27</div>
                        <div class="calendar-event-indicator practice-indicator"></div>
                    </div>
                    <div class="calendar-day">
                        <div class="calendar-date">28</div>
                    </div>
                </div>
            </div>

            <!-- Session Stats Section -->
            <div class="session-stats">
                <div class="stats-header">
                    <i class="fas fa-chart-pie"></i>
                    <h2>Session Stats</h2>
                </div>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">45</div>
                        <div class="stat-label">Completed Sessions</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">12</div>
                        <div class="stat-label">Matches Played</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">87%</div>
                        <div class="stat-label">Attendance Rate</div>
                    </div>
                </div>
            </div>

            <!-- Medical History Section -->
            <div class="medical-history">
                <div class="medical-header">
                    <h2><i class="fas fa-briefcase-medical"></i> Player Medical History</h2>
                    <button class="view-all-btn">
                        View All <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                <div class="medical-list">
                    <div class="medical-item">
                        <div class="medical-player-avatar">RA</div>
                        <div class="medical-info">
                            <div class="medical-player-name">Rahul Sharma</div>
                            <div class="medical-issue">Hamstring Strain</div>
                            <div class="medical-date">Started: Apr 15, 2025</div>
                        </div>
                        <div class="medical-status status-injured">Injured</div>
                    </div>
                    <div class="medical-item">
                        <div class="medical-player-avatar">VP</div>
                        <div class="medical-info">
                            <div class="medical-player-name">Virat Patel</div>
                            <div class="medical-issue">Sprained Ankle</div>
                            <div class="medical-date">Started: Apr 10, 2025</div>
                        </div>
                        <div class="medical-status status-recovering">Recovering</div>
                    </div>
                    <div class="medical-item">
                        <div class="medical-player-avatar">AK</div>
                        <div class="medical-info">
                            <div class="medical-player-name">Amit Kumar</div>
                            <div class="medical-issue">Shoulder Injury</div>
                            <div class="medical-date">Started: Apr 5, 2025</div>
                        </div>
                        <div class="medical-status status-injured">Injured</div>
                    </div>
                    <div class="medical-item">
                        <div class="medical-player-avatar">SJ</div>
                        <div class="medical-info">
                            <div class="medical-player-name">Sunil Joshi</div>
                            <div class="medical-issue">Back Pain</div>
                            <div class="medical-date">Started: Mar 25, 2025</div>
                        </div>
                        <div class="medical-status status-active">Cleared</div>
                    </div>
                </div>
            </div>

            <!-- Financial Requests Section -->
            <div class="financial-requests">
                <div class="financial-header">
                    <h2><i class="fas fa-coins"></i> Financial Requests</h2>
                    <button class="view-all-btn">
                        View All <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                <div class="financial-list">
                    <div class="request-item">
                        <div class="request-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="request-details">
                            <div class="request-title">Equipment Purchase</div>
                            <div class="request-player">
                                <i class="fas fa-user"></i>
                                Rohit Sharma
                            </div>
                            <div class="request-date">Requested: Apr 19, 2025</div>
                        </div>
                        <div class="request-amount">₹15,000</div>
                        <div class="request-buttons">
                            <button class="approve-btn">Approve</button>
                            <button class="reject-btn">Reject</button>
                        </div>
                    </div>
                    <div class="request-item">
                        <div class="request-icon">
                            <i class="fas fa-plane"></i>
                        </div>
                        <div class="request-details">
                            <div class="request-title">Travel Expense</div>
                            <div class="request-player">
                                <i class="fas fa-user"></i>
                                Ajay Singh
                            </div>
                            <div class="request-date">Requested: Apr 18, 2025</div>
                        </div>
                        <div class="request-amount">₹8,500</div>
                        <div class="request-buttons">
                            <button class="approve-btn">Approve</button>
                            <button class="reject-btn">Reject</button>
                        </div>
                    </div>
                    <div class="request-item">
                        <div class="request-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div class="request-details">
                            <div class="request-title">Medical Reimbursement</div>
                            <div class="request-player">
                                <i class="fas fa-user"></i>
                                Karan Mehta
                            </div>
                            <div class="request-date">Requested: Apr 15, 2025</div>
                        </div>
                        <div class="request-amount">₹12,200</div>
                        <div class="request-buttons">
                            <button class="approve-btn">Approve</button>
                            <button class="reject-btn">Reject</button>
                        </div>
                    </div>
                    <div class="request-item">
                        <div class="request-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <div class="request-details">
                            <div class="request-title">Kit Replacement</div>
                            <div class="request-player">
                                <i class="fas fa-user"></i>
                                Dinesh Patel
                            </div>
                            <div class="request-date">Requested: Apr 14, 2025</div>
                        </div>
                        <div class="request-amount">₹7,800</div>
                        <div class="request-buttons">
                            <button class="approve-btn">Approve</button>
                            <button class="reject-btn">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        // Dashboard JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Current date highlight
            const today = new Date();
            const todayDate = today.getDate();
            const todayDay = today.getDay();
            
            // Format options for date display
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            
            // Weather API integration could be added here
            // This is a placeholder for demonstration
            const weatherDisplay = document.querySelector('.weather-info span');
            fetchWeather();
            
            function fetchWeather() {
                // In a real application, you would fetch weather data from an API
                // For now, we're using dummy data
                const weather = {
                    temp: 28,
                    condition: 'Sunny'
                };
                
                // Update weather display
                weatherDisplay.innerHTML = `${weather.temp}°C, ${weather.condition}`;
            }
            
            // Calendar navigation
            const prevMonthBtn = document.querySelector('.calendar-btn:first-child');
            const nextMonthBtn = document.querySelector('.calendar-btn:last-child');
            const monthDisplay = document.querySelector('.calendar-month');
            
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();
            
            // Event listeners for calendar navigation
            prevMonthBtn.addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                updateCalendarMonth();
            });
            
            nextMonthBtn.addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                updateCalendarMonth();
            });
            
            function updateCalendarMonth() {
                const monthNames = [
                    'January', 'February', 'March', 'April', 
                    'May', 'June', 'July', 'August', 
                    'September', 'October', 'November', 'December'
                ];
                
                monthDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;
                
                // In a real application, you would regenerate the calendar days
                // and fetch events for the selected month
            }
            
            // Quick action buttons event listeners
            const actionButtons = document.querySelectorAll('.action-btn');
            actionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.textContent.trim();
                    console.log(`Action clicked: ${action}`);
                    
                    // Handle different actions
                    switch(action) {
                        case 'Create Training Session':
                            window.location.href = '<?php echo ROOT; ?>/coach/createSession';
                            break;
                        case 'Log Attendance':
                            window.location.href = '<?php echo ROOT; ?>/coach/attendance';
                            break;
                        case 'Add New Player':
                            window.location.href = '<?php echo ROOT; ?>/coach/addPlayer';
                            break;
                        case 'Performance Report':
                            window.location.href = '<?php echo ROOT; ?>/coach/reports';
                            break;
                    }
                });
            });
            
            // Schedule action buttons
            const scheduleButtons = document.querySelectorAll('.schedule-btn');
            scheduleButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    const action = this.textContent.trim();
                    const sessionTitle = this.closest('.schedule-item').querySelector('.schedule-title').textContent;
                    
                    console.log(`${action} clicked for ${sessionTitle}`);
                    
                    // Handle different schedule actions
                    switch(action) {
                        case 'Details':
                            // View session details
                            break;
                        case 'Record':
                            // Record session data
                            window.location.href = '<?php echo ROOT; ?>/coach/recordSession';
                            break;
                        case 'Notes':
                            // Add or view notes
                            break;
                    }
                });
            });
            
            // Financial request buttons
            const approveButtons = document.querySelectorAll('.approve-btn');
            const rejectButtons = document.querySelectorAll('.reject-btn');
            
            approveButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const requestItem = this.closest('.request-item');
                    const requestTitle = requestItem.querySelector('.request-title').textContent;
                    const playerName = requestItem.querySelector('.request-player').textContent.trim();
                    
                    console.log(`Approved: ${requestTitle} for ${playerName}`);
                    
                    // In a real application, you would send an AJAX request to approve
                    // For demonstration, we'll just change the UI
                    requestItem.style.opacity = '0.6';
                    this.textContent = 'Approved';
                    this.disabled = true;
                    this.nextElementSibling.disabled = true;
                });
            });
            
            rejectButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const requestItem = this.closest('.request-item');
                    const requestTitle = requestItem.querySelector('.request-title').textContent;
                    const playerName = requestItem.querySelector('.request-player').textContent.trim();
                    
                    console.log(`Rejected: ${requestTitle} for ${playerName}`);
                    
                    // In a real application, you would send an AJAX request to reject
                    // For demonstration, we'll just change the UI
                    requestItem.style.opacity = '0.6';
                    this.textContent = 'Rejected';
                    this.disabled = true;
                    this.previousElementSibling.disabled = true;
                });
            });
        });
    </script>
</body>
</html>