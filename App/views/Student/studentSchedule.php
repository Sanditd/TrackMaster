<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Schedule | TrackMaster</title>
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

        /* Main Container */
        .dashboard-container {
            max-width: 1200px;
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

        /* Main Content Grid - Two Columns */
        .main-content {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 45px;
            margin-top: 20px;
        }

        /* Dashboard Section Cards */
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

        /* Calendar */
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

        /* Modal */
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

        /* Upcoming Appointments */
        .appointments-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 15px;
        }

        .appointment-item {
            background: var(--light-color);
            padding: 15px;
            border-radius: var(--border-radius);
            border-left: 4px solid var(--secondary-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .appointment-date {
            font-weight: 600;
            color: var(--primary-color);
        }

        .appointment-title {
            color: var(--dark-color);
        }

        /* Buttons */
        .btn, .view-more-btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .btn:hover, .view-more-btn:hover {
            background: #cc8400;
        }

        .btn-secondary, .cancel-btn {
            background: var(--light-color);
            color: var(--dark-color);
            border: 1px solid #ddd;
        }

        .btn-secondary:hover, .cancel-btn:hover {
            background: #e6e6e6;
            border-color: #ccc;
        }

        /* Forms */
        .form-container {
            margin-top: 15px;
        }

        .schedule-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .required-field::after {
            content: ' *';
            color: red;
        }

        .form-group input, 
        .form-group textarea {
            padding: 10px;
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
            width: 100%;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .form-header {
            margin-bottom: 15px;
        }

        .form-footer {
            margin-top: 15px;
            color: var(--gray-color);
            font-style: italic;
        }

        .form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        /* Full Width Section */
        .full-width {
            grid-column: 1 / -1;
        }

        /* Status Table */
        .status-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .status-table th, 
        .status-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .status-table th {
            background-color: var(--light-color);
            color: var(--primary-color);
            font-weight: 600;
        }

        .status-table tr:hover {
            background-color: rgba(0, 38, 77, 0.03);
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-completed {
            background-color: #cce5ff;
            color: #004085;
        }

        /* Action buttons in table */
        .table-actions {
            display: flex;
            gap: 5px;
        }

        .action-btn {
            background: transparent;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
            font-size: 1rem;
            padding: 5px;
            transition: var(--transition);
        }

        .action-btn:hover {
            color: var(--secondary-color);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .main-content {
                grid-template-columns: 1fr 1fr;
            }
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

            .status-table {
                font-size: 0.9rem;
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
            
            .appointment-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .status-table th, 
            .status-table td {
                padding: 8px 10px;
            }

            .table-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'?>
    <?php require 'sidebar.php'?>
    
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1><i class="fas fa-calendar-alt"></i> Student Schedule</h1>
            <p>Manage your training schedule, request changes, and view upcoming sessions</p>
        </div>

        <div class="main-content">
            <!-- Calendar Section -->
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
                </div>
                <p><i class="fas fa-info-circle"></i> You can add notes to your Calendar by clicking on any date</p>
            </div>

            <!-- Upcoming Sessions Section -->
            <div class="dashboard-section">
                <h2>Upcoming Sessions</h2>
                <div class="appointments-list">
                    <div class="appointment-item">
                        <span class="appointment-date"><i class="fas fa-clock"></i> Nov 30 - 6:30 a.m.</span> 
                        <span class="appointment-title">Coaching Session 25</span>
                    </div>
                    <div class="appointment-item">
                        <span class="appointment-date"><i class="fas fa-clock"></i> Dec 3 - 7:00 a.m.</span> 
                        <span class="appointment-title">Coaching Session 26</span>
                    </div>
                    <div class="appointment-item">
                        <span class="appointment-date"><i class="fas fa-clock"></i> Dec 7 - 6:30 a.m.</span> 
                        <span class="appointment-title">Coaching Session 27</span>
                    </div>
                    <div class="appointment-item">
                        <span class="appointment-date"><i class="fas fa-clock"></i> Dec 10 - 7:00 a.m.</span> 
                        <span class="appointment-title">Coaching Session 28</span>
                    </div>
                    <div class="appointment-item">
                        <span class="appointment-date"><i class="fas fa-clock"></i> Dec 14 - 6:30 a.m.</span> 
                        <span class="appointment-title">Coaching Session 29</span>
                    </div>
                </div>
                <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentAttendance'">
                    <i class="fas fa-clipboard-check"></i> View My Attendance
                </button>
            </div>

                        <!-- Request Schedule Change Section -->
                        <div class="dashboard-section">
                <h2>Request Schedule Change</h2>
                <p><i class="fas fa-info-circle"></i> Fill out the form below to request changes to your training schedule</p>
                <div class="form-container">
                    <form id="scheduleEditForm" class="schedule-form">
                        <div class="form-group">
                            <label for="stu_name" class="required-field">Student Name:</label>
                            <input type="text" id="stu_name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="event_name" class="required-field">Event Name:</label>
                            <input type="text" id="event_name" placeholder="e.g. Track Practice, Competition" required>
                        </div>

                        <div class="form-group">
                            <label for="event_date" class="required-field">Event Date and Time:</label>
                            <input type="datetime-local" id="event_date" required>
                        </div>

                        <div class="form-group">
                            <label for="event_location" class="required-field">Event Location:</label>
                            <input type="text" id="event_location" placeholder="Enter location details" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="reschedule_reason" class="required-field">Reason for the Request:</label>
                            <textarea id="reschedule_reason" placeholder="Please explain why you need to reschedule..." required></textarea>
                        </div>
                            
                        <div class="form-buttons">
                            <button type="submit" class="btn">
                                <i class="fas fa-paper-plane"></i> Submit Request
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                    <div class="form-footer">
                        <p><i class="fas fa-exclamation-circle"></i> All schedule change requests are subject to coach approval</p>
                    </div>
                </div>
            </div>

            <!-- Request Extra Classes Section -->
            <div class="dashboard-section">
                <h2>Request Extra Classes</h2>
                <p><i class="fas fa-info-circle"></i> Need additional training or academic support? Request extra classes here</p>
                <div class="form-container">
                    <form id="scheduleExtraClassForm" class="schedule-form">
                        <div class="form-group">
                            <label for="extra_stu_name" class="required-field">Student Name:</label>
                            <input type="text" id="extra_stu_name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="subject_name" class="required-field">Subject Name:</label>
                            <input type="text" id="subject_name" placeholder="e.g. Sprint Training, Mathematics" required>
                        </div>

                        <div class="form-group">
                            <label for="school_name" class="required-field">School:</label>
                            <input type="text" id="school_name" placeholder="Enter your school name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="notes" class="required-field">Notes:</label>
                            <textarea id="notes" placeholder="Provide details about what you need help with..." required></textarea>
                        </div>
                            
                        <div class="form-buttons">
                            <button type="submit" class="btn">
                                <i class="fas fa-paper-plane"></i> Submit Request
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                    <div class="form-footer">
                        <p><i class="fas fa-clock"></i> The School will review your request and respond within 48 hours</p>
                    </div>
                </div>
            </div>

            <!-- Request Status Table - Full Width -->
            <div class="dashboard-section full-width">
                <h2>Request Status</h2>
                <p><i class="fas fa-info-circle"></i> Track the status of your schedule change and extra class requests</p>
                <div class="table-responsive">
                    <table class="status-table">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Type</th>
                                <th>Date Submitted</th>
                                <th>Event/Subject</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#REQ-2325</td>
                                <td>Schedule Change</td>
                                <td>Nov 15, 2024</td>
                                <td>Sprint Practice</td>
                                <td><span class="status-badge status-approved">Approved</span></td>
                                <td class="table-actions">
                                    <button class="action-btn" title="View Details"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#REQ-2315</td>
                                <td>Extra Class</td>
                                <td>Nov 10, 2024</td>
                                <td>Mathematics</td>
                                <td><span class="status-badge status-completed">Completed</span></td>
                                <td class="table-actions">
                                    <button class="action-btn" title="View Details"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#REQ-2390</td>
                                <td>Schedule Change</td>
                                <td>Nov 22, 2024</td>
                                <td>Track Competition</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td class="table-actions">
                                    <button class="action-btn" title="View Details"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn" title="Edit Request"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn" title="Cancel Request"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#REQ-2289</td>
                                <td>Extra Class</td>
                                <td>Nov 5, 2024</td>
                                <td>Sprint Training</td>
                                <td><span class="status-badge status-rejected">Rejected</span></td>
                                <td class="table-actions">
                                    <button class="action-btn" title="View Details"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn" title="Submit Again"><i class="fas fa-redo"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>#REQ-2405</td>
                                <td>Schedule Change</td>
                                <td>Nov 25, 2024</td>
                                <td>Cricket Practice</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td class="table-actions">
                                    <button class="action-btn" title="View Details"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn" title="Edit Request"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn" title="Cancel Request"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

    <?php require 'footer.php'; ?>

    <script src="/TrackMaster/Public/js/Student/calender.js"></script>
</body>
</html>