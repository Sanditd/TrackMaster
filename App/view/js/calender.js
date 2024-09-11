document.addEventListener('DOMContentLoaded', function() {
    const calendarHeader = document.querySelector('.calendar-header span');
    const calendarGrid = document.querySelector('.calendar-grid');
    const prevButton = document.querySelector('.calendar-header button:first-child');
    const nextButton = document.querySelector('.calendar-header button:last-child');

    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    const events = {
 
    };

    function renderCalendar(month, year) {
        calendarGrid.innerHTML = '';

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        calendarHeader.textContent = `${monthNames[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('date');
            calendarGrid.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dateCell = document.createElement('div');
            dateCell.classList.add('date');
            const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

            if (events[dateString]) {
                dateCell.classList.add('event');
                dateCell.innerHTML = `${day}<br><span>${events[dateString]}</span>`;
            } else {
                dateCell.textContent = day;
            }

            calendarGrid.appendChild(dateCell);
        }
    }

    prevButton.addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    nextButton.addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    renderCalendar(currentMonth, currentYear);
});
