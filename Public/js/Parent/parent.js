// Data for profiles
const profiles = {
    john: {
        name: "John Doe",
        age: 15,
        team: "Soccer U16",
        position: "Forward",
        coach: "Coach Smith",
        stats: "10 goals in 5 games"
    },
    jane: {
        name: "Jane Smith",
        age: 14,
        team: "Basketball U15",
        position: "Guard",
        coach: "Coach Brown",
        stats: "8 assists in 4 games"
    },
    mark: {
        name: "Mark Taylor",
        age: 16,
        team: "Baseball U18",
        position: "Pitcher",
        coach: "Coach Lee",
        stats: "12 strikeouts in 3 games"
    }
};

// Function to display the selected profile
function showProfile() {
    const selector = document.getElementById("profileSelector");
    const selectedProfile = profiles[selector.value];
    
    // Update the profile details
    document.getElementById("name").textContent = selectedProfile.name;
    document.getElementById("age").textContent = selectedProfile.age;
    document.getElementById("team").textContent = selectedProfile.team;
    document.getElementById("position").textContent = selectedProfile.position;
    document.getElementById("coach").textContent = selectedProfile.coach;
    document.getElementById("stats").textContent = selectedProfile.stats;
}

document.getElementById("paidAmount").addEventListener("input", function () {
    // Retrieve Total Fees and Paid Amount
    const totalFees = parseFloat(document.getElementById("totalFees").textContent);
    const paidAmount = parseFloat(this.value);

    // Validate the Paid Amount
    if (isNaN(paidAmount) || paidAmount < 0) {
        alert("Please enter a valid paid amount.");
        this.value = ""; // Reset invalid input
        return;
    }

    // Calculate the Balance
    const balance = totalFees - paidAmount;

    // Ensure Balance is not negative
    if (balance < 0) {
        alert("Paid amount exceeds Total Fees.");
        this.value = ""; // Reset the overpayment input
        return;
    }

    // Update the Balance in the DOM
    document.getElementById("balance").textContent = balance.toFixed(2);
});

