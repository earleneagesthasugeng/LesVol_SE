function toggleDropdown(id) {
    const targetId = id || 'nav-dropdown';
    const targetMenu = document.getElementById(targetId);

    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        if (menu !== targetMenu) {
            menu.classList.remove('open');
        }
    });

    if (targetMenu) {
        targetMenu.classList.toggle('open');
    }
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown-wrapper')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('open');
        });
    }
});