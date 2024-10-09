
const userDropdown = document.getElementById('dropdownMenu');
const userMenu = document.getElementById('dropdown-menu');

userDropdown.addEventListener('click', () => {
  userMenu.classList.toggle('show');
});