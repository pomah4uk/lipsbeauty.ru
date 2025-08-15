document.addEventListener('DOMContentLoaded', function() {
    var phoneInput = document.getElementById('modal-phone');
    if (!phoneInput) return;
    phoneInput.addEventListener('focus', function() {
        if (!this.value.startsWith('+7')) {
            this.value = '+7';
        }
    });
    phoneInput.addEventListener('keydown', function(e) {
        // Разрешаем только цифры, Backspace, Delete, стрелки, Tab, Home, End
        if (
            e.key.length === 1 && !/[0-9]/.test(e.key) && !(this.selectionStart < 2 && e.key === '+')
        ) {
            e.preventDefault();
        }
    });
    phoneInput.addEventListener('input', function() {
        // Если не начинается с +7, подставляем только один раз
        if (!this.value.startsWith('+7')) {
            // Удаляем все нецифры
            let digits = this.value.replace(/\D/g, '');
            // Если пользователь случайно ввёл 7 в начале, убираем её
            if (digits.startsWith('7')) digits = digits.slice(1);
            this.value = '+7' + digits.slice(0, 10);
        } else {
            // После +7 оставляем только 10 цифр
            let after = this.value.slice(2).replace(/\D/g, '').slice(0, 10);
            this.value = '+7' + after;
        }
    });
}); 