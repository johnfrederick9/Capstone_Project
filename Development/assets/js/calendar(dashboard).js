document.addEventListener("DOMContentLoaded", function() {
    // Initialize current month and year
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();  // 0 (January) to 11 (December)
    let currentYear = currentDate.getFullYear();  // e.g., 2024

    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const daysInMonth = (month, year) => new Date(year, month + 1, 0).getDate();  // Number of days in a month

    // Render the calendar for the given month and year
    function renderCalendar(month, year) {
        const calendarGrid = document.querySelector(".calendar-grid");
        const calendarHeader = document.querySelector("#calendar h3");

        // Update the month and year in the calendar header
        calendarHeader.textContent = `${monthNames[month]} ${year}`;

        // Clear the previous calendar content
        calendarGrid.innerHTML = "";

        // Add day names
        const dayNames = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
        dayNames.forEach(day => {
            const dayElement = document.createElement('div');
            dayElement.classList.add('calendar-day');
            dayElement.textContent = day;
            calendarGrid.appendChild(dayElement);
        });

        // Get the day the month starts on
        const firstDay = new Date(year, month, 1).getDay();

        // Add empty spaces before the first day of the month
        for (let i = 0; i < firstDay; i++) {
            const blankDay = document.createElement("div");
            blankDay.classList.add("calendar-date");
            calendarGrid.appendChild(blankDay);
        }

        // Add the days of the month
        for (let day = 1; day <= daysInMonth(month, year); day++) {
            const dateElement = document.createElement("div");
            dateElement.classList.add("calendar-date");
            dateElement.textContent = day;
            calendarGrid.appendChild(dateElement);
        }
    }

    // Move to the next month
    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {  // If December, move to January of next year
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    }

    // Move to the previous month
    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {  // If January, move to December of previous year
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    }

    // Add event listeners for the next and previous buttons
    document.getElementById("nextMonth").addEventListener("click", nextMonth);
    document.getElementById("prevMonth").addEventListener("click", prevMonth);

    // Initial render of the calendar
    renderCalendar(currentMonth, currentYear);
});
