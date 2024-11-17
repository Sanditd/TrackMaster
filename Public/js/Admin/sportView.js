let currentEditField = "";

// Search Sport by Name (Simulated with static data)
function searchSport() {
    let searchQuery = document.getElementById("searchSport").value.toLowerCase();
    let sportName = document.getElementById("sportName").textContent.toLowerCase();

    if (sportName.includes(searchQuery)) {
        document.getElementById("sportDetails").style.display = "block";
    } else {
        document.getElementById("sportDetails").style.display = "none";
    }
}

// Open Edit Popup
function editDetail(field) {
    currentEditField = field;
    let currentValue = document.getElementById(field).textContent;
    document.getElementById("editValue").value = currentValue;
    document.getElementById("editPopup").style.display = "flex";
}

// Save Edited Value
function saveEdit() {
    let newValue = document.getElementById("editValue").value;
    document.getElementById(currentEditField).textContent = newValue;
    closeEditPopup();
}

// Close Edit Popup
function closeEditPopup() {
    document.getElementById("editPopup").style.display = "none";
}
