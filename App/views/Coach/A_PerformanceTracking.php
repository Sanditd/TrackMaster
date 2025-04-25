<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Performance Tracking | TrackMaster</title>
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

        /* Performance Container */
        .performance-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header Section */
        .performance-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .performance-header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .performance-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Performance Grid */
        .performance-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        /* Performance Cards */
        .performance-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid rgba(0, 38, 77, 0.1);
        }

        .performance-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 38, 77, 0.15);
        }

        .card-icon {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-color);
            color: var(--primary-color);
            font-size: 3rem;
            padding: 20px;
        }

        .card-content {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-content h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.4rem;
            position: relative;
            padding-bottom: 10px;
        }

        .card-content h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }

        .card-content p {
            color: var(--gray-color);
            margin-bottom: 20px;
            line-height: 1.5;
            flex-grow: 1;
        }

        .card-footer {
            margin-top: auto;
            text-align: right;
        }

        .card-footer span {
            color: var(--secondary-color);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .performance-card:hover .card-footer span {
            color: #cc8400;
            transform: translateX(5px);
        }

        /* Card Color Variants */
        .team-card .card-icon {
            background: rgba(0, 38, 77, 0.1);
        }

        .player-card .card-icon {
            background: rgba(255, 165, 0, 0.1);
        }

        .update-team-card .card-icon {
            background: rgba(0, 128, 0, 0.1);
            color: #006400;
        }

        .update-player-card .card-icon {
            background: rgba(75, 0, 130, 0.1);
            color: #4b0082;
        }

        /* Modal Styles */
        .performance-modal {
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

        .performance-modal.active {
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

        .modal-content h3 {
            color: var(--primary-color);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.3rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-color);
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
        }

        .search-btn, .submit-btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            width: 100%;
            justify-content: center;
        }

        .search-btn:hover, .submit-btn:hover {
            background: #cc8400;
        }

        .search-results {
            margin-top: 20px;
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #eee;
            border-radius: var(--border-radius);
        }

        .player-result {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            transition: var(--transition);
        }

        .player-result:last-child {
            border-bottom: none;
        }

        .player-result:hover {
            background: var(--light-color);
        }

        .player-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .player-info h4 {
            margin: 0;
            color: var(--primary-color);
            font-size: 1rem;
        }

        .player-info p {
            margin: 3px 0 0;
            font-size: 0.85rem;
            color: var(--gray-color);
        }

        .select-btn {
            background: transparent;
            border: 1px solid var(--secondary-color);
            color: var(--secondary-color);
            padding: 6px 12px;
            border-radius: var(--border-radius);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .select-btn:hover {
            background: var(--secondary-color);
            color: white;
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
            .performance-header {
                padding: 20px 15px;
            }
            
            .performance-header h1 {
                font-size: 1.8rem;
            }
            
            .performance-header p {
                font-size: 1rem;
            }
            
            .performance-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .card-icon {
                height: 100px;
                font-size: 2.5rem;
            }
            
            .card-content {
                padding: 20px;
            }
            
            .modal-content {
                padding: 20px 15px;
            }
        }

        @media (max-width: 480px) {
            .performance-header h1 {
                font-size: 1.6rem;
            }
            
            .card-content h2 {
                font-size: 1.2rem;
            }
            
            .card-content p {
                font-size: 0.95rem;
            }

            .form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    font-size: 1rem;
    transition: var(--transition);
    margin-bottom: 15px;
}

.form-control:focus {
    border-color: var(--secondary-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
}
        }
    </style>
</head>
<body>
    <?php require 'CoachNav.php'; ?>

    <div class="performance-container">
        <div class="performance-header">
            <h1><i class="fas fa-chart-line"></i> Cricket Performance Center</h1>
            <p>Track, analyze, and improve individual and team cricket performances with detailed statistics</p>
        </div>


            <!-- Player Performance Section -->
            <div class="performance-card player-card" onclick="showPlayerSelectModal()">
                <div class="card-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-content">
                    <h2>Player Performance</h2>
                    <p>Analyze individual player statistics, track progress over time, and identify areas for improvement.</p>
                    <div class="card-footer">
                        <span>Player Analytics <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
            </div>

            <!-- Update Team Performance -->

            <!-- Update Player Performance -->
            
        </div>
    </div>


    <div id="playerSelectModal" class="performance-modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('playerSelectModal')">&times;</span>
        <h3><i class="fas fa-users"></i> Select Player</h3>
        <form id="playerSelectForm">
            <div class="form-group">
                <label for="playerDropdown">Choose Player:</label>
                <select id="playerDropdown" class="form-control" required>
                    <option value="">-- Select a Player --</option>
                    <!-- Options will be populated by JavaScript -->
                </select>
            </div>
            <button type="submit" class="submit-btn">
                <i class="fas fa-chart-line"></i> View Performance
            </button>
        </form>
    </div>
</div>



    <div class="modal-overlay" id="modalOverlay"></div>

    <?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>
    
    <script>
        // Enhanced JavaScript for modals and interactions
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.getElementById('modalOverlay').classList.remove('active'); 
        }

        function showPlayerSelectModal() {
            // Show loading state
            document.getElementById('playerDropdown').innerHTML = '<option value="">Loading players...</option>';
            
            // Show modal
            document.getElementById('playerSelectModal').classList.add('active');
            document.getElementById('modalOverlay').classList.add('active');
            
            // Fetch players via AJAX
            fetchPlayersForCoach();
        }

        function fetchPlayersForCoach() {
    fetch('<?php echo ROOT; ?>/coach/getPlayersForCoach')
        .then(response => response.json())
        .then(data => {
            console.log('Received data:', data); // Add this line
            const dropdown = document.getElementById('playerDropdown');
            dropdown.innerHTML = '<option value="">-- Select a Player --</option>';
            
            if (data.players && data.players.length > 0) {
                console.log('Players array:', data.players); // Check the array
                data.players.forEach(player => {
                    console.log('Player object:', player); // Check each player
                    const option = document.createElement('option');
                    option.value = player.player_id;
                    option.textContent = player.player_name || 'Unnamed Player'; // Fallback text
                    dropdown.appendChild(option);
                });
            } else {
                dropdown.innerHTML = '<option value="">No players found</option>';
            }
        })
        .catch(error => {
            console.error('Error fetching players:', error);
            document.getElementById('playerDropdown').innerHTML = '<option value="">Error loading players</option>';
        });
}

        // Handle form submission
        document.getElementById('playerSelectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const playerId = document.getElementById('playerDropdown').value;
            if (playerId) {
                window.location.href = `<?php echo ROOT; ?>/coach/playerperformance/${playerId}`;
            }
        });

        document.querySelector('.team-card').onclick = function(e) {
        e.preventDefault();
        showTeamSelectModal();
    };

    // (Keep all your existing JavaScript functions)
    </script>
</body>
</html>