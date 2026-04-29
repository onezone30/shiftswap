@php
use App\Models\User;

$userRole = Auth::user()->role;

$navItems = collect([
    ['label' => 'Dashboard',   'route' => 'dashboard',        'icon' => 'home'],
    ['label' => 'Schedule',    'route' => 'schedule.index',   'icon' => 'calendar'],
    ['label' => 'Shift Swaps', 'route' => 'shift-swaps.index','icon' => 'arrows-right-left'],
    ['label' => 'Staff',       'route' => 'staff.index',      'icon' => 'user-group'],
    ['label' => 'Branches',    'route' => 'branches.index',   'icon' => 'building-storefront'],
    ['label' => 'Positions',   'route' => 'positions.index',  'icon' => 'briefcase'],
    ['label' => 'Users',       'route' => 'users.index',      'icon' => 'users'],
    ['label' => 'Reports',     'route' => 'reports.index',    'icon' => 'chart-bar'],
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
                        <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="h-4 w-4 shrink-0" />
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
                <x-heroicon-o-arrow-right-on-rectangle class="h-4 w-4" />
                Log Out
            </button>
        </form>
    </div>

</aside>
