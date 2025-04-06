document.addEventListener("DOMContentLoaded", function () {
    var errorMessage = document.getElementById('error-message') ? JSON.parse(document.getElementById('error-message').textContent) : "";
    var successMessage = document.getElementById('success-message') ? JSON.parse(document.getElementById('success-message').textContent) : "";
    
    if (errorMessage.length > 0) {
        showCustomAlert(errorMessage);
    }

    if (successMessage.length > 0) {
        showCustomAlert(successMessage, "success");
    }

    document.getElementById("teamSportForm").addEventListener("submit", function (event) {
        event.preventDefault();
        let formData = new FormData(this);

        for (let pair of formData.entries()) {
            console.log(pair[0] + ": " + pair[1]);
        }

        fetch("../../admin/addTeamSport", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response from server:", data);
        })
        .catch(error => console.error("Error:", error));
    });
});

function showCustomAlert(message) {
    document.getElementById('customAlertMessage').innerText = message;
    document.getElementById('customAlertOverlay').style.display = 'flex';
}

function hideCustomAlert() {
    document.getElementById('customAlertOverlay').style.display = 'none';
}

function addDynamicField(containerId, fieldHtml) {
    const container = document.getElementById(containerId);
    const newField = document.createElement('div');
    newField.className = 'input-group';
    newField.innerHTML = fieldHtml;
    container.appendChild(newField);
}

function removeField(element) {
    element.parentElement.remove();
}

function addPositionField(element) {
    addDynamicField('dynamic-positions-container', `
        <input type="text" name="positions[]" placeholder="Position" required>
        <button class="add-btn" onclick="addPositionField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `);
    element.remove();
}

function addTypeField(element) {
    addDynamicField('dynamic-types-container', `
        <input type="text" name="types[]" placeholder="Type" required>
        <button class="add-btn" onclick="addTypeField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `);
    element.remove();
}

function addRuleField(element) {
    addDynamicField('dynamic-rules-container', `
        <textarea name="rules[]" placeholder="Enter a rule" style="width:400%" required></textarea>
        <button class="add-btn" onclick="addRuleField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `);
    element.remove();
}

function addGameField(element) {
    addDynamicField('dynamic-games-container', `
        <input type="text" name="Gtypes[]" placeholder="Game Type" required>
        <select name="durationType[]" required>
            <option value="T">Time Based</option>
            <option value="O">Over Based</option>
            <option value="S">Score Based</option>
        </select>
        <input type="number" name="duration[]" placeholder="Duration" required>
        <button class="add-btn" onclick="addGameField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `);
    element.remove();
}


function addWeightField() {
    let container = document.getElementById("dynamic-weight-container");
    let index = container.getElementsByClassName("input-group").length + 1;

    let newField = document.createElement("div");
    newField.classList.add("input-group");
    newField.innerHTML = `
        <input type="text" id="weight-class-${index}" name="weightClass[]" 
            placeholder="Enter weight class name (e.g., Heavyweight)" required>
        <input type="number" name="minWeight[]" id="min-weight-${index}" 
            placeholder="Min Weight (kg/lbs)" step="0.1" required>
        <input type="number" name="maxWeight[]" id="max-weight-${index}" 
            placeholder="Max Weight (kg/lbs)" step="0.1" required>
            <button class="add-btn" onclick="addWeightField(this)">➕</button>
        <button type="button" class="remove-btn" onclick="removeField(this)">➖</button>
    `;

    container.appendChild(newField);
}

// Ensure remove button works without breaking add functionality
function removeField(button) {
    let parent = button.parentElement;
    parent.remove();
}
