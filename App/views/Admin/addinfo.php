<?php
    require_once 'nav.php';
    $nav = new Nav();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/login.css">
    <link rel="stylesheet" href="<?php echo ROOT?>/Public/css/Admin/signup.css">
</head>
<?php $nav->render(); ?>

<body>

    <div class="container">
        <h1>Additional Information</h1>

        <form method="POST" action="<?php echo ROOT ?>/signUpController/Signup" enctype="multipart/form-data">

            <!-- Common Fields (for all roles) -->
            <label for="profile_photo">Upload Profile Photo</label>
            <input type="file" name="profile_photo" required>
     

            <?php if ($data['role'] == 'Coach'): ?>
            <!-- Coach Specific Fields -->
            <label for="coach_type">Coach Type</label>
            <select name="coach_type" id="coach_type" required onchange="toggleCoachType()" placeholder="Select Type">
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

            <?php elseif ($data['role'] == 'Player'): ?>
            <!-- Player Specific Fields -->
            <label for="sport">Select Sport</label>
            <select name="sport" required>
                <?php
                foreach ($sports as $sport) {
                    echo "<option value='{$sport['id']}'>{$sport['name']}</option>";
                }
                ?>
            </select>

            <label for="division">Select Division</label>
            <select name="division" required>
                <?php
                foreach ($divisions as $division) {
                    echo "<option value='{$division['id']}'>{$division['name']}</option>";
                }
                ?>
            </select>

            <label for="school">Select School</label>
            <select name="school" required>
                <?php
                foreach ($schools as $school) {
                    echo "<option value='{$school['id']}'>{$school['name']}</option>";
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

            <?php elseif ($data['role'] == 'School'): ?>
            <!-- School Specific Fields -->
            <label for="profile_photo">Upload Profile Photo</label>
            <input type="file" name="profile_photo" required>

            <?php elseif ($data['role'] == 'Parent'): ?>
            <!-- Parent Specific Fields -->
            <label for="student">Select Student/Player</label>
            <input type="text" name="student" placeholder="Search Student" required>

            <label for="sport">Select Sport</label>
            <select name="sport" required>
                <?php
                foreach ($sports as $sport) {
                    echo "<option value='{$sport['id']}'>{$sport['name']}</option>";
                }
                ?>
            </select>

            <label for="school">Select School</label>
            <select name="school" required>
                <?php
                foreach ($schools as $school) {
                    echo "<option value='{$school['id']}'>{$school['name']}</option>";
                }
                ?>
            </select>

            <?php endif; ?>

            <!-- Submit Button -->
            <button type="submit">Submit</button>
        </form>
    </div>

</body>

<script>
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

</html>
