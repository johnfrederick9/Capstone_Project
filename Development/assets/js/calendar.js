const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  eventModal = new bootstrap.Modal(document.getElementById("eventModal"), {}),
  eventStartInput = document.getElementById("event_start"),
  eventEndInput = document.getElementById("event_end");

let today = new Date();
let month = today.getMonth();
let year = today.getFullYear();
let selectedDates = [];

// Use the events passed from PHP
const existingEvents = window.existingEvents || [];

const months = [
  "January", "February", "March", "April", "May", "June", "July",
  "August", "September", "October", "November", "December"
];

// Initialize the calendar
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevMonthLastDay = new Date(year, month, 0).getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const lastWeekday = lastDay.getDay();
  const currentDay = today.getDate();
  const currentMonth = today.getMonth();
  const currentYear = today.getFullYear();

  // Set the current month and year in the header
  date.innerHTML = months[month] + " " + year;

  let days = "";

  // Add days from the previous month
  for (let i = day - 1; i >= 0; i--) {
    days += `<div class="day disabled">${prevMonthLastDay - i}</div>`;
  }

  // Create the days for the current month
  for (let i = 1; i <= lastDate; i++) {
    const dateValue = new Date(year, month, i);
    const isSelected = selectedDates.some(date => date.getTime() === dateValue.getTime());
    const isToday = i === currentDay && month === currentMonth && year === currentYear;
    const isPast = dateValue < new Date(currentYear, currentMonth, currentDay); // Check if the date is in the past
    const hasEvent = checkIfHasEvent(dateValue); // Check if there is an event on this date

    days += `<div class="day${isSelected ? " active" : ""}${isToday ? " today" : ""}${isPast || hasEvent ? " disabled" : ""}" data-day="${i}">
              ${i}${hasEvent ? "<span class='event-indicator'>●</span>" : ""}
            </div>`;
  }

  // Add days from the next month
  for (let i = lastWeekday + 1; i <= 6; i++) {
    days += `<div class="day disabled">${i - lastWeekday}</div>`;
  }

  daysContainer.innerHTML = days;
  addDayListener();
}

// Add click listeners to the days
function addDayListener() {
  const days = document.querySelectorAll(".day:not(.disabled)");

  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      const dayValue = parseInt(e.target.dataset.day);
      const dateValue = new Date(year, month, dayValue);

      // Prevent selection of past dates, but allow today
      if (dateValue < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {
        alert("You cannot select a date before today.");
        return;
      }

      // Prevent selection if there's already an event on that date
      if (checkIfHasEvent(dateValue)) {
        alert("There is already an event on this date.");
        return;
      }

      // Toggle the date selection
      if (selectedDates.some(date => date.getTime() === dateValue.getTime())) {
        // If the date is already selected, remove it
        selectedDates = selectedDates.filter(date => date.getTime() !== dateValue.getTime());
        e.target.classList.remove("active");
      } else {
        // Otherwise, add the date to selectedDates
        selectedDates.push(dateValue);
        e.target.classList.add("active");
      }

      // Sort selectedDates to ensure correct order (start to end)
      selectedDates.sort((a, b) => a - b);

      // Log the selected dates
      console.log("Selected dates:", selectedDates.map(date => formatDate(date)));
    });
  });

  // Listen for 'Enter' key press to show the modal
  document.addEventListener("keydown", function (event) {
    if (event.key === "Enter" && selectedDates.length > 0) {
      // Get the first and last selected dates
      const startDate = selectedDates[0];
      const endDate = selectedDates[selectedDates.length - 1];

      // Set the modal input fields
      eventStartInput.value = formatDate(startDate);
      eventEndInput.value = formatDate(endDate);

      // Show the modal
      eventModal.show();
    }
  });
}

// Check if the date has an event
function checkIfHasEvent(dateValue) {
  return existingEvents.some(event => {
    const eventStart = new Date(event.event_start);
    const eventEnd = new Date(event.event_end);
    return dateValue >= eventStart && dateValue <= eventEnd;
  });
}

// Format a date as yyyy-mm-dd
function formatDate(date) {
  let day = date.getDate();
  let month = date.getMonth() + 1;
  let year = date.getFullYear();
  if (day < 10) day = "0" + day;
  if (month < 10) month = "0" + month;
  return `${year}-${month}-${day}`;
}

// Handle month navigation
prev.addEventListener("click", () => {
  month--;
  if (month < 0) {
    month = 11; // If month goes below January, set to December of the previous year
    year--;
  }
  initCalendar(); // Reinitialize the calendar for the new month/year
});

next.addEventListener("click", () => {
  month++;
  if (month > 11) {
    month = 0; // If month goes beyond December, set to January of the next year
    year++;
  }
  initCalendar(); // Reinitialize the calendar for the new month/year
});

// Handle 'Go to Today' button
todayBtn.addEventListener("click", () => {
  // Set the current month and year to today
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();

  // Clear selected dates
  selectedDates = [];

  // Reinitialize the calendar for the current month and year
  initCalendar();
});
function showAlert(message, alertClass) {
    var alertDiv = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' + message +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    alertDiv.css({
        "position": "fixed",
        "top": "10px",
        "right": "10px",
        "z-index": "9999",
        "background-color": alertClass === "alert-danger" ? "#f8d7da" : "#d4edda",
        "border-color": alertClass === "alert-danger" ? "#f5c6cb" : "#c3e6cb"
    });
    $("body").append(alertDiv);
    setTimeout(function() {
        alertDiv.alert('close');
    }, 900);
}

// Initialize the calendar on page load
initCalendar();

        // Example of marking dates in JavaScript
        document.querySelectorAll('.day').forEach(dayElement => {
            const dayDate = dayElement.getAttribute('data-date'); // assuming each .day has a data-date attribute

            fetch('check_event.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'event_date=' + dayDate
            })
            .then(response => response.json())
            .then(data => {
                if (data.hasEvent) {
                    dayElement.classList.add('event-day');
                }
            });
        });
        // Add click listeners to the days
function addDayListener() {
  const days = document.querySelectorAll(".day:not(.disabled)");

  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      const dayValue = parseInt(e.target.dataset.day);
      const dateValue = new Date(year, month, dayValue);

      // Prevent selection of past dates, but allow today
      if (dateValue < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {
        alert("You cannot select a date before today.");
        return;
      }

      // Prevent selection if there's already an event on that date
      if (checkIfHasEvent(dateValue)) {
        alert("There is already an event on this date.");
        return;
      }

      // Toggle the date selection
      if (selectedDates.some(date => date.getTime() === dateValue.getTime())) {
        // If the date is already selected, remove it
        selectedDates = selectedDates.filter(date => date.getTime() !== dateValue.getTime());
        e.target.classList.remove("active");
      } else {
        // Otherwise, add the date to selectedDates
        selectedDates.push(dateValue);
        e.target.classList.add("active");
      }

      // Sort selectedDates to ensure correct order (start to end)
      selectedDates.sort((a, b) => a - b);

      // Automatically show the modal if exactly two dates are selected
      if (selectedDates.length === 2) {
        // Get the first and last selected dates as start and end
        const startDate = selectedDates[0];
        const endDate = selectedDates[1];

        // Set the modal input fields
        eventStartInput.value = formatDate(startDate);
        eventEndInput.value = formatDate(endDate);

        // Show the modal
        eventModal.show();
      } else if (selectedDates.length > 2) {
        // Limit the selection to only two dates
        showAlert("Please select only two dates for start and end.", "alert-danger");
        selectedDates = selectedDates.slice(0, 2);
        initCalendar(); // Reinitialize to clear extra selections
      }
    });
  });
}

