// achievements.js

const achievementsTable = document.querySelector('table tbody');
const form = document.querySelector('.form-section form');
const carouselInner = document.querySelector('#carouselAchievementsDashboard');

// Function to create a new carousel item
function createCarouselItem(place, level, date, description) {
    const carouselItem = document.createElement('div');
    carouselItem.classList.add('carousel-item');

    carouselItem.innerHTML = `
        <div class="image-container">
            <img src="/Public/img/Student/achievements.png" alt="Achievement Image">
        </div>
        <div class="content-container">
            <h3>${place}</h3>
            <h3 class="level">${level}</h3>
            <p>${date}</p>
            <p>${description}</p>
        </div>
    `;

    return carouselItem;
}

form.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form reload

    // Collect form data
    const place = form.querySelector('#description').value;
    const level = form.querySelector('input[name="level"]:checked').value;
    const description = form.querySelector('#description').value;
    const date = form.querySelector('#date').value;

    // Create a new table row
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${date}</td>
        <td>${place}</td>
        <td>${level}</td>
        <td>${description}</td>
        <td>
            <button class="Edit-button">Edit</button>
            <button class="delete-button">Delete</button>
        </td>
    `;

    // Append the new row to the table
    achievementsTable.appendChild(newRow);

    // Create and append a new carousel item
    const newCarouselItem = createCarouselItem(place, level, date, description);
    carouselInner.appendChild(newCarouselItem);

    // Reset form fields
    form.reset();

    // Add edit and delete functionality to new row
    addTableRowListeners(newRow);
    updateCarousel(); // Update carousel display
});

// Add listeners for edit and delete buttons
function addTableRowListeners(row) {
    const editButton = row.querySelector('.Edit-button');
    const deleteButton = row.querySelector('.delete-button');

    // Edit button functionality
    editButton.addEventListener('click', function () {
        const cells = row.querySelectorAll('td');
        form.querySelector('#date').value = cells[0].textContent;
        form.querySelector('#description').value = cells[1].textContent;
        form.querySelector(`input[name="level"][value="${cells[2].textContent.toLowerCase()}"]`).checked = true;
        form.querySelector('#description').value = cells[3].textContent;

        // Remove the row and its corresponding carousel item for editing
        const index = Array.from(achievementsTable.rows).indexOf(row);
        carouselInner.children[index].remove();
        row.remove();

        updateCarousel(); // Update carousel display
    });

    // Delete button functionality
    deleteButton.addEventListener('click', function () {
        const index = Array.from(achievementsTable.rows).indexOf(row);

        // Remove the row and its corresponding carousel item
        carouselInner.children[index].remove();
        row.remove();

        updateCarousel(); // Update carousel display
    });
}

// Add listeners to initial rows in the table
document.querySelectorAll('table tbody tr').forEach(addTableRowListeners);

// Function to update the carousel visibility
function updateCarousel() {
    const carouselItems = document.querySelectorAll('.carousel-item');
    carouselItems.forEach((item, index) => {
        item.style.display = (index === currentSlide) ? 'block' : 'none';
    });

    // If the current slide index is out of range, reset it
    if (currentSlide >= carouselItems.length) {
        currentSlide = 0;
    }
}

// Initialize carousel with the first item visible
let currentSlide = 0;
updateCarousel();
