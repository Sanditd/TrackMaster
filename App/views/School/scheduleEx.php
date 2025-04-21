<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Extra Class Request</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f4f4f9;
        }

        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }

        .request-form {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .request-form h2 {
            font-size: 20px;
            color: #00264d;
            margin-bottom: 20px;
            border-bottom: 2px solid #ffa500;
            display: inline-block;
            padding-bottom: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        .form-actions {
            margin-top: 20px;
            text-align: right;
        }

        .form-actions button {
            background-color: #ffa500;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .form-actions button:hover {
            background-color: #e69500;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="request-form">
            <h2>Schedule Extra Class Request</h2>
            <form method="post" action="<?php echo URLROOT; ?>/school/scheduleEx">


                <div class="form-group">
                    <label for="players">Select Players</label>
                    <select id="players" name="players[]" multiple>
    <option>Player 1</option>
    <option>Player 2</option>
    <option>Player 3</option>
    <option>Player 4</option>
</select>

                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Enter subject">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" placeholder="Write a brief description"></textarea>
                </div>

                <div class="form-group">
                    <label for="date">Class Date</label>
                    <input type="date" id="date" name="date">
                </div>

                <div class="form-group">
                    <label for="venue">Venue</label>
                    <input type="text" id="venue" name="venue" placeholder="Enter class venue">
                </div>

                <div class="form-actions">
                    <button type="submit">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
