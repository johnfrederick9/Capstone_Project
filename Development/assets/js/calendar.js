const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  eventModal = new bootstrap.Modal(document.getElementById('eventModal'), {}),
  eventStartInput = document.getElementById("event_start"),
  eventEndInput = document.getElementById("event_end");

let today = new Date();
let month = today.getMonth();
let year = today.getFullYear();
let selectedDates = [];

const months = [
  "January", "February", "March", "April", "May", "June", "July",
  "August", "September", "October", "November", "December"
];

// Initialize the calendar
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();

  // Set the current month and year in the header
  date.innerHTML = months[month] + " " + year;

  let days = "";

  // Create the days for the current month
  for (let i = 1; i <= lastDate; i++) {
    days += `<div class="day" data-day="${i}">${i}</div>`;
  }

  daysContainer.innerHTML = days;
  addDayListener();
}

// Add click listeners to the days
function addDayListener() {
  const days = document.querySelectorAll(".day");

  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      const dayValue = parseInt(e.target.dataset.day);
      const dateValue = new Date(year, month, dayValue);

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
  document.addEventListener("keydown", function(event) {
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

// Initialize the calendar on page load
initCalendar();
