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

        /* Main Content Grid */
        .main-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
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

        /* Status Section */
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 15px;
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

        /* Sports Section */
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

        /* Buttons */
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

        /* Achievement Section */
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
    animation: rot 3s  infinite;
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
    0% {
      transform: rotate(0deg);
    }
  
    50% {
      transform: rotate(340deg);
    }
  
    100% {
      transform: rotate(0deg);
    }
  }
  
  @keyframes grow {
    0% {
      transform: rotate(0deg);
    }
  
    25% {
      transform: rotate(-5deg);
    }
  
    75% {
      transform: rotate(5deg);
    }
  
    100% {
      transform: scale(1) rotate(0deg);
    }
  }

        /* Medical Status */
        .dashboard-section p strong {
            color: var(--primary-color);
            font-weight: 600;
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

        /* Responsive Design */
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
        <div class="dashboard-header">
            <h1><i class="fas fa-user-graduate"></i> Student Dashboard</h1>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?> - Track your sports activities, achievements, and performance</p>
        </div>

        <div class="main-content">
            <!-- Status Section -->
            <div class="dashboard-section">

            
            
<div class="dashboard-section">
    <h2>Current Training Status</h2>
    <?php if (isset($data['status']) && $data['status']): ?>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($data['status']->status); ?></p>
        <p><strong>Last Updated:</strong> <?php echo htmlspecialchars($data['status']->last_updated); ?></p>
    <?php else: ?>
        <p><strong>Status:</strong> Not Available</p>
    <?php endif; ?>
</div>



<!-- 
<?php if (isset($_SESSION['username'])): ?>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
<?php else: ?>
    <p>Welcome, Guest!</p>
<?php endif; ?> -->



















                <h2>Current Status</h2>
                <p><i class="fas fa-info-circle"></i> Update your current training status</p>
                <div class="radio-group">
                    <input class="radio-input" name="radio-group" id="radio1" type="radio" checked>
                    <label class="radio-label" for="radio1">
                    <span class="radio-inner-circle"></span>
                    <i class="fas fa-running"></i> Practicing
                    </label>
                    
                    <input class="radio-input" name="radio-group" id="radio2" type="radio">
                    <label class="radio-label" for="radio2">
                    <span class="radio-inner-circle"></span>
                    <i class="fas fa-trophy"></i> In a Meet
                    </label>
                    
                    <input class="radio-input" name="radio-group" id="radio3" type="radio">
                    <label class="radio-label" for="radio3">
                    <span class="radio-inner-circle"></span>
                    <i class="fas fa-bed"></i> At Rest
                    </label>

                    <input class="radio-input" name="radio-group" id="radio4" type="radio">
                    <label class="radio-label" for="radio4">
                    <span class="radio-inner-circle"></span>
                    <i class="fas fa-medkit"></i> Injured
                    </label>
                </div>
            </div>

            <!-- Sports Section -->
            <div class="dashboard-section">
                <h2>Registered Sports</h2>
                <div class="section-content">
                    <div class="sports">
                        <h3><i class="fas fa-cricket"></i> Cricket</h3>
                        <button class="btn" onclick="window.location.href='<?php echo ROOT ?>/Student/coachProfile'">
                            <i class="fas fa-user-tie"></i> View My Coach
                        </button>
                        <button class="btn" onclick="window.location.href='<?php echo ROOT ?>/Student/PlayerPerformance'">
                            <i class="fas fa-chart-line"></i> Track My Performance
                        </button>
                    </div>
                    <div class="sports">
                        <h3><i class="fas fa-running"></i> Athletics</h3>
                        <button class="btn" onclick="window.location.href='<?php echo ROOT ?>/Student/coachProfile'">
                            <i class="fas fa-user-tie"></i> View My Coach
                        </button>
                        <button class="btn" onclick="window.location.href='<?php echo ROOT ?>/Student/PlayerPerformance'">
                            <i class="fas fa-chart-line"></i> Track My Performance
                        </button>
                    </div>
                </div>
            </div>

            <!-- Achievement Section -->
            <div class="dashboard-section">
                <h2>My Achievements</h2>
                <br>
                <br>
                <div class="container">
                <svg class="svg-icon" height="100" preserveAspectRatio="xMidYMid meet" viewBox="0 0 100 100" width="100" x="0" xmlns="http://www.w3.org/2000/svg" y="0">
                    <path d="M62.11,53.93c22.582-3.125,22.304-23.471,18.152-29.929-4.166-6.444-10.36-2.153-10.36-2.153v-4.166H30.099v4.166s-6.194-4.291-10.36,2.153c-4.152,6.458-4.43,26.804,18.152,29.929l5.236,7.777v8.249s-.944,4.597-4.833,4.986c-3.903,.389-7.791,4.028-7.791,7.374h38.997c0-3.347-3.889-6.986-7.791-7.374-3.889-.389-4.833-4.986-4.833-4.986v-8.249l5.236-7.777Zm7.388-24.818s2.833-3.097,5.111-1.347c2.292,1.75,2.292,15.86-8.999,18.138l3.889-16.791Zm-44.108-1.347c2.278-1.75,5.111,1.347,5.111,1.347l3.889,16.791c-11.291-2.278-11.291-16.388-8.999-18.138Z">
                    </path>
                </svg>  
                <div class="container__star">
                    
                    <div class="star-eight"></div>
                </div>
  
            <div></div>
            </div>
            <br>
            <br>
            <br>
            <br>

                <center><div class="action-buttons">
                    <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/studentAchievements'">
                        <i class="fas fa-medal"></i> View My Achievements
                    </button>
                </div></center>
            </div>

            <!-- Medical Section -->
            <div class="dashboard-section">
                <h2>Current Medical Status</h2>
                <?php if(isset($data['currentStatus']) && $data['currentStatus']): ?>
                    <p><strong><i class="fas fa-calendar-check"></i> Last updated:</strong> <?php echo htmlspecialchars($data['currentStatus']->date); ?></p>
                    <p><strong><i class="fas fa-heartbeat"></i> Medical Conditions:</strong> <?php echo htmlspecialchars($data['currentStatus']->medical_condition); ?></p>
                    <p><strong><i class="fas fa-pills"></i> Medication:</strong> <?php echo htmlspecialchars($data['currentStatus']->medication); ?></p>
                    <p><strong><i class="fas fa-clipboard"></i> Notes:</strong> <?php echo htmlspecialchars($data['currentStatus']->notes); ?></p>
                <?php else: ?>
                    <p><strong><i class="fas fa-calendar-check"></i> Last updated:</strong> N/A</p>
                    <p><strong><i class="fas fa-heartbeat"></i> Medical Conditions:</strong> None</p>
                    <p><strong><i class="fas fa-pills"></i> Medication:</strong> None</p>
                    <p><strong><i class="fas fa-clipboard"></i> Notes:</strong> None</p>
                <?php endif; ?>
                <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/medicalStatus'">
                    <i class="fas fa-first-aid"></i> Update Medical Status
                </button>
            </div>

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
                </div>
                <p><i class="fas fa-info-circle"></i> Click on any date to add or view notes</p>
            </div>

            <!-- Financial Section -->
            <div class="dashboard-section">
                <h2>Financial Status</h2>
                <div class="section-content">
                    <p><strong><i class="fas fa-money-check-alt"></i> Financial Aid Status:</strong> Receive Funds</p>
                    <button class="btn" onclick="window.location.href='<?php echo URLROOT ?>/Student/financialStatus'">
                        <i class="fas fa-wallet"></i> Update Financial Status
                    </button> 
                </div>
            </div>
        </div>
    </div>

    <?php require 'footer.php'?>

    <script src="/TrackMaster/Public/js/Student/carousel.js"></script>
    <script src="/TrackMaster/Public/js/Student/calender.js"></script>
</body>
</html>