document.addEventListener("DOMContentLoaded", function() {
    const fileInput = document.getElementById('photo');
    const fileNameSpan = document.getElementById('file-name');
    const photoPreview = document.getElementById('photo-preview');

    if (fileInput) { // ✅ Check if the element exists before using it
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                fileNameSpan.textContent = file.name;

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        photoPreview.innerHTML = `<img src="${e.target.result}" alt="Photo Preview">`;
                    };

                    reader.readAsDataURL(file);
                } else {
                    photoPreview.innerHTML = `<p>Invalid file type. Please upload an image.</p>`;
                }
            } else {
                fileNameSpan.textContent = "No file chosen";
                photoPreview.innerHTML = `<p>No photo uploaded</p>`;
            }
        });
    } else {
        console.warn("Element with ID 'photo' not found in the DOM.");
    }
});





document.addEventListener('DOMContentLoaded', function() {
const dobInput = document.getElementById('dob');
const ageInput = document.getElementById('age');

dobInput.addEventListener('change', function() {
const dob = new Date(dobInput.value);
const today = new Date();

if (!isNaN(dob)) {
let age = today.getFullYear() - dob.getFullYear();
const monthDiff = today.getMonth() - dob.getMonth();
const dayDiff = today.getDate() - dob.getDate();

if (monthDiff < 0 || (monthDiff===0 && dayDiff < 0)) { age--; } ageInput.value=age> 0 ? age : "Invalid Date";
    } else {
    ageInput.value = "Invalid Date";
    }
    });

    });

    function validateAge() {
        const ageInput = document.getElementById("age").value;
        const role = document.querySelector("input[name='role']").value;
        const age = parseInt(ageInput, 10);

        if (role === "coach" && (age < 30 || age > 60)) {
            showCustomAlert("Check your birth day. Your age doesn't match the age criteria for a coach.");
            return false;
        }

        if (role === "student" && (age < 13 || age > 21)) {
            showCustomAlert("Check your birth day. Your age doesn't match the age criteria for a player.");
            return false;
        }

        return true;
    }


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
    document.getElementById('customAlertOverlay').style.display = 'none';
    }

    // Show PHP backend error on page load
    document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM fully loaded"); // Debugging

    if (typeof errorMessage !== "undefined" && errorMessage.trim() !== "") {
    showCustomAlert(errorMessage); // ✅ Show backend errors
    }

    // Attach event listener for form submission
    const form = document.getElementById("signup-form"); // ✅ Ensure ID matches your form

    if (form) {
    form.addEventListener("submit", function (event) {
    console.log("Form submit event triggered"); // Debugging

    if (!validatePassword()) {
    console.log("Password validation failed"); // Debugging
    event.preventDefault(); // ✅ Prevent form submission if validation fails
    }
    });
    }
    });

    // Function to validate password (for frontend)
    function validatePassword() {
    console.log("validatePassword called"); // Debugging

    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirm-password").value.trim();

    // Password strength regex: At least 8 characters, one uppercase, one lowercase, one number, one special character
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!passwordRegex.test(password)) {
    showCustomAlert("Password must be at least 8 characters, contain uppercase, lowercase, a number, and a specialcharacter.");

    return false;
    }

    if (password !== confirmPassword) {
    showCustomAlert("Passwords do not match.");
    return false;
    }

    return true; // Allow form submission if valid
    }



    // Function to update zones based on selected district

    const provinceDistricts = {
    central: ["Kandy", "Matale", "Nuwara Eliya"],
    eastern: ["Batticaloa", "Ampara", "Trincomalee"],
    northern: ["Jaffna", "Kilinochchi", "Mannar", "Vavuniya", "Mullaitivu"],
    southern: ["Galle", "Matara", "Hambantota"],
    western: ["Colombo", "Gampaha", "Kalutara"],
    "north-central": ["Anuradhapura", "Polonnaruwa"],
    "north-western": ["Kurunegala", "Puttalam"],
    "sabaragamuwa": ["Ratnapura", "Kegalle"],
    uva: ["Badulla", "Moneragala"]
    };

    function updateDistricts() {
    // Get selected province
    const province = document.getElementById("Province").value;

    // Get the District select element
    const districtSelect = document.getElementById("District");

    // Clear previous options
    districtSelect.innerHTML = '<option value="" disabled selected>Select District</option>';

    // Add districts of the selected province
    if (province && provinceDistricts[province]) {
    provinceDistricts[province].forEach(district => {
    const option = document.createElement("option");
    option.value = district.toLowerCase().replace(" ", "-");
    option.textContent = district;
    districtSelect.appendChild(option);
    });
    }
    }

    // Preload district and zone data from PHP
    console.log("Districts data received:", districts);

    /**
    * Updates the zone dropdown based on the selected district
    */
    function updateZones() {
    const districtSelect = document.getElementById('District');
    const zoneSelect = document.getElementById('zone');
    const selectedDistrict = districtSelect.value
    .trim(); // Normalize the selected district value

    console.log("Selected District:", selectedDistrict);

    // Clear existing options
    zoneSelect.innerHTML = '<option value="" disabled selected>Select Zone</option>';

    // Normalize district keys and find the match
    const normalizedDistricts = Object.keys(districts).reduce((acc, key) => {
    acc[key.trim().toLowerCase()] = districts[key];
    return acc;
    }, {});

    const normalizedSelectedDistrict = selectedDistrict.toLowerCase();

    if (normalizedDistricts[normalizedSelectedDistrict]) {
    console.log("Zones for district:", normalizedDistricts[normalizedSelectedDistrict]);
    normalizedDistricts[normalizedSelectedDistrict].forEach(zone => {
    const option = document.createElement('option');
    option.value = zone;
    option.textContent = zone;
    zoneSelect.appendChild(option);
    });
    } else {
    console.warn(`No zones found for district: ${selectedDistrict}`);
    }
    }