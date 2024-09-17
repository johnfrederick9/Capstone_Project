// <script src="assets/js/date.js"></script>

function getCurrentDate() {
    const now = new Date();
    const year = now.getFullYear();
    let month = (now.getMonth() + 1).toString().padStart(2, '0'); // January is 0!
    let day = now.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
}

// Set today's date to the input field with id="todayDate"
document.getElementById('todayDate').value = getCurrentDate();