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
    const container = document.getElementById("dynamic-weight-container");
    const index = container.getElementsByClassName("input-group").length + 1;

    const newField = document.createElement("div");
    newField.classList.add("input-group");
    newField.innerHTML = `
        <input type="text" name="weightClass[]" placeholder="Enter class name" required>
        <input type="number" name="min[]" placeholder="Minimum" step="0.1" required>
        <input type="number" name="max[]" placeholder="Maximum" step="0.1" required>
        <button type="button" class="add-btn" onclick="addWeightField()">➕</button>
        <button type="button" class="remove-btn" onclick="removeField(this)">➖</button>
    `;

    container.appendChild(newField);
}

// Ensure remove button works without breaking add functionality
function removeField(button) {
    let parent = button.parentElement;
    parent.remove();
}

//vaidate ind sports class names max>min
document.querySelector("form").addEventListener("submit", function (e) {
    const classNames = document.getElementsByName("weightClass[]");
    const minWeights = document.getElementsByName("min[]");
    const maxWeights = document.getElementsByName("max[]");

    let classSet = new Set();
    let errorMessages = [];

    for (let i = 0; i < classNames.length; i++) {
        const className = classNames[i].value.trim();
        const min = parseFloat(minWeights[i].value);
        const max = parseFloat(maxWeights[i].value);

        // Check for duplicate class names
        if (classSet.has(className)) {
            errorMessages.push(`Duplicate class name found: "${className}"`);
        } else {
            classSet.add(className);
        }

        // Check if max > min
        if (isNaN(min) || isNaN(max) || max <= min) {
            errorMessages.push(`Invalid weight range for class "${className}": max must be greater than min.`);
        }
    }

    if (errorMessages.length > 0) {
        e.preventDefault(); // Stop form submission
        showCustomAlert(errorMessages.join("<br>")); // Use your custom alert
    }
});


