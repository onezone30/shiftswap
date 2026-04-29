<x-app-layout>

    {{-- Page header --}}
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('users.index') }}" class="btn btn-ghost btn-sm btn-square text-base-content/50 hover:text-base-content">
            <x-heroicon-o-arrow-left class="h-4 w-4" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-base-content">Add User</h1>
            <p class="text-sm text-base-content/50 mt-0.5">Create a new staff account</p>
        </div>
    </div>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="flex flex-col gap-5 max-w-3xl">

            {{-- Personal information --}}
            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body p-6 gap-5">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-user class="h-4 w-4 text-base-content/40" />
                        <h2 class="font-semibold text-base-content text-sm">Personal Information</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Name --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="name">
                                <span class="label-text font-medium">Full Name <span class="text-error">*</span></span>
                            </label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                   class="input input-bordered input-sm @error('name') input-error @enderror"
                                   placeholder="e.g. Jane Doe" autofocus />
                            @error('name')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="email">
                                <span class="label-text font-medium">Email Address <span class="text-error">*</span></span>
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="input input-bordered input-sm @error('email') input-error @enderror"
                                   placeholder="e.g. jane@example.com" />
                            @error('email')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- Password --}}
            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body p-6 gap-5">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-lock-closed class="h-4 w-4 text-base-content/40" />
                        <h2 class="font-semibold text-base-content text-sm">Password</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Password --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="password">
                                <span class="label-text font-medium">Password <span class="text-error">*</span></span>
                            </label>
                            <input id="password" type="password" name="password"
                                   class="input input-bordered input-sm @error('password') input-error @enderror"
                                   placeholder="Min. 8 characters" />
                            @error('password')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Confirm password --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="password_confirmation">
                                <span class="label-text font-medium">Confirm Password <span class="text-error">*</span></span>
                            </label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="input input-bordered input-sm"
                                   placeholder="Repeat password" />
                        </div>

                    </div>
                </div>
            </div>

            {{-- Assignment & Access --}}
            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body p-6 gap-5">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-building-storefront class="h-4 w-4 text-base-content/40" />
                        <h2 class="font-semibold text-base-content text-sm">Assignment & Access</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Branch --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="branch_id">
                                <span class="label-text font-medium">Branch <span class="text-error">*</span></span>
                            </label>
                            <select id="branch_id" name="branch_id"
                                    class="select select-bordered select-sm @error('branch_id') select-error @enderror">
                                <option value="" disabled @selected(!old('branch_id'))>Select a branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" @selected(old('branch_id') == $branch->id)>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('branch_id')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Position --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="position_id">
                                <span class="label-text font-medium">Position <span class="text-error">*</span></span>
                            </label>
                            <select id="position_id" name="position_id"
                                    class="select select-bordered select-sm @error('position_id') select-error @enderror">
                                <option value="" disabled @selected(!old('position_id'))>Select a position</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" @selected(old('position_id') == $position->id)>
                                        {{ $position->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('position_id')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="role">
                                <span class="label-text font-medium">Role <span class="text-error">*</span></span>
                            </label>
                            <select id="role" name="role"
                                    class="select select-bordered select-sm @error('role') select-error @enderror">
                                <option value="" disabled @selected(!old('role'))>Select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->value }}" @selected(old('role') === $role->value)>
                                        {{ $role->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('users.index') }}" class="btn btn-ghost btn-sm">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary btn-sm gap-2">
                    <x-heroicon-o-user-plus class="h-4 w-4" />
                    Create User
                </button>
            </div>

        </div>
    </form>

</x-app-layout>
