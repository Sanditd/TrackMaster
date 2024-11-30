<?php if (isset($_SESSION['error'])): ?>
    <div class="error"><?php echo $_SESSION['error']; ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up - Student</title>
        <link rel="stylesheet" href="../Public/css/Coach/CoachSignup.css">
    </head>
    <body>
        <div id="signup-port">
            <span id="signup-port-logo">
                <img src="../Public/img/logo-black.png" alt="TrackMaster Logo">
            </span>
            <h2>Sign Up - School</h2>
            <form method="POST" action="<?php echo ROOT; ?>/signupcontroller/schoolsignup" enctype="multipart/form-data">

            
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Enter First Name">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Enter Last Name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter Username" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Create Password</label>
                        <input type="password" id="password" name="password" placeholder="Create Password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter Address" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required>
        
                    </div>
                    <div class="form-group">
                        <label for="sport">Age</label>
                        <input type="text" id="age" name="age" placeholder="Enter Age" required>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div> 
                    <div class="form-group">
                    <label for="photo">Upload Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required>
                </div>
                </div>
                
                <div class="form-row">
                <div class="form-group">
                        <label for="school_name">School Name</label>
                        <input type="text" id="school_name" name="school_name" placeholder="Enter School Name">
                    </div>
                    <div class="form-group">
                        <label for="school_email">School Email</label>
                        <input type="school_email" id="school_email" name="school_email" placeholder="Enter Email" required>
                    </div>
                </div>
                <div class="form-row">
                <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" placeholder="Enter a brief biography" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="facilities">Professioanl Experience</label>
                        <textarea id="facilities" name="facilities" placeholder="facilities" rows="3" required></textarea>
                    </div>
                </div>

                <button type="submit">Sign Up</button>
            </form>
        </div>
    </body>
    </html>
