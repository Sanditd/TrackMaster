// Global variable to track current slide
let currentSlide = 0;

// Function to show slides in the carousel
function showSlide(index) {
    const slides = document.querySelectorAll('.carousel-item');
    const totalSlides = slides.length;

    if (index >= totalSlides) currentSlide = 0;
    if (index < 0) currentSlide = totalSlides - 1;

    slides.forEach(slide => slide.style.display = 'none');

    for (let i = 0; i < 3; i++) {
        const slideIndex = (currentSlide + i) % totalSlides;
        slides[slideIndex].style.display = 'block';
    }
}

function nextSlide() {
    currentSlide++;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide--;
    showSlide(currentSlide);
}

// Show the initial slides
showSlide(currentSlide);

// Function to add a new achievement to both carousels
function addAchievementToCarousels(imageSrc, title, description) {
    const achievementHTML = `
        <div class="carousel-item">
            <div class="image-container">
                <img src="${imageSrc}">
            </div>
            <div class="content-container">
                <h3>${title}</h3>
                <p>${description}</p>
            </div>
        </div>
    `;

    // Add to the student achievements carousel
    document.getElementById('carouselAchievementsStudent').insertAdjacentHTML('beforeend', achievementHTML);

    // Add to the dashboard carousel
    document.getElementById('carouselAchievementsDashboard').insertAdjacentHTML('beforeend', achievementHTML);
}

// Handle the form submission to add a new achievement
document.getElementById('achievementForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get form values
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const imageInput = document.getElementById('image').files[0]; // Get uploaded image

    if (!imageInput) {
        alert("Please upload an image.");
        return;
    }

    // Read the image file
    const reader = new FileReader();
    reader.onload = function(e) {
        const imageSrc = e.target.result; // Base64 image URL

        // Add the achievement to both carousels
        addAchievementToCarousels(imageSrc, title, description);
    };

    reader.readAsDataURL(imageInput); // Convert image file to base64
});
