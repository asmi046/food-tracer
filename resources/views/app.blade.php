<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- PWA Meta Tags -->
        <meta name="theme-color" content="#18a058">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="Food Tracker">
        <meta name="msapplication-TileImage" content="img/pwa_icons/icon-144x144.png">
        <meta name="msapplication-TileColor" content="#18a058">

        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
        <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
        <link rel="mask-icon" href="img/favicons/mask-icon.svg" color="#18a058">

        <!-- Manifest -->
        <link rel="manifest" href="/manifest.json">


        <title inertia>{{ config('app.name', 'Food Tracker') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
