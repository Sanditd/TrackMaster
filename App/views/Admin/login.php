<?php
    //require "../../config/init.php";
    //require "../core/init.php";
    require_once 'nav.php';
    $nav = new Nav();
?>

<!DOCTYPE html>
<html>


<?php
// Start session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if there's a success message in the session
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Remove the message after retrieving it
} else {
    $successMessage = "";
}
?>


<head>
    <title>Login</title>

    <link rel="stylesheet" href="../../Public/css/Admin/login.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/Public/css/Admin/selectRole.css">

</head>

<body id="loginbody">


    <?php $nav->render(); ?>


    <div id="main-container">
        <div class="slider">
            <div class="slides">
                <img src="<?php echo ROOT; ?>/public/img/roles/coach.jpeg" alt="Slide 1">
                <img src="<?php echo ROOT; ?>/public/img/roles/coach.jpeg" alt="Slide 2">
                <img src="<?php echo ROOT; ?>/public/img/roles/coach.jpeg" alt="Slide 3">

    <div id="login-dis">
        <div id="wel-track">Welcome to TrackMaster</div>

        <div id="wel-dis">Whether you're an aspiring athlete or a seasoned professional, TrackMaster is your go-to
            platform for
            tracking and optimizing your sports performance. <br><br>
            Our cutting-edge tools allow you to monitor your progress,
            set goals, and analyze your performance with precision. From daily workouts to long-term milestones,
            TrackMaster provides the insights you need to stay ahead of the game and achieve your full potential. Join
            our community of dedicated sportsmen and take control of your athletic journey today!</div>

    </div>

    <div id="login-port">
        <span id="login-port-logo">
        <img src="../Public/img/logo-black.png" alt="Logo">
        </span>
        <form action="<?php echo ROOT ?>/loginController/login" method="POST">
            <div>
                <input type="text" placeholder="Enter username" name="username">

            </div>
            <div class="navigation">
                <button id="prev">❮</button>
                <button id="next">❯</button>
            </div>
        </div>

        <div id="login-dis">
            <div id="wel-track">Welcome to TrackMaster</div>

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
            <form action="<?php echo ROOT ?>/loginController/login" method="POST">
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
            <div class="or"><a href="<?php echo ROOT ?>/signUpController/selectrole">Register Here</a></div>

        </div>

        <div class="popup">
            <div id="frogetPW-port">
                <span id="login-port-logo">
                    <img src="../../public/assets/icon/logo-black.png" alt="trackmaster logo">
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


        function showCustomAlert(message) {
            document.getElementById('customAlertMessage').innerText = message;
            document.getElementById('customAlertOverlay').style.display = 'block';
        }

        function hideCustomAlert() {
            document.getElementById('customAlertOverlay').style.display = 'none';
        }

        // Show the alert if a success message exists
        window.onload = function() {
            var successMessage = "<?php echo addslashes($successMessage); ?>";
            if (successMessage) {
                showCustomAlert(successMessage);
            }
        };
        </script>

    </div>

    <div id="customAlertOverlay" style="display: none;">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
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