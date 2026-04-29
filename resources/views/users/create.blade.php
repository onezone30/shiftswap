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

    <form method="POST" action="{{ route('users.store') }}"
          x-data="{
              role: '{{ old('role', '') }}',
              positionId: '{{ old('position_id', '') }}',
              selectedBranches: @js(array_map('intval', old('branch_ids', []))),
              allBranchIds: @js($branches->pluck('id')->toArray()),
              adminPositionId: {{ $adminPosition?->id ?? 'null' }},
              managerPositionId: {{ $managerPosition?->id ?? 'null' }},

              setRole(newRole) {
                  this.role = newRole;
                  if (newRole === 'admin') {
                      this.positionId = this.adminPositionId;
                      this.selectedBranches = [...this.allBranchIds];
                  } else if (newRole === 'manager') {
                      this.positionId = this.managerPositionId;
                  } else {
                      this.positionId = '';
                      if (this.selectedBranches.length > 1) {
                          this.selectedBranches = [this.selectedBranches[0]];
                      }
                  }
              },

              isChecked(id) { return this.selectedBranches.includes(id); },

              toggleBranch(id) {
                  if (this.role === 'admin') return;
                  if (this.role === 'employee') {
                      this.selectedBranches = [id];
                  } else {
                      const idx = this.selectedBranches.indexOf(id);
                      idx > -1 ? this.selectedBranches.splice(idx, 1) : this.selectedBranches.push(id);
                  }
              },
          }">
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

                        {{-- Phone --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="phone">
                                <span class="label-text font-medium">Phone Number</span>
                            </label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                                   class="input input-bordered input-sm @error('phone') input-error @enderror"
                                   placeholder="e.g. 09171234567" />
                            @error('phone')
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

                        {{-- Role --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="role">
                                <span class="label-text font-medium">Role <span class="text-error">*</span></span>
                            </label>
                            <select id="role" name="role"
                                    @change="setRole($event.target.value)"
                                    class="w-full h-9 px-3 pr-8 text-sm text-base-content bg-base-100 border rounded-lg cursor-pointer focus:outline-none focus:border-primary transition-colors {{ $errors->has('role') ? 'border-error' : 'border-base-300' }}">
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

                        {{-- Position --}}
                        <div class="form-control gap-1.5">
                            <span class="label-text font-medium">Position <span class="text-error">*</span></span>

                            {{-- Hidden input carries the actual value for all role types --}}
                            <input type="hidden" name="position_id" :value="positionId">

                            {{-- Admin / Manager: locked display --}}
                            <div x-show="role === 'admin' || role === 'manager'"
                                 class="w-full h-9 px-3 text-sm bg-base-200 border border-base-300 rounded-lg flex items-center justify-between text-base-content/60">
                                <span x-text="role === 'admin' ? 'Admin' : 'Manager'"></span>
                                <x-heroicon-o-lock-closed class="h-3.5 w-3.5 text-base-content/30" />
                            </div>

                            {{-- Employee: free select --}}
                            <select x-show="role === 'employee'"
                                    @change="positionId = $event.target.value"
                                    class="w-full h-9 px-3 pr-8 text-sm text-base-content bg-base-100 border border-base-300 rounded-lg cursor-pointer focus:outline-none focus:border-primary transition-colors">
                                <option value="" disabled :selected="!positionId">Select a position</option>
                                @foreach ($employeePositions as $position)
                                    <option value="{{ $position->id }}" @selected(old('position_id') == $position->id)>
                                        {{ $position->name }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- No role selected yet --}}
                            <div x-show="role === ''"
                                 class="w-full h-9 px-3 text-sm bg-base-200 border border-base-300 rounded-lg flex items-center text-base-content/30 italic">
                                Select a role first
                            </div>

                            @error('position_id')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Employment type --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="employment_type">
                                <span class="label-text font-medium">Employment Type <span class="text-error">*</span></span>
                            </label>
                            <select id="employment_type" name="employment_type"
                                    class="w-full h-9 px-3 pr-8 text-sm text-base-content bg-base-100 border rounded-lg cursor-pointer focus:outline-none focus:border-primary transition-colors {{ $errors->has('employment_type') ? 'border-error' : 'border-base-300' }}">
                                <option value="" disabled @selected(!old('employment_type'))>Select type</option>
                                @foreach ($employmentTypes as $type)
                                    <option value="{{ $type->value }}" @selected(old('employment_type') === $type->value)>
                                        {{ $type->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employment_type')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Hire date --}}
                        <div class="form-control gap-1.5">
                            <label class="label py-0" for="hired_at">
                                <span class="label-text font-medium">Hire Date</span>
                            </label>
                            <input id="hired_at" type="date" name="hired_at"
                                   value="{{ old('hired_at') }}"
                                   class="input input-bordered input-sm @error('hired_at') input-error @enderror" />
                            @error('hired_at')
                                <span class="text-xs text-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- Branch --}}
                    <div class="form-control gap-2">
                        <div class="flex items-center justify-between">
                            <span class="label-text font-medium">Branch <span class="text-error">*</span></span>
                            <span class="text-xs text-base-content/40"
                                  x-text="role === 'admin' ? 'All branches assigned automatically'
                                        : role === 'manager' ? 'Select all that apply'
                                        : role === 'employee' ? 'Select one branch'
                                        : 'Select a role first'">
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @foreach ($branches as $branch)
                                {{-- Hidden checkbox — Alpine controls checked state for form submission --}}
                                <input type="checkbox" name="branch_ids[]" value="{{ $branch->id }}"
                                       class="sr-only"
                                       :checked="isChecked({{ $branch->id }})">

                                {{-- Visual card --}}
                                <div @click="toggleBranch({{ $branch->id }})"
                                     :class="{
                                         'border-primary bg-primary/5':     isChecked({{ $branch->id }}),
                                         'border-base-300':                 !isChecked({{ $branch->id }}),
                                         'cursor-not-allowed':              role === 'admin',
                                         'cursor-pointer hover:border-primary/50 hover:bg-base-200/40': role !== 'admin',
                                     }"
                                     class="flex items-center gap-3 p-3 rounded-lg border transition-colors select-none">

                                    {{-- Indicator: circle for employee, square for admin/manager --}}
                                    <div :class="{
                                             'rounded-full': role === 'employee',
                                             'rounded':      role !== 'employee',
                                             'bg-primary border-primary': isChecked({{ $branch->id }}),
                                             'border-base-300 bg-base-100': !isChecked({{ $branch->id }}),
                                         }"
                                         class="w-4 h-4 border-2 shrink-0 flex items-center justify-center transition-colors">
                                        <x-heroicon-o-check x-show="isChecked({{ $branch->id }})"
                                                            class="h-2.5 w-2.5 text-primary-content" />
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-base-content leading-tight">{{ $branch->name }}</p>
                                        <p class="text-xs text-base-content/50 truncate">{{ $branch->address }}</p>
                                    </div>

                                    <x-heroicon-o-lock-closed x-show="role === 'admin'"
                                                              class="h-3.5 w-3.5 text-base-content/25 shrink-0" />
                                </div>
                            @endforeach
                        </div>

                        @error('branch_ids')
                            <span class="text-xs text-error">{{ $message }}</span>
                        @enderror
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
