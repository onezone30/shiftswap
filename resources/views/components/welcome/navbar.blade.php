<div class="navbar bg-base-100 border-b border-base-300 sticky top-0 z-50">
    <div class="navbar-start">
        <a href="/" class="flex items-center gap-2">
            <img src="{{ asset('images/shiftswap_logo.jpg') }}" alt="ShiftSwap Logo" class="w-16 h-16">
            <span class="text-xl font-bold">
                <span class="text-primary">Shift</span><span class="text-secondary">Swap</span>
            </span>
        </a>
    </div>

    <div class="navbar-end gap-2">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Get Started</a>
                @endif
            @endauth
        @endif
    </div>
</div>
