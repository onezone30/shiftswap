@php
use App\Models\User;

$userRole = Auth::user()->role;

$navItems = collect([
    [
        'label' => 'Dashboard',
        'route' => 'dashboard',
        // 'roles' => [User::ROLE_ADMIN, User::ROLE_MANAGER, User::ROLE_EMPLOYEE],
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
    ],
    [
        'label' => 'Schedule',
        'route' => 'schedule.index',
        // 'roles' => [User::ROLE_ADMIN, User::ROLE_MANAGER, User::ROLE_EMPLOYEE],
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    ],
    [
        'label' => 'Shift Swaps',
        'route' => 'shift-swaps.index',
        // 'roles' => [User::ROLE_ADMIN, User::ROLE_MANAGER, User::ROLE_EMPLOYEE],
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>',
    ],
    [
        'label' => 'Staff',
        'route' => 'staff.index',
        // 'roles' => [User::ROLE_ADMIN, User::ROLE_MANAGER],
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
    ],
    [
        'label' => 'Branches',
        'route' => 'branches.index',
        // 'roles' => [User::ROLE_ADMIN],
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
    ],
    [
        'label' => 'Users',
        'route' => 'users.index',
        // 'roles' => [User::ROLE_ADMIN],
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
    ],
    [
        'label' => 'Reports',
        'route' => 'reports.index',
        // 'roles' => [User::ROLE_ADMIN, User::ROLE_MANAGER],
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
    ],
])
// ->filter(fn($item) => in_array($userRole, $item['roles']))->values()->all();
@endphp

<aside class="w-64 min-h-full bg-base-100 border-r border-base-300 flex flex-col">

    {{-- Logo --}}
    <div class="p-5 border-b border-base-300">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('images/shiftswap_logo.jpg') }}" alt="ShiftSwap" class="w-9 h-9 rounded-lg">
            <x-brand-title />
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 p-3 overflow-y-auto">
        <ul class="flex flex-col gap-0.5 w-full">
            @foreach ($navItems as $item)
                @php $isActive = request()->routeIs($item['route']); @endphp
                <li>
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors
                              {{ $isActive
                                  ? 'bg-neutral text-neutral-content font-semibold'
                                  : 'text-base-content/60 hover:bg-base-300 hover:text-base-content' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            {!! $item['icon'] !!}
                        </svg>
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    {{-- User profile & logout --}}
    <div class="p-4 border-t border-base-300">
        <div class="flex items-center gap-3 mb-3">
            <x-user-avatar :name="Auth::user()->name" />
            <div class="min-w-0">
                <p class="text-sm font-semibold text-base-content truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-base-content/50 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-ghost btn-sm w-full justify-start gap-2 text-base-content/70 hover:text-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Log Out
            </button>
        </form>
    </div>

</aside>
