<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/medStatus.css">
</head>

<body>

<div id="main">
    <?php require 'navbar.php'?>
    <?php require 'sidebar.php'?>

    <div class="intro">
        <center>
            <h1>Student Player Medical History</h1>
        </center>
    </div>

    <div class="container">
            <div class="rate">
                <h3><i>How Are You Feeling Today...?</i></h3>
                <div class="rating">
                <input value="5" name="rating" id="star5" type="radio" />
                <label title="5 stars" for="star5">
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgOne"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgTwo"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <div class="ombre"></div>
                </label>

                <input value="4" name="rating" id="star4" type="radio" />
                <label title="4 stars" for="star4">
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgOne"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgTwo"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <div class="ombre"></div>
                </label>

                <input value="3" name="rating" id="star3" type="radio" />
                <label title="3 stars" for="star3">
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgOne"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgTwo"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <div class="ombre"></div>
                </label>

                <input value="2" name="rating" id="star2" type="radio" />
                <label title="2 stars" for="star2">
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgOne"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgTwo"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <div class="ombre"></div>
                </label>

                <input value="1" name="rating" id="star1" type="radio" />
                <label title="1 star" for="star1">
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgOne"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <svg
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2"
                    stroke="#000000"
                    fill="none"
                    viewBox="0 0 24 24"
                    height="35"
                    width="35"
                    xmlns="http://www.w3.org/2000/svg"
                    class="svgTwo"
                    >
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                    ></polygon>
                    </svg>
                    <div class="ombre"></div>
                </label>
                </div>
            </div>

            <div class="table-section">
                <h2>Current Medical Status</h2>
                <p><strong>Last updated:</strong> 2021-03-24</p>
                <p><strong>Medical Conditions:</strong> None</p>
                <p><strong>Medication:</strong> None</p>
                <p><strong>Notes:</strong> None</p>
            </div> 

            <div class="table-section">
                <h2>Things to Consider</h2>
                <p><strong>Blood Type:</strong> A+</p>
                <p><strong>Allergies:</strong> None</p>
                <p><strong>Special Notes:</strong> None</p>
                <p><strong>Emergency Contact:</strong> 071 8213324</p>
                
                <button id="openThingsModal">
                    <svg aria-hidden="true" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-width="2" stroke="#ffffff" d="M11 4H4C3.44772 4 3 4.44772 3 5V19C3 19.5523 3.44772 20 4 20H18C18.5523 20 19 19.5523 19 19V12" stroke-linejoin="round" stroke-linecap="round"></path>
                        <path stroke-width="2" stroke="#ffffff" d="M17.5 3.5C18.3284 2.67157 19.6716 2.67157 20.5 3.5C21.3284 4.32843 21.3284 5.67157 20.5 6.5L12 15L8 16L9 12L17.5 3.5Z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                    EDIT INFORMATION
                </button>
            </div>
    </div>

    <div class="table-section">
            <h2>Medical History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date Updated</th>
                        <th>Medical Condition</th>
                        <th>Medication</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>08/11/2024</td>
                        <td>Sprained Ankle</td>
                        <td>Strong Pain Killers</td>
                        <td>Reported by Dr. Smith and was advised to rest.</td>
                    </tr>
                </tbody>
            </table>
            <button id="openModal">
                <svg aria-hidden="true" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-width="2" stroke="#ffffff" d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H11M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V11.8125" stroke-linejoin="round" stroke-linecap="round"></path>
                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="#ffffff" d="M17 15V18M17 21V18M17 18H14M17 18H20"></path>
                </svg>
                ADD A NEW RECORD
            </button>
        </div>
    
</div>

<!-- Modal for Adding Medical Record -->
<div id="medicalModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeMedical">&times;</span>
        <h2>Add a New Medical Record</h2>
        <form action="saveMedicalStatus" method="POST">
            <input type="hidden" name="user_id" value="1">

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br>

            <label for="condition">Medical Condition:</label>
            <input type="text" id="condition" placeholder="Enter the Ongoing Medical Condition" name="condition" required><br>

            <label for="medication">Medication:</label>
            <textarea id="medication" placeholder="Enter the Given Medications" name="medication" required></textarea><br>

            <label for="notes">Notes:</label>
            <textarea id="notes" placeholder="Enter Additional Notes" name="notes" required></textarea><br>

            <center><button class="edit-button" type="submit">Submit</button></center>
        </form>
    </div>
</div>

<!-- Modal for Editing Things to Consider -->
<div id="thingsModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeThings">&times;</span>
        <h2>Edit Things to Consider</h2>
        <form action="saveThingsToConsider" method="POST">
            <input type="hidden" name="user_id" value="1">

            <label for="bloodType">Blood Type:</label>
            <input type="text" id="bloodType" name="bloodType" value="A+" required><br>

            <label for="allergies">Allergies:</label>
            <textarea id="allergies" name="allergies" placeholder="Enter any allergies">None</textarea><br>

            <label for="specialNotes">Special Notes:</label>
            <textarea id="specialNotes" name="specialNotes" placeholder="Enter any special notes">None</textarea><br>

            <label for="emergencyContact">Emergency Contact:</label>
            <input type="text" id="emergencyContact" name="emergencyContact" value="071 8213324" required><br>

            <center><button class="edit-button" type="submit">Save Changes</button></center>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?> 

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Medical Record Modal
    const medicalModal = document.getElementById("medicalModal");
    const openModalButton = document.getElementById("openModal");
    const closeMedicalButton = document.getElementById("closeMedical");
    const mainContent = document.getElementById("main");

    openModalButton.addEventListener("click", function() {
        medicalModal.style.display = "flex";
        mainContent.classList.add("blur");
    });

    closeMedicalButton.addEventListener("click", function() {
        medicalModal.style.display = "none";
        mainContent.classList.remove("blur");
    });

    // Things to Consider Modal
    const thingsModal = document.getElementById("thingsModal");
    const openThingsModalButton = document.getElementById("openThingsModal");
    const closeThingsButton = document.getElementById("closeThings");

    openThingsModalButton.addEventListener("click", function() {
        thingsModal.style.display = "flex";
        mainContent.classList.add("blur");
    });

    closeThingsButton.addEventListener("click", function() {
        thingsModal.style.display = "none";
        mainContent.classList.remove("blur");
    });

    // Close modals when clicking outside
    window.addEventListener("click", function(event) {
        if (event.target === medicalModal) {
            medicalModal.style.display = "none";
            mainContent.classList.remove("blur");
        }
        if (event.target === thingsModal) {
            thingsModal.style.display = "none";
            mainContent.classList.remove("blur");
        }
    });
});
</script>

</body>
</html>
