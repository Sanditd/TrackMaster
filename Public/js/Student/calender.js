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

function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const today = new Date();

    monthYearElement.textContent = `${date.toLocaleString("default", { month: "long" })} ${year}`;

    // Get first day and total days of the month
    const firstDay = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();

    datesElement.innerHTML = "";

    // Add blank spaces for days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
        datesElement.innerHTML += `<div></div>`;
    }

    // Add day numbers
    for (let i = 1; i <= totalDays; i++) {
        const dayDiv = document.createElement("div");
        dayDiv.textContent = i;

        const dateKey = `${year}-${String(month + 1).padStart(2, "0")}-${String(i).padStart(2, "0")}`;

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

        // Add tooltip for notes
        if (notes[dateKey]) {
            dayDiv.style.backgroundColor = "orange";
            dayDiv.setAttribute("title", notes[dateKey]); // Add tooltip with the note
        }

        // Add click event for creating notes
        dayDiv.addEventListener("click", () => openNoteModal(dateKey));

        datesElement.appendChild(dayDiv);
    }
}

function openNoteModal(dateKey) {
    selectedDate = dateKey;
    noteInput.value = notes[dateKey] || "";
    document.getElementById("noteTitle").textContent = `Add Note for ${dateKey}`;
    noteModal.classList.remove("hidden");
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
    renderCalendar(currentDate);
    closeNoteModal();
}

prevMonthButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

nextMonthButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

closeModalButton.addEventListener("click", closeNoteModal);
saveNoteButton.addEventListener("click", saveNote);

// Initial render
renderCalendar(currentDate);