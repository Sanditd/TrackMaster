// Get the form and its elements
const form = document.querySelector("form");
const financialReportsInput = document.getElementById("financialReports");

// Add event listener for form submission
form.addEventListener("submit", (event) => {
    event.preventDefault(); // Prevent default form submission behavior

    // Validate form inputs
    if (!validateForm()) {
        return;
    }

    // Confirmation dialog
    if (confirm("Are you sure you want to submit the application?")) {
        // Simulate form submission or further actions
        alert("Application submitted successfully!");
        form.reset(); // Reset the form after submission
    }
});

// Function to validate the form
function validateForm() {
    const studentName = document.getElementById("studentName").value.trim();
    const guardianName = document.getElementById("guardianName").value.trim();
    const annualIncome = document.getElementById("annualIncome").value.trim();
    const reason = document.getElementById("reason").value.trim();
    const date = document.getElementById("date").value.trim();
    const financialReports = financialReportsInput.files[0];

    // Check if required fields are filled
    if (!studentName || !guardianName || !annualIncome || !reason || !date || !financialReports) {
        alert("Please fill in all required fields.");
        return false;
    }

    // Validate annual income (must be numeric)
    if (isNaN(annualIncome)) {
        alert("Annual income must be a numeric value.");
        return false;
    }

    // Validate file type for financial reports
    const validFileTypes = ["application/pdf"];
    if (!validFileTypes.includes(financialReports.type)) {
        alert("Please upload a valid PDF file for financial reports.");
        return false;
    }

    return true;
}

// Add real-time validation for file type
financialReportsInput.addEventListener("change", () => {
    const financialReports = financialReportsInput.files[0];

    if (financialReports && financialReports.type !== "application/pdf") {
        alert("Only PDF files are allowed.");
        financialReportsInput.value = ""; // Clear the input if invalid
    }
});
