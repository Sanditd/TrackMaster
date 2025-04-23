<?php
    //require " echo ROOT/config/init.php";
    //require " echo ROOT/core/init.php";
    require_once 'nav.php';
    $nav = new Nav();
?>

<!DOCTYPE html>
<html>


<?php
$Success_message = "";
$Error_message = "";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['success_message'])) {
    $Success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    $Error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

?>


<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/login.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/Public/css/Admin/selectRole.css">

</head>

<body id="loginbody">

<?php if ($Success_message): ?>
<div class="alert alert-success"><?= htmlspecialchars($Success_message) ?></div>
<?php endif; ?>
<?php if ($Error_message): ?>
<div class="alert alert-danger"><?= htmlspecialchars($Error_message) ?></div>
<?php endif; ?>

<div id="customAlertOverlay">
    <div id="customAlertBox">
        <h2>Notice</h2>
        <p id="customAlertMessage"></p>
        <button onclick="hideCustomAlert()">OK</button>
    </div>
</div>

<script id="error-message" type="application/json"><?= json_encode(trim($Error_message)) ?></script>
<script id="success-message" type="application/json"><?= json_encode(trim($Success_message)) ?></script>
<script src="<?php echo ROOT?>/Public/js/Admin/formHandler.js"></script>


    <?php $nav->render(); ?>

    <div id="main-container">
        <div class="slider">
            <div class="slides">
                <img src="<?php echo ROOT; ?>/public/img/roles/coach.jpeg" alt="Slide 1">
                <img src="<?php echo ROOT; ?>/public/img/roles/coach.jpeg" alt="Slide 2">
                <img src="<?php echo ROOT; ?>/public/img/roles/coach.jpeg" alt="Slide 3">
            </div>
            <div class="navigation">
                <button id="prev">❮</button>
                <button id="next">❯</button>
            </div>
        </div>

        <div id="login-dis">
            <div id="wel-track">Welcome Admin</div>

            <div id="wel-dis">Whether you're an aspiring athlete striving to break personal records or a seasoned
                professional aiming for peak performance, TrackMaster is your ultimate partner in achieving success. Our
                platform is designed to empower athletes of all levels with the tools and insights they need to excel.
                <br><br>

                With TrackMaster, you can monitor your progress in real-time, set meaningful goals, and gain valuable
                insights into your training routines. Whether it's tracking your daily workouts, measuring improvements
                in endurance, or analyzing intricate performance metrics, TrackMaster ensures you have the data and
                support necessary to make informed decisions and push beyond your limits.
                <br><br>

                Our cutting-edge technology doesn’t just help you train—it transforms the way you approach your sport.
                From creating personalized training plans to celebrating milestones, we’re here every step of the way to
                keep you motivated and on track.
                <br><br>
                Join a thriving community of passionate athletes who share your dedication and ambition. Connect with
                others, share your journey, and find inspiration in the achievements of your peers. With TrackMaster,
                you're not just optimizing your performance; you're unlocking your full potential and becoming the best
                version of yourself.
                <br><br>
                Take charge of your athletic journey today, and let TrackMaster guide you toward unparalleled excellence
                and success. Together, we can achieve greatness!
            </div>
        </div>


        <div id="login-port">
            <span id="login-port-logo">
                <img src="<?php echo ROOT?>/Public\img\logo-black.png" alt="Logo">
            </span>
            <form action="<?php echo ROOT ?>/loginController/adminLogin" method="POST">
                <div>
                    <input type="text" placeholder="Enter username" name="username">
                </div>
                <div>
                    <input type="password" placeholder="Enter Password" name="password">
                </div>
                <button type="submit">LOGIN / SIGN UP</button>
            </form>
            <div class="or">Or</div>
            <div class="or"><button id="frogetPW-button">Frogot Password</button></div>
            <div class="or"><a href="<?php echo ROOT ?>/signUpController/Admin">Register Here</a></div>

        </div>

        <div class="popup">
            <div id="frogetPW-port">
                <span id="login-port-logo">
                    <img src="<?php echo ROOT?>/public/assets/icon/logo-black.png" alt="trackmaster logo">
                </span>
                <form method="POST">
                    <div>
                        Reset Froget Password
                    </div>
                    <div>
                        <input type="text" placeholder="Enter Username">
                    </div>
                    <div>
                        <input type="text" placeholder="Enter Email">
                    </div>
                    <div>
                        <input type="text" placeholder="Enter PhoneNumber">
                    </div>
                    <button type="Submit">Submit</button>
                </form>
                <button class="close-popup">Close</button>
            </div>
        </div>



        <script>
        document.getElementById("frogetPW-button").addEventListener("click", function() {
            document.querySelector(".popup").style.display = "flex";
        })

        document.querySelector(".close-popup").addEventListener("click", function() {
            document.querySelector(".popup").style.display = "none";
        });

        </script>

    </div>

  

</body>

<script>
const slides = document.querySelector('.slides');
const slideImages = document.querySelectorAll('.slides img');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

let currentIndex = 0;

function updateSlidePosition() {
    slides.style.transform = `translateX(${-currentIndex * 100}%)`;
}

prevButton.addEventListener('click', () => {
    currentIndex = (currentIndex === 0) ? slideImages.length - 1 : currentIndex - 1;
    updateSlidePosition();
});

nextButton.addEventListener('click', () => {
    currentIndex = (currentIndex === slideImages.length - 1) ? 0 : currentIndex + 1;
    updateSlidePosition();
});

// Auto-slide
setInterval(() => {
    currentIndex = (currentIndex === slideImages.length - 1) ? 0 : currentIndex + 1;
    updateSlidePosition();
}, 3000);
</script>

</html>