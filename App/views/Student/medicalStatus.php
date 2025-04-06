<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History</title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/Student/medStatus.css">
</head>
<body>

<?php require 'navbar.php'?>
<?php require 'sidebar.php'?>

<div id="main">

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

    
    <div class="table-section">
            <h2>Current Medical Status</h2>
            <p><strong>Last updated:</strong> 2021-03-24</p>
            <p><strong>Medical Conditions:</strong> None</p>
            <p><strong>Medication:</strong> None</p>
            <p><strong>Notes:</strong> None</p>
            </div> 
</div>

<!-- Modal for Adding Medical Record -->
<div id="medicalModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add a New Medical Record</h2>
        <form action="<?php echo ROOT?>/student/saveMedicalStatus" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">

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

<?php require 'footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("medicalModal");
    const openModalButton = document.getElementById("openModal");
    const closeModalButton = document.querySelector(".close");
    const mainContent = document.getElementById("main");

    openModalButton.addEventListener("click", function () {
        modal.style.display = "flex";
        mainContent.classList.add("blur"); 
    });

    closeModalButton.addEventListener("click", function () {
        modal.style.display = "none";
        mainContent.classList.remove("blur"); 
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
            mainContent.classList.remove("blur");
        }
    });
});
</script>

</body>
</html>
