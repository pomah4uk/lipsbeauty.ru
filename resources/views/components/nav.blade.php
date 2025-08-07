<nav class="nav">
    <div class="nav__container">
        <a href="/" class="nav__logo">
            <img src="/img/logo.svg" alt="Beauty Lips Logo" style="height:38px; margin-right:10px;"> Beauty Lips
        </a>
        
        <!-- Бургер кнопка -->
        <button class="nav__burger" id="nav-burger" type="button" aria-label="Открыть меню">
            <span class="nav__burger-line"></span>
            <span class="nav__burger-line"></span>
            <span class="nav__burger-line"></span>
        </button>
        
        <!-- Мобильное меню -->
        <div class="nav__mobile-menu" id="nav-mobile-menu">
            <div class="nav__mobile-menu-content">
                <ul class="nav__mobile-list">
                    <li class="nav__mobile-item">
                        <a class="nav__mobile-link{{ request()->routeIs('home') ? ' nav__mobile-link--active' : '' }}" href="{{ route('home') }}">Главная</a>
                    </li>
                    <li class="nav__mobile-item">
                        <a class="nav__mobile-link{{ request()->routeIs('galary') ? ' nav__mobile-link--active' : '' }}" href="{{ route('galary') }}">Галерея</a>
                    </li>
                    <li class="nav__mobile-item">
                        <a class="nav__mobile-link{{ request()->routeIs('posts') ? ' nav__mobile-link--active' : '' }}" href="{{ route('posts') }}">Посты</a>
                    </li>
                    <li class="nav__mobile-item">
                        <a class="nav__mobile-link" href="#lips_card">Список услуг</a>
                    </li>
                    <li class="nav__mobile-item">
                        <a class="nav__mobile-link" href="#features">FAQ</a>
                    </li>
                    <li class="nav__mobile-item">
                        <a class="nav__mobile-link" href="#contact">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Десктопное меню -->
        <ul class="nav__menu" id="nav-menu">
            <li><a class="nav__link{{ request()->routeIs('home') ? ' nav__link--active' : '' }}" href="{{ route('home') }}">Главная</a></li>
            <li><a class="nav__link{{ request()->routeIs('galary') ? ' nav__link--active' : '' }}" href="{{ route('galary') }}">Галерея</a></li>
            <li><a class="nav__link{{ request()->routeIs('posts') ? ' nav__link--active' : '' }}" href="{{ route('posts') }}">Посты</a></li>
            <li><a class="nav__link" href="#lips_card">Список услуг</a></li>
            <li><a class="nav__link" href="#features">FAQ</a></li>
            <li><a class="nav__link" href="#contact">Контакты</a></li>
        </ul>
    </div>
</nav>