<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ url(asset('icon.jpg')) }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <script src="{{ asset('js/echo.js') }}"></script>--}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('js')
</head>
<body class="dark:bg-darkBg text-tahiti scrollbar-none" x-data="{nav: false, dark: $persist(false)}" :class="{'dark': dark}">
@yield('body')

@livewireScripts
<script src="{{ asset('js/sa.js') }}"></script>
{{--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
<x-livewire-alert::scripts />
<script src="{{ asset('js/spa.js') }}" data-turbolinks-eval="false"></script>
</body>
</html>
