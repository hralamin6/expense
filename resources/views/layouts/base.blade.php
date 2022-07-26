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

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
{{--        <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
{{--        <script src="{{ asset('js/app.js') }}" defer></script>--}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        @yield('body')

        @livewireScripts
        {{--        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
{{--        <script src="{{ asset('js/sa.js') }}"></script>--}}
        <script src="{{ secure_asset('js/sa.js') }}"></script>
        <x-livewire-alert::scripts />
{{--        <script src="{{ asset('js/spa.js') }}" data-turbolinks-eval="false"></script>--}}
{{--        <script src="{{ secure_asset('js/spa.js') }}" data-turbolinks-eval="false"></script>--}}
        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
    </body>
</html>
