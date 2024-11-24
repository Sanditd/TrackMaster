// Ensure popup is visible initially
document.getElementById('popup').style.display = 'block'; 

// Handle "Team Sport" button click
function showTeamSport() {
    // Display the team sport form
    document.getElementById('teamSport').style.display = 'block';
    // Hide the popup
    closePopup();
}

// Handle "Individual Sport" button click
function showIndSport() {
    // Display the team sport form
    document.getElementById('indSports').style.display = 'block';
    // Hide the popup
    closePopup();
}

// Close the popup
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

// Optional: Hide the "teamSport" section initially
document.getElementById('teamSport').style.display = 'none';
