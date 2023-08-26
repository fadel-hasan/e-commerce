<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/ts/app.ts'])
</head>

<body class="font-[Cairo] scroll-smooth">

    @include('layouts.header')
    <main class="relative" id="app">
        {{-- @if (session()->has('success'))
            <x-alert message="{{ session()->get('success') }}" type='success' title="نجاح" />
        @elseif (session()->has('error'))
            @if (is_array(session()->get('error')))
                @foreach (session()->get('error') as $error)
                    <x-alert message="{{ $error }}" type='fail' title="خطأ" />
                @endforeach
            @else
                <x-alert message="{{ session()->get('error') }}" type='fail' title="خطأ" />
            @endif
        @endif --}}
        <div class="">

            Welcome
            <br>
            You can go to
        </div>
        <a href="{{ Route('get.login') }}">Login</a>
        <br>
        <a href="{{ Route('logout') }}">Logout</a>
        @yield('app')
    </main>
</body>

</html>
