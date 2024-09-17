// <script src="assets/js/form_click.js"></script>


document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.querySelector('.form-container');

    const btnAddPopup = document.querySelector('.add-popup');
    const iconAddClose = document.querySelector('.add_icon-close');

    const btnUpdatePopup = document.querySelector('.update');

    
    btnAddPopup.addEventListener('click', () => {
        wrapper.style.transform = 'scale(1)';
    });

    iconAddClose.addEventListener('click', () => {
        wrapper.style.transform = 'scale(0)';
    });

    btnUpdatePopup.addEventListener('click', () => {
        wrapper.style.transform = 'scale(1)';
    });

});
