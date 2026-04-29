<x-app-layout>

    {{-- Page header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-base-content">Positions</h1>
            <p class="text-sm text-base-content/50 mt-0.5">
                @if (request()->hasAny(['search', 'status']))
                    Showing {{ $positions->count() }} of {{ $totalPositions }} positions
                @else
                    {{ $totalPositions }} positions
                @endif
            </p>
        </div>
        <button class="btn btn-primary btn-sm gap-2">
            <x-heroicon-o-plus class="h-4 w-4" />
            Add Position
        </button>
    </div>

    {{-- Stat cards --}}
    @php
        $statCards = [
            [
                'label'     => 'Total Positions',
                'value'     => $totalPositions,
                'sub'       => 'Across all branches',
                'icon'      => 'heroicon-o-briefcase',
                'iconBg'    => 'bg-primary/10',
                'iconColor' => 'text-primary',
            ],
            [
                'label'     => 'Active',
                'value'     => $activeCount,
                'sub'       => 'Currently in use',
                'icon'      => 'heroicon-o-check-circle',
                'iconBg'    => 'bg-success/10',
                'iconColor' => 'text-success',
            ],
            [
                'label'     => 'Inactive',
                'value'     => $inactiveCount,
                'sub'       => 'Not currently used',
                'icon'      => 'heroicon-o-x-circle',
                'iconBg'    => 'bg-base-300',
                'iconColor' => 'text-base-content/40',
            ],
            [
                'label'     => 'Staff Assigned',
                'value'     => $totalAssigned,
                'sub'       => 'Across all positions',
                'icon'      => 'heroicon-o-user-group',
                'iconBg'    => 'bg-warning/10',
                'iconColor' => 'text-warning',
            ],
        ];
    @endphp

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach ($statCards as $card)
            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body p-5">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm text-base-content/60">{{ $card['label'] }}</span>
                        <div class="w-9 h-9 {{ $card['iconBg'] }} rounded-lg flex items-center justify-center">
                            <x-dynamic-component :component="$card['icon']" class="h-4 w-4 {{ $card['iconColor'] }}" />
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-base-content">{{ $card['value'] }}</p>
                    <p class="text-xs text-base-content/50 mt-1">{{ $card['sub'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Table card --}}
    <div class="card bg-base-100 border border-base-300 shadow-sm">

        {{-- Toolbar --}}
        <form method="GET" action="{{ route('positions.index') }}"
              class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 border-b border-base-300">

            <div class="relative w-full sm:max-w-sm">
                <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-base-content/40 pointer-events-none" />
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by name or description..."
                       class="input input-bordered input-sm w-full pl-9 text-base-content bg-base-100" />
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <span class="text-xs font-medium text-base-content/40 hidden sm:block">Filter by</span>

                @php
                    $selectClass = 'h-9 px-3 pr-8 text-sm text-base-content bg-base-100 border border-base-300 rounded-lg cursor-pointer focus:outline-none focus:border-primary transition-colors';
                @endphp

                <select name="status" class="{{ $selectClass }}">
                    <option value="">All statuses</option>
                    <option value="active"   @selected(request('status') === 'active')>Active</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                </select>

                <button type="submit" class="btn btn-primary btn-sm gap-2 ml-1">
                    <x-heroicon-o-magnifying-glass class="h-4 w-4" />
                    Search
                </button>

                @if (request()->hasAny(['search', 'status']))
                    <a href="{{ route('positions.index') }}" class="btn btn-ghost btn-sm text-base-content/50">
                        Clear
                    </a>
                @endif
            </div>
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead class="bg-base-200/60 text-xs text-base-content/60 uppercase tracking-wide">
                    <tr>
                        <th class="py-3">Position</th>
                        <th class="py-3">Description</th>
                        <th class="py-3">Staff</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($positions as $position)
                        <tr class="hover border-b border-base-200 last:border-0">

                            {{-- Position name --}}
                            <td class="py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0
                                                {{ $position->is_active ? 'bg-primary/10' : 'bg-base-200' }}">
                                        <x-heroicon-o-briefcase class="h-4 w-4 {{ $position->is_active ? 'text-primary' : 'text-base-content/30' }}" />
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm text-base-content">{{ $position->name }}</p>
                                        @if ($position->slug)
                                            <p class="text-xs text-base-content/40 font-mono">{{ $position->slug }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Description --}}
                            <td class="py-3 max-w-xs">
                                @if ($position->description)
                                    <p class="text-sm text-base-content/60 truncate">{{ $position->description }}</p>
                                @else
                                    <span class="text-xs text-base-content/30 italic">No description</span>
                                @endif
                            </td>

                            {{-- Staff count --}}
                            <td class="py-3">
                                <div class="flex items-center gap-1.5 text-sm text-base-content/60">
                                    <x-heroicon-o-user-group class="h-3.5 w-3.5 text-base-content/30" />
                                    {{ $position->users_count }}
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="py-3">
                                @if ($position->is_active)
                                    <span class="badge badge-success badge-sm">Active</span>
                                @else
                                    <span class="badge badge-ghost badge-sm text-base-content/40">Inactive</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="py-3">
                                <div class="flex items-center gap-1">
                                    <button class="btn btn-ghost btn-xs text-base-content/40 hover:text-base-content" title="Edit">
                                        <x-heroicon-o-pencil-square class="h-4 w-4" />
                                    </button>
                                    <button class="btn btn-ghost btn-xs text-error/40 hover:text-error" title="Delete">
                                        <x-heroicon-o-trash class="h-4 w-4" />
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-16">
                                <div class="flex flex-col items-center gap-2 text-base-content/30">
                                    <x-heroicon-o-briefcase class="h-10 w-10" />
                                    <p class="text-sm">No positions found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-app-layout>
