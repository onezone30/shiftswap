<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="shiftswap">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShiftSwap — Employee Scheduling & Shift Exchange</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-welcome.navbar />
    <x-welcome.hero />
    <x-welcome.problem-solution />
    <x-welcome.features />
    <x-welcome.target-audience />
    <x-welcome.about />
    <x-welcome.cta />
    <x-welcome.footer />
</body>
</html>
