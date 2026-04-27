<header class="lg:hidden bg-base-100 border-b border-base-300 h-14 flex items-center justify-between px-4 sticky top-0 z-30">

    {{-- Logo --}}
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
        <img src="{{ asset('images/shiftswap_logo.jpg') }}" alt="ShiftSwap" class="w-8 h-8 rounded-lg">
        <x-brand-title size="text-base" />
    </a>

    {{-- Hamburger --}}
    <label for="app-drawer" class="btn btn-ghost btn-sm">
        <x-heroicon-o-bars-3 class="h-5 w-5" />
    </label>

</header>
