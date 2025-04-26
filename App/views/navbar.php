<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color:rgb(0, 0, 0);
            --secondary-color: #ffa500;
            --light-color: #f8f9fa;
            --dark-color: #333;
            --gray-color: #666;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 38, 77, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva commences, Verdana, sans-serif;
        }

        body {
            color: var(--dark-color);
        }

        header {
            background-color: var(--primary-color);
            box-shadow: var(--box-shadow);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            width: 20%;
            height: 60px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .nav-links {
            display: flex;
            list-style: none;
            align-items: center;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: #ffffff;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .nav-links a:hover {
            background: var(--secondary-color);
            color: #ffffff;
        }

        .login {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .login:hover {
            background-color: #cc8400;
        }

        .openbtn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
            color: white;
        }

        .button {
            margin-left: 30px;
            width: 40px;
            height: 40px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--dark-color);
            border-radius: 50%;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--box-shadow);
            border: none;
        }

        .bell {
            width: 18px;
        }

        .bell path {
            fill: white;
        }

        .button:hover {
            background-color: var(--gray-color);
        }

        .button:hover .bell {
            animation: bellRing 0.9s both;
        }

        @keyframes bellRing {
            0%, 100% { transform-origin: top; }
            15% { transform: rotateZ(10deg); }
            30% { transform: rotateZ(-10deg); }
            45% { transform: rotateZ(5deg); }
            60% { transform: rotateZ(-5deg); }
            75% { transform: rotateZ(2deg); }
        }

        .button:active {
            transform: scale(0.8);
        }

        .notification-icon {
            width: 33px;
            height: 33px;
            margin-left: 10px;
            margin-top: 10px;
            filter: brightness(150%);
        }

        @media (max-width: 768px) {
            .openbtn {
                display: block;
                position: absolute;
                left: 15px;
                top: 15px;
                z-index: 101;
            }

            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .logo {
                margin: 0 auto;
                padding: 10px 0;
                width: 40%;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                background-color: var(--primary-color);
                position: fixed;
                top: 0;
                left: -100%;
                height: 100vh;
                padding-top: 80px;
                transition: left 0.3s ease;
                z-index: 100;
            }

            .nav-links.active {
                left: 0;
            }

            .nav-links li {
                margin: 15px 0;
                width: 100%;
                text-align: center;
            }

            .nav-links .button {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <button class="openbtn" onclick="toggleNav()"><i class="fas fa-bars"></i></button>
            <div class="logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="TrackMaster Logo">
            </div>
            <ul class="nav-links">
                <li><a href="<?php echo URLROOT ?>/student/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="<?php echo URLROOT ?>/common/aboutUs"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li><a href="<?php echo URLROOT ?>/common/help"><i class="fas fa-question-circle"></i> Help & Support</a></li>
                <li>
                    <button class="login" onclick="window.location.href='<?php echo URLROOT ?>/loginController/logout'">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
            </ul>
        </nav>
    </header>
    <script>
        function toggleNav() {
            const navLinks = document.querySelector(".nav-links");
            navLinks.classList.toggle("active");
        }
    </script>
</body>
</html>