let currentSlide = 0;

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

showSlide(currentSlide);
