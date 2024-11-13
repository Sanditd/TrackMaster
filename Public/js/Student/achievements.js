document.getElementById('achievementForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get the values from the form inputs
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const imageInput = document.getElementById('image').files[0]; // Get the uploaded image file

    if (!imageInput) {
        alert("Please upload an image.");
        return;
    }

    // Create a FileReader to display the uploaded image
    const reader = new FileReader();
    reader.onload = function(e) {
        // Add achievement to table only
        addAchievementToTable(e.target.result, title, description);
    };
    reader.readAsDataURL(imageInput);

    // Clear the form after submission
    document.getElementById('achievementForm').reset();
});

// Function to add achievement to the table
function addAchievementToTable(imageSrc, title, description) {
    const tableBody = document.querySelector('#achievementTable tbody');

    // Create a new row
    const row = document.createElement('tr');

    // Create the image cell
    const imgCell = document.createElement('td');
    const imgElement = document.createElement('img');
    imgElement.src = imageSrc;
    imgElement.style.width = '100px'; // Adjust the image size as needed
    imgElement.style.height = 'auto';
    imgCell.appendChild(imgElement);
    row.appendChild(imgCell);

    // Create the title cell
    const titleCell = document.createElement('td');
    titleCell.textContent = title;
    row.appendChild(titleCell);

    // Create the description cell
    const descriptionCell = document.createElement('td');
    descriptionCell.textContent = description;
    row.appendChild(descriptionCell);

    // Append the new row to the table body
    tableBody.appendChild(row);
}
