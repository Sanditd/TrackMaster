<!DOCTYPE html>
<html>
<head>
    <title>School Facilities Update Form</title>
    <style>
        body {
            background-color: #f3f3f3;
        }
        *{
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
    </style>
</head>
<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>

    <div class="header">
        <h1>Update School Facilities</h1>
    </div>

    <div class="form-container">
        <form>
            <div class="form-group">
                <label>Facility Type</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="facilityType" value="Track"> Track</label>
                    <label><input type="checkbox" name="facilityType" value="Indoor"> Indoor</label>
                    <label><input type="checkbox" name="facilityType" value="Ground"> Ground</label>
                    <label><input type="checkbox" name="facilityType" value="Swimming Pool"> Swimming Pool</label>
                    <label><input type="checkbox" name="facilityType" value="Other"> Other</label>
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
                <label>Availability Status</label>
                <select name="status">
                    <option value="">Select</option>
                    <option>Available</option>
                    <option>In Use</option>
                    <option>Reserved</option>
                    <option>Under Maintenance</option>
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
                <label>Last Maintenance Date</label>
                <input type="date" name="lastMaintenance">
            </div>

            <div class="form-group">
                <label>Issues Identified</label>
                <textarea name="issues" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Repairs Done</label>
                <textarea name="repairs" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Maintenance Cost</label>
                <input type="number" name="maintenanceCost" step="0.01">
            </div>

            <div class="form-group">
                <label>Next Scheduled Maintenance</label>
                <input type="date" name="nextMaintenance">
            </div>

            <div class="form-group">
                <label>Upload Facility Photos</label>
                <input type="file" name="photos" multiple>
            </div>

            <div class="form-group">
                <label>Updated By</label>
                <input type="text" name="updatedBy">
            </div>

            <div class="form-group">
                <label>Date of Update</label>
                <input type="date" name="updateDate" value="<?= date('Y-m-d'); ?>">
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

</body>
</html>
