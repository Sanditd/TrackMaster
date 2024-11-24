<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Profile</title>
    <link rel="stylesheet" href="/Public/css/School/Editprofile.css">

</head>
<body>



    <div id="main">
        
    <div class="container">
        <div class="header">
            <h2>My Profile</h2>
            <a href="editSchoolProfile.html">
            <button class="edit-button">Edit My Profile</button>
         </a>
        </div>
        <div class="profile-form">
            <div class="left-section">
                <div class="profile-picture">
                    <img src="/Public/img/profile.jpeg" alt="Profile Picture">
                </div>
        
                <div class="input-group">
                    <label for="name">School Name </label>
                    <input type="text" id="first-name" value="Maliyadewa Collage, Kurunagala" readonly>
                </div>
               
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="maliyadewaclg@gmail.com" readonly>
                </div>

                <div class="input-group">
                        <label for="phone">Telephone Number</label>
                        <input type="text" id="phone" value="033-2721456" readonly>
                </div>
                
                <div class="input-group">
                    <label for="code">School Code</label>
                    <input type="text" id="number" value ="R002" readonly>
                </div>

            </div>

            <div class="right-section">

                

                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" value="Maliyadeva College, Negombo Rd, Kurunegala
                    " readonly>
                </div>

                <div class="input-group">
                    <label for="zone">Zone</label>
                    <input type="text" id="zone" value="Kurunagala" readonly>
                
                </div>

                <div class="input-group">
                    <label for="province">Select Province</label>
                    <select id="province" name="province" disabled>
                        <option value="north-western" selected>North western</option>
                        <option value="central" >Central</option>
                        <option value="eastern">Eastern</option>
                        <option value="northern">Northern</option>
                        <option value="southern">Southern</option>
                        <option value="western">Western</option>
                        <option value="uva">Uva</option>
                        <option value="sabaragamuwa">Sabaragamuwa</option>
                        <option value="north-central">North Central</option>
                    </select>
                </div>
                
                

                
                <div class="input-group">
                    <label for="facilities">Facilities Available</label>
                </div>
                    <div class="checkbox-container">
                            <label>
                                <input type="checkbox" checked disabled> Track
                            </label>
                            <label>
                                <input type="checkbox" disabled> Indoor
                            </label>
                            <label>
                                <input type="checkbox" checked disabled> Ground
                            </label>
                            <label>
                                <input type="checkbox" disabled> Swimming Pool
                            </label>
                            <label>
                                <input type="checkbox" disabled> Other
                            </label>              
                    </div>
                

            </div>
        </div>
    </div>

    </div>

    

</body>
</html>