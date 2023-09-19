<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('') }}errors/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="copyright" content="@yield('author')" />
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="@yield('author')">
    <meta name="geo.placename" content="Syrian Arab Republic">
    <meta name="geo.region" content="SY">
    <meta name="theme-color" content="#FFFAE7">
    <meta name="msapplication-navbutton-color" content="#FFFAE7">
    <meta name="apple-mobile-web-app-status-bar-style" content="#FFFAE7">
    <meta property="og:title" content="@yield('description')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description"
        content="@yield('description')" />
    <meta property="og:type" content="website" />
    <meta http-equiv="Content-Language" content="ar-sy" />
    <meta name="distribution" content="Arbice" />
    <meta name="owner" content="@yield('author')" />
    <meta name="classification" content="Internet" />
    <meta name="googlebot" content="noarchive" />
    <meta name="resource-type" content="document" />
    <meta http-equiv="Cache-Control" content="site" />
</head>

<body class="bg-red font-['Cairo'] max-h-full ">
    @yield('app')
</body>
</html>
