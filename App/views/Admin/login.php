<?php
    //require " echo ROOT/config/init.php";
    //require " echo ROOT/core/init.php";
    require_once 'nav.php';
    $nav = new Nav();
?>

<!DOCTYPE html>
<html lang="en">
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

if (isset($_SESSION['error_message'])) {
    $successMessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Remove the message after retrieving it
} else {
    $successMessage = "";
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrackMaster Login</title>
    <style>
        :root {
            --primary-color:rgb(0, 7, 13);
            --secondary-color: #ffa500;
            --light-color: #f8f9fa;
            --dark-color: #333;
            --gray-color: #666;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 38, 77, 0.1);
            --transition: all 0.3s ease;
            --success-color: #28a745;
            --error-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-color);
            color: var(--dark-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        #main-container {
            display: flex;
            flex-direction: row;
            height: calc(100vh - 70px);
        }
        
        /* Navigation Bar */
        nav {
            background-color: var(--primary-color);
            padding: 15px 30px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        nav .logo img {
            height: 40px;
        }
        
        nav .nav-links {
            display: flex;
            gap: 20px;
        }
        
        nav .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        nav .nav-links a:hover {
            color: var(--secondary-color);
        }
        
        /* Login Display Section */
        #login-dis {
            flex: 1;
            padding: 40px;
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        #wel-track {
            font-size: 32px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 30px;
            position: relative;
        }
        
        #wel-track:after {
            content: "";
            position: absolute;
            width: 100px;
            height: 4px;
            background-color: var(--secondary-color);
            left: 0;
            bottom: -10px;
            border-radius: 2px;
        }
        
        #wel-dis {
            line-height: 1.6;
            color: var(--gray-color);
            margin-bottom: 30px;
            font-size: 15px;
        }
        
        /* Slider */
        .slider {
            flex: 1;
            position: relative;
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }
        
        .slides {
            display: flex;
            transition: transform 0.5s ease;
            height: 100%;
        }
        
        .slides img {
            min-width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .navigation {
            position: absolute;
            bottom: 30px;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        
        .navigation button {
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            color: var(--dark-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .navigation button:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }
        
        /* Login Form */
        #login-port {
            width: 400px;
            padding: 40px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 40px;
        }
        
        #login-port-logo {
            margin-bottom: 30px;
            display: block;
            text-align: center;
        }
        
        #login-port-logo img {
            height: 60px;
        }
        
        #login-port form {
            width: 100%;
        }
        
        #login-port input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 14px;
            transition: var(--transition);
        }
        
        #login-port input:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 2px rgba(255, 165, 0, 0.2);
        }
        
        #login-port button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 20px;
        }
        
        #login-port button[type="submit"]:hover {
            background-color: #001a33;
        }
        
        .or {
            text-align: center;
            margin: 15px 0;
            color: var(--gray-color);
        }
        
        #frogetPW-button {
            background: none;
            border: none;
            color: var(--info-color);
            cursor: pointer;
            text-decoration: underline;
            font-size: 14px;
        }
        
        #login-port a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        /* Social Login */
        .social-login {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 15px;
        }
        
        .social-login button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .facebook {
            background-color: #3b5998;
            color: white;
        }
        
        .google {
            background-color: #db4437;
            color: white;
        }
        
        .linkedin {
            background-color: #0077b5;
            color: white;
        }
        
        /* Popup for Forgot Password */
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        #frogetPW-port {
            background-color: white;
            padding: 30px;
            border-radius: var(--border-radius);
            width: 400px;
            box-shadow: var(--box-shadow);
        }
        
        #frogetPW-port div:nth-child(2) {
            font-size: 18px;
            font-weight: bold;
            margin: 15px 0;
            color: var(--primary-color);
        }
        
        .close-popup {
            background-color: var(--gray-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            margin-top: 15px;
            transition: var(--transition);
        }
        
        .close-popup:hover {
            background-color: var(--dark-color);
        }
        
        /* Custom Alert */
        #customAlertOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        #customAlertBox {
            background-color: white;
            padding: 30px;
            border-radius: var(--border-radius);
            width: 400px;
            text-align: center;
            box-shadow: var(--box-shadow);
        }
        
        #customAlertBox h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        
        #customAlertBox button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            margin-top: 20px;
            cursor: pointer;
            transition: var(--transition);
        }
        
        #customAlertBox button:hover {
            background-color: #001a33;
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            #main-container {
                flex-direction: column;
                height: auto;
            }
            
            .slider {
                height: 300px;
            }
            
            #login-port {
                width: 90%;
                margin: 20px auto;
            }
            
            #login-dis {
                padding: 20px;
            }
        }
        
        /* New user section style */
        .new-user-section {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: var(--border-radius);
            text-align: center;
            max-width: 250px;
        }
        
        .new-user-section h2 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .new-user-section p {
            margin-bottom: 15px;
            font-size: 14px;
            color: var(--gray-color);
        }
        
        .sign-up-btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
        }
        
        .sign-up-btn:hover {
            background-color: #e69500;
        }

        .llogo {
            width: 20%;
            height: 60px;
            transition: var(--transition);
        }

        .llogo img {
            width: 95%;
            height: 95%;
            object-fit: cover;
        }

        .llogo:hover {
            transform: scale(1.05);
        }

        /* Improved Forgot Password Popup Styling */
.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    backdrop-filter: blur(3px);
}

#frogetPW-port {
    background-color: white;
    padding: 40px;
    border-radius: var(--border-radius);
    width: 400px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    position: relative;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

#frogetPW-port #login-port-logo {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

#frogetPW-port #login-port-logo img {
    height: 50px;
}

#frogetPW-port form div:first-of-type {
    font-size: 22px;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 25px;
    text-align: center;
    position: relative;
}

#frogetPW-port form div:first-of-type:after {
    content: "";
    position: absolute;
    width: 60px;
    height: 3px;
    background-color: var(--secondary-color);
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    border-radius: 2px;
}

#frogetPW-port form input {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    font-size: 14px;
    transition: var(--transition);
}

#frogetPW-port form input:focus {
    outline: none;
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 2px rgba(255, 165, 0, 0.2);
}

#frogetPW-port form button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    font-weight: bold;
    cursor: pointer;
    transition: var(--transition);
    margin-top: 10px;
}

#frogetPW-port form button[type="submit"]:hover {
    background-color: #001a33;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 38, 77, 0.2);
}

.close-popup {
    background-color: transparent;
    color: var(--gray-color);
    border: 1px solid #ddd;
    padding: 10px 20px;
    border-radius: var(--border-radius);
    cursor: pointer;
    margin-top: 15px;
    transition: var(--transition);
    width: 100%;
    font-weight: 500;
}

.close-popup:hover {
    background-color: #f5f5f5;
    color: var(--dark-color);
}

/* Add a close X in the corner */
#frogetPW-port .close-x {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 18px;
    color: var(--gray-color);
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    transition: var(--transition);
}

#frogetPW-port .close-x:hover {
    color: var(--dark-color);
}

/* Additional helper text */
#frogetPW-port .helper-text {
    font-size: 13px;
    color: var(--gray-color);
    margin-top: -15px;
    margin-bottom: 20px;
    text-align: left;
}
    </style>
</head>
<body id="loginbody">
    <nav>
    <div class="llogo">
                <img src="/TrackMaster/Public/img/logo.png" alt="TrackMaster Logo">
            </div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
    </nav>

    <div id="main-container">
        <div id="login-dis">
            <div id="wel-track">Welcome to TrackMaster</div>
            <div id="wel-dis">
                Whether you're an aspiring athlete striving to break personal records or a seasoned professional aiming for peak performance, TrackMaster is your ultimate partner in achieving success. Our platform is designed to empower athletes of all levels with the tools and insights they need to excel.
                <br><br>
                With TrackMaster, you can monitor your progress in real-time, set meaningful goals, and gain valuable insights into your training routines. Whether it's tracking your daily workouts, measuring improvements in endurance, or analyzing intricate performance metrics, TrackMaster ensures you have the data and support necessary to make informed decisions and push beyond your limits.
                <br><br>
                Our cutting-edge technology doesn't just help you train—it transforms the way you approach your sport. From creating personalized training plans to celebrating milestones, we're here every step of the way to keep you motivated and on track.
            </div>
        </div>

        <div class="slider">
            <div class="slides">
            <img src="<?php echo ROOT; ?>/public/img/roles/coach.jpeg" alt="Slide 1">
                <img src="<?php echo ROOT; ?>/public/img/roles/players.jpeg" alt="Slide 2">
                <img src="< ?php echo ROOT; ?>/public/img/roles/school.jpeg" alt="Slide 3">
            </div>
            <div class="navigation">
                <button id="prev">❮</button>
                <button id="next">❯</button>
            </div>
            
        </div>

        <div id="login-port">
            <span id="login-port-logo">
            <img src="<?php echo ROOT?>/Public\img\logo-black.png" alt="Logo">
            </span>
            <form action="<?php echo ROOT ?>/loginController/login" method="POST">
                <div>
                    <input type="text" placeholder="Enter username" name="username" required>
                </div>
                <div>
                    <input type="password" placeholder="Enter Password" name="password" required>
                </div>
                <button type="submit">LOGIN</button>
            </form>
            
            <div class="social-login">
                <button class="facebook"><i class="fab fa-facebook-f"></i>f</button>
                <button class="google"><i class="fab fa-google"></i>G</button>
                <button class="linkedin"><i class="fab fa-linkedin-in"></i>in</button>
            </div>
            
            <div class="or">Or</div>
            <div class="or"><button id="frogetPW-button">Forgot Password</button></div>
            <div class="or"><a href="<?php echo ROOT ?>/signUpController/selectrole">Register Here</a></div>
        </div>
    </div>

    <div class="popup">
    <div id="frogetPW-port">
        <button class="close-x">&times;</button>
        <span id="login-port-logo">
        <img src="<?php echo ROOT?>/Public\img\logo-black.png" alt="Logo">
        </span>
        <form method="POST" action="/resetPasswordController/requestReset">
            <div>
                Reset Your Password
            </div>
            <div>
                <input type="text" placeholder="Enter Username" name="username" required>
            </div>
            <div>
                <input type="email" placeholder="Enter Email Address" name="email" required>
                <p class="helper-text">We'll send a verification code to this email</p>
            </div>
            <div>
                <input type="tel" placeholder="Enter Phone Number" name="phone" required>
            </div>
            <button type="submit">Send Reset Link</button>
        </form>
        <button class="close-popup">Cancel</button>
    </div>
</div>
    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p id="customAlertMessage"></p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>

    <script>
        document.querySelector(".close-popup").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "none";
    }); 
    document.querySelector(".close-x").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "none";
    });
    
    // Close popup when clicking outside
    document.querySelector(".popup").addEventListener("click", function(e) {
        if (e.target === this) {
            this.style.display = "none";
        }
    });
        
        document.getElementById("frogetPW-button").addEventListener("click", function() {
            document.querySelector(".popup").style.display = "flex";
        });

        document.querySelector(".close-popup").addEventListener("click", function() {
            document.querySelector(".popup").style.display = "none";
        });

        function showCustomAlert(message) {
            document.getElementById('customAlertMessage').innerText = message;
            document.getElementById('customAlertOverlay').style.display = 'flex';
        }

        function hideCustomAlert() {
            document.getElementById('customAlertOverlay').style.display = 'none';
        }

        // For the slider
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

        // Check for success or error messages
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            if (message) {
                showCustomAlert(message);
            }
        };
        
    </script>
</body>
</html>