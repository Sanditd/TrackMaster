// Function to show custom alert
function showCustomAlert(message) {
    console.log("showCustomAlert called with message:", message);

    const alertMessage = document.getElementById('customAlertMessage');
    const alertOverlay = document.getElementById('customAlertOverlay');

    if (alertMessage && alertOverlay) {
        alertMessage.innerText = message;
        alertOverlay.style.display = 'block';
    } else {
        console.error("Custom alert elements not found in the DOM.");
    }
}

// Function to hide custom alert
function hideCustomAlert() {
    const alertOverlay = document.getElementById('customAlertOverlay');
    if (alertOverlay) {
        alertOverlay.style.display = 'none';
    } else {
        console.error("Custom alert overlay not found.");
    }
}

// Show PHP backend error on page load
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM fully loaded"); // Debugging

    if (typeof errorMessage !== "undefined" && errorMessage.trim() !== "") {
        showCustomAlert(errorMessage); // ✅ Show backend errors
    }
}); // ✅ Properly closed the function here
