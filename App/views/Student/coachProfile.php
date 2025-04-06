<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Profile</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/profile.css">

</head>
<body>

<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>

    <div id="main">
        
    <div class="container">
        <div class="header">
            <h2>Coach Profile</h2>
        </div>
        <div class="profile-form">
            <div class="left-section">
                <div class="profile-picture">
                    <img src="/TrackMaster/Public/img/profile.jpeg" alt="Profile Picture">
                </div>
                <div class="input-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" value="Sandith" readonly>
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" value="Moras" readonly>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="sandith@gmail.com" readonly>
                </div>
                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" value="0764911397" readonly>
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" value="55/4A, Pirivena Road, Ratmalana" readonly>
                </div>
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" disabled>
                        <option selected>Male</option>
                        <option>Female</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="birthday">Birthday</label>
                    <input type="date" id="birthday" value="2008-01-16" readonly>
                </div>

                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea id="description" rows="16" readonly >"Experienced cricket coach with over 10 years of expertise in developing and mentoring young athletes. Skilled in building strong team dynamics, enhancing individual performance, and creating personalized training plans to help players reach their highest potential. Passionate about fostering a positive and disciplined environment that encourages growth, resilience, and sportsmanship. Proven track record in leading teams to victory in regional and national tournaments. Dedicated to supporting each player's journey from beginner to elite athlete."</textarea>               
                </div>

                <div class="input-group">
                    <label for="educational-qualifications">Educational Qualifications</label>
                    <textarea id="educational-qualifications" rows="16" readonly >Master's in Sports Science, Mumbai University (2005)
Advanced Diploma in Sports Management, National Sports Institute (2007)
ICC Level 3 Coaching Certification
BCCI High-Performance Coaching Diploma
                    </textarea>               
                </div>

            </div>

            <div class="right-section">
                <div class="input-group">
                    <label for="playing-experience">Professional Playing Experience</label>
                    <textarea id="playing-experience" rows="16" readonly >Played First-Class Cricket for Maharashtra State Team (1998-2010)
                                                                           Right-handed Opening Batsman
                                                                        Scored over 4,500 runs in domestic cricket
                                                                        Represented Mumbai Indians in early IPL seasons
                    </textarea>               
                </div>

                <div class="input-group">
                    <label for="coaching-experience">Coaching Experience</label>
                    <textarea id="coaching-experience" rows="16" readonly >Head Coach, Mumbai Junior Cricket Academy (2012-2018)
                                                                            Assistant Coach, Maharashtra State Cricket Team (2015-2020)
                                                                            Currently Head Coach, Mumbai Ranji Trophy Team (2020-Present)
                                                                            Youth Development Coach for BCCI Talent Hunt Program
                    </textarea>               
                </div>

                <div class="input-group">
                    <label for="technical-specializations">Technical Specializations</label>
                    <textarea id="technical-specializations" rows="16" readonly >Batting Technique Specialist
                                                                                Performance Analysis Expert
                                                                                Strength and Conditioning Coach
                                                                                Mental Conditioning Consultant
                    </textarea>               
                </div>

                <div class="input-group">
                    <label for="key-achievements">Key Achievements</label>
                    <textarea id="key-achievements" rows="16" readonly >Developed 12 players who went on to play national-level cricket
                                                                                Led Maharashtra team to Ranji Trophy semi-finals (2022)
                                                                        Recognized as "Coach of the Year" by Maharashtra Cricket Association (2021)
                    </textarea>               
                </div>

            </div>
        </div>
    </div>

    </div>

    <?php require 'footer.php'; ?>

</body>
</html>