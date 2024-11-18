// Preview profile picture functionality
const profilePicInput = document.getElementById('profile-pic-input');
const profilePicPreview = document.getElementById('profile-pic-preview');

profilePicInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = () => {
            profilePicPreview.src = reader.result; 
        };
        reader.readAsDataURL(file);
    }
});

// Form validation
const saveButton = document.querySelector('.edit-button[type="submit"]');
saveButton.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent the default form submission

    const fields = {
        firstName: document.getElementById('first-name').value.trim(),
        lastName: document.getElementById('last-name').value.trim(),
        email: document.getElementById('email').value.trim(),
        phone: document.getElementById('phone').value.trim(),
        address: document.getElementById('address').value.trim(),
        school: document.getElementById('school').value.trim(),
        grade: document.getElementById('grade').value.trim(),
        guardian: document.getElementById('guardian').value.trim(),
        birthday: document.getElementById('birthday').value.trim(),
    };

    // Basic validation
    if (Object.values(fields).some(field => !field)) {
        alert('Please fill in all fields.');
        return;
    }

    // Email validation
    if (!/^\S+@\S+\.\S+$/.test(fields.email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // Phone number validation
    if (!/^\d{10}$/.test(fields.phone)) {
        alert('Please enter a valid 10-digit phone number.');
        return;
    }

    alert('Profile updated successfully!');
    // Here you can send the data to the server or handle it as needed.
});

// Cancel button confirmation
const cancelButton = document.querySelector('.edit-button[onclick]');
cancelButton.addEventListener('click', (event) => {
    const confirmCancel = confirm('Are you sure you want to cancel editing? Unsaved changes will be lost.');
    if (!confirmCancel) {
        event.preventDefault(); // Prevent navigation if the user cancels
    }
});

// Autofill default data (if needed for debugging or testing)
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('first-name').value = 'Eraji';
    document.getElementById('last-name').value = 'Thenuwara';
    document.getElementById('email').value = 'thenuwara@gmail.com';
    document.getElementById('phone').value = '0712345678';
    document.getElementById('address').value = '55/4A, Pirivena Road, Ratmalana';
    document.getElementById('school').value = 'Maliyadeva Balika Vidyalaya';
    document.getElementById('grade').value = '11 - A';
    document.getElementById('guardian').value = 'T.H.C.Silva';
    document.getElementById('birthday').value = '2008-01-16';
});
