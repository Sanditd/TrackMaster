<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/Public/css/Admin/login.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/Public/css/Admin/signup.css">
    <style>
        /* Base Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #00264d;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            color: #00264d;
            margin-bottom: 20px;
            border-bottom: 2px solid #ffa500;
            display: inline-block;
            padding-bottom: 5px;
        }

        h2 {
            font-size: 1.5rem;
            color: #00264d;
            margin: 20px 0;
        }

        /* Role Selection */
        .roles {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .role {
            background-color: #ffa500;
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-size: 1rem;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .role a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .role:hover {
            background-color: #e67600;
            transform: translateY(-5px);
        }

        /* Modal (popup) styles */
        .popup {
            display: none;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            max-width: 100%;
            text-align: center;
        }

        .close-popup {
            cursor: pointer;
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            margin-top: 10px;
        }

        /* Link Styling */
        a {
            text-decoration: none;
            color: #ffa500;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #00264d;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Signup</h1>

        <!-- Role Selection -->
        <h2>Select Your Role</h2>
        <div class="roles">
            <div class="role"><a href="<?php echo ROOT ?>/signupcontroller/coachsignupview">Coach</a></div>
            <div class="role"><a href="<?php echo ROOT ?>/signupcontroller/studentsignupview">Player</a></div>
            <div class="role"><a href="<?php echo ROOT ?>/signupcontroller/schoolsignupview">School</a></div>
            <div class="role"><a href="<?php echo ROOT ?>/signupcontroller/parentsignupview">Parent</a></div>
        </div>
    </div>

</body>

</html>
        