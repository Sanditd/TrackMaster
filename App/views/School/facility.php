<!DOCTYPE html>
<html>
<head>
    <title>School Facilities Update Form</title>
    <style>
        body {
            background-color: #f3f3f3;
        }
        * {
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #002a5c;
            color: white;
            padding: 20px;
            text-align: center;
            max-width: 1200px;
            margin: 30px auto 0;
        }
        .form-container {
            background-color: white;
            max-width: 700px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.15);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .checkbox-group label {
            font-weight: normal;
        }
        .btn-submit {
            background-color: #ffa500;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #e69500;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 20px auto;
            max-width: 700px;
            border: 1px solid #c3e6cb;
            text-align: center;
        }
    </style>
</head>
<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>

<div class="header">
    <h1>Update School Facilities</h1>
</div>

<?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div class="success-message">
        ✅ Data updated successfully!
    </div>
<?php endif; ?>

<div class="form-container">
    <form method="post" action="<?php echo URLROOT; ?>/school/facilityForm">
        <div class="form-group">
            <label>Facility Type</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="facilityType[]" value="Track"> Track</label>
                <label><input type="checkbox" name="facilityType[]" value="Indoor"> Indoor</label>
                <label><input type="checkbox" name="facilityType[]" value="Ground"> Ground</label>
                <label><input type="checkbox" name="facilityType[]" value="Swimming Pool"> Swimming Pool</label>
                <label><input type="checkbox" name="facilityType[]" value="Other"> Other</label>
            </div>
            <input type="text" name="otherFacility" placeholder="Specify if Other">
        </div>

        <div class="form-group">
            <label>Facility Name</label>
            <input type="text" name="facilityName">
        </div>

        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location">
        </div>

        <div class="form-group">
            <label>Date Established</label>
            <input type="date" name="dateEstablished">
        </div>

        <div class="form-group">
            <label>Size / Area</label>
            <input type="text" name="size" placeholder="e.g. 100m track, 50x30m court">
        </div>

        <div class="form-group">
            <label>Current Condition</label>
            <select name="condition">
                <option value="">Select</option>
                <option>Excellent</option>
                <option>Good</option>
                <option>Needs Repair</option>
                <option>Damaged</option>
            </select>
        </div>

        <div class="form-group">
            <label>Capacity / Max Users</label>
            <input type="number" name="capacity">
        </div>

        <div class="form-group">
            <label>Schedule Notes / Time Restrictions</label>
            <textarea name="scheduleNotes" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>Remarks / Notes</label>
            <textarea name="remarks" rows="3"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>

<?php require 'C:/xampp/htdocs/TrackMaster/App/views/footer.php'; ?>

</body>
</html>
