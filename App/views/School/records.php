<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/School/records.css">

</head>
<body>

<?php require 'navbar.php'; ?>
<?php require 'sidebar.php'; ?>
        
    <div class="dashboard-container">
        <div class="dashboard-header">
           <center> <h1>Acedemic records </h1> </center><br> 
        </div>

        

        <div class="main-content">
            <div class="section recent-clients">
                <h2>Student List</h2>
                <form class="formcontent" onsubmit="" >
                    <ul>
                        <li>
                            <label for="studentName">Student Name:</label>
                            <select id="studentName">
                                <option>Morty Smith</option>
                                <option>Rick Sanchez</option>
                                <option>Paul Hewmatt</option>
                                <option>Sheen Estevez</option>
                                <option>John Doe</option>
                            </select>
                        </li>
                        <li>
                            <label for="grade">Grade:</label>
                            <input type="text" id="grade" placeholder="Enter grade">
                        </li>
                        <li>
                            <label for="term">Term:</label>
                            <input type="text" id="term" placeholder="Enter term">
                        </li>
                        <li>
                            <label for="average">Average:</label>
                            <input type="number" id="average" placeholder="Enter average">
                        </li>
                        <li>
                            <label for="rank">Rank:</label>
                            <input type="number" id="rank" placeholder="Enter rank">
                        </li>
                    </ul>
                    <button type="submit">Submit</button>
                </form>
            </div>

            
            <div class="section recent-clients">
                <h2>Students</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Grade</th>
                            <th>Term</th>
                            <th>Average</th>
                            <th>Rank</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        <!-- Dynamically added rows will appear here -->
                        <tr>
                            <td>John Doe</td>
                            <td class="editable">A</td>
                            <td class="editable">Term 1</td>
                            <td class="editable">90</td>
                            <td class="editable">1</td>
                            <td>
                                <button class="action-btn edit-btn" onclick="editRow(this)">Edit</button>
                                <button class="action-btn delete-btn" onclick="deleteRow(this)">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td class="editable">B</td>
                            <td class="editable">Term 2</td>
                            <td class="editable">85</td>
                            <td class="editable">3</td>
                            <td>
                                <button class="action-btn edit-btn" onclick="editRow(this)">Edit</button>
                                <button class="action-btn delete-btn" onclick="deleteRow(this)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        
            

        </div>
    </div>

    <script src="/Public/js/School/record.js"></script>
    <script src="/Public/js/School/submit.js"></script>

    <?php include './../footer.php'?>
</body>