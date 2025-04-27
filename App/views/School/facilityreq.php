<?php
// Database connection
$host = "localhost";
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$database = "track_master";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die('<div class="alert alert-danger">Connection failed: ' . $conn->connect_error . '</div>');
}

$successMessage = "";
$errorMessage = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data
    $eventName = $_POST['event_name'];
    $coachName = $_POST['coach_name'];
    $eventDate = $_POST['event_date'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];
    
    // Format date and time
    $dateAndTime = $eventDate . " - " . $startTime . " - " . $endTime;
    
    // Insert data into database
    $sql = "INSERT INTO facilities_requests (event_name, coach_name, date_and_time, status) 
            VALUES (?, ?, ?, 'pending')";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $eventName, $coachName, $dateAndTime);
    
    if ($stmt->execute()) {
        $successMessage = "Facility request submitted successfully!";
    } else {
        $errorMessage = "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

// Get list of facilities for dropdown
$facilitiesQuery = "SELECT * FROM facilities ORDER BY name";
$facilitiesResult = $conn->query($facilitiesQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request School Facility</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #002a5c;
            color: white;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-submit {
            background-color: #ffa500;
            border-color: #ffa500;
            color: white;
            font-weight: bold;
        }
        .btn-submit:hover {
            background-color: #e69500;
            border-color: #e69500;
            color: white;
        }
    </style>
</head>
<body>

<?php require 'navbar.php'?>

    <div class="container-fluid">
        <div class="header">
            <h2>Request School Facility</h2>
        </div>

        <div class="form-container">
            <?php if ($successMessage): ?>
                <div class="alert alert-success"><?php echo $successMessage; ?></div>
            <?php endif; ?>
            
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="event_name" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="event_name" name="event_name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="coach_name" class="form-label">Coach/Requestor Name</label>
                        <input type="text" class="form-control" id="coach_name" name="coach_name" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="event_date" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="event_date" name="event_date" required>
                    </div>
                    <div class="col-md-4">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" required>
                    </div>
                    <div class="col-md-4">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="facility" class="form-label">Facility</label>
                    <select class="form-select" id="facility" name="facility" required>
                        <option value="" selected disabled>Select a facility</option>
                        <?php 
                        if ($facilitiesResult && $facilitiesResult->num_rows > 0) {
                            while ($facility = $facilitiesResult->fetch_assoc()) {
                                echo '<option value="' . $facility['id'] . '">' . htmlspecialchars($facility['name']) . '</option>';
                            }
                        } else {
                            echo '<option value="cricket">Cricket Ground</option>';
                            echo '<option value="football">Football Field</option>';
                            echo '<option value="basketball">Basketball Court</option>';
                            echo '<option value="swimming">Swimming Pool</option>';
                            echo '<option value="hall">Main Hall</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="purpose" class="form-label">Purpose of Request</label>
                    <textarea class="form-control" id="purpose" name="purpose" rows="3" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="participants" class="form-label">Number of Participants</label>
                    <input type="number" class="form-control" id="participants" name="participants" min="1" required>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="equipment" name="equipment">
                    <label class="form-check-label" for="equipment">Additional Equipment Required</label>
                </div>
                
                <div class="mb-3" id="equipment_details" style="display: none;">
                    <label for="equipment_list" class="form-label">Equipment Details</label>
                    <textarea class="form-control" id="equipment_list" name="equipment_list" rows="2"></textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-submit btn-lg">Submit Request</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show/hide equipment details based on checkbox
        document.getElementById('equipment').addEventListener('change', function() {
            document.getElementById('equipment_details').style.display = this.checked ? 'block' : 'none';
        });
    </script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>