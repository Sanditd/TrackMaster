// Handle form submission
document.getElementById("financial-status-form").addEventListener("submit", function(event) {
    event.preventDefault(); 

    const formData = new FormData(this);

    // Example: Send data to server (replace with your API endpoint)
    fetch('/api/submitFinancialStatus', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Alert user with successful submission
        alert("Application submitted successfully!"); // {{ edit_1 }}
        // Optionally, reset the form
        this.reset();
    })
    .catch(error => {
        console.error("Error submitting application:", error);
        alert("There was an error submitting your application.");
    });
});