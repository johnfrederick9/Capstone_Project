document.addEventListener("DOMContentLoaded", function () {
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();  // 0 = January
    let currentYear = currentDate.getFullYear();  // e.g., 2024

    const monthNames = ["January", "February", "March", "April", "May", "June", 
                        "July", "August", "September", "October", "November", "December"];

    // Function to fetch events from the database
    function fetchEvents(callback) {
        fetch('../../pages/dashboard/fetch_events.php')
            .then(response => response.json())
            .then(data => {
                const filteredEvents = data.filter(event => isEventValid(event)); // Filter past events
                callback(filteredEvents);
            })
            .catch(err => console.error('Error fetching events:', err));
    }

    // Check if an event is valid (i.e., in the current or future months)
    function isEventValid(event) {
        const eventDate = new Date(event.event_end);  // Use the event's end date
        const today = new Date();

        // Return true if the event ends in the current or future month
        return eventDate.getFullYear() > today.getFullYear() || 
               (eventDate.getFullYear() === today.getFullYear() && eventDate.getMonth() >= today.getMonth());
    }

    // Render the calendar for a given month and year
    function renderCalendar(month, year, events) {
        const calendarGrid = document.querySelector(".calendar-grid");
        const calendarHeader = document.querySelector("#calendar h3");

        calendarHeader.textContent = `${monthNames[month]} ${year}`;
        calendarGrid.innerHTML = "";  // Clear previous content

        // Add day headers
        ['S', 'M', 'T', 'W', 'T', 'F', 'S'].forEach(day => {
            const dayEl = document.createElement('div');
            dayEl.classList.add('calendar-day');
            dayEl.textContent = day;
            calendarGrid.appendChild(dayEl);
        });

        const firstDay = new Date(year, month, 1).getDay();
        const totalDays = new Date(year, month + 1, 0).getDate();

        // Add empty cells before the first day of the month
        for (let i = 0; i < firstDay; i++) {
            calendarGrid.appendChild(document.createElement('div'));
        }

        // Add days and highlight if there are events
        for (let day = 1; day <= totalDays; day++) {
            const date = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const dayEl = document.createElement('div');
            dayEl.classList.add('calendar-date');
            dayEl.textContent = day;

            // Check if any event matches this date
            const event = events.find(e => e.event_start <= date && e.event_end >= date);
            if (event) {
                dayEl.classList.add('has-event');
                dayEl.addEventListener('click', () => showEventDetails(event));
            }

            calendarGrid.appendChild(dayEl);
        }
    }

    // Show event details in an alert (you can replace this with a modal if needed)
    function showEventDetails(event) {
        alert(`Event: ${event.event_name}\nLocation: ${event.event_location}\nType: ${event.event_type}\nDate: ${event.event_start} to ${event.event_end}`);
    }

    // Handle month changes
    function changeMonth(offset) {
        currentMonth += offset;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        } else if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        fetchEvents(events => renderCalendar(currentMonth, currentYear, events));
    }

    // Event listeners for month navigation
    document.getElementById("nextMonth").addEventListener("click", () => changeMonth(1));
    document.getElementById("prevMonth").addEventListener("click", () => changeMonth(-1));

    // Initial load of the calendar with events
    fetchEvents(events => renderCalendar(currentMonth, currentYear, events));
});
