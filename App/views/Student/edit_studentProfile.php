<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Profile</title>
    <link rel="stylesheet" href="/Public/css/Student/profile.css">
</head>

<body>

    <!-- Main Content -->
    <div id="main">

        <div class="container">
            <div class="header">
                <h2>My profile › Edit Profile</h2>
    
                </a>
            </div>
            <div class="profile-form">
                <div class="left-section">
                    <div class="profile-picture">
                        <img src="/Public/img/profile.jpeg" alt="Profile Picture" id="profile-pic-preview">
                        <input type="file" id="profile-pic-input" accept="image/*">
                    </div>
                    <div class="input-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" value="Eraji">
                    </div>
                    <div class="input-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" value="Thenuwara" >
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="thenuwara@gmail.com">
                    </div>
                    <div class="input-group">
                        <label for="phone">WhatsApp Number</label>
                        <input type="text" id="phone" value="0712345678">
                    </div>
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" value="55/4A, Pirivena Road, Ratmalana">
                    </div>
                    <div class="input-group">
                        <label for="gender">Gender</label>
                        <select id="gender">
                            <option selected>Female</option>
                            <option>Male</option>
                        </select>
                    </div>
    
                    <div class="input-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" id="birthday" value ="2008-01-16" >
                    </div>

                    </div>
    
                <div class="right-section">
                    
                    <div class="input-group">
                        <label for="description">Bio</label>
                        <textarea id="description" rows="16" >🏃‍♂️When I’m not on the track, you’ll probably find me relaxing with a smoothie or jamming to my favorite playlist. My motto is "Hard work beats talent when talent doesn’t work hard," and it’s what keeps me striving for greatness every day! 🚀</textarea>               
                    </div>
                    
                    <div class="input-group">
                        <label for="School">School</label>
                        <input type="text" id="school" value="Maliyadeva Balika Vidyalaya">
                    </div>
    
                    <div class="input-group">
                        <label for="Grade">Grade</label>
                        <input type="text" id="grade" value="11 - A">
                    </div>

                    <div class="input-group">
                        <label for="Guardian">Guardian</label>
                        <input type="text" id="guardian" value="T.H.C.Silva" >
                    </div>

                    <div class="btns">
                        <button  type="submit" class="edit-button">Save Changes</button>
                        <button class="edit-button" onclick="window.location.href='/App/views/Student/studentprofile.html'">Cancel</button></center>
                    </div>

                </div>
            </div>
        </div>        

    </div>

            <script src="/Public/js/Student/edit_studentprofile.js"></script>

</body>
</html>