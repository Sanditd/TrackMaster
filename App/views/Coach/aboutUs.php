<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="/TrackMaster/Public/css/about.css">
</head>

<body>

    <?php require 'CoachNav.php'?>


<div class="about">

        <div class="intro">
            <h1>Welcome to TRACKMASTER</h1>
            <p>The Ultimate Platform Designed to Transform the Way Schools, Coaches, Students, and Parents Collaborate in Nurturing Athletic Excellence.</p>
        </div>

        <h3>Who We Serve?</h3>

        <div class="vision_mission">
            <div class="card">
                    <img src="/TrackMaster/Public/img/about4.jpeg" alt="students">
                <div class="content">
                    <h4>STUDENTS</h4>
                    <p>Take charge of your athletic journey! Track your growth, showcase your achievements, and stay updated on schedules and events.</p>
                </div>
            </div>
            <div class="card">
                    <img src="/TrackMaster/Public/img/about7.jpeg" alt="coaches">
                <div class="content">
                    <h4>COACHES</h4>
                    <p>Gain valuable insights into your athletes’ progress with real-time performance data and history. Plan better training schedules, monitor student fitness, and focus on areas of improvement with ease.</p>
                </div>
            </div>
            <div class="card">
                    <img src="/TrackMaster/Public/img/about5.jpeg" alt="parents">
                <div class="content">
                    <h4>PARENTS</h4>
                    <p>Be an active part of your child’s athletic journey. Get instant updates on schedules, health reports, and progress. Stay informed and support your child’s growth every step of the way.</p>
                </div>
            </div>
            <div class="card">
                    <img src="/TrackMaster/Public/img/about6.jpeg" alt="schools">
                <div class="content">
                    <h4>SCHOOLS</h4>
                    <p> Foster collaboration between coaches, students, and parents to create a thriving sports culture in your institution.</p>
                </div>
            </div>    
        </div>

        <script>
        function toggleContent(element) {
            let content = element.querySelector(".content");
            content.style.bottom = content.style.bottom === "0px" ? "-100%" : "0px";
        }
        </script>

    <section class="box">
                <center><p>"...Our Mission is to Simplify Sports Management through Innovation, Ensuring Every Student-Athlete is Empowered to Excel Both On and Off the Field and Gets the Guidance, Structure, and Support Needed to Reach Their Goals..."<p></center>
    </section>

    <div class="why">
    <img class="image" src="/TrackMaster/Public/img/about1.jpeg" alt="about">
    <div class = "users">
    <h3>Why Choose TrackMaster?</h3>
        <ul class="list-inline" id="features">
            <li>Comprehensive Features:</li>
                <p>From tracking progress to scheduling and communication, TrackMaster has it all.<p>
            <li>User-Friendly Interface:</li> 
                <p>Designed with simplicity and ease of use for all age groups.<p>
            <li>Secure & Reliable:</li>
                <p> Your data is safe with us, ensuring complete privacy and security.<p>
            <li>Empowering Every Stakeholder:</li> 
                <p>Ensures students, coaches, parents, and schools work together seamlessly.</p>
        </ul>
    </div>
    </div>

    <div class="outro">
    <section class="box">
                <center>
                <p>"...We Believe that Every Student-Athlete Has the Potential to Shine, and We try to Provide the Tools and Insights Needed to Unleash Their Full Capabilities..." </p>    
                </center>
    </section>
    <img class="images" src="/TrackMaster/Public/img/about2.jpeg" alt="about">
    </div>

    <h5>With a Focus on Streamlined Communication, Performance Tracking, and Holistic Development, </br>We Bring Together All Stakeholders on a Unified Platform to Ensure no Talent Goes Unnoticed...</h5>


    

</div>

<?php require 'footer.php'; ?>

</body>
</html>
