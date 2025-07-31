document.addEventListener('DOMContentLoaded', function() {
    const burger = document.getElementById('crm-burger');
    const mobileMenu = document.getElementById('crm-mobile-menu');
    const body = document.body;
    if (!burger || !mobileMenu) return;
    function toggleMenu() {
        burger.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        if (mobileMenu.classList.contains('active')) {
            body.style.overflow = 'hidden';
        } else {
            body.style.overflow = '';
        }
    }
    burger.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        toggleMenu();
    });
    mobileMenu.addEventListener('click', function(e) {
        if (e.target === mobileMenu) {
            toggleMenu();
        }
    });
    const mobileLinks = mobileMenu.querySelectorAll('.crm-mobile-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            setTimeout(toggleMenu, 100);
        });
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            toggleMenu();
        }
    });
    window.addEventListener('resize', function() {
        if (window.innerWidth > 900 && mobileMenu.classList.contains('active')) {
            toggleMenu();
        }
    });
});