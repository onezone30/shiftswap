<x-app-layout>

    {{-- Page header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-base-content">Dashboard</h1>
            <p class="text-sm text-base-content/50 mt-0.5">{{ now()->format('l, F j, Y') }}</p>
        </div>
        <button class="btn btn-primary btn-sm gap-2">
            <x-heroicon-o-plus class="h-4 w-4" />
            New Schedule
        </button>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-base-content/60">Total Staff</span>
                    <div class="w-9 h-9 bg-primary/10 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-user-group class="h-4 w-4 text-primary" />
                    </div>
                </div>
                <p class="text-3xl font-bold text-base-content">24</p>
                <p class="text-xs text-success mt-1">↑ 2 this month</p>
            </div>
        </div>

        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-base-content/60">Active Shifts</span>
                    <div class="w-9 h-9 bg-success/10 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-calendar class="h-4 w-4 text-success" />
                    </div>
                </div>
                <p class="text-3xl font-bold text-base-content">8</p>
                <p class="text-xs text-base-content/50 mt-1">Today across all branches</p>
            </div>
        </div>

        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-base-content/60">Pending Swaps</span>
                    <div class="w-9 h-9 bg-warning/10 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-arrows-right-left class="h-4 w-4 text-warning" />
                    </div>
                </div>
                <p class="text-3xl font-bold text-base-content">3</p>
                <p class="text-xs text-warning mt-1">Awaiting your approval</p>
            </div>
        </div>

        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-base-content/60">Branches</span>
                    <div class="w-9 h-9 bg-secondary/10 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-building-storefront class="h-4 w-4 text-secondary" />
                    </div>
                </div>
                <p class="text-3xl font-bold text-base-content">4</p>
                <p class="text-xs text-base-content/50 mt-1">Putatan, Bayanan, Poblacion, San Pedro</p>
            </div>
        </div>

    </div>

    {{-- Main grid: Schedule + Pending Swaps --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- This week's schedule --}}
        <div class="xl:col-span-2 card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body p-0">
                <div class="flex items-center justify-between p-5 border-b border-base-300">
                    <h2 class="font-bold text-base-content">This Week's Schedule</h2>
                    <button class="btn btn-ghost btn-xs text-primary">View all</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-base-content/60 text-xs">
                                <th>Employee</th>
                                <th>Branch</th>
                                <th>Position</th>
                                <th>Shift</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ([
                                ['Maria Ramos',   'Putatan',    'Cashier',    'Mon • 8AM – 4PM',  'confirmed'],
                                ['Jose Cruz',     'Putatan',    'Bagger',     'Mon • 4PM – 12AM', 'confirmed'],
                                ['Ana Pineda',    'Bayanan',    'Cashier',    'Tue • 8AM – 4PM',  'pending'],
                                ['Carlos Reyes',  'Bayanan',    'Supervisor', 'Wed • 8AM – 4PM',  'confirmed'],
                                ['Maria Santos',  'Poblacion',  'Cashier',    'Thu • 8AM – 4PM',  'confirmed'],
                                ['Luis Garcia',   'San Pedro',  'Bagger',     'Fri • 4PM – 12AM', 'pending'],
                            ] as [$name, $branch, $position, $shift, $status])
                                <tr class="hover">
                                    <td>
                                        <div class="flex items-center gap-2.5">
                                            <div class="avatar placeholder">
                                                <div class="bg-base-300 rounded-full w-7 text-xs font-semibold">
                                                    <span>{{ strtoupper(substr($name, 0, 1) . substr(strstr($name, ' '), 1, 1)) }}</span>
                                                </div>
                                            </div>
                                            <span class="font-medium text-sm">{{ $name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-sm text-base-content/70">{{ $branch }}</td>
                                    <td class="text-sm text-base-content/70">{{ $position }}</td>
                                    <td class="text-sm text-base-content/70">{{ $shift }}</td>
                                    <td>
                                        @if ($status === 'confirmed')
                                            <span class="badge badge-success badge-sm">Confirmed</span>
                                        @else
                                            <span class="badge badge-warning badge-sm">Swap Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pending swap requests --}}
        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body p-0">
                <div class="flex items-center justify-between p-5 border-b border-base-300">
                    <h2 class="font-bold text-base-content">Pending Swaps</h2>
                    <span class="badge badge-warning badge-sm">3 pending</span>
                </div>
                <ul class="divide-y divide-base-300">
                    @foreach ([
                        ['Ana Pineda',   'Jose Cruz',    'Tue • 8AM–4PM',  'Awaiting coworker'],
                        ['Carlos Reyes', 'Maria Santos', 'Wed • 8AM–4PM',  'Awaiting approval'],
                        ['Luis Garcia',  'Jose Cruz',    'Fri • 4PM–12AM', 'Awaiting coworker'],
                    ] as [$from, $to, $shift, $stage])
                        <li class="p-4">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div class="text-sm font-medium text-base-content leading-snug">
                                    {{ $from }}
                                    <span class="text-secondary font-bold mx-1">↔</span>
                                    {{ $to }}
                                </div>
                            </div>
                            <p class="text-xs text-base-content/60 mb-3">{{ $shift }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-warning">{{ $stage }}</span>
                                <div class="flex gap-1">
                                    <button class="btn btn-success btn-xs">Approve</button>
                                    <button class="btn btn-error btn-xs btn-outline">Reject</button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

</x-app-layout>
