<?php
    require "../core/init.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>

<body style="background-color: #36373f;">


    <div id="nav">
        <header>
            <div id="logo">
                <img src="../../public/assets/icon/logo.png" alt="trackmaster logo">
            </div>

            <div id="nav-links">
                <span id="navicon"><img src="../../public/assets/icon/use.png" alt="how to use"></span>
                <span id="navicon"><img src="../../public/assets/icon/acc.png" alt="account icon"></span>

            </div>
        </header>
    </div>

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
            <img src="../../public/assets/icon/logo-black.png" alt="trackmaster logo">
        </span>
        <form>
            <div>
                <span class="icon"><i class="fas fa-user"></i></span>
                <input type="text" placeholder="Enter username">
            </div>
            <div>
                <span class="icon"><i class="fas fa-lock"></i></span>
                <input type="password" placeholder="Enter Password">
            </div>
            <button type="submit">LOGIN</button>
        </form>
        <div class="or">Or</div>
        <div class="or"><a href="">Frogot Password</a></div>


    </div>




</body>

</html>