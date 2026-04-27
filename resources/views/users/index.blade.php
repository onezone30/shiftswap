<x-app-layout>

    {{-- Page header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-base-content">Users</h1>
            <p class="text-sm text-base-content/50 mt-0.5">{{ $users->count() }} total users</p>
        </div>
        <button class="btn btn-primary btn-sm gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Add User
        </button>
    </div>

    {{-- Summary cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        @foreach ([
            ['label' => 'Total',     'value' => $users->count(),                              'class' => 'bg-base-100'],
            ['label' => 'Admins',    'value' => $users->where('role', 'admin')->count(),    'class' => 'bg-error/10'],
            ['label' => 'Managers',  'value' => $users->where('role', 'manager')->count(),  'class' => 'bg-warning/10'],
            ['label' => 'Employees', 'value' => $users->where('role', 'employee')->count(), 'class' => 'bg-success/10'],
        ] as $stat)
            <div class="card {{ $stat['class'] }} border border-base-300 shadow-sm">
                <div class="card-body p-5">
                    <p class="text-sm text-base-content/60">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-bold text-base-content">{{ $stat['value'] }}</p>
                </div>
            </div>
        @endforeach

    </div>

    {{-- Users table --}}
    <div class="card bg-base-100 border border-base-300 shadow-sm">

        {{-- Toolbar --}}
        <div class="flex items-center justify-between gap-3 p-4 border-b border-base-300">
            <input
                type="text"
                placeholder="Search users..."
                class="input input-bordered input-sm w-full max-w-xs"
            />
            <div class="flex items-center gap-2 shrink-0">
                <select class="select select-bordered select-sm">
                    <option value="">All roles</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="employee">Employee</option>
                </select>
                <select class="select select-bordered select-sm">
                    <option value="">All branches</option>
                    @foreach ($users->pluck('branch.name')->unique()->sort() as $branch)
                        <option>{{ $branch }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr class="text-xs text-base-content/60">
                        <th>User</th>
                        <th>Branch</th>
                        <th>Position</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="hover">

                            {{-- User --}}
                            <td>
                                <div class="flex items-center gap-3">
                                    <x-user-avatar :name="$user->name" />
                                    <div class="min-w-0">
                                        <p class="font-medium text-sm text-base-content truncate">{{ $user->name }}</p>
                                        <p class="text-xs text-base-content/50 truncate">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Branch --}}
                            <td>
                                <span class="badge badge-ghost badge-sm">{{ $user->branch->name }}</span>
                            </td>

                            {{-- Position --}}
                            <td class="text-sm text-base-content/70">{{ $user->position->name }}</td>

                            {{-- Role --}}
                            <td><x-role-badge :role="$user->role" /></td>

                            {{-- Joined --}}
                            <td class="text-sm text-base-content/50 whitespace-nowrap">
                                {{ $user->created_at->format('M j, Y') }}
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="dropdown dropdown-end">
                                    <label tabindex="0" class="btn btn-ghost btn-xs text-base-content/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/>
                                        </svg>
                                    </label>
                                    <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 border border-base-300 rounded-box shadow-md w-36 z-10 p-1">
                                        <li><a class="text-sm">Edit</a></li>
                                        <li><a class="text-sm text-error">Delete</a></li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-base-content/40 text-sm">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-app-layout>
