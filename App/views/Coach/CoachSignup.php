<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Coach</title>
    <link rel="stylesheet" href="../../Public/css/Coach/CoachSignup.css">
</head>
<body>
    <div id="signup-port">
        <span id="signup-port-logo">
            <img src="../../public/assets/icon/logo-black.png" alt="TrackMaster Logo">
        </span>
        <h2>Sign Up - Coach</h2>
        <form id="signup-form" action = "<?php echo URLROOT?>Coach/signup" method="POST">

            <div class="form-row">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Enter First Name">
                    <span class="form-invalid"><?php echo $data['firstname_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Enter Last Name" required>
                    <span class="form-invalid"><?php echo $data['lastname_err']; ?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" required>
                    <span class="form-invalid"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required>
                    <span class="form-invalid"><?php echo $data['phone_err']; ?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Create Password</label>
                    <input type="password" id="password" name="password" placeholder="Create Password" required>
                    <span class="form-invalid"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                    <span class="form-invalid"><?php echo $data['confirm-password_err']; ?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter Address" required>
                    <span class="form-invalid"><?php echo $data['address_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" required>
                    <span class="form-invalid"><?php echo $data['dob_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="sport">Sport</label>
                    <input type="text" id="sport" name="sport" placeholder="Enter Sport" required>
                    <span class="form-invalid"><?php echo $data['sport_err']; ?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="zone">Zone</label>
                    <input type="text" id="zone" name="zone" placeholder="Enter Zone" required>
                    <span class="form-invalid"><?php echo $data['zone_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Enter Description"></textarea>
                </div>
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
