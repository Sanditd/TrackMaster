document.addEventListener("DOMContentLoaded", function () {
    const sliderContainer = document.querySelector(".slider-container");
    const prevBtn = document.querySelector(".prev-btn");
    const nextBtn = document.querySelector(".next-btn");
    const cards = document.querySelectorAll(".achievement-card");
    const cardCount = cards.length;
    const cardWidth = cards[0].offsetWidth + 20; // Width of card including margin
    let currentPosition = 0;
    
    // Calculate total width of the slider container
    const totalWidth = cardCount * cardWidth;

    // Set the container's width to fit all cards
    sliderContainer.style.width = `${totalWidth}px`;

    // Function to check button states (disables if at limits)
    function updateButtonStates() {
        prevBtn.disabled = currentPosition <= 0;
        const maxScroll = totalWidth - sliderContainer.parentElement.offsetWidth;
        nextBtn.disabled = currentPosition >= maxScroll;
    }

    // Initial check to disable buttons if necessary
    updateButtonStates();

    // Handle Next Button
    nextBtn.addEventListener("click", function () {
        const maxScroll = totalWidth - sliderContainer.parentElement.offsetWidth;
        if (currentPosition < maxScroll) {
            currentPosition += cardWidth;
            if (currentPosition > maxScroll) {
                currentPosition = maxScroll; // Prevent over-scrolling
            }
            sliderContainer.style.transform = `translateX(-${currentPosition}px)`;
        }
        updateButtonStates();
    });

    // Handle Previous Button
    prevBtn.addEventListener("click", function () {
        if (currentPosition > 0) {
            currentPosition -= cardWidth;
            if (currentPosition < 0) {
                currentPosition = 0; // Prevent under-scrolling (negative position)
            }
            sliderContainer.style.transform = `translateX(-${currentPosition}px)`;
        }
        updateButtonStates();
    });

    // Handle "View More" button click for each card
    const viewMoreButtons = document.querySelectorAll(".view-more-btn");
    viewMoreButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            alert(`You clicked "View More" on card ${index + 1}`);
        });
    });

    // Handle "View All Achievements" button click
    const viewAllButton = document.querySelector(".view-all-btn");
    viewAllButton.addEventListener("click", () => {
        alert("Viewing all achievements");
    });
});
