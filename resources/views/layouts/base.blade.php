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
    <meta name="description" content="@yield('description', 'Easily make and customize your class note according to subject and chapter wise') - {{config('app.name')}}">

    <meta property="og:title" content="@yield('title', 'Home Page') - {{config('app.name')}}" />
    <meta property="og:description" content="@yield('description', 'Easily make and customize your class note according to subject and chapter wise') - {{config('app.name')}}" />
    <meta property="og:url" content="@yield('url', config('app.url'))" />
    <meta property="og:image" content="{{ url(asset('icon.jpg')) }}" />
    <meta property="og:image:secure_url" content="{{ url(asset('icon.jpg')) }}" />
    <meta property="og:site_name" content="{{config('app.name')}}" />
    <meta property="og:image:width" content="1536" />
    <meta property="og:image:height" content="1024" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="@yield('description', 'Easily make and customize your class note according to subject and chapter wise') - {{config('app.name')}}" />
    <meta name="twitter:title" content="@yield('title', 'Home Page') - {{config('app.name')}}" />
    <meta name="twitter:image" content="{{ url(asset('icon.jpg')) }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url(asset('icon.jpg')) }}" type="image/x-icon">
    <link rel="icon" href="{{ url(asset('icon.jpg')) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />

    @livewireStyles
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="dark:bg-darkBg text-tahiti scrollbar-none" x-data="{nav: false, dark: $persist(false)}" :class="{'dark': dark}">
@yield('body')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('js')

@livewireScripts
<script src="{{ asset('js/sa.js') }}"></script>
<x-livewire-alert::scripts />
<script src="{{ asset('js/spa.js') }}" data-turbolinks-eval="false"></script>
</body>
</html>
