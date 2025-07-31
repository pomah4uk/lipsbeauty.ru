<div id="contactModal" class="modal-feedback">
    <div class="modal-dialog">
        <button class="modal-close" aria-label="Закрыть">&times;</button>
        <h2 class="modal-title">Записаться на консультацию</h2>
        @if(session('success'))
            <div class="global-success">{{ session('success') }}</div>
        @endif
        <form class="contact-form" action="{{ route('client.store') }}" method="post">
            @csrf
            <div class="input-group">
                <span class="input-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11" cy="7" r="4" stroke="#a3154b" stroke-width="2" fill="none"/>
                        <path d="M3 19C3 15.6863 6.68629 13 10 13H12C15.3137 13 19 15.6863 19 19" stroke="#a3154b" stroke-width="2" fill="none"/>
                    </svg>
                </span>
                <input type="text" name='name' placeholder="Ваше имя" required>
            </div>
            <div class="input-group">
                <span class="input-icon"><img src="{{ asset('img/icons/phone.png') }}" alt=""></span>
                <input id="modal-phone" type="tel" name='phone' placeholder="+7XXXXXXXXXX" pattern="\+7[0-9]{10}" maxlength="12" inputmode="numeric">
            </div>
            <button class="modal__btn" type="submit">Записаться <img src="{{ asset('img/icons/double-arrow.png') }}" alt="#" style="margin-left:8px; height:18px; vertical-align:middle;"/></button>
        </form>
        <script src="/js/modal-phone.js"></script>
    </div>
</div> 