document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.carousel');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    let currentIndex = 0;
    const totalCards = document.querySelectorAll('.card').length;
    const maxVisibleCards = 2;
    nextBtn.addEventListener('click', () => {
        if (currentIndex < totalCards - maxVisibleCards) {
            currentIndex++;
            updateCarousel();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });

    function updateCarousel() {
        const cardWidth = document.querySelector('.card').offsetWidth + 20; // 20 for margin
        const newTransformValue = -(currentIndex * cardWidth);
        carousel.style.transform = `translateX(${newTransformValue}px)`;
    }
});


<div class="carousel-container">
<button class="prev-btn">←</button>
<div class="carousel">

    <div class="card">
        <div class="card-wapper">
        <img src="/App/view/assests/achievements.png" alt="Card image" class="card-img">
        <div class="card-content">
            <h3 class="card-title">Best Athlete</h3>
            <p class="card-text">Awarded as the best athlete in the school</p>
            <a href="#" class="card-btn">View More</a>
        </div>
    </div>
    </div>

    <div class="card">
        <div class="card-wapper">
        <img src="/App/view/assests/achievements.png" alt="Card image" class="card-img">
        <div class="card-content">
            <h3 class="card-title">Best Athlete</h3>
            <p class="card-text">Awarded as the best athlete in the school</p>
            <a href="#" class="card-btn">View More</a>
        </div>
    </div>
    </div>

    <div class="card">
        <div class="card-wapper">
        <img src="/App/view/assests/achievements.png" alt="Card image" class="card-img">
        <div class="card-content">
            <h3 class="card-title">Best Athlete</h3>
            <p class="card-text">Awarded as the best athlete in the school</p>
            <a href="#" class="card-btn">View More</a>
        </div>
    </div>
    </div>

    <div class="card">
        <div class="card-wapper">
        <img src="/App/view/assests/achievements.png" alt="Card image" class="card-img">
        <div class="card-content">
            <h3 class="card-title">Best Athlete</h3>
            <p class="card-text">Awarded as the best athlete in the school</p>
            <a href="#" class="card-btn">View More</a>
        </div>
    </div>
    </div>

    <div class="card">
        <div class="card-wapper">
        <img src="/App/view/assests/achievements.png" alt="Card image" class="card-img">
        <div class="card-content">
            <h3 class="card-title">Best Athlete</h3>
            <p class="card-text">Awarded as the best athlete in the school</p>
            <a href="#" class="card-btn">View More</a>
        </div>
    </div>
    </div>


    <div class="card">
        <div class="card-wapper">
        <img src="/App/view/assests/achievements.png" alt="Card image" class="card-img">
        <div class="card-content">
            <h3 class="card-title">Best Athlete</h3>
            <p class="card-text">Awarded as the best athlete in the school</p>
            <a href="#" class="card-btn">View More</a>
        </div>
    </div>
    </div>

</div>
<button class="next-btn">→</button>
<button class="profile-edit-btn" onclick="window.location.href='/App/view/html/student_achievements.html'">View All Acheivements</button>
</div>