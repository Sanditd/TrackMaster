<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
        }
        
        header {
            background-color: #000000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #007bff;
        }
        
        .nav-links img {
            height: 24px;
            cursor: pointer;
        }
        
        .login {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .login:hover {
            background-color: #0056b3;
        }

        .openbtn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
        }

        .button {
        margin-left: 30px;
        width: 40px;
        height: 40px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgb(44, 44, 44);
        border-radius: 50%;
        cursor: pointer;
        transition-duration: .3s;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.13);
        border: none;
        }

        .bell {
        width: 18px;
        }

        .bell path {
        fill: white;
        }

        .button:hover {
        background-color: rgb(56, 56, 56);
        }

        .button:hover .bell {
        animation: bellRing 0.9s both;
        }

        @keyframes bellRing {
        0%,
        100% {
            transform-origin: top;
        }

        15% {
            transform: rotateZ(10deg);
        }

        30% {
            transform: rotateZ(-10deg);
        }

        45% {
            transform: rotateZ(5deg);
        }

        60% {
            transform: rotateZ(-5deg);
        }

        75% {
            transform: rotateZ(2deg);
        }
        }

        .button:active {
        transform: scale(0.8);
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
            }
            
            .nav-links {
                flex-direction: column;
                width: 100%;
                background-color: white;
                position: fixed;
                top: 0;
                left: -100%;
                height: 100vh;
                padding-top: 60px;
                transition: left 0.3s ease;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            }
            
            .nav-links.active {
                left: 0;
            }
            
            .nav-links li {
                margin: 15px 0;
                width: 100%;
                text-align: center;
            }
        }
    </style>
    <script>
        function toggleNav() {
            document.getElementById("navbar").classList.toggle("active");
            const navLinks = document.querySelector(".nav-links");
            navLinks.classList.toggle("active");
        }
    </script>
</head>
<body>
    <header>
        <button class="openbtn" onclick="toggleNav()">☰</button>
        <nav class="navbar" id="navbar">
            <div class="logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="TrackMaster Logo">
            </div>
            <ul class="nav-links">
                <li><a href="<?php echo URLROOT ?>/student/dashboard">Dashboard</a></li>
                <li><a href="<?php echo URLROOT ?>/common/aboutUs">About Us</a></li>
                <li><a href="<?php echo URLROOT ?>/common/help">Help & Support</a></li>
                
                <li><button class="login" onclick="window.location.href='<?php echo URLROOT ?>/loginController/logout'">Logout</button></li>
                <!-- From Uiverse.io by vinodjangid07 --> 
                <button class="button">
                    <svg viewBox="0 0 448 512" class="bell"><path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"></path></svg>
                </button>
            </ul>
        </nav>
    </header>
</body>
</html>
