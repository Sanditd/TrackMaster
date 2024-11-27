document.querySelector(".formcontent").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get form data
    const studentName = document.getElementById("studentName").value;
    const grade = document.getElementById("grade").value;
    const term = document.getElementById("term").value;
    const average = document.getElementById("average").value;
    const rank = document.getElementById("rank").value;

    // Validate inputs (optional)
    if (!studentName || !grade || !term || !average || !rank) {
        alert("Please fill in all fields");
        return;
    }

    // Call function to add new student row to the table
    addStudentRow(studentName, grade, term, average, rank);

    // Clear the form
    document.getElementById("grade").value = "";
    document.getElementById("term").value = "";
    document.getElementById("average").value = "";
    document.getElementById("rank").value = "";
});
