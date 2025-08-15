// CRM Navigation JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Элементы бургер меню
    const burger = document.getElementById('crm-burger');
    const sidebar = document.getElementById('crm-sidebar');
    const sidebarClose = document.getElementById('crm-sidebar-close');
    const body = document.body;

    // Функция открытия/закрытия сайдбара
    function toggleSidebar() {
        sidebar.classList.toggle('crm__sidebar--active');
        body.classList.toggle('crm__body--sidebar-open');
        
        // Обновляем aria-expanded для доступности
        const isExpanded = sidebar.classList.contains('crm__sidebar--active');
        burger.setAttribute('aria-expanded', isExpanded);
    }

    // Обработчики событий
    if (burger) {
        burger.addEventListener('click', toggleSidebar);
    }

    if (sidebarClose) {
        sidebarClose.addEventListener('click', toggleSidebar);
    }

    // Закрытие сайдбара при клике вне его на мобильных устройствах
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 1024) {
            const isClickInsideSidebar = sidebar && sidebar.contains(event.target);
            const isClickOnBurger = burger && burger.contains(event.target);
            
            if (!isClickInsideSidebar && !isClickOnBurger && sidebar.classList.contains('crm__sidebar--active')) {
                toggleSidebar();
            }
        }
    });

    // Закрытие сайдбара при изменении размера окна
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024 && sidebar.classList.contains('crm__sidebar--active')) {
            toggleSidebar();
        }
    });

    // Функция для показа уведомлений
    window.showNotification = function(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `crm__alert crm__alert--${type}`;
        notification.textContent = message;
        
        // Добавляем кнопку закрытия
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = '&times;';
        closeBtn.className = 'crm__alert-close';
        closeBtn.style.cssText = 'background: none; border: none; font-size: 1.2rem; cursor: pointer; margin-left: 1rem;';
        closeBtn.onclick = () => notification.remove();
        
        notification.appendChild(closeBtn);
        
        // Вставляем в начало контента
        const content = document.querySelector('.crm__content');
        if (content) {
            content.insertBefore(notification, content.firstChild);
            
            // Автоматически удаляем через 5 секунд
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }
    };

    // Функция для подтверждения удаления
    window.confirmDelete = function(message = 'Вы уверены, что хотите удалить этот элемент?') {
        return confirm(message);
    };

    // Функция для создания модального окна
    window.createModal = function(title, content, buttons = []) {
        const modalOverlay = document.createElement('div');
        modalOverlay.className = 'crm__modal-overlay';
        
        const modal = document.createElement('div');
        modal.className = 'crm__modal';
        
        modal.innerHTML = `
            <div class="crm__modal-header">
                <h3 class="crm__modal-title">${title}</h3>
                <button class="crm__modal-close" aria-label="Закрыть">&times;</button>
            </div>
            <div class="crm__modal-body">
                ${content}
            </div>
            <div class="crm__modal-footer">
                ${buttons.map(btn => `
                    <button class="crm__btn crm__btn--${btn.type || 'secondary'}" ${btn.id ? `id="${btn.id}"` : ''}>
                        ${btn.text}
                    </button>
                `).join('')}
            </div>
        `;
        
        modalOverlay.appendChild(modal);
        document.body.appendChild(modalOverlay);
        
        // Показываем модальное окно
        setTimeout(() => {
            modalOverlay.classList.add('crm__modal-overlay--active');
        }, 10);
        
        // Обработчики закрытия
        const closeModal = () => {
            modalOverlay.classList.remove('crm__modal-overlay--active');
            setTimeout(() => {
                if (modalOverlay.parentNode) {
                    modalOverlay.remove();
                }
            }, 300);
        };
        
        modalOverlay.querySelector('.crm__modal-close').addEventListener('click', closeModal);
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });
        
        return {
            close: closeModal,
            element: modalOverlay
        };
    };

    // Обработка форм с AJAX
    document.addEventListener('submit', function(event) {
        const form = event.target;
        
        // Проверяем, есть ли атрибут data-ajax
        if (form.hasAttribute('data-ajax')) {
            event.preventDefault();
            
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn ? submitBtn.textContent : '';
            
            // Показываем состояние загрузки
            if (submitBtn) {
                submitBtn.textContent = 'Отправка...';
            }
            
            fetch(form.action, {
                method: form.method || 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message || 'Операция выполнена успешно', 'success');
                    if (data.redirect) {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1000);
                    }
                } else {
                    showNotification(data.message || 'Произошла ошибка', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Произошла ошибка при отправке формы', 'error');
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            });
        }
    });

    // Обработка кнопок удаления
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('crm__btn--danger') && event.target.hasAttribute('data-confirm')) {
            const message = event.target.getAttribute('data-confirm');
            if (!confirmDelete(message)) {
                event.preventDefault();
            }
        }
    });

    // Анимация загрузки для кнопок
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('crm__btn') && !event.target.disabled) {
            const btn = event.target;
            const originalText = btn.textContent;
            
            // Добавляем спиннер
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Загрузка...';
            
            // Восстанавливаем через 2 секунды (если не было редиректа)
            setTimeout(() => {
                if (btn.disabled) {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            }, 2000);
        }
    });

    // Подсветка активных элементов в навигации
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.crm__nav-link');
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && currentPath.includes(href.split('/').pop())) {
            link.classList.add('crm__nav-link--active');
        }
    });

    // Инициализация tooltips (если есть)
    if (typeof tippy !== 'undefined') {
        tippy('[data-tippy-content]', {
            placement: 'top',
            arrow: true,
            theme: 'crm-tooltip'
        });
    }

    console.log('CRM Navigation initialized');
});
