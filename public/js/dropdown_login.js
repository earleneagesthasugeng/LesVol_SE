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

document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('nav');

    if (navbar) {
        window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        });
    }
});
