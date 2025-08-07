<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админка</title>
    <link rel="stylesheet" href="{{ asset('css/crm/main-admin.css') }}">
</head>
<body>
    <div class="admin__sidebar" id="crm-sidebar">
        <a href="{{ route('home') }}" class="admin__sidebar-link{{ request()->is('home') ? ' admin__sidebar-link--active' : '' }}">Главная</a>
        <a href="{{ route('crm.clients') }}" class="admin__sidebar-link{{ request()->is('crm/clients') ? ' admin__sidebar-link--active' : '' }}">Клиенты</a>
        <a href="{{ route('crm.posts.index') }}" class="admin__sidebar-link{{ request()->is('crm/posts*') ? ' admin__sidebar-link--active' : '' }}">Посты</a>
        <a href="{{ route('crm.photos.index') }}" class="admin__sidebar-link{{ request()->is('crm/photos*') ? ' admin__sidebar-link--active' : '' }}">Галерея</a>
        <a href="{{ route('crm.services.index') }}" class="admin__sidebar-link{{ request()->is('crm/services*') ? ' admin__sidebar-link--active' : '' }}">Услуги</a>
        <form action="{{ route('crm.logout') }}" method="POST" style="display:block;">
            @csrf
            <button type="submit" class="admin__sidebar-link logout-btn">Выйти</button>
        </form>
    </div>
    <div class="admin__header">
        <button class="crm-burger" id="crm-burger" type="button" aria-label="Открыть меню">
            <span class="crm-burger-line"></span>
            <span class="crm-burger-line"></span>
            <span class="crm-burger-line"></span>
        </button>
        Панель администратора
    </div>
    <div class="crm-mobile-menu" id="crm-mobile-menu">
        <div class="crm-mobile-menu-content">
            <a href="{{ route('home') }}" class="crm-mobile-link{{ request()->is('home') ? ' crm-mobile-link--active' : '' }}">Главная</a>
            <a href="{{ route('crm.clients') }}" class="crm-mobile-link{{ request()->is('crm/clients') ? ' crm-mobile-link--active' : '' }}">Клиенты</a>
            <a href="{{ route('crm.posts.index') }}" class="crm-mobile-link{{ request()->is('crm/posts') ? ' crm-mobile-link--active' : '' }}">Посты</a>
            <a href="{{ route('crm.photos.index') }}" class="crm-mobile-link{{ request()->is('crm/photos*') ? ' crm-mobile-link--active' : '' }}">Галерея</a>
            <a href="{{ route('crm.services.index') }}" class="crm-mobile-link{{ request()->is('crm/services*') ? ' crm-mobile-link--active' : '' }}">Услуги</a>
            <form action="{{ route('crm.logout') }}" method="POST" style="display:block;">
                @csrf
                <button type="submit" class="crm-mobile-link logout-btn">Выйти</button>
            </form>
        </div>
    </div>
    <div class="admin__content">
        @yield('content')
    </div>
    @stack('scripts')
    <script src="/js/crm-nav.js"></script>
</body>
</html> 