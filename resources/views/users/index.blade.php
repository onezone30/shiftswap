<x-app-layout>
<div x-data="{ confirmAction: '', deleteTarget: { name: '' } }">

    {{-- Page header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-base-content">Users</h1>
            <p class="text-sm text-base-content/50 mt-0.5">
                @if (request()->hasAny(['search', 'role', 'branch']))
                    Showing {{ $users->total() }} of {{ $totalUsers }} users
                @else
                    {{ $totalUsers }} total users
                @endif
            </p>
        </div>
        <button class="btn btn-primary btn-sm gap-2">
            <x-heroicon-o-plus class="h-4 w-4" />
            Add User
        </button>
    </div>

    {{-- Summary cards --}}
    @php
        $statCards = [
            [
                'label'      => 'Total Users',
                'value'      => $totalUsers,
                'sub'        => 'Across all branches',
                'icon'       => 'heroicon-o-user-group',
                'iconBg'     => 'bg-primary/10',
                'iconColor'  => 'text-primary',
            ],
            [
                'label'      => 'Admins',
                'value'      => $roleCounts->get('admin', 0),
                'sub'        => 'Full system access',
                'icon'       => 'heroicon-o-shield-check',
                'iconBg'     => 'bg-error/10',
                'iconColor'  => 'text-error',
            ],
            [
                'label'      => 'Managers',
                'value'      => $roleCounts->get('manager', 0),
                'sub'        => 'Branch-level access',
                'icon'       => 'heroicon-o-briefcase',
                'iconBg'     => 'bg-warning/10',
                'iconColor'  => 'text-warning',
            ],
            [
                'label'      => 'Employees',
                'value'      => $roleCounts->get('employee', 0),
                'sub'        => ($totalUsers > 0 ? round(($roleCounts->get('employee', 0) / $totalUsers) * 100) : 0) . '% of total users',
                'icon'       => 'heroicon-o-user',
                'iconBg'     => 'bg-success/10',
                'iconColor'  => 'text-success',
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

    {{-- Users table --}}
    <div class="card bg-base-100 border border-base-300 shadow-sm">

        {{-- Toolbar --}}
        <form method="GET" action="{{ route('users.index') }}"
              class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 border-b border-base-300">

            {{-- Search --}}
            <div class="relative w-full sm:max-w-sm">
                <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-base-content/40 pointer-events-none" />
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by name or email..."
                       class="input input-bordered input-sm w-full pl-9 text-base-content bg-base-100"/>
            </div>

            {{-- Filters --}}
            <div class="flex items-center gap-2 shrink-0">
                <span class="text-xs font-medium text-base-content/40 hidden sm:block">Filter by</span>

                @php
                    $selectClass = 'h-9 px-3 pr-8 text-sm text-base-content bg-base-100 border border-base-300 rounded-lg cursor-pointer focus:outline-none focus:border-primary transition-colors';
                @endphp

                <select name="role" class="{{ $selectClass }}">
                    <option value="">All roles</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->value }}" @selected(request('role') === $role->value)>
                            {{ $role->label() }}
                        </option>
                    @endforeach
                </select>

                <select name="branch" class="{{ $selectClass }}">
                    <option value="">All branches</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch }}" @selected(request('branch') === $branch)>{{ $branch }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary btn-sm gap-2 ml-1">
                    <x-heroicon-o-magnifying-glass class="h-4 w-4" />
                    Search
                </button>

                @if (request()->hasAny(['search', 'role', 'branch']))
                    <a href="{{ route('users.index') }}" class="btn btn-ghost btn-sm text-base-content/50">
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
                        <th class="py-3">User</th>
                        <th class="py-3">Branch</th>
                        <th class="py-3">Position</th>
                        <th class="py-3">Role</th>
                        <th class="py-3">Joined</th>
                        <th class="py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="hover border-b border-base-200 last:border-0">

                            {{-- User --}}
                            <td class="py-3">
                                <div class="flex items-center gap-3">
                                    <x-user-avatar :name="$user->name" />
                                    <div class="min-w-0">
                                        <p class="font-semibold text-sm text-base-content">{{ $user->name }}</p>
                                        <p class="text-xs text-base-content/50">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Branch --}}
                            <td class="py-3">
                                <div class="flex items-center gap-1.5 text-sm text-base-content/70">
                                    <x-heroicon-o-map-pin class="h-3.5 w-3.5 text-base-content/40 shrink-0" />
                                    {{ $user->branch->name }}
                                </div>
                            </td>

                            {{-- Position --}}
                            <td class="py-3 text-sm text-base-content/70">{{ $user->position->name }}</td>

                            {{-- Role --}}
                            <td class="py-3"><x-role-badge :role="$user->role" /></td>

                            {{-- Joined --}}
                            <td class="py-3 text-sm text-base-content/50 whitespace-nowrap">
                                {{ $user->created_at->format('M j, Y') }}
                            </td>

                            {{-- Actions --}}
                            <td class="py-3">
                                <div class="flex items-center gap-1">
                                    <button class="btn btn-ghost btn-xs text-base-content/40 hover:text-base-content" title="Edit">
                                        <x-heroicon-o-pencil-square class="h-4 w-4" />
                                    </button>
                                    <button
                                        class="btn btn-ghost btn-xs text-error/40 hover:text-error"
                                        title="Delete"
                                        @click="confirmAction = '{{ route('users.destroy', $user) }}'; deleteTarget.name = '{{ addslashes($user->name) }}'; $refs.confirmModal.showModal()">
                                        <x-heroicon-o-trash class="h-4 w-4" />
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-16">
                                <div class="flex flex-col items-center gap-2 text-base-content/30">
                                    <x-heroicon-o-user-group class="h-10 w-10" />
                                    <p class="text-sm">No users found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="px-4 py-3 border-t border-base-300">
                {{ $users->links() }}
            </div>
        @endif

    </div>

    {{-- Delete confirmation modal --}}
    <x-confirm-modal title="Delete user?" action-label="Delete">
        You are about to delete <span class="font-medium text-base-content" x-text="deleteTarget.name"></span>.
        This action cannot be undone.
    </x-confirm-modal>

</div>
</x-app-layout>
