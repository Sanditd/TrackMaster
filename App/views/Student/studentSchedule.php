<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Schedule | TrackMaster</title>
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
            gap: 55px;
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
            padding: 40px;
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
    
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1><i class="fas fa-calendar-alt"></i> Student Schedule</h1>
            <p>Manage your training schedule, request changes, and view upcoming sessions</p>
        </div>

                    <!-- Upcoming Sessions Section -->
                    <div class="dashboard-section">
                <h2>Upcoming Sessions</h2>
                <div class="appointments-list">
                <?php if(empty($data['scheduledEvents'])): ?>
                    <div class="appointment-item">
                        <span class="appointment-title">No scheduled events found</span>
                    </div>
                <?php else: ?>
                    <?php foreach($data['scheduledEvents'] as $event): ?>
                        <div class="appointment-item">
                            <span class="appointment-date">
                                <i class="fas fa-clock"></i> 
                                <?php echo date('g:i A', strtotime($event->time_from)) . ' - ' . date('g:i A', strtotime($event->time_to)); ?>
                            </span> 
                            <span class="appointment-title"><?php echo $event->event_name; ?></span>
                            <span class="appointment-school"><?php echo $event->school_name; ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>

        <div class="main-content">



                        <!-- Request Schedule Change Section -->
                        <div class="dashboard-section">
                <h2>Request Schedule Change</h2>
                <p><i class="fas fa-info-circle"></i> Fill out the form below to request changes to your training schedule</p>
                <div class="form-container">
                    <form id="scheduleEditForm" class="schedule-form" action="<?php echo URLROOT; ?>/student/requestSheuleChange" method="post">
                        <div class="form-group">
                        <label for="event_id">Event Name</label>
                            <select id="event_id" name="event_id" required>
                                <option value="">Select Event</option>
                                <?php foreach($data['events'] as $event): ?>
                                        <option value="<?php echo $event->event_id; ?>">
                                        <?php echo $event->event_name; ?>
                                        </option>
                                <?php endforeach; ?>
                            </select>
                                </div>
                        
                        <div class="form-group">
                            <label for="reschedule_reason" class="required-field">Reason for the Request:</label>
                            <textarea id="reschedule_reason" placeholder="Please explain why you need to reschedule..." required>
                                <?php echo isset($_POST['reschedule_reason']) ? $_POST['reschedule_reason'] : ''; ?></textarea>

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
    <p><i class="fas fa-info-circle"></i> Need additional academic support? Request extra classes here</p>

    
    <div class="form-container">
        <form id="scheduleExtraClassForm" class="schedule-form" action="<?php echo URLROOT; ?>/student/requestExtraClass" method="post">
            <div class="form-group">
                <label for="subject_name" class="required-field">Subject Name:</label>
                <input type="text" id="subject_name" name="subject_name" 
                       value="<?php echo isset($_SESSION['extra_class_form_data']['subject_name']) ? htmlspecialchars($_SESSION['extra_class_form_data']['subject_name']) : ''; ?>" 
                       placeholder="e.g. Mathematics, Science" required>
                <?php if (isset($_SESSION['extra_class_errors']['subject_name'])) : ?>
                    <span class="text-danger"><?php echo $_SESSION['extra_class_errors']['subject_name']; ?></span>
                    <?php unset($_SESSION['extra_class_errors']['subject_name']); ?>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="reason" class="required-field">Reason:</label>
                <textarea id="reason" name="reason" placeholder="Provide details about what you need help with..." required><?php echo isset($_SESSION['extra_class_form_data']['reason']) ? htmlspecialchars($_SESSION['extra_class_form_data']['reason']) : ''; ?></textarea>
                <?php if (isset($_SESSION['extra_class_errors']['reason'])) : ?>
                    <span class="text-danger"><?php echo $_SESSION['extra_class_errors']['reason']; ?></span>
                    <?php unset($_SESSION['extra_class_errors']['reason']); ?>
                <?php endif; ?>
            </div>
                
            <div class="form-buttons">
                <button type="submit" class="btn">
                    <i class="fas fa-paper-plane"></i> Submit Request
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Clear Form
                </button>
            </div>
        </form>
        <div class="form-footer">
            <p><i class="fas fa-clock"></i> The School will review your request and respond within 48 hours</p>
        </div>
    </div>
</div></div></div>

<?php 
// Clear the session variables after displaying them
unset($_SESSION['extra_class_form_data']);
unset($_SESSION['extra_class_errors']);
?>

            <!-- Request Status Table - Full Width -->
                                
    

    <?php require 'footer.php'; ?>

    <script src="/TrackMaster/Public/js/Student/calender.js"></script>
</body>
</html>