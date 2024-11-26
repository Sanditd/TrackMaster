let deleteMode = false;
let originalData = []; // Store original data to revert if cancel is clicked

// Store original data from the table
function storeOriginalData() {
    originalData = [];
    let rows = document.querySelectorAll('#studentTable tbody tr');
    rows.forEach(row => {
        let rowData = [];
        row.querySelectorAll('td').forEach(cell => {
            rowData.push(cell.textContent);
        });
        originalData.push(rowData);
    });
}

document.querySelector('.edit-btn').addEventListener('click', function() {
    let table = document.getElementById('studentTable');
    let rows = table.getElementsByTagName('tr');

    // Store original data in case of cancellation
    storeOriginalData();

    // Loop through each row (skip the header)
    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName('td');
        
        // Enable editing for each cell without making the table big
        for (let j = 0; j < cells.length; j++) {
            let cellText = cells[j].textContent;
            cells[j].innerHTML = `<input type="text" value="${cellText}" class="cell-input">`;
        }
    }

    // Change the button to save the changes and add a cancel button
    this.textContent = 'Save';
    this.removeEventListener('click', arguments.callee); // Remove previous edit event
    this.addEventListener('click', saveEdits); // Attach save function

    let cancelButton = document.createElement('button');
    cancelButton.textContent = 'Cancel';
    cancelButton.classList.add('cancel-btn');
    this.parentElement.appendChild(cancelButton); // Add Cancel button to the page

    cancelButton.addEventListener('click', cancelEdit); // Attach cancel function
});

function saveEdits() {
    let table = document.getElementById('studentTable');
    let rows = table.getElementsByTagName('tr');

    // Loop through each row (skip the header)
    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName('td');
        
        // Update each cell with the new input value
        for (let j = 0; j < cells.length; j++) {
            let input = cells[j].getElementsByTagName('input')[0];
            if (input) {
                cells[j].textContent = input.value; // Update text content
            }
        }
    }

    // Change the button back to 'Edit'
    let editButton = document.querySelector('.edit-btn');
    editButton.textContent = 'Edit';
    editButton.removeEventListener('click', saveEdits); // Remove save event
    editButton.addEventListener('click', function() {
        alert('Editing Mode is already saved.');
    });

    // Remove Cancel button
    let cancelButton = document.querySelector('.cancel-btn');
    if (cancelButton) cancelButton.remove();
}

function cancelEdit() {
    let table = document.getElementById('studentTable');
    let rows = table.getElementsByTagName('tr');

    // Revert the table content to the original state
    let rowIndex = 0;
    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName('td');
        originalData[rowIndex].forEach((value, j) => {
            cells[j].textContent = value;
        });
        rowIndex++;
    }

    // Change the button back to 'Edit'
    let editButton = document.querySelector('.edit-btn');
    editButton.textContent = 'Edit';
    editButton.removeEventListener('click', saveEdits); // Remove save event
    editButton.addEventListener('click', function() {
        alert('Editing Mode is already saved.');
    });

    // Remove Cancel button
    let cancelButton = document.querySelector('.cancel-btn');
    if (cancelButton) cancelButton.remove();
}

document.querySelector('.delete-btn').addEventListener('click', function() {
    deleteMode = !deleteMode;

    // Toggle delete mode on and off
    if (deleteMode) {
        this.textContent = 'Click a row to delete';
        highlightRowsForDeletion();

        // Create and append Cancel button
        let cancelButton = document.createElement('button');
        cancelButton.textContent = 'Cancel';
        cancelButton.classList.add('cancel-btn');
        this.parentElement.appendChild(cancelButton);

        cancelButton.addEventListener('click', cancelDelete); // Attach cancel delete function
    } else {
        this.textContent = 'Delete';
        removeRowHighlight();
        let cancelButton = document.querySelector('.cancel-btn');
        if (cancelButton) cancelButton.remove(); // Remove Cancel button
    }
});

function highlightRowsForDeletion() {
    let tableRows = document.querySelectorAll('#studentTable tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('click', function() {
            if (deleteMode) {
                let confirmation = confirm("Are you sure you want to delete this row?");
                if (confirmation) {
                    // Remove the row from the table
                    this.remove();
                    deleteMode = false; // Exit delete mode after deletion
                    document.querySelector('.delete-btn').textContent = 'Delete'; // Reset button text
                    let cancelButton = document.querySelector('.cancel-btn');
                    if (cancelButton) cancelButton.remove(); // Remove Cancel button
                }
            }
        });
        row.style.cursor = 'pointer'; // Change cursor to pointer to show it's clickable
    });
}

function removeRowHighlight() {
    let tableRows = document.querySelectorAll('#studentTable tbody tr');
    tableRows.forEach(row => {
        row.removeEventListener('click', function() {
            if (deleteMode) {
                let confirmation = confirm("Are you sure you want to delete this row?");
                if (confirmation) {
                    this.remove();
                    deleteMode = false;
                    document.querySelector('.delete-btn').textContent = 'Delete';
                }
            }
        });
        row.style.cursor = 'default'; // Reset cursor back to default
    });
}

function cancelDelete() {
    deleteMode = false;
    document.querySelector('.delete-btn').textContent = 'Delete'; // Reset the delete button text
    let cancelButton = document.querySelector('.cancel-btn');
    if (cancelButton) cancelButton.remove(); // Remove Cancel button
    removeRowHighlight(); // Disable row highlighting
}
