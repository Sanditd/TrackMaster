// Open the corresponding popup when an <a> tag is clicked
document.querySelectorAll(".open-popup").forEach(function (link) {
    link.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default anchor behavior
        const popupId = this.getAttribute("data-popup"); // Get the target popup ID
        const popup = document.getElementById(popupId); // Find the popup
        if (popup) {
            popup.style.display = "flex"; // Show the popup
            document.getElementById("content").classList.add("blur");
        }
    });
});

// Close the popup when the close button is clicked
document.querySelectorAll(".frmclosebtn").forEach(function (closeButton) {
    closeButton.addEventListener("click", function () {
        const popup = this.closest(".popup"); // Get the parent popup
        if (popup) {
            popup.style.display = "none"; // Hide the popup
            document.getElementById("content").classList.remove("blur");
        }
    });
});

// Close the popup when clicking outside the form
window.addEventListener("click", function (event) {
    document.querySelectorAll(".popup").forEach(function (popup) {
        if (event.target === popup) {
            popup.style.display = "none"; // Hide the popup
            document.getElementById("content").classList.remove("blur");
        }
    });
});
