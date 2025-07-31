// Новое бургерное меню
document.addEventListener('DOMContentLoaded', function() {
    console.log('Nav.js загружен');
    
    const burger = document.getElementById('nav-burger');
    const mobileMenu = document.getElementById('nav-mobile-menu');
    const body = document.body;
    
    if (!burger || !mobileMenu) {
        console.error('Не найдены элементы бургер меню');
        return;
    }
    
    console.log('Элементы найдены:', { burger, mobileMenu });
    
    // Функция переключения меню
    function toggleMenu() {
        console.log('Переключение меню');
        burger.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        
        // Блокируем скролл
        if (mobileMenu.classList.contains('active')) {
            body.style.overflow = 'hidden';
        } else {
            body.style.overflow = '';
        }
    }
    
    // Клик по бургер кнопке
    burger.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Клик по бургеру');
        toggleMenu();
    });
    
    // Клик по затемненной области для закрытия
    mobileMenu.addEventListener('click', function(e) {
        if (e.target === mobileMenu) {
            console.log('Клик по затемненной области');
            toggleMenu();
        }
    });
    
    // Клик по ссылкам в мобильном меню
    const mobileLinks = mobileMenu.querySelectorAll('.nav__mobile-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            console.log('Клик по мобильной ссылке:', link.textContent);
            setTimeout(toggleMenu, 100);
        });
    });
    
    // Закрытие по Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            console.log('Закрытие по Escape');
            toggleMenu();
        }
    });
    
    // Закрытие при изменении размера окна
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && mobileMenu.classList.contains('active')) {
            console.log('Закрытие при ресайзе');
            toggleMenu();
        }
    });
    
    console.log('Бургер меню инициализировано');
}); 