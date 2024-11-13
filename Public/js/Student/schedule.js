// Dynamically populate schedule data
const scheduleData = [
    { date: '2024-09-18', event: 'Football Practice', time: '10:00 AM', location: 'Stadium' },
    { date: '2024-09-20', event: 'Basketball Tournament', time: '2:00 PM', location: 'School Gym' },
    { date: '2024-09-22', event: 'Swimming Training', time: '8:00 AM', location: 'Aquatic Center' }
];

function populateSchedule() {
    const scheduleBody = document.getElementById('schedule-body');
    scheduleBody.innerHTML = ''; // Clear any existing rows

    scheduleData.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${item.date}</td><td>${item.event}</td><td>${item.time}</td><td>${item.location}</td>`;
        scheduleBody.appendChild(row);
    });
}

// Form submission logic for schedule change
document.getElementById('scheduleEditForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const studentName = document.getElementById('stu_name').value;
    const eventName = document.getElementById('event_name').value;
    const eventDate = document.getElementById('event_date').value;
    const eventLocation = document.getElementById('event_location').value;
    const rescheduleReason = document.getElementById('reschedule_reason').value;

    console.log('Schedule Change Request:', {
        studentName, eventName, eventDate, eventLocation, rescheduleReason
    });

    alert('Your request for schedule change has been submitted!');
    this.reset();
});

// Form submission logic for extra class request
document.getElementById('scheduleExtraClassForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const studentName = document.getElementById('stu_name').value;
    const subjectName = document.getElementById('subject_name').value;
    const schoolName = document.getElementById('school_name').value;
    const notes = document.getElementById('notes').value;

    console.log('Extra Class Request:', {
        studentName, subjectName, schoolName, notes
    });

    alert('Your request for extra classes has been submitted!');
    this.reset();
});

// Initialize the page with the necessary data
document.addEventListener('DOMContentLoaded', function() {
    populateSchedule();
    renderCalendar();
});