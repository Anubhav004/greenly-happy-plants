 // Disable right-click
 window.addEventListener('contextmenu', function (e) {
  e.preventDefault();
});
 
 // Dropdown functionality
 function toggleDropdown(dropdownId) {
    var dropdownMenu = document.getElementById(dropdownId + 'Menu');
    dropdownMenu.classList.toggle('show');
  }
