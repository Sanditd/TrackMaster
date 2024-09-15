document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.editProfileForm');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Perform validation (example: check if all required fields are filled)
        const inputs = form.querySelectorAll('input[required], select[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('error'); // Add error class for styling
            } else {
                input.classList.remove('error'); // Remove error class if valid
            }
        });

        if (isValid) {
            // Here you can handle the form data, e.g., send it to a server
            console.log('Form submitted successfully!');
            // Example: form.submit(); // Uncomment to submit the form
        } else {
            console.log('Please fill in all required fields.');
        }
    });
});
