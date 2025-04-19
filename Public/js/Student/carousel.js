let currentSlide = 0;
const slidesPerView = window.innerWidth > 992 ? 3 : window.innerWidth > 768 ? 2 : 1;
let autoplayInterval;

// Initialize the carousel
function initCarousel() {
    const carousel = document.getElementById('carouselAchievementsDashboard');
    const items = carousel.querySelectorAll('.carousel-item');
    
    if (items.length === 0) return;
    
    // Set up autoplay
    startAutoplay();
    
    // Stop autoplay on hover
    carousel.parentElement.addEventListener('mouseenter', stopAutoplay);
    carousel.parentElement.addEventListener('mouseleave', startAutoplay);
    
    // Add swipe gesture support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    carousel.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    }, false);
    
    carousel.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, false);
    
    function handleSwipe() {
        const difference = touchStartX - touchEndX;
        if (difference > 50) {
            nextSlide(); // Swipe left
        } else if (difference < -50) {
            prevSlide(); // Swipe right
        }
    }
    
    // Initial position
    updateCarouselPosition();
}

function startAutoplay() {
    stopAutoplay(); // Clear any existing interval
    autoplayInterval = setInterval(() => {
        nextSlide();
    }, 4000); // Change slide every 4 seconds
}

function stopAutoplay() {
    if (autoplayInterval) {
        clearInterval(autoplayInterval);
    }
}

function updateCarouselPosition() {
    const carousel = document.getElementById('carouselAchievementsDashboard');
    const items = carousel.querySelectorAll('.carousel-item');
    
    if (items.length === 0) return;
    
    const maxSlide = Math.max(0, Math.ceil(items.length / slidesPerView) - 1);
    
    // Make sure currentSlide is within valid range
    if (currentSlide < 0) currentSlide = 0;
    if (currentSlide > maxSlide) currentSlide = maxSlide;
    
    // Calculate the translation value
    const itemWidth = items[0].offsetWidth + parseInt(getComputedStyle(items[0]).marginLeft) + 
                    parseInt(getComputedStyle(items[0]).marginRight);
    const translateX = -currentSlide * slidesPerView * itemWidth;
    
    carousel.style.transform = `translateX(${translateX}px)`;

    updateDots();
    
    items.forEach((item, index) => {
        const normalizedIndex = index % slidesPerView;
        const slidePosition = Math.floor(index / slidesPerView);
        
        if (slidePosition === currentSlide) {
            item.style.opacity = "1";
        } else {
            item.style.opacity = "0.7";
        }
    });
}

function updateDots() {
    const dots = document.querySelectorAll('.carousel-dot');
    dots.forEach((dot, index) => {
        if (index === currentSlide) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

function prevSlide() {
    currentSlide--;
    updateCarouselPosition();
    stopAutoplay();
    startAutoplay();
}

function nextSlide() {
    currentSlide++;
    updateCarouselPosition();
    stopAutoplay();
    startAutoplay();
}

function goToSlide(slideIndex) {
    currentSlide = slideIndex;
    updateCarouselPosition();
    stopAutoplay();
    startAutoplay();
}

// Initialize carousel when DOM is loaded
document.addEventListener('DOMContentLoaded', initCarousel);

// Update slides per view on window resize
window.addEventListener('resize', () => {
    const newSlidesPerView = window.innerWidth > 992 ? 3 : window.innerWidth > 768 ? 2 : 1;
    if (newSlidesPerView !== slidesPerView) {
        slidesPerView = newSlidesPerView;
        updateCarouselPosition();
    }
});