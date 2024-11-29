<?php
    require_once 'nav.php';
    $nav = new Nav();
?>

<!DOCTYPE html>
<html>

<head>

    <title>Signup</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/Public/css/Admin/login.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/Public/css/Admin/signup.css">
    <style>
    /* Modal (popup) styles */
    .popup {
        display: none;
        /* position: fixed; */
        top: 80px;
        left: 0;
        width: 100%;
        height: 100%;
        /* background-color: rgba(0, 0, 0, 0.5); */
        justify-content: center;
        align-items: center;

    }

    .popup-content {
        background-color: white;
        margin-top: 150px;
        padding: 20px;
        border-radius: 5px;
        width: 400px;
        max-width: 100%;
    }

    .close-popup {
        cursor: pointer;
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        margin-top: 10px;
    }
    </style>

</head>

<body>

    <?php $nav->render(); ?>

    <div class="container">
        <h1>Signup</h1>


        <!-- Role Selection -->
        <h2>Select Your Role</h2>
        <div class="roles">
            <div class="role" data-role="Coach">Coach</div>
            <div class="role" data-role="Player">Player</div>
            <div class="role" data-role="School">School</div>
            <div class="role" data-role="Parent">Parent</div>
        </div>
    </div>

    <!-- Popup Modal -->
    <div class="popup" id="signupPopup">
        <div class="popup-content">
            <h2>Signup Form</h2>
            <form method="POST" action="<?php echo ROOT ?>/signUpController/Signup/sfdf">
                <!-- Hidden input to store selected role -->
                <input type="hidden" id="role" name="role" value="">

                <!-- Common Fields -->
                <div class="common-fields">
                    <input type="text" id="firstName" placeholder="First Name" name="fname" required>
                    <input type="text" id="lastName" placeholder="Last Name" name="lname" required>
                    <input type="text" id="userName" placeholder="User Name" name="uname" required>
                    <input type="tel" id="phone" placeholder="Phone Number" name="pnum" required>
                    <input type="text" id="address" placeholder="Address" name="address" required>
                    <input type="email" id="email" placeholder="Email" name="email" required>
                    <input type="password" id="password" placeholder="Password" name="password" required>
                    <input type="password" id="confirmPassword" placeholder="Confirm Password" name="cpassword"
                        required>
                </div>

                <!-- Role-Specific Fields (Initially Hidden) -->
                <div id="coach-fields" class="role-specific-fields" style="display: none;">
                    <label for="coach_type">Coach Type</label>
                    <select name="coach_type" id="coach_type" onchange="toggleCoachType()" required>
                        <option value="divisional">Divisional</option>
                        <option value="provincial">Provincial</option>
                        <option value="national">National</option>
                    </select>

                    <!-- Divisional Coach Options -->
                    <div id="divisional_options" style="display: none;">
                        <select name="division" id="division" required>
                            <?php
                    if (!empty($data['divisions'])) {
                        foreach ($data['divisions'] as $division) {
                            echo "<option value='{$division->divisionId}'>{$division->divName}</option>";
                        }
                    } else {
                        echo "<option disabled>No divisions available</option>";
                    }
                    ?>
                        </select>
                    </div>
                    <!-- Provincial Coach Options -->
                    <div id="provincial_options" style="display: none;">
                        <select name="province" required id="province">
                            <?php
                    if (!empty($data['provinces'])) {
                        foreach ($data['provinces'] as $province) {
                            echo "<option value='{$province->provincialId}'>{$province->proName}</option>";
                        }
                    } else {
                        echo "<option disabled>No Provinces available</option>";
                    }
                    ?>
                        </select>
                    </div>

                    <label for="description">Description</label>
                    <textarea name="description" placeholder="Describe your coaching experience" required></textarea>

                    <label for="sport">Select Sport</label>
                    <select name="sport" required>
                        <?php
                    if (!empty($data['sports'])) {
                        foreach ($data['sports'] as $sport) {
                            echo "<option value='{$sport->sportId}'>{$sport->sportName}</option>";
                        }
                    } else {
                        echo "<option disabled>No Sport available</option>";
                    }
                    ?>
                    </select>
                </div>

                <div id="player-fields" class="role-specific-fields" style="display: none;">
                    <label for="sport">Select Sport</label>
                    <select name="sport" required>
                        <?php
                    if (!empty($data['sports'])) {
                        foreach ($data['sports'] as $sport) {
                            echo "<option value='{$sport->sportId}'>{$sport->sportName}</option>";
                        }
                    } else {
                        echo "<option disabled>No Sport available</option>";
                    }
                    ?>
                    </select>
                    <label for="division">Select Division</label>
                    <select name="division" id="division" required>
                        <?php
                    if (!empty($data['divisions'])) {
                        foreach ($data['divisions'] as $division) {
                            echo "<option value='{$division->divisionId}'>{$division->divName}</option>";
                        }
                    } else {
                        echo "<option disabled>No divisions available</option>";
                    }
                    ?>
                    </select>

                    <label for="school">Select School</label>
                    <select name="school" id="school" required>
                        <?php
                    if (!empty($data['schools'])) {
                        foreach ($data['schools'] as $school) {
                            echo "<option value='{$school->schoolId}'>{$school->schoolName}</option>";
                        }
                    } else {
                        echo "<option disabled>No School available</option>";
                    }
                    ?>
                    </select>

                    <label for="age">Age</label>
                    <input type="number" name="age" required>

                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" required>

                    <label for="level">Level</label>
                    <select name="level" required>
                        <option value="divisional">Divisional</option>
                        <option value="provincial">Provincial</option>
                        <option value="national">National</option>
                    </select>
                </div>

                <div id="school-fields" class="role-specific-fields" style="display: none;">
                    <label for="profile_photo">Upload Profile Photo</label>
                    <input type="file" name="profile_photo" required>
                </div>

                <div id="parent-fields" class="role-specific-fields" style="display: none;">
                    <label for="student">Select Student/Player</label>
                    <input type="text" name="student" placeholder="Search Student" required>

                    <label for="student">Select Student</label>
                    <select name="student" required>
                        <!-- Dynamically populated schools -->
                    </select>
                </div>

                <button type="submit" >Submit</button>
                <button type="button" class="close-popup">Cancel</button>
            </form>
        </div>
    </div>

    <script>
    // Handle role selection
    const roles = document.querySelectorAll('.role');
    const roleInput = document.getElementById('role');
    const roleSpecificFields = document.querySelectorAll('.role-specific-fields');
    const popup = document.getElementById('signupPopup');
    const closePopup = document.querySelector('.close-popup');

    roles.forEach(role => {
        role.addEventListener('click', () => {
            const selectedRole = role.getAttribute('data-role');
            console.log('Selected role:', selectedRole);
            // Set the selected role to the hidden input
            roleInput.value = selectedRole;

            // Show the popup
            popup.style.display = 'flex';

            // Show role-specific fields based on selection
            roleSpecificFields.forEach(field => {
                field.style.display = 'none'; // Hide all role-specific fields
            });

            const selectedRoleFields = document.getElementById(`${selectedRole.toLowerCase()}-fields`);
            if (selectedRoleFields) {
                selectedRoleFields.style.display = 'block'; // Show the selected role's fields
            }
        });
    });

    // Close popup
    closePopup.addEventListener('click', () => {
        popup.style.display = 'none'; // Hide the popup
    });

    // Function to toggle visibility of coach-specific options
    function toggleCoachType() {
        const coachType = document.getElementById('coach_type').value;
        const divisionalOptions = document.getElementById('divisional_options');
        const provincialOptions = document.getElementById('provincial_options');

        // Reset visibility
        divisionalOptions.style.display = 'none';
        provincialOptions.style.display = 'none';

        // Show the appropriate options based on the selected coach type
        if (coachType === 'divisional') {
            divisionalOptions.style.display = 'block';
        } else if (coachType === 'provincial') {
            provincialOptions.style.display = 'block';
        }
    }
    </script>

</body>

</html>