
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

    <div class="container">
        <h1>Signup</h1>


        <!-- Role Selection -->
        <h2>Select Your Role</h2>
        <div class="roles">
            <div class="role" data-role="Coach"><a href="<?php echo ROOT ?>/signupcontroller/coachsignupview">Coach</a></div>
            <div class="role" data-role="Player"><a href="<?php echo ROOT ?>/signupcontroller/studentsignupview">Player</a></div>
            <div class="role" data-role="School"><a href="<?php echo ROOT ?>/signupcontroller/schoolsignupview">School</a></div>
            <div class="role" data-role="Parent">Parent</div>
        </div>
    </div>
</body>