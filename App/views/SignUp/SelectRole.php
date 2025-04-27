<?php
    require_once __DIR__ . '/../Admin/nav.php';
    $nav = new Nav();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        :root {
            --primary-color: rgb(0, 7, 13);
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-color);
            color: var(--dark-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
        
        /* Main Content */
        #main-container {
            display: flex;
            flex: 1;
            padding: 20px;
        }
        
        /* Container setup */
        .signup-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }
        
        /* Left side with information */
        .info-side {
            flex: 1;
            padding: 40px;
            background-color: white;
            display: flex;
            flex-direction: column;
        }
        
        .title {
            font-size: 32px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 20px;
            position: relative;
        }
        
        .title:after {
            content: "";
            position: absolute;
            width: 100px;
            height: 4px;
            background-color: var(--secondary-color);
            left: 0;
            bottom: -10px;
            border-radius: 2px;
        }
        
        /* Right side with role selection */
        .role-selection {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        #TLogo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        #TLogo img {
            height: 70px;
        }
        
        /* Style for the roles list */
        .roles {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
            max-width: 400px;
        }
        
        /* Style for each role */
        .role {
            background-color: white;
            padding: 15px 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            color: var(--dark-color);
            font-size: 18px;
            font-weight: 500;
            border: 1px solid #eee;
        }
        
        .role:hover {
            background: rgb(152, 210, 255);
            box-shadow: 0 0 20px 5px hsl(215, 100%, 76.5%);
            color: black;
        }
        
        /* Preview section */
        .preview-section {
            flex: 1;
            position: relative;
            overflow: hidden;
            min-height: 500px;
            background-color: #f5f7fa;
        }
        
        .color {
            height: 25%;
            width: 100%;
            background-position: center;
            background-size: cover;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
            font-size: 1.2rem;
        }
        
        .color:hover {
            height: 40%;
        }
        
        /* Info text at bottom of preview */
        #preview-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: var(--dark-color);
        }
        
        /* Social media links */
        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }
        
        .socialContainer {
            width: 52px;
            height: 52px;
            border-radius: 5px;
            background-color: rgb(44, 44, 44);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: var(--transition);
            cursor: pointer;
        }
        
        .containerOne:hover {
            background-color: #d62976;
        }
        
        .containerTwo:hover {
            background-color: #25f4ee;
        }
        
        .containerThree:hover {
            background-color: #1877f2;
        }
        
        .containerFour:hover {
            background-color: green;
        }
        
        .socialContainer:active {
            transform: scale(0.9);
        }
        
        .socialSvg {
            width: 19px;
            fill: white;
        }
        
        .largeIcon {
            width: 27px;
        }
        
        /* Custom Alert */
        #customAlertOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        #customAlertBox {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        #customAlertBox h2 {
            margin-top: 0;
            color: var(--primary-color);
        }
        
        #customAlertBox button {
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 14px;
            margin-top: 20px;
            transition: var(--transition);
        }
        
        #customAlertBox button:hover {
            background-color: #001a33;
        }
        
        /* Back to login link */
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
        
        /* Responsive design */
        @media (max-width: 992px) {
            .signup-container {
                flex-direction: column;
            }
            
            .preview-section {
                min-height: 300px;
            }
        }
    </style>
</head>

<body>
    <!-- Using the nav from login page -->
    <nav>
        <div class="llogo">
            <img src="<?php echo ROOT; ?>/Public/img/logo.png" alt="TrackMaster Logo">
        </div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
    </nav>

    <div id="main-container">
        <div class="signup-container">
            <div class="info-side">
                <h1 class="title">Welcome to TrackMaster</h1>
                <p>
                    Join our community and experience the best way to track and improve your athletic performance.
                    Whether you're a coach, player, school representative, or parent, we have the tools you need.
                </p>
                <br><br>    
                <div class="preview-section">
                    <div class="color" id="Coach" style="background-image: url('<?php echo ROOT; ?>/public/img/roles/coach.jpeg');">
                        <span>Coaches</span>
                    </div>
                    <div class="color" id="Player" style="background-image: url('<?php echo ROOT; ?>/public/img/roles/players.jpeg');">
                        <span>Players</span>
                    </div>
                    <div class="color" id="School" style="background-image: url('<?php echo ROOT; ?>/public/img/roles/school.jpeg');">
                        <span>Schools</span>
                    </div>
                    <div class="color" id="Parent" style="background-image: url('<?php echo ROOT; ?>/public/img/roles/parents.jpeg');">
                        <span>Parents</span>
                    </div>
                    <div id="preview-info">
                        <div id="desc">Hover over a role to learn more</div>
                    </div>
                </div>
            </div>
            
            <div class="role-selection">
                <div id="TLogo">
                    <img src="<?php echo ROOT?>/Public/img/logo-black.png" alt="trackmaster logo">
                </div>
                <h1 class="title">Signup</h1>
                <h2>Select Your Role</h2>
                
                <div class="roles">
                    <a href="<?php echo ROOT ?>/signupcontroller/coachsignupview" class="role" data-role="Coach" onmouseover="showInfo('Coach')" onmouseout="hideInfo()">
                        Coach
                    </a>
                    
                    <a href="<?php echo ROOT ?>/signupcontroller/studentsignupview" class="role" data-role="Player" onmouseover="showInfo('Player')" onmouseout="hideInfo()">
                        Player
                    </a>
                    
                    <a href="<?php echo ROOT ?>/signupcontroller/schoolsignupview" class="role" data-role="School" onmouseover="showInfo('School')" onmouseout="hideInfo()">
                        School
                    </a>
                    
                    <div class="role" data-role="Parent" onmouseout="hideInfo()" onmouseover="showInfo('Parent')" onclick="showCustomAlert()">
                        Parent
                    </div>
                </div>
                
                <div class="social-links">
                    <a href="#" class="socialContainer containerOne">
                        <svg class="socialSvg instagramSvg" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z">
                            </path>
                        </svg>
                    </a>

                    <a href="#" class="socialContainer containerTwo">
                        <svg class="socialSvg tiktokSvg largeIcon" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>Tiktok</title>
                            <g id="Icon/Social/tiktok-white" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M38.0766847,15.8542954 C36.0693906,15.7935177 34.2504839,14.8341149 32.8791434,13.5466056 C32.1316475,12.8317108 31.540171,11.9694126 31.1415066,11.0151329 C30.7426093,10.0603874 30.5453728,9.03391952 30.5619062,8 L24.9731521,8 L24.9731521,28.8295196 C24.9731521,32.3434487 22.8773693,34.4182737 20.2765028,34.4182737 C19.6505623,34.4320127 19.0283477,34.3209362 18.4461858,34.0908659 C17.8640239,33.8612612 17.3337909,33.5175528 16.8862248,33.0797671 C16.4386588,32.6422142 16.0833071,32.1196657 15.8404292,31.5426268 C15.5977841,30.9658208 15.4727358,30.3459348 15.4727358,29.7202272 C15.4727358,29.0940539 15.5977841,28.4746337 15.8404292,27.8978277 C16.0833071,27.3207888 16.4386588,26.7980074 16.8862248,26.3604545 C17.3337909,25.9229017 17.8640239,25.5791933 18.4461858,25.3491229 C19.0283477,25.1192854 19.6505623,25.0084418 20.2765028,25.0219479 C20.7939283,25.0263724 21.3069293,25.1167239 21.794781,25.2902081 L21.794781,19.5985278 C21.2957518,19.4900128 20.7869423,19.436221 20.2765028,19.4380839 C18.2431278,19.4392483 16.2560928,20.0426009 14.5659604,21.1729264 C12.875828,22.303019 11.5587449,23.9090873 10.7814424,25.7878401 C10.003907,27.666593 9.80084889,29.7339663 10.1981162,31.7275214 C10.5953834,33.7217752 11.5748126,35.5530237 13.0129853,36.9904978 C14.4509252,38.4277391 16.2828722,39.4064696 18.277126,39.8028054 C20.2711469,40.1991413 22.3382874,39.9951517 24.2163416,39.2169177 C26.0948616,38.4384508 27.7002312,37.1209021 28.8296253,35.4300711 C29.9592522,33.7397058 30.5619062,31.7522051 30.5619062,29.7188301 L30.5619062,18.8324027 C32.7275484,20.3418321 35.3149087,21.0404263 38.0766847,21.0867664 L38.0766847,15.8542954 Z" id="Fill-1" fill="#FFFFFF"></path>
                            </g>
                        </svg>
                    </a>

                    <a href="#" class="socialContainer containerThree">
                        <svg class="socialSvg" width="19px" height="19px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.9,2H3.1A1.1,1.1,0,0,0,2,3.1V20.9A1.1,1.1,0,0,0,3.1,22h9.58V14.25h-2.6v-3h2.6V9a3.64,3.64,0,0,1,3.88-4,20.26,20.26,0,0,1,2.33.12v2.7H17.3c-1.26,0-1.5.6-1.5,1.47v1.93h3l-.39,3H15.8V22h5.1A1.1,1.1,0,0,0,22,20.9V3.1A1.1,1.1,0,0,0,20.9,2Z" fill="#FFFFFF"/>
                        </svg>
                    </a>

                    <a href="#" class="socialContainer containerFour">
                        <svg class="socialSvg whatsappSvg" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
                            </path>
                        </svg>
                    </a>
                </div>
                
                <div class="back-link">
                    <a href="<?php echo ROOT?>/loginController/login">Back to login page</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Alert for Parent role -->
    <div id="customAlertOverlay">
        <div id="customAlertBox">
            <h2>Notice</h2>
            <p>Please Contact Your Child's Coach for Account Creation.</p>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
    </div>

    <script>
        // Data for role descriptions
        const roleData = {
            Coach: {
                description: 'Coaches guide and train players to achieve their best performance. Track player progress, create training plans, and analyze performance metrics.'
            },
            Player: {
                description: 'Players participate in games and represent their teams with dedication. Track your personal progress, view training schedules, and stay connected with your team.'
            },
            School: {
                description: 'Schools manage teams and provide support for various sporting activities. Coordinate multiple teams, communicate with coaches, and monitor overall performance.'
            },
            Parent: {
                description: 'Parents support their children\'s development and growth in sports. Stay updated on your child\'s progress and communicate with coaches.'
            }
        };

        // Show info when hovering over a role 
        function showInfo(role) {
            const description = document.getElementById('desc');
            const roleElement = document.getElementById(role);
            
            if (roleData[role]) {
                description.textContent = roleData[role].description;
                roleElement.style.height = '40%';
            }
        }

        // Hide info when mouse leaves
        function hideInfo() {
            document.querySelectorAll('.color').forEach(element => {
                element.style.height = '25%';
            });
        }

        // Show custom alert for parent role
        function showCustomAlert() {
            document.getElementById('customAlertOverlay').style.display = 'flex';
        }

        // Hide custom alert
        function hideCustomAlert() {
            document.getElementById('customAlertOverlay').style.display = 'none';
        }
    </script>
</body>

</html>