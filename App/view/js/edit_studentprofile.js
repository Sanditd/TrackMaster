document.addEventListener("DOMContentLoaded", function() {
    const profileImage = document.getElementById('profileImage');
    const uploadProfilePic = document.getElementById('uploadProfilePic');
    const form = document.querySelector(".editProfileForm");
    const saveButton = document.querySelector(".profile-edit-btn");

    // Preview profile picture before uploading
    uploadProfilePic.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Show success message when the form is submitted
    saveButton.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent form submission

        let isValid = true;
        const inputs = form.querySelectorAll("input, select");

        inputs.forEach(input => {
            if (!input.checkValidity()) {
                isValid = false;
                input.classList.add("error"); // Add error class for styling
            } else {
                input.classList.remove("error"); // Remove error class if valid
            }
        });

        // Additional check for email validity for all email fields
        const emailInputs = [emailInput, guardianEmailInput];
        emailInputs.forEach(emailInput => {
            if (emailInput && !emailInput.checkValidity()) {
                isValid = false;
                emailInput.classList.add("error");
            }
        });

        // New code to show success message if valid
        if (isValid) {
            alert("Profile updated successfully!"); // Success message
        }
    });
});
