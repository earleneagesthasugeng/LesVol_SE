const navbar = document.getElementById("navbar");
const navbarLogo = document.getElementById("navbarLogo");

window.addEventListener("scroll", function () {
    if (window.scrollY > 80) {
        navbar.classList.add("scrolled");
        navbarLogo.src = navbarLogo.dataset.red;
    } else {
        navbar.classList.remove("scrolled");
        navbarLogo.src = navbarLogo.dataset.white;
    }
});