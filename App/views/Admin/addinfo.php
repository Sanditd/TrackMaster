<?php
    require_once 'nav.php';
    $nav = new Nav();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" href="../../Public/css/Admin/login.css">
    <link rel="stylesheet" href="../../Public/css/Admin/signup.css">
</head>
<?php $nav->render(); ?>

<body>

<div class="container">
    <h1>Additional Information</h1>

    <form method="POST" action="<?php echo ROOT ?>/loginController/Signup" enctype="multipart/form-data">
        
        <!-- Common Fields (for all roles) -->
        <label for="profile_photo">Upload Profile Photo</label>
        <input type="file" name="profile_photo" required>
        <?echo $data?>

        <?php if ($data['role'] == 'coach'): ?>
            <!-- Coach Specific Fields -->
            <label for="coach_type">Coach Type</label>
            <select name="coach_type" required>
                <option value="divisional">Divisional</option>
                <option value="provincial">Provincial</option>
                <option value="national">National</option>
            </select>

            <label for="description">Description</label>
            <textarea name="description" placeholder="Describe your coaching experience" required></textarea>

            <label for="division">Select Division</label>
            <select name="division" required>
                <?php
                foreach ($divisions as $division) {
                    echo "<option value='{$division['id']}'>{$division['name']}</option>";
                }
                ?>
            </select>

            <label for="sport">Select Sport</label>
            <select name="sport" required>
                <?php
                foreach ($sports as $sport) {
                    echo "<option value='{$sport['id']}'>{$sport['name']}</option>";
                }
                ?>
            </select>

        <?php elseif ($data['role'] == 'player'): ?>
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

        <?php elseif ($data['role'] == 'school'): ?>
            <!-- School Specific Fields -->
            <label for="profile_photo">Upload Profile Photo</label>
            <input type="file" name="profile_photo" required>

        <?php elseif ($data['role'] == 'parent'): ?>
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
</html>
