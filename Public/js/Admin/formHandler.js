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
    // Get the parent container (input-group)
    const parentGroup = element.parentElement;
    
    // Get the previous sibling which should have the add button
    const prevSibling = parentGroup.previousElementSibling;
    
    // If there's a previous sibling, make sure it has an add button
    if (prevSibling) {
        // Check if the previous sibling already has an add button
        const hasAddBtn = prevSibling.querySelector('.add-btn');
        
        // If it doesn't have an add button, add one
        if (!hasAddBtn) {
            const addBtn = document.createElement('button');
            addBtn.className = 'add-btn';
            
            // Determine which add function to use based on context or container ID
            const containerId = parentGroup.parentElement.id;
            let onclickFunction;
            
            if (containerId === 'dynamic-positions-container') {
                onclickFunction = "addPositionField(this)";
            } else if (containerId === 'dynamic-types-container') {
                onclickFunction = "addTypeField(this)";
            } else if (containerId === 'dynamic-rules-container') {
                onclickFunction = "addRuleField(this)";
            } else if (containerId === 'dynamic-games-container') {
                onclickFunction = "addGameField(this)";
            } else if (containerId === 'dynamic-weight-container') {
                onclickFunction = "addWeightField()";
            }
            
            addBtn.setAttribute('onclick', onclickFunction);
            addBtn.textContent = '➕';
            prevSibling.appendChild(addBtn);
        }
    }
    
    // Remove the current field
    parentGroup.remove();
}

function addPositionField(element) {
    // Get current field count to create unique ID
    const fieldCount = document.querySelectorAll('#dynamic-positions-container .input-group').length + 1;
    
    // Set the HTML content
    const fieldHtml = `
        <input type="text" id="positions-${fieldCount}" name="positions[]" placeholder="Position" required>
        <button class="add-btn" onclick="addPositionField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `;
    
    // Add the new dynamic field
    addDynamicField('dynamic-positions-container', fieldHtml);
    
    // Remove the add button from the previous field
    element.remove();
}

function addTypeField(element) {
    const fieldHtml = `
        <input type="text" name="types[]" placeholder="Type" required>
        <button class="add-btn" onclick="addTypeField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `;
    
    addDynamicField('dynamic-types-container', fieldHtml);
    element.remove();
}

function addRuleField(element) {
    const fieldHtml = `
        <textarea name="rules[]" placeholder="Enter a rule" style="width:400%" required></textarea>
        <button class="add-btn" onclick="addRuleField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `;
    
    addDynamicField('dynamic-rules-container', fieldHtml);
    element.remove();
}

function addGameField(element) {
    const fieldHtml = `
        <input type="text" name="Gtypes[]" placeholder="Game Type" required>
        <select name="durationType[]" required>
            <option value="T">Time Based</option>
            <option value="O">Over Based</option>
            <option value="S">Score Based</option>
        </select>
        <input type="number" name="duration[]" placeholder="Duration" required>
        <button class="add-btn" onclick="addGameField(this)">➕</button>
        <button class="remove-btn" onclick="removeField(this)">❌</button>
    `;
    
    addDynamicField('dynamic-games-container', fieldHtml);
    element.remove();
}

function addWeightField() {
    const fieldHtml = `
        <input type="text" name="weightClass[]" placeholder="Enter class name" required>
        <input type="number" name="min[]" placeholder="Minimum" step="0.1" required>
        <input type="number" name="max[]" placeholder="Maximum" step="0.1" required>
        <button type="button" class="add-btn" onclick="addWeightField()">➕</button>
        <button type="button" class="remove-btn" onclick="removeField(this)">❌</button>
    `;
    
    addDynamicField('dynamic-weight-container', fieldHtml);
}