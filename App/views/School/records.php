<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Performance Tracking | TrackMaster</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/navbar.css">
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

        /* Academic Container */
        .academic-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .academic-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .academic-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .academic-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Academic Records Table */
        .records-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .section-header {
            background: var(--primary-color);
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-header h2 {
            font-size: 1.4rem;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: rgba(0, 38, 77, 0.05);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            font-weight: 600;
            color: var(--primary-color);
        }

        th i, td i {
            margin-right: 8px;
            color: var(--secondary-color);
        }

        tr:hover {
            background-color: rgba(0, 38, 77, 0.02);
        }

        .action-btn {
            padding: 8px 12px;
            border-radius: var(--border-radius);
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-right: 5px;
            transition: var(--transition);
        }

        .edit-btn {
            background-color: rgba(0, 123, 255, 0.1);
            color: #0077cc;
        }

        .edit-btn:hover {
            background-color: #0077cc;
            color: white;
        }

        .delete-btn {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #dc3545;
            color: white;
        }

        /* Add Record Form */
        .add-record-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .formcontent {
            padding: 25px;
        }

        .formcontent ul {
            list-style: none;
        }

        .formcontent li {
            margin-bottom: 20px;
        }

        .formcontent label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-color);
            font-weight: 500;
        }

        .formcontent input,
        .formcontent select,
        .formcontent textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .formcontent input:focus,
        .formcontent select:focus,
        .formcontent textarea:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        .formcontent textarea {
            min-height: 120px;
            resize: vertical;
        }

        .formcontent button {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            margin-top: 10px;
        }

        .formcontent button:hover {
            background: #cc8400;
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 500px;
            z-index: 1001;
            display: none;
        }

        .modal.active {
            display: block;
        }

        .modal-content {
            padding: 25px;
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray-color);
            transition: var(--transition);
        }

        .close-modal:hover {
            color: var(--primary-color);
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
        }

        .modal-overlay.active {
            display: block;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .academic-header {
                padding: 20px 15px;
            }
            
            .academic-header h1 {
                font-size: 1.8rem;
            }
            
            .academic-header p {
                font-size: 1rem;
            }
            
            th, td {
                padding: 12px 10px;
            }
            
            .action-btn {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .academic-header h1 {
                font-size: 1.6rem;
            }
            
            th, td {
                padding: 10px 8px;
                font-size: 0.9rem;
            }
            
            .formcontent {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
    
    <div class="academic-container">
        <div class="academic-header">
            <h1><i class="fas fa-graduation-cap"></i> Academic Performance Center</h1>
            <p>Track, analyze, and improve student academic performance with detailed grade records</p>
        </div>

        <!-- Records Section -->
        <div class="records-section">
            <div class="section-header">
                <h2><i class="fas fa-list"></i> Student Records</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-user"></i> Name</th>
                        <th><i class="fas fa-graduation-cap"></i> Grade</th>
                        <th><i class="fas fa-calendar-alt"></i> Term</th>
                        <th><i class="fas fa-percentage"></i> Average</th>
                        <th><i class="fas fa-trophy"></i> Rank</th>
                        <th><i class="fas fa-sticky-note"></i> Notes</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <?php if (!empty($data['records'])): ?>
                        <?php foreach ($data['records'] as $record): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($record->firstname); ?></td>
                                <td class="editable"><?php echo htmlspecialchars($record->grade); ?></td>
                                <td class="editable"><?php echo htmlspecialchars($record->term); ?></td>
                                <td class="editable"><?php echo htmlspecialchars($record->average); ?></td>
                                <td class="editable"><?php echo htmlspecialchars($record->rank); ?></td>
                                <td class="editable"><?php echo htmlspecialchars($record->notes); ?></td>
                                <td>
                                    <button class="action-btn edit-btn" type="button" onclick="window.location.href='<?php echo URLROOT ?>/School/editRecord/<?php echo $record->player_id; ?>'">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn delete-btn" type="button" onclick="confirmDelete('<?php echo $record->player_id; ?>')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7">No records found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Add Record Form Section -->
        <div class="add-record-section">
            <div class="section-header">
                <h2><i class="fas fa-plus-circle"></i> Submit New Academic Record</h2>
            </div>
            <form class="formcontent" method="POST" action="<?php echo URLROOT; ?>/school/submitRecord">
                <ul>
                    <li>
                        <label for="studentName"><i class="fas fa-user"></i> Student Name:</label>
                        <select id="studentName" name="firstname">
                            <option value="" disabled selected>Please select a student</option>
                            <?php foreach ($data['players'] as $player): ?>
                                <option><?php echo htmlspecialchars($player->firstname); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li>
                        <label for="grade"><i class="fas fa-graduation-cap"></i> Grade:</label>
                        <input type="text" id="grade" name="grade" placeholder="Enter grade">
                    </li>
                    <li>
                        <label for="term"><i class="fas fa-calendar-alt"></i> Term:</label>
                        <input type="text" id="term" name="term" placeholder="Enter term">
                    </li>
                    <li>
                        <label for="average"><i class="fas fa-percentage"></i> Average:</label>
                        <input type="number" id="average" name="average" placeholder="Enter average">
                    </li>
                    <li>
                        <label for="rank"><i class="fas fa-trophy"></i> Rank:</label>
                        <input type="number" id="rank" name="rank" placeholder="Enter rank">
                    </li>
                    <li>
                        <label for="notes"><i class="fas fa-sticky-note"></i> Additional Notes:</label>
                        <textarea id="notes" name="notes" placeholder="Enter any additional information about the student's performance"></textarea>
                    </li>
                </ul>
                <center>
                    <button type="submit"><i class="fas fa-paper-plane"></i> Submit Record</button>
                </center>
            </form>
        </div>
    </div>

    <!-- Confirmation Dialog Modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('confirmModal')">&times;</span>
            <h3><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h3>
            <p>Are you sure you want to delete this record? This action cannot be undone.</p>
            <div style="margin-top: 20px; text-align: right;">
                <button class="action-btn edit-btn" onclick="closeModal('confirmModal')">Cancel</button>
                <button class="action-btn delete-btn" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
    <div class="modal-overlay" id="modalOverlay"></div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        // Function to handle modal closing
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.getElementById('modalOverlay').classList.remove('active');
        }

        // Function to show confirmation dialog
        function confirmDelete(playerId) {
            document.getElementById('confirmModal').classList.add('active');
            document.getElementById('modalOverlay').classList.add('active');
            
            // Set up the confirm button action
            document.getElementById('confirmDeleteBtn').onclick = function() {
                window.location.href = '<?php echo URLROOT; ?>/School/deleteRecord/' + playerId;
            };
        }

        // Add event listeners for table row hover effects
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('#studentTableBody tr');
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