document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("medical-report-form");
    const messageDiv = document.getElementById("message");
    const tableBody = document.getElementById("report-table-body");

    // Check if tableBody exists
    if (!tableBody) {
        console.error("Table body not found!");
        return; // Exit if table body is not found
    }

    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission

        // Validate fields
        const date = document.getElementById("date").value;
        const condition = document.getElementById("condition").value;
        const notes = document.getElementById("notes").value;
        const report = document.getElementById("report").files.length;
        const medication = document.getElementById("medication").value; // Get medication value

        if (!date || !condition || !medication || !notes || report === 0) { // Include medication in validation
            messageDiv.innerHTML = "<p style='color:red;'>Please fill out all fields correctly.</p>";
            return;
        }

        // If validation passes
        messageDiv.innerHTML = "<p style='color:green;'>Form submitted successfully!</p>";
        console.log("Form submitted successfully!"); // Log success message

        // Scroll to the table
        tableBody.scrollIntoView({ behavior: 'smooth' });

        // Alert the user
        alert("Form submitted successfully!");

        // Add data to the table
        const newRow = tableBody.insertRow(); // Create a new row
        newRow.insertCell(0).innerText = date; // Fill date
        newRow.insertCell(1).innerText = condition; // Fill condition
        newRow.insertCell(2).innerText = medication; // Fill medication
        newRow.insertCell(3).innerText = notes; // Fill notes
        newRow.insertCell(4).innerText = "File uploaded"; // Indicate file upload

        // Clear the form fields after submission
        form.reset();
    });
});
