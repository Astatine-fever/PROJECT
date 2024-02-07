// JavaScript to toggle visibility of dropdown content
document.addEventListener('DOMContentLoaded', function() {
    var dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(event) {
            event.preventDefault();
            var content = this.querySelector('.dropdown-content');
            content.classList.toggle('show');
        });
    });
});
