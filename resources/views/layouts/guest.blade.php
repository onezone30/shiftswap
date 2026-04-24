<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="shiftswap">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ShiftSwap') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200">

    <div class="min-h-screen flex flex-col lg:flex-row">

        {{-- Brand panel — hidden on mobile --}}
        <div class="hidden lg:flex lg:w-5/12 bg-primary flex-col items-center justify-center gap-8 p-16">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/shiftswap_logo.jpg') }}" alt="ShiftSwap" class="w-14 h-14 rounded-xl shadow-lg">
                <span class="text-4xl font-extrabold text-primary-content">
                    Shift<span class="text-secondary">Swap</span>
                </span>
            </a>

            <p class="text-primary-content/75 text-base text-center max-w-xs leading-relaxed">
                Employee scheduling &amp; shift exchange built for retail businesses that deserve better than group chats.
            </p>

            <ul class="space-y-3 w-full max-w-xs">
                @foreach ([
                    'Manage schedules across all branches',
                    'Digital shift swaps with manager approval',
                    'Real-time notifications for everyone',
                ] as $point)
                    <li class="flex items-center gap-3 text-primary-content/90 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ $point }}
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Form panel --}}
        <div class="flex-1 flex flex-col items-center justify-center p-6 lg:p-16">

            {{-- Mobile logo --}}
            <a href="/" class="flex items-center gap-2 mb-8 lg:hidden">
                <img src="{{ asset('images/shiftswap_logo.jpg') }}" alt="ShiftSwap" class="w-10 h-10 rounded-lg">
                <span class="text-2xl font-extrabold">
                    <span class="text-primary">Shift</span><span class="text-secondary">Swap</span>
                </span>
            </a>

            <div class="w-full max-w-md">
                {{ $slot }}
            </div>

        </div>

    </div>

</body>
</html>
