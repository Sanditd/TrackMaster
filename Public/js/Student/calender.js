const monthYearElement = document.getElementById("monthYear");
const datesElement = document.getElementById("dates");
const prevMonthButton = document.getElementById("prevMonth");
const nextMonthButton = document.getElementById("nextMonth");
const noteModal = document.getElementById("noteModal");
const noteInput = document.getElementById("noteInput");
const saveNoteButton = document.getElementById("saveNote");
const closeModalButton = document.getElementById("closeModal");

let currentDate = new Date();
let notes = {}; // Stores notes as { 'YYYY-MM-DD': 'Note content' }
let selectedDate = null;

// Load notes from localStorage
function loadNotes() {
    const savedNotes = localStorage.getItem('calendarNotes');
    if (savedNotes) {
        notes = JSON.parse(savedNotes);
    }
}

// Save notes to localStorage
function saveNotesToStorage() {
    localStorage.setItem('calendarNotes', JSON.stringify(notes));
}

function formatDateKey(year, month, day) {
    return `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
}

function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const today = new Date();

    // Update month and year display with animation
    monthYearElement.style.opacity = '0';
    setTimeout(() => {
        monthYearElement.textContent = `${date.toLocaleString("default", { month: "long" })} ${year}`;
        monthYearElement.style.opacity = '1';
    }, 150);

    // Get first day and total days of the month
    const firstDay = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();
    
    // Get the last day of the previous month
    const prevMonthDays = new Date(year, month, 0).getDate();

    datesElement.innerHTML = "";

    // Add days from previous month (grayed out)
    for (let i = 0; i < firstDay; i++) {
        const dayDiv = document.createElement("div");
        dayDiv.textContent = prevMonthDays - firstDay + i + 1;
        dayDiv.classList.add("prev-month-day");
        dayDiv.style.color = "#cccccc"; // Light gray color
        datesElement.appendChild(dayDiv);
    }

    // Add day numbers for current month
    for (let i = 1; i <= totalDays; i++) {
        const dayDiv = document.createElement("div");
        dayDiv.textContent = i;

        const dateKey = formatDateKey(year, month, i);

        // Apply styles based on date conditions
        if (
            today.getFullYear() === year &&
            today.getMonth() === month &&
            today.getDate() === i
        ) {
            dayDiv.classList.add("current");
        } else if (
            year > today.getFullYear() || 
            (year === today.getFullYear() && month > today.getMonth()) ||
            (year === today.getFullYear() && month === today.getMonth() && i > today.getDate())
        ) {
            dayDiv.classList.add("upcoming");
        }

        // Use full background for dates with notes
        if (notes[dateKey]) {
            dayDiv.classList.add("has-note");
            dayDiv.setAttribute("title", notes[dateKey].substring(0, 30) + (notes[dateKey].length > 30 ? "..." : "")); // Truncate long notes in tooltip
        }

        // Add click event for creating notes with animation
        dayDiv.addEventListener("click", () => {
            dayDiv.style.transform = "scale(0.9)";
            setTimeout(() => {
                dayDiv.style.transform = "scale(1)";
                openNoteModal(dateKey, i);
            }, 150);
        });

        datesElement.appendChild(dayDiv);
    }

    // Fill remaining slots with next month days (grayed out)
    const totalCells = 42; // 6 rows of 7 days
    const remainingCells = totalCells - (firstDay + totalDays);
    
    if (remainingCells > 0 && remainingCells < 7) { // Only add if there's a partial row
        for (let i = 1; i <= remainingCells; i++) {
            const dayDiv = document.createElement("div");
            dayDiv.textContent = i;
            dayDiv.classList.add("next-month-day");
            dayDiv.style.color = "#cccccc"; // Light gray color
            datesElement.appendChild(dayDiv);
        }
    }
}

function openNoteModal(dateKey, day) {
    selectedDate = dateKey;
    noteInput.value = notes[dateKey] || "";
    
    // Format the date for display
    const dateParts = dateKey.split('-');
    const dateObj = new Date(parseInt(dateParts[0]), parseInt(dateParts[1]) - 1, parseInt(dateParts[2]));
    const formattedDate = dateObj.toLocaleString('default', { 
        weekday: 'long', 
        month: 'long', 
        day: 'numeric',
        year: 'numeric'
    });
    
    document.getElementById("noteTitle").textContent = `Note for ${formattedDate}`;
    noteModal.classList.remove("hidden");
    
    // Focus on the textarea
    setTimeout(() => {
        noteInput.focus();
    }, 300);
}

function closeNoteModal() {
    noteModal.classList.add("hidden");
}

function saveNote() {
    if (noteInput.value.trim()) {
        notes[selectedDate] = noteInput.value.trim();
    } else {
        delete notes[selectedDate]; // Remove note if input is empty
    }
    
    // Save to localStorage
    saveNotesToStorage();
    
    renderCalendar(currentDate);
    closeNoteModal();
}

// Month navigation with animation
prevMonthButton.addEventListener("click", () => {
    prevMonthButton.style.transform = "scale(0.9)";
    setTimeout(() => {
        prevMonthButton.style.transform = "scale(1)";
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    }, 150);
});

nextMonthButton.addEventListener("click", () => {
    nextMonthButton.style.transform = "scale(0.9)";
    setTimeout(() => {
        nextMonthButton.style.transform = "scale(1)";
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    }, 150);
});

// Add keyboard event listeners
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !noteModal.classList.contains("hidden")) {
        closeNoteModal();
    }
    
    if (e.key === "Enter" && e.ctrlKey && !noteModal.classList.contains("hidden")) {
        saveNote();
    }
});

closeModalButton.addEventListener("click", closeNoteModal);
saveNoteButton.addEventListener("click", saveNote);

// Load notes from localStorage on startup
loadNotes();

// Initial render
renderCalendar(currentDate);