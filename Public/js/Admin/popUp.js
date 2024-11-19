// Ensure popup and other elements are hidden or visible at the start
document.getElementById('popup').style.display = 'block'; // Show popup initially
// document.getElementById('teamSport').style.display = 'none'; // Hide team sport form
// document.getElementById('mainContent').style.display = 'none'; // Hide main content initially

// Handle Popup Button Clicks
function showTeamSport () {
    document.getElementById('sportType').value = 'Team';
    //document.getElementById('mainContent').style.display = 'block'; // Show main content
    document.getElementById('teamSport').style.display = 'block'; // Show team sport form
    closePopup();
}


document.getElementById('individualSportBtn').addEventListener('click', function () {
    document.getElementById('sportType').value = 'Individual';
    document.getElementById('mainContent').style.display = 'block'; // Show main content
    document.getElementById('teamSport').style.display = 'none'; // Hide team sport form
    closePopup();
});

// Function to close popup and show main content
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}
