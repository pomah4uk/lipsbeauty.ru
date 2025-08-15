<footer class="footer">
    <div class="footer__container">
        <ul class="footer__menu">
            <li><a href="/">Главная</a></li>
            <li><a href="#lips_card">Список услуг</a></li>
            <li><a href="{{ route('galary') }}">Галерея</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#contact">Контакты</a></li>
        </ul>
        <div>
            <div class="footer__contacts">
                <div>Россия, Томск</div>
                <div>+7 923 437 91 14</div>
                <div>Krasnovairiska@gmail.com</div>
            </div>
            <div class="footer__social">
                <span>Мы в соцсетях:</span>
                <a href="https://vk.com/moment_zagarr" target="_blank"><i class="fa fa-vk"></i></a>
            </div>
        </div>
    </div>
    <div class="footer__copyright">
        &copy; {{ date('Y') }} Big Lips. Все права защищены.
    </div>
</footer>
<!-- Footer section end -->

@vite(['resources/js/app.js'])

@stack('scripts')

</body>
</html>
