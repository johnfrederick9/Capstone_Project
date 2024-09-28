document.addEventListener("DOMContentLoaded", function() {
    const currentDate = new Date();
    const currentMonth = currentDate.getMonth();
    const currentYear = currentDate.getFullYear();

    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const daysInMonth = (month, year) => new Date(year, month + 1, 0).getDate();

    function renderCalendar(month, year) {
        const calendarGrid = document.querySelector(".calendar-grid");
        const calendarHeader = document.querySelector("#calendar h3");
        
        // Set month and year title
        calendarHeader.textContent = `${monthNames[month]} ${year}`;

        // Clear previous calendar content
        calendarGrid.innerHTML = "";

        // Calculate the day of the week the month starts on
        const firstDay = new Date(year, month, 1).getDay();

        // Fill in the blank spaces for the days before the first of the month
        for (let i = 0; i < firstDay; i++) {
            const blankDay = document.createElement("div");
            blankDay.classList.add("calendar-date");
            calendarGrid.appendChild(blankDay);
        }

        // Fill in the days of the month
        for (let day = 1; day <= daysInMonth(month, year); day++) {
            const dateElement = document.createElement("div");
            dateElement.classList.add("calendar-date");
            dateElement.textContent = day;
            calendarGrid.appendChild(dateElement);
        }
    }

    // Initial render of the calendar
    renderCalendar(currentMonth, currentYear);
});
