// Get elements
const popup = document.getElementById('searchPopup');
const overlay = document.querySelector('.overlay');

// Show popup
function showSearchPopup() {
    popup.classList.remove('hidden');
    popup.style.display = 'block'; // Show popup
    overlay.style.display = 'block'; // Show overlay
}

// Hide popup
function hideSearchPopup() {
    popup.style.display = 'none'; // Hide popup
    overlay.style.display = 'none'; // Hide overlay
}

// Close popup when clicking outside the popup or overlay
document.addEventListener('click', function(event) {
    if (!popup.contains(event.target) && !overlay.contains(event.target)) {
        hideSearchPopup(); // Hide popup if the click is outside
    }
});

// Close popup when overlay is clicked
overlay.addEventListener('click', hideSearchPopup);

// Optional: Close popup using ESC key
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        hideSearchPopup();
    }
});

 function navigateTo(url) { window.location.href = url; } 
