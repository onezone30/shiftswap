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

    {{-- Flash toast --}}
    @if (session('success') || session('error'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 4000)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="toast toast-top toast-end z-50 mt-4 mr-4">
            @if (session('success'))
                <div class="alert alert-success shadow-lg">
                    <x-heroicon-o-check-circle class="h-5 w-5 shrink-0" />
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error shadow-lg">
                    <x-heroicon-o-x-circle class="h-5 w-5 shrink-0" />
                    <span>{{ session('error') }}</span>
                </div>
            @endif
        </div>
    @endif

</body>
</html>
