function openModal() {
    const modal = document.getElementById('contactModal');
    if (modal) {
        modal.style.display = 'flex';
        modal.style.pointerEvents = 'auto';
        document.body.style.overflow = 'hidden';
    }
}
function closeModal() {
    const modal = document.getElementById('contactModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('contactModal');
    // Открытие по .hero__btn
    document.querySelectorAll('.hero__btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    });
    // Открытие по .contacts__btn
    document.querySelectorAll('.contacts__btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    });
    if (modal) {
        // Закрытие по клику на фон
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });
        // Закрытие по .modal-close
        modal.querySelectorAll('.modal-close').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeModal();
            });
        });
    }
    // Закрытие по Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
    // Автоматически закрывать модалку при успешной отправке
    var globalSuccess = document.querySelector('.global-success');
    if (globalSuccess && modal) {
        modal.style.display = 'none';
        setTimeout(function() {
            globalSuccess.style.display = 'none';
        }, 4000);
    }
}); 