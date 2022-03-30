window.addEventListener("scroll", navbar);

function navbar() {
    if (window.scrollY > 50) {
        var nav = document.getElementById("navbar");
        nav.classList.add('scrolled');
    }
    if (window.scrollY < 50) {
        var nav = document.getElementById("navbar");
        nav.classList.remove('scrolled');
    }
}