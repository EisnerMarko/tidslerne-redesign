document.addEventListener('DOMContentLoaded', () => {
    const dropdownToggle = document.getElementById('dropdown-toggle');
    const dropdownMenu = document.getElementById('dropdown-menu');

    dropdownToggle.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });
});