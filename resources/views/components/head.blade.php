<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Big Lips — Косметология, увеличение губ, уход за лицом и телом')</title>
    <meta name="description" content="@yield('description', 'Профессиональная косметология в Томске: увеличение губ, уход за кожей, инъекции, коррекция лица. Запишитесь на консультацию!')">
    <meta name="keywords" content="@yield('keywords', 'косметология, увеличение губ, инъекции, Томск, уход за лицом, биоревитализация, мезотерапия, липолитики')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph для соцсетей -->
    <meta property="og:title" content="@yield('og_title', 'Big Lips — Косметология, увеличение губ, уход за лицом и телом')" />
    <meta property="og:description" content="@yield('og_description', 'Профессиональная косметология в Томске: увеличение губ, уход за кожей, инъекции, коррекция лица. Запишитесь на консультацию!')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('img/lips_info.jpg') }}" />

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet">

    <!-- Main Stylesheets -->
    @vite(['resources/css/app.css'])
</head>
<body>