// Function to handle editing a row
function editRow(button) {
    const row = button.closest('tr');
    const cells = row.querySelectorAll('td');
    
    cells.forEach(cell => {
        if (cell.classList.contains('editable')) {
            cell.contentEditable = true;
        }
    });

    // Change button to Save
    button.innerText = 'Save';
    button.onclick = function() {
        saveRow(row, button);
    };
}

// Function to save the edited row
function saveRow(row, button) {
    const cells = row.querySelectorAll('td');
    
    cells.forEach(cell => {
        if (cell.classList.contains('editable')) {
            cell.contentEditable = false;
        }
    });

    // Change the button back to Edit
    button.innerText = 'Edit';
    button.onclick = function() {
        editRow(button);
    };
}

// Function to delete a row
function deleteRow(button) {
    const row = button.closest('tr');
    row.remove();
}

// Function to add a new student row to the table dynamically
function addStudentRow(studentName, grade, term, average, rank) {
    const tableBody = document.getElementById('studentTableBody');
    
    // Create a new row
    const row = tableBody.insertRow();

    // Insert cells with student data
    row.insertCell(0).innerText = studentName;
    row.insertCell(1).innerText = grade;
    row.insertCell(2).innerText = term;
    row.insertCell(3).innerText = average;
    row.insertCell(4).innerText = rank;

    // Add action buttons to the last cell
    const actionCell = row.insertCell(5);

    // Create Edit button
    const editButton = document.createElement('button');
    editButton.innerText = 'Edit';
    editButton.classList.add('action-btn', 'edit-btn');
    editButton.onclick = function() {
        editRow(editButton);
    };

    // Create Delete button
    const deleteButton = document.createElement('button');
    deleteButton.innerText = 'Delete';
    deleteButton.classList.add('action-btn', 'delete-btn');
    deleteButton.onclick = function() {
        deleteRow(deleteButton);
    };

    // Append buttons to the action cell
    actionCell.appendChild(editButton);
    actionCell.appendChild(deleteButton);
}
