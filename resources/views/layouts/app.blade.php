<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="shiftswap">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ShiftSwap') }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/shiftswap_logo_no_bg.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200 font-sans antialiased">

    <div class="drawer lg:drawer-open min-h-screen">
        <input id="app-drawer" type="checkbox" class="drawer-toggle">

        {{-- Page content --}}
        <div class="drawer-content flex flex-col min-h-screen">
            <x-app.topbar />
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>

        {{-- Sidebar --}}
        <div class="drawer-side z-40">
            <label for="app-drawer" aria-label="Close sidebar" class="drawer-overlay"></label>
            <x-app.sidebar />
        </div>
    </div>

</body>
</html>
