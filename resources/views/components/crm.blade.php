<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список дел</title>
    <link rel="stylesheet" href="/css/crm.css">
</head>
<body class="crm">
<header><h1 class="crm__title">Система управления контентом</h1></header><hr>
<h2 class="crm__subtitle"></h2>

<div class="crm__main">
    <div class="crm__layout">
        <nav class="crm__sidebar">
            <ul class="crm__menu">
                <li><a class="crm__menu-link" href="{{ route('crm.photos.index') }}">Галерея</a></li>
                <li><a class="crm__menu-link" href="{{ route('crm.clients') }}">Клиенты</a></li>
                <li><a class="crm__menu-link" href="{{ route('crm.articles.index') }}">Статьи</a></li>
                <li><a class="crm__menu-link" href="{{ route('crm.promotion') }}">Акции</a></li>
                <li><a class="crm__menu-link" href="{{ route('crm.services.index') }}">Услуги</a></li>
            </ul>
        </nav>
        <div class="crm__content">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>