// Function to handle profile picture preview when uploading a new picture
document.getElementById('profile-pic-input').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-pic-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Form validation before submitting
document.querySelector('button[type="submit"]').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form submission for validation
    
    // Validate form fields
    const name = document.getElementById('name').value.trim();
    const birthday = document.getElementById('birthday').value;
    const whatsapp = document.getElementById('whatsapp').value.trim();
    const email = document.getElementById('email').value.trim();
    const guardianName = document.getElementById('guardian-name').value.trim();
    const guardianContact = document.getElementById('guardian-contact').value.trim();
    const guardianEmail = document.getElementById('guardian-email').value.trim();

    if (!name || !birthday || !whatsapp || !email || !guardianName || !guardianContact || !guardianEmail) {
        alert('Please fill out all required fields.');
        return;
    }

    const emailPattern = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    if (!emailPattern.test(email) || !emailPattern.test(guardianEmail)) {
        alert('Please enter a valid email address.');
        return;
    }
    
    const guardianEmailPattern = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    if (!guardianEmailPattern.test(guardianEmail)) {
        alert('Please enter a valid guardian email address.');
        return;
    }

    alert('Form is valid and ready to submit!');
});
