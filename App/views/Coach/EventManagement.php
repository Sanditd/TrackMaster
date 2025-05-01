<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | TrackMaster</title>
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

        .tcontainer {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
        }

        /* Dashboard Header */
        .dashboard-header {
            grid-column: 1 / -1;
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

        /* Form Section */
        .form-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .form-section h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
        }

        .form-section label {
            margin-top: 15px;
            margin-bottom: 5px;
            color: var(--dark-color);
            font-weight: 500;
        }

        .form-section input, 
        .form-section textarea {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-section input:focus,
        .form-section textarea:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        .form-section button {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
            margin-top: 10px;
        }

        .form-section button:hover {
            background: #cc8400;
        }

        /* Table Section */
        .table-section {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .table-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .table-card h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background-color: rgba(0, 38, 77, 0.05);
            color: var(--primary-color);
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table tr:hover {
            background-color: rgba(0, 38, 77, 0.02);
        }

        /* Action buttons */
        .create-btn, .edit-btn, .delete-btn {
            padding: 8px 12px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            margin-right: 5px;
        }

        .create-btn {
            background-color: #28a745;
            color: white;
        }

        .create-btn:hover {
            background-color: #218838;
        }

        .edit-btn {
            background-color: var(--secondary-color);
            color: white;
        }

        .edit-btn:hover {
            background-color: #cc8400;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        /* Status badges */
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: rgba(255, 165, 0, 0.2);
            color: #cc8400;
        }

        .status-approved {
            background-color: rgba(40, 167, 69, 0.2);
            color: #218838;
        }

        .status-rejected {
            background-color: rgba(220, 53, 69, 0.2);
            color: #c82333;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .tcontainer {
                grid-template-columns: 1fr;
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
            
            .form-section, .table-card {
                padding: 20px 15px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-header h1 {
                font-size: 1.6rem;
            }
            
            table {
                font-size: 0.9rem;
            }
            
            .create-btn, .edit-btn, .delete-btn {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<html><body>
    <?php require 'CoachNav.php'; ?>

    

    <div class="tcontainer">

    <div class="dashboard-header">
        <h1><i class="fas fa-calendar-alt"></i> Event Management Dashboard</h1>
        <p>Create, manage and track events for your students and teams</p>
    </div>
        
        <div class="form-section">
            <h2><i class="fas fa-plus-circle"></i> Create Event</h2>
            <form action="<?php echo URLROOT; ?>/coach/createEventRequest" method="post">
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" placeholder="Enter event name" required 
                    value="<?php echo isset($_POST['event_name']) ? $_POST['event_name'] : ''; ?>">
                <span class="error"><?php echo isset($data['event_name_err']) ? $data['event_name_err'] : ''; ?></span>

                <label for ="event_name">No of Players</label>
                <input type = "number"  id = "no_players" name = "no_players" placeholder= "Enter no of players participating" required min="1" max="50"
                <?php echo isset($_POST['no_players']) ? $_POST['no_players'] : ''; ?>>

                <label for="school_id">Venue (School):</label>
                <select id="school_id" name="school_id" required>
                    <option value="">Select School</option>
                    <?php foreach($data['schools'] as $school): ?>
                        <option value="<?php echo $school->school_id; ?>">
                            <?php echo $school->school_name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="event_date">Date:</label>
                <input type="date" id="event_date" name="event_date" required
                    value="<?php echo isset($_POST['event_date']) ? $_POST['event_date'] : ''; ?>">
                <span class="error"><?php echo isset($data['event_date_err']) ? $data['event_date_err'] : ''; ?></span>

                <label for="time_from">Time From:</label>
                <input type="time" id="time_from" name="time_from" required
                    value="<?php echo isset($_POST['time_from']) ? $_POST['time_from'] : ''; ?>">
                <span class="error"><?php echo isset($data['time_from_err']) ? $data['time_from_err'] : ''; ?></span>

                <label for="time_to">Time To:</label>
                <input type="time" id="time_to" name="time_to" required
                    value="<?php echo isset($_POST['time_to']) ? $_POST['time_to'] : ''; ?>">
                <span class="error"><?php echo isset($data['time_to_err']) ? $data['time_to_err'] : ''; ?></span>

                <label for="facilities_required">Facilities Required:</label>
                <textarea id="facilities_required" name="facilities_required" rows="4" 
                    placeholder="Enter required facilities"><?php echo isset($_POST['facilities_required']) ? $_POST['facilities_required'] : ''; ?></textarea>

                <button type="submit"><i class="fas fa-paper-plane"></i> Send Request</button>
            </form>
        </div>

        <div class="table-section">
            <div class="table-card">
                <h2><i class="fas fa-list-alt"></i> Event Requests</h2>
                <?php flash('event_message'); ?>
                <?php flash('event_error', 'error'); ?>
                
                <table>
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>No of Players</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Venue</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['eventRequests'])): ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">No event requests found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['eventRequests'] as $request): ?>
                                <tr>
                                    <td><?php echo $request->event_name; ?></td>
                                    <td><?php echo $request->no_players; ?></td>
                                    <td><?php echo date('M j, Y', strtotime($request->event_date)); ?></td>
                                    <td><?php echo date('g:i A', strtotime($request->time_from)) . ' - ' . date('g:i A', strtotime($request->time_to)); ?></td>
                                    <td><?php echo $request->school_name; ?></td>
                                    <td>
                                        <span class="status status-<?php echo strtolower($request->status); ?>">
                                            <?php echo ucfirst($request->status); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($request->status == 'approved'): ?>
                                            <form action="<?php echo URLROOT; ?>/coach/createScheduledEvent/<?php echo $request->request_id; ?>" method="post" style="display: inline;">
                                                <button type="submit" class="create-btn"><i class="fas fa-check"></i> Create</button>
                                            </form>
                                        <?php endif; ?>
                                        
                                
                                        
                                        <form action="<?php echo URLROOT; ?>/coach/deleteEventRequest/<?php echo $request->request_id; ?>" method="post" style="display: inline;">
                                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="table-card">
                <h2><i class="fas fa-calendar-check"></i> Scheduled Events</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Venue</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['scheduledEvents'])): ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">No scheduled events found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['scheduledEvents'] as $event): ?>
                                <tr>
                                    <td><?php echo $event->event_name; ?></td>
                                    <td><?php echo date('M j, Y', strtotime($event->event_date)); ?></td>
                                    <td><?php echo date('g:i A', strtotime($event->time_from)) . ' - ' . date('g:i A', strtotime($event->time_to)); ?></td>
                                    <td><?php echo $event->school_name; ?></td>
                                    <td>
                                        <form action="<?php echo URLROOT; ?>/coach/deleteScheduledEvent/<?php echo $event->event_id; ?>" method="post" style="display: inline;">
                                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
</body>
</html>