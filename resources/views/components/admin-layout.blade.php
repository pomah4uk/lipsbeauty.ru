<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM - Панель администратора</title>
    @vite([
    'resources/css/crm/crm.css',
    'resources/css/public/font-awesome.min.css',
    'resources/js/app.js'
    ])
</head>
<body>
    <div class="crm">
        <!-- Боковое меню -->
        <aside class="crm__sidebar" id="crm-sidebar">
            <div class="crm__sidebar-header">
                <h1 class="crm__sidebar-title">CRM</h1>
                <button class="crm__sidebar-close" id="crm-sidebar-close" aria-label="Закрыть меню">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            
            <nav class="crm__nav">
                <ul class="crm__nav-list">
                    <li class="crm__nav-item">
                        <a href="{{ route('home') }}" class="crm__nav-link{{ request()->is('home') ? ' crm__nav-link--active' : '' }}">
                            <i class="fa fa-home"></i>
                            <span>Главная</span>
                        </a>
                    </li>
                    <li class="crm__nav-item">
                        <a href="{{ route('crm.clients') }}" class="crm__nav-link{{ request()->is('crm/clients') ? ' crm__nav-link--active' : '' }}">
                            <i class="fa fa-users"></i>
                            <span>Клиенты</span>
                        </a>
                    </li>
                    <li class="crm__nav-item">
                        <a href="{{ route('crm.posts.index') }}" class="crm__nav-link{{ request()->is('crm/posts*') ? ' crm__nav-link--active' : '' }}">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Посты</span>
                        </a>
                    </li>
                    <li class="crm__nav-item">
                        <a href="{{ route('crm.photos.index') }}" class="crm__nav-link{{ request()->is('crm/photos*') ? ' crm__nav-link--active' : '' }}">
                            <i class="fa fa-image"></i>
                            <span>Галерея</span>
                        </a>
                    </li>
                    <li class="crm__nav-item">
                        <a href="{{ route('crm.services.index') }}" class="crm__nav-link{{ request()->is('crm/services*') ? ' crm__nav-link--active' : '' }}">
                            <i class="fa fa-cogs"></i>
                            <span>Услуги</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="crm__sidebar-footer">
                <form action="{{ route('crm.logout') }}" method="POST" class="crm__logout-form">
                    @csrf
                    <button type="submit" class="crm__logout-btn">
                        <i class="fa fa-sign-out"></i>
                        <span>Выйти</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Основной контент -->
        <main class="crm__main">
            <!-- Шапка -->
            <header class="crm__header">
                <div class="crm__header-content">
                    <button class="crm__burger" id="crm-burger" type="button" aria-label="Открыть меню">
                        <span class="crm__burger-line"></span>
                        <span class="crm__burger-line"></span>
                        <span class="crm__burger-line"></span>
                    </button>
                    
                    <div class="crm__header-title">
                        <h2>@yield('page-title', 'Панель администратора')</h2>
                    </div>
                    
                    <div class="crm__header-actions">
                        @yield('header-actions')
                    </div>
                </div>
            </header>

            <!-- Контент страницы -->
            <div class="crm__content">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html> 