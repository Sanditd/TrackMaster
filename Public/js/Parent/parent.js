document.addEventListener('DOMContentLoaded', function () {
    // Approve Financial Report
    document.getElementById('approve-report').addEventListener('click', function () {
        alert('Financial report approved.');
    });

    // Absence Notification Form Submission
    document.getElementById('absence-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const date = document.getElementById('date').value;
        const activity = document.getElementById('activity').value;
        const reason = document.getElementById('reason').value;

        if (date && activity && reason) {
            alert(`Absence for ${activity} on ${date} has been notified. Reason: ${reason}`);
            document.getElementById('absence-form').reset();
        } else {
            alert('Please fill in all the fields.');
        }
    });
});
