<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - {{ config('APP_NAME', 'Frontend Test') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/vendors/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('assets/vendors/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets/vendors/images/favicon-16x16.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/styles/style.css') }}">
    @livewireStyles
    @stack('css')
</head>
<body>
    <livewire:layouts.loader />
    <livewire:layouts.header />
    <livewire:layouts.sidebar />
    <div class="mobile-menu-overlay"></div>
    <div class="main-container">
        {{ $slot }}
    </div>
    <script src="{{ asset('assets/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('assets/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('assets/vendors/scripts/layout-settings.js') }}"></script>
    @livewireScripts
    @stack('js')
</body>
</html>
