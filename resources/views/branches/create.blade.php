<x-app-layout>

    {{-- Page header --}}
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('branches.index') }}" class="btn btn-ghost btn-sm btn-square text-base-content/50 hover:text-base-content">
            <x-heroicon-o-arrow-left class="h-4 w-4" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-base-content">Add Branch</h1>
            <p class="text-sm text-base-content/50 mt-0.5">Register a new store location</p>
        </div>
    </div>

    <form method="POST" action="{{ route('branches.store') }}">
        @csrf

        <div class="flex flex-col gap-5 max-w-3xl">

            {{-- Location details --}}
            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body p-6 gap-5">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-building-storefront class="h-4 w-4 text-base-content/40" />
                        <h2 class="font-semibold text-base-content text-sm">Location Details</h2>
                    </div>

                    {{-- Name --}}
                    <div class="form-control gap-1.5">
                        <label class="label py-0" for="name">
                            <span class="label-text font-medium">Branch Name <span class="text-error">*</span></span>
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               class="input input-bordered input-sm @error('name') input-error @enderror"
                               placeholder="e.g. Putatan Branch" autofocus />
                        @error('name')
                            <span class="text-xs text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="form-control gap-1.5">
                        <label class="label py-0" for="address">
                            <span class="label-text font-medium">Address <span class="text-error">*</span></span>
                        </label>
                        <input id="address" type="text" name="address" value="{{ old('address') }}"
                               class="input input-bordered input-sm @error('address') input-error @enderror"
                               placeholder="e.g. 65 National Road, Putatan, Muntinlupa" />
                        @error('address')
                            <span class="text-xs text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Phone --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="phone">
                                <span class="label-text font-medium">Phone</span>
                            </label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                                   class="input input-bordered input-sm @error('phone') input-error @enderror"
                                   placeholder="e.g. 02-1234567" />
                            @error('phone')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="email">
                                <span class="label-text font-medium">Email</span>
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="input input-bordered input-sm @error('email') input-error @enderror"
                                   placeholder="e.g. putatan@rebeccas.com" />
                            @error('email')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- Management --}}
            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body p-6 gap-5">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-user-circle class="h-4 w-4 text-base-content/40" />
                        <h2 class="font-semibold text-base-content text-sm">Management</h2>
                    </div>

                    {{-- Manager --}}
                    <div class="form-control gap-1.5">
                        <label class="label py-0" for="manager_id">
                            <span class="label-text font-medium">Manager</span>
                        </label>
                        <select id="manager_id" name="manager_id"
                                class="w-full h-9 px-3 pr-8 text-sm text-base-content bg-base-100 border rounded-lg cursor-pointer focus:outline-none focus:border-primary transition-colors {{ $errors->has('manager_id') ? 'border-error' : 'border-base-300' }}">
                            <option value="">— No manager assigned —</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}" @selected(old('manager_id') == $manager->id)>
                                    {{ $manager->name }} ({{ $manager->role->label() }})
                                </option>
                            @endforeach
                        </select>
                        @error('manager_id')
                            <span class="text-xs text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div class="form-control gap-1.5">
                        <label class="label py-0" for="notes">
                            <span class="label-text font-medium">Notes</span>
                            <span class="label-text-alt text-base-content/40">Max 512 characters</span>
                        </label>
                        <textarea id="notes" name="notes" rows="3"
                                  class="textarea textarea-bordered textarea-sm resize-none @error('notes') textarea-error @enderror"
                                  placeholder="Any additional notes about this branch...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="text-xs text-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('branches.index') }}" class="btn btn-ghost btn-sm">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary btn-sm gap-2">
                    <x-heroicon-o-building-storefront class="h-4 w-4" />
                    Create Branch
                </button>
            </div>

        </div>
    </form>

</x-app-layout>
