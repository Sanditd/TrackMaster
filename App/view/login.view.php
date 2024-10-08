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
                <input type="text" placeholder="Enter username">
            </div>
            <div>
                <input type="password" placeholder="Enter Password">
            </div>
            <button type="submit">LOGIN</button>
        </form>
        <div class="or">Or</div>
        <div class="or"><button id="frogetPW-button">Frogot Password</button></div>

    </div>

    <div class="popup">
        <div id="frogetPW-port">
            <span id="login-port-logo">
                <img src="../../public/assets/icon/logo-black.png" alt="trackmaster logo">
            </span>
            <form>
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
        document.getElementById("frogetPW-button").addEventListener("click",function(){
            document.querySelector(".popup").style.display="flex";
        })

        document.querySelector(".close-popup").addEventListener("click", function(){
            document.querySelector(".popup").style.display = "none";
        });
    </script>

</body>

</html>