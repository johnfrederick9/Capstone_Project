// <script src="assets/js/dropdown.js"></script>

document.addEventListener("DOMContentLoaded", function() {
    const dropdowns = document.querySelectorAll('.dropdown');

    let currentOpenDropdown = null;

    dropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('.bx-chevron-down');
        const content = dropdown.querySelector('.dropdown-content');
        const input = dropdown.querySelector('.dropdown-input');
        
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            
            if (currentOpenDropdown && currentOpenDropdown !== content) {
                currentOpenDropdown.classList.remove('show');
            }
            
            content.classList.toggle('show');
            currentOpenDropdown = content.classList.contains('show') ? content : null;
        });

        // Handle dropdown item click
        content.querySelectorAll('a').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                input.value = this.dataset.value;
                content.classList.remove('show');
                currentOpenDropdown = null;
            });
        });
    });

    // Close the dropdown if the user clicks outside of any dropdown
    window.addEventListener('click', function() {
        if (currentOpenDropdown) {
            currentOpenDropdown.classList.remove('show');
            currentOpenDropdown = null;
        }
    });
});