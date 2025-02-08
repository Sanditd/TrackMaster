<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="../../Public/css/Admin/form.css"> -->
    <link rel="stylesheet" href="../../Public/css/Admin/navbar.css">
    <link rel="stylesheet" href="../../Public/css/Admin/zoneManage.css">
    <script src="../../Public/js/Admin/sidebar.js"></script>

    <!-- FullCalendar CSS and JS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script> -->
</head>

<body>
    <div class="adminNav">
        <?php require_once 'adminNav.php'?>
    </div>

    <div id="frame" style="margin-top: 100px; margin-left:100px">
        <div class="container">

            <div class="temp-container">
                <div id="signup-port">

                    <div class="temp2-container">
                        <div class="column">
                            <h3>Add New Sport</h3>
                            <br>
                            <div class="form-group">
                                <label for="sportName">Sport Name</label>
                                <input type="text" id="sportName" name="sportName" placeholder="Cricket">
                            </div>

                            <div class="form-group">
                                <label for="numOfPlayers">Number of Players</label>
                                <input type="text" id="numOfPlayers" name="numOfPlayers" placeholder="11">
                            </div>

                            <div class="form-group">
                                <div id="dynamic-positions-container">
                                    <div class="input-group">
                                        <label for="positions">Player Position (Click ➕ to add more positions)</label>
                                        <input type="text" id="positions" name="positions[]" placeholder="Batsman">
                                        <button class="add-btn" onclick="addPositionField(this)">➕</button>

                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div id="dynamic-types-container">
                                    <div class="input-group">
                                        <label for="types">Player Types (Click ➕ to add more types)</label>
                                        <input type="text" id="types-1" name="types[]" placeholder="Left Hand Batsman">
                                        <button class="add-btn" onclick="addTypeField(this)">➕</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
    <label for="duration">Game Types and Durations</label>
    <div class="input-row">
        <input type="text" id="Gtypes-1" name="Gtypes[]" placeholder="Enter game type name">
        <select name="durationType" id="duration-type">
            <option value="T">Time Based</option>
            <option value="O">Over Based</option>
            <option value="S">Score Based</option>
        </select>
        <input type="text" name="duration" id="duration" placeholder="Enter duration">
    </div>
</div>


                        </div>

                        <div class="column">



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Custom Alert Box -->
    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>


</body>

<script>
// Show the alert box
function showCustomAlert(message) {
    document.getElementById('customAlertMessage').innerText = message;
    document.getElementById('customAlertOverlay').style.display = 'flex';
}

// Hide the alert box
function hideCustomAlert() {
    document.getElementById('customAlertOverlay').style.display = 'none';
}

// Check for error or success message from PHP and display the alert
<?php if (!empty($data['errormsg']) || isset($_GET['error']) || isset($_GET['success'])): ?>
const alertMessage =
    <?php 
    echo json_encode(
        !empty($data['errormsg']) 
            ? $data['errormsg'] 
            : (!empty($_GET['error']) 
                ? htmlspecialchars($_GET['error']) 
                : htmlspecialchars($_GET['success']))
    ); 
    ?>;
showCustomAlert(alertMessage);
<?php endif; ?>

let positionFieldCount = 1; // Counter for position fields
let typeFieldCount = 1; // Counter for type fields

// Function to add a new position field
function addPositionField(element) {
    positionFieldCount++;
    const container = document.getElementById('dynamic-positions-container');

    const newField = document.createElement('div');
    newField.className = 'input-group';
    newField.innerHTML = `
        <input type="text" id="positions-${positionFieldCount}" name="positions[]" placeholder="Position ${positionFieldCount}">
        <button class="add-btn" onclick="addPositionField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `;

    // Insert the new field after the current field
    container.insertBefore(newField, element.parentElement.nextSibling);

    // Remove the "Add" button from the current field
    element.remove();
}

// Function to add a new type field
function addTypeField(element) {
    typeFieldCount++;
    const container = document.getElementById('dynamic-types-container');

    const newField = document.createElement('div');
    newField.className = 'input-group';
    newField.innerHTML = `
        <input type="text" id="types-${typeFieldCount}" name="types[]" placeholder="Type ${typeFieldCount}">
        <button class="add-btn" onclick="addTypeField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `;

    // Insert the new field after the current field
    container.insertBefore(newField, element.parentElement.nextSibling);

    // Remove the "Add" button from the current field
    element.remove();
}

// Function to remove an input field
function removeField(element) {
    const container = element.closest('.form-group').querySelector('div[id$="-container"]');

    // Remove the current field
    element.parentElement.remove();

    // Ensure the last field in this container has an "Add" button
    const inputGroups = container.getElementsByClassName('input-group');
    if (inputGroups.length > 0) {
        const lastField = inputGroups[inputGroups.length - 1];
        if (!lastField.querySelector('.add-btn')) {
            const addButton = document.createElement('button');
            addButton.className = 'add-btn';
            addButton.textContent = '➕';
            addButton.setAttribute('onclick', container.id.includes('positions') ? 'addPositionField(this)' :
                'addTypeField(this)');
            lastField.appendChild(addButton);
        }
    } else {
        alert("You must have at least one field in this section!");
    }
}
</script>

</html>