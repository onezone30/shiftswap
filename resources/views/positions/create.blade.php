<x-app-layout>

    {{-- Page header --}}
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('positions.index') }}" class="btn btn-ghost btn-sm btn-square text-base-content/50 hover:text-base-content">
            <x-heroicon-o-arrow-left class="h-4 w-4" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-base-content">Add Position</h1>
            <p class="text-sm text-base-content/50 mt-0.5">Create a new job position</p>
        </div>
    </div>

    <form method="POST" action="{{ route('positions.store') }}"
          x-data="{
              name: '{{ old('name') }}',
              slug: '{{ old('slug') }}',
              slugEdited: {{ old('slug') ? 'true' : 'false' }},
              syncSlug() {
                  if (!this.slugEdited) {
                      this.slug = this.name
                          .toLowerCase()
                          .replace(/[^a-z0-9\s-]/g, '')
                          .trim()
                          .replace(/\s+/g, '-');
                  }
              },
          }">
        @csrf

        <div class="flex flex-col gap-5 max-w-3xl">

            {{-- Details --}}
            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body p-6 gap-5">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-briefcase class="h-4 w-4 text-base-content/40" />
                        <h2 class="font-semibold text-base-content text-sm">Position Details</h2>
                    </div>

                    {{-- Name --}}
                    <div class="form-control gap-1.5">
                        <label class="label py-0" for="name">
                            <span class="label-text font-medium">Name <span class="text-error">*</span></span>
                        </label>
                        <input id="name" type="text" name="name"
                               x-model="name"
                               @input="syncSlug()"
                               class="input input-bordered input-sm @error('name') input-error @enderror"
                               placeholder="e.g. Cashier" autofocus />
                        @error('name')
                            <span class="text-xs text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="form-control gap-1.5">
                        <label class="label py-0" for="slug">
                            <span class="label-text font-medium">Slug</span>
                            <span class="label-text-alt text-base-content/40">Auto-generated from name</span>
                        </label>
                        <input id="slug" type="text" name="slug"
                               x-model="slug"
                               @input="slugEdited = true"
                               class="input input-bordered input-sm font-mono @error('slug') input-error @enderror"
                               placeholder="e.g. cashier" />
                        @error('slug')
                            <span class="text-xs text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-control gap-1.5">
                        <label class="label py-0" for="description">
                            <span class="label-text font-medium">Description</span>
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="textarea textarea-bordered textarea-sm resize-none @error('description') textarea-error @enderror"
                                  placeholder="Briefly describe the responsibilities of this position...">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-xs text-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Settings --}}
            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body p-6 gap-4">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-adjustments-horizontal class="h-4 w-4 text-base-content/40" />
                        <h2 class="font-semibold text-base-content text-sm">Settings</h2>
                    </div>

                    {{-- is_active toggle --}}
                    <label class="flex items-center justify-between cursor-pointer">
                        <div>
                            <p class="text-sm font-medium text-base-content">Active</p>
                            <p class="text-xs text-base-content/50 mt-0.5">Inactive positions cannot be assigned to employees</p>
                        </div>
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1"
                               class="toggle toggle-primary"
                               @checked(old('is_active', '1') === '1') />
                    </label>

                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('positions.index') }}" class="btn btn-ghost btn-sm">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary btn-sm gap-2">
                    <x-heroicon-o-plus class="h-4 w-4" />
                    Create Position
                </button>
            </div>

        </div>
    </form>

</x-app-layout>
