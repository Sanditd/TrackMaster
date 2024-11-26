document.querySelector(".formcontent").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get form data
    const studentName = document.getElementById("studentName").value;
    const grade = document.getElementById("grade").value;
    const term = document.getElementById("term").value;
    const average = document.getElementById("average").value;
    const rank = document.getElementById("rank").value;

    // Validate inputs (optional)
    if (!studentName || !grade || !term || !average || !rank) {
        alert("Please fill in all fields");
        return;
    }

    // Create a new table row
    const tableBody = document.getElementById("studentTableBody");
    const newRow = document.createElement("tr");

    // Add cells to the row
    newRow.innerHTML = `
        <td>${studentName}</td>
        <td class="editable">${grade}</td>
        <td class="editable">${term}</td>
        <td class="editable">${average}</td>
        <td class="editable">${rank}</td>
        <td>
            <button class="action-btn edit-btn" onclick="editRow(this)">Edit</button>
            <button class="action-btn delete-btn" onclick="deleteRow(this)">Delete</button>
        </td>
    `;

    // Append the row to the table
    tableBody.appendChild(newRow);

    // Clear the form
    document.getElementById("grade").value = "";
    document.getElementById("term").value = "";
    document.getElementById("average").value = "";
    document.getElementById("rank").value = "";
});

// Function to edit a row
function editRow(button) {
    // Your edit logic (from another JS file or inline)
    alert("Edit functionality is not implemented in this code snippet.");
}

// Function to delete a row
function deleteRow(button) {
    const row = button.parentElement.parentElement; // Find the row
    row.remove(); // Remove the row
}