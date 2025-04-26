<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History | TrackMaster</title>
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

        /* Header Section */
        .medical-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .medical-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .medical-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Main Container */
        .medical-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Medical Content Grid */
        .medical-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        /* Medical Section Cards */
        .medical-section {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border: 1px solid rgba(0, 38, 77, 0.1);
            padding: 25px;
            margin-bottom: 25px;
        }

        .medical-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 38, 77, 0.15);
        }

        .medical-section h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.4rem;
            position: relative;
            padding-bottom: 10px;
        }

        .medical-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .medical-section p {
            color: var(--gray-color);
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .medical-section p strong {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Rating System */
        .feeling-section {
            text-align: center;
            margin-bottom: 15px;
        }

        .feeling-section h3 {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            font-style: italic;
        }

        .rating {
            display: flex;
            flex-direction: row-reverse;
            gap: 0.5rem;
            justify-content: center;
            margin: 20px 0;
        }

        .rating input {
            display: none;
        }

        .rating label {
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .rating label:hover {
            transform: scale(1.1);
        }

        .rating label svg {
            width: 35px;
            height: 35px;
            transition: all 0.3s ease;
        }

        .rating label .svgOne {
            stroke: var(--gray-color);
            fill: transparent;
        }

        .rating label .svgTwo {
            position: absolute;
            top: 0;
            left: 0;
            fill: var(--secondary-color);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .rating input:checked ~ label .svgOne {
            stroke: transparent;
        }

        .rating input:checked ~ label .svgTwo {
            opacity: 1;
            animation: bounce 0.5s ease;
        }

        .rating label:hover .svgOne,
        .rating label:hover ~ label .svgOne {
            stroke: var(--secondary-color);
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        /* Table Styles */
        .medical-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }

        .medical-table th,
        .medical-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .medical-table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        .medical-table tbody tr:nth-child(even) {
            background-color: rgba(0, 38, 77, 0.03);
        }

        .medical-table tbody tr:hover {
            background-color: rgba(255, 165, 0, 0.05);
        }

        /* Button Styles */
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
            gap: 8px;
            transition: var(--transition);
            margin-top: 15px;
        }

        .btn:hover {
            background: #cc8400;
            transform: translateY(-2px);
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 25px;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 500px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            color: var(--gray-color);
            cursor: pointer;
            transition: var(--transition);
        }

        .close:hover {
            color: var(--primary-color);
        }

        .blur {
            filter: blur(4px);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 2px rgba(255, 165, 0, 0.1);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        /* Error message styles */
        .invalid-feedback {
            display: block;
            color: #dc3545;
            margin-top: 5px;
            font-size: 0.9rem;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        /* Flash message styles */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .medical-content {
                grid-template-columns: 1fr;
            }
            
            .medical-header h1 {
                font-size: 1.8rem;
            }
            
            .modal-content {
                width: 95%;
                padding: 20px;
            }
            
            .medical-section {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .medical-header h1 {
                font-size: 1.6rem;
            }
            
            .medical-section h2 {
                font-size: 1.2rem;
            }
            
            .feeling-section h3 {
                font-size: 1.1rem;
            }
            
            .rating {
                gap: 0.3rem;
            }
            
            .rating label svg {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'?>
    <?php require 'sidebar.php'?>
    
    <div class="medical-container">
        <div class="medical-header">
            <h1><i class="fas fa-heartbeat"></i> Medical History</h1>
            <p>Monitor and update your health information for optimal performance</p>
        </div>

        <?php flash('medical_message'); ?>

        <div class="medical-content">
            <!-- Current Status Section -->
            <div class="medical-section">
                <h2>Current Medical Status</h2>
                <div class="feeling-section">
                    <h3>How Are You Feeling Today...?</h3>
                    <div class="rating">
                        <input value="5" name="rating" id="star5" type="radio" />
                        <label title="5 stars" for="star5">
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgOne">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgTwo">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </label>

                        <input value="4" name="rating" id="star4" type="radio" />
                        <label title="4 stars" for="star4">
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgOne">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgTwo">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </label>

                        <input value="3" name="rating" id="star3" type="radio" checked />
                        <label title="3 stars" for="star3">
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgOne">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgTwo">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </label>

                        <input value="2" name="rating" id="star2" type="radio" />
                        <label title="2 stars" for="star2">
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgOne">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgTwo">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </label>

                        <input value="1" name="rating" id="star1" type="radio" />
                        <label title="1 star" for="star1">
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgOne">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#000000" fill="none" viewBox="0 0 24 24" height="35" width="35" xmlns="http://www.w3.org/2000/svg" class="svgTwo">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </label>
                    </div>
                </div>
                
                <?php if(isset($data['currentStatus']) && $data['currentStatus']): ?>
                    <p><strong><i class="fas fa-calendar-check"></i> Last updated:</strong> <?php echo date('d/m/Y', strtotime($data['currentStatus']->date)); ?></p>
                    <p><strong><i class="fas fa-heartbeat"></i> Medical Conditions:</strong> <?php echo htmlspecialchars($data['currentStatus']->medical_condition); ?></p>
                    <p><strong><i class="fas fa-pills"></i> Medication:</strong> <?php echo htmlspecialchars($data['currentStatus']->medication); ?></p>
                    <p><strong><i class="fas fa-clipboard"></i> Notes:</strong> <?php echo htmlspecialchars($data['currentStatus']->notes); ?></p>
                <?php else: ?>
                    <p><strong><i class="fas fa-calendar-check"></i> Last updated:</strong> Not Updated Yet</p>
                    <p><strong><i class="fas fa-heartbeat"></i> Medical Conditions:</strong> Not Updated Yet</p>
                    <p><strong><i class="fas fa-pills"></i> Medication:</strong> Not Updated Yet</p>
                    <p><strong><i class="fas fa-clipboard"></i> Notes:</strong>Not Updated Yet</p>
                <?php endif; ?>
                
                <button id="openModal" class="btn">
                    <i class="fas fa-plus-circle"></i> Add New Record
                </button>
            </div>

            <!-- Things to Consider Section -->
                <div class="medical-section">
                    <h2>Important Health Information</h2>
                    <?php if(isset($data['thingsToConsider']) && $data['thingsToConsider']): ?>
                        <p><strong><i class="fas fa-tint"></i> Blood Type:</strong> <?php echo htmlspecialchars($data['thingsToConsider']->blood_type ?? 'Not Updated Yet'); ?></p>
                        <p><strong><i class="fas fa-exclamation-triangle"></i> Allergies:</strong> <?php echo htmlspecialchars($data['thingsToConsider']->allergies ?? 'Not Updated Yet'); ?></p>
                        <p><strong><i class="fas fa-info-circle"></i> Special Notes:</strong> <?php echo htmlspecialchars($data['thingsToConsider']->special_notes ?? 'Not Updated Yet'); ?></p>
                        <p><strong><i class="fas fa-phone"></i> Emergency Contact:</strong> <?php echo htmlspecialchars($data['thingsToConsider']->emergency_contact ?? 'Not Updated Yet'); ?></p>
                    <?php else: ?>
                    <p><strong><i class="fas fa-tint"></i> Blood Type:</strong> Not Updated Yet</p>
                    <p><strong><i class="fas fa-exclamation-triangle"></i> Allergies:</strong> Not Updated Yet</p>
                    <p><strong><i class="fas fa-info-circle"></i> Special Notes:</strong> Not Updated Yet</p>
                    <p><strong><i class="fas fa-phone"></i> Emergency Contact:</strong> Not Updated Yet</p>
                <?php endif; ?>
                
                <button id="openThingsModal" class="btn">
                    <i class="fas fa-edit"></i> Edit Information
                </button>
            </div>
        </div>

        <!-- Medical History Table Section -->
        <div class="medical-section">
            <h2>Medical History Records</h2>
            <table class="medical-table">
                <thead>
                    <tr>
                        <th>Date Updated</th>
                        <th>Medical Condition</th>
                        <th>Medication</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($data['medicalHistory']) && !empty($data['medicalHistory'])): ?>
                        <?php foreach($data['medicalHistory'] as $record): ?>
                            <tr>
                                <td><?php echo date('d/m/Y', strtotime($record->date)); ?></td>
                                <td><?php echo htmlspecialchars($record->medical_condition); ?></td>
                                <td><?php echo htmlspecialchars($record->medication); ?></td>
                                <td><?php echo htmlspecialchars($record->notes); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No medical history available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Medical Record Modal -->
    <div id="medicalModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeMedical">&times;</span>
            <h2>Add a New Medical Record</h2>
            <form action="<?php echo URLROOT; ?>/medicalStatus/saveMedicalStatus" method="POST">
                <div class="form-group">
                    <label for="date"><i class="fas fa-calendar"></i> Date:</label>
                    <input type="date" id="date" name="date" class="form-control <?php echo isset($data['errors']['date']) ? 'is-invalid' : ''; ?>" value="<?php echo date('Y-m-d'); ?>" required>
                    <?php if(isset($data['errors']['date'])): ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['date']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="condition"><i class="fas fa-heartbeat"></i> Medical Condition:</label>
                    <input type="text" id="condition" name="condition" class="form-control <?php echo isset($data['errors']['condition']) ? 'is-invalid' : ''; ?>" placeholder="Enter any ongoing medical conditions" required>
                    <?php if(isset($data['errors']['condition'])): ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['condition']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="medication"><i class="fas fa-pills"></i> Medication:</label>
                    <textarea id="medication" name="medication" class="form-control <?php echo isset($data['errors']['medication']) ? 'is-invalid' : ''; ?>" placeholder="List any medications you're currently taking"></textarea>
                    <?php if(isset($data['errors']['medication'])): ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['medication']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="notes"><i class="fas fa-sticky-note"></i> Notes:</label>
                    <textarea id="notes" name="notes" class="form-control <?php echo isset($data['errors']['notes']) ? 'is-invalid' : ''; ?>" placeholder="Add any additional notes or concerns"></textarea>
                    <?php if(isset($data['errors']['notes'])): ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['notes']; ?></span>
                    <?php endif; ?>
                </div>

                <center>
                    <p>
                    **You cannot Delete or Edit these Records Once Submitted.
                    </p>
                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i> Save Record
                    </button>
                </center>
            </form>
        </div>
    </div>

    <!-- Edit Health Information Modal -->
    <div id="thingsModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeThings">&times;</span>
            <h2>Edit Health Information</h2>
            <form action="<?php echo URLROOT; ?>/Student/saveThingsToConsider" method="POST">
                <div class="form-group">
                    <label for="bloodType"><i class="fas fa-tint"></i> Blood Type:</label>
                    <input type="text" id="bloodType" name="bloodType" class="form-control <?php echo isset($data['errors']['blood_type']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($data['thingsToConsider']) && $data['thingsToConsider']->blood_type ? htmlspecialchars($data['thingsToConsider']->blood_type) : ''; ?>" required>
                    <?php if(isset($data['errors']['blood_type'])): ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['blood_type']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="allergies"><i class="fas fa-exclamation-triangle"></i> Allergies:</label>
                    <textarea id="allergies" name="allergies" class="form-control <?php echo isset($data['errors']['allergies']) ? 'is-invalid' : ''; ?>" placeholder="List any allergies you have"><?php echo isset($data['thingsToConsider']) && $data['thingsToConsider']->allergies ? htmlspecialchars($data['thingsToConsider']->allergies) : ''; ?></textarea>
                    <?php if(isset($data['errors']['allergies'])): ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['allergies']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="specialNotes"><i class="fas fa-info-circle"></i> Special Notes:</label>
                    <textarea id="specialNotes" name="specialNotes" class="form-control <?php echo isset($data['errors']['special_notes']) ? 'is-invalid' : ''; ?>" placeholder="Add any important health information"><?php echo isset($data['thingsToConsider']) && $data['thingsToConsider']->special_notes ? htmlspecialchars($data['thingsToConsider']->special_notes) : ''; ?></textarea>
                    <?php if(isset($data['errors']['special_notes'])): ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['special_notes']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="emergencyContact"><i class="fas fa-phone"></i> Emergency Contact:</label>
                    <input type="text" id="emergencyContact" name="emergencyContact" class="form-control <?php echo isset($data['errors']['emergency_contact']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($data['thingsToConsider']) && $data['thingsToConsider']->emergency_contact ? htmlspecialchars($data['thingsToConsider']->emergency_contact) : ''; ?>" required>
                    <?php if(isset($data['errors']['emergency_contact'])): ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['emergency_contact']; ?></span>
                    <?php endif; ?>
                </div>

                <center>
                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </center>
            </form>
        </div>
    </div>

    <?php require 'footer.php'?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Medical Record Modal
            const medicalModal = document.getElementById("medicalModal");
            const openModalButton = document.getElementById("openModal");
            const closeMedicalButton = document.getElementById("closeMedical");
            const mainContent = document.querySelector(".medical-container");

            openModalButton.addEventListener("click", function() {
                medicalModal.style.display = "flex";
                mainContent.classList.add("blur");
            });

            closeMedicalButton.addEventListener("click", function() {
                medicalModal.style.display = "none";
                mainContent.classList.remove("blur");
            });

            // Things to Consider Modal
            const thingsModal = document.getElementById("thingsModal");
            const openThingsModalButton = document.getElementById("openThingsModal");
            const closeThingsButton = document.getElementById("closeThings");

            openThingsModalButton.addEventListener("click", function() {
                thingsModal.style.display = "flex";
                mainContent.classList.add("blur");
            });

            closeThingsButton.addEventListener("click", function() {
                thingsModal.style.display = "none";
                mainContent.classList.remove("blur");
            });

            // Close modals when clicking outside
            window.addEventListener("click", function(event) {
                if (event.target === medicalModal) {
                    medicalModal.style.display = "none";
                    mainContent.classList.remove("blur");
                }
                if (event.target === thingsModal) {
                    thingsModal.style.display = "none";
                    mainContent.classList.remove("blur");
                }
            });
            
            // Save rating selection
            const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');
            ratingInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // You can add AJAX code here to save the rating
                    const selectedRating = this.value;
                    console.log("Selected rating: " + selectedRating);
                    
                    // Example AJAX call (uncomment and customize as needed)
                    /*
                    fetch('<?php echo URLROOT; ?>/medicalStatus/saveRating', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            rating: selectedRating,
                            user_id: <?php echo isset($data['user_id']) ? $data['user_id'] : 1; ?>
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Rating saved:', data);
                    })
                    .catch((error) => {
                        console.error('Error saving rating:', error);
                    });
                    */
                });
            });
        });
    </script>
</body>
</html>