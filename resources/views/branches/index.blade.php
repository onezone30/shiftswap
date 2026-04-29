<x-app-layout>

    {{-- Page header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-base-content">Branches</h1>
            <p class="text-sm text-base-content/50 mt-0.5">
                {{ $branches->count() }} {{ Str::plural('location', $branches->count()) }}
                &middot;
                {{ $totalStaff }} {{ Str::plural('staff member', $totalStaff) }}
            </p>
        </div>
        <a href="{{ route('branches.create') }}" class="btn btn-primary btn-sm gap-2">
            <x-heroicon-o-plus class="h-4 w-4" />
            Add Branch
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('branches.index') }}" class="mb-6 flex items-center gap-2">
        <div class="relative w-full max-w-sm">
            <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-base-content/40 pointer-events-none" />
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by name or address..."
                   class="input input-bordered input-sm w-full pl-9 text-base-content bg-base-100" />
        </div>
        <button type="submit" class="btn btn-primary btn-sm gap-2">
            <x-heroicon-o-magnifying-glass class="h-4 w-4" />
            Search
        </button>
        @if (request()->filled('search'))
            <a href="{{ route('branches.index') }}" class="btn btn-ghost btn-sm text-base-content/50">
                Clear
            </a>
        @endif
    </form>

    {{-- Cards grid --}}
    @if ($branches->isEmpty())
        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body items-center justify-center py-24 text-center">
                <x-heroicon-o-building-storefront class="h-12 w-12 text-base-content/20 mb-4" />
                <p class="text-base-content/40 text-sm font-medium">
                    {{ request()->filled('search') ? 'No branches match your search' : 'No branches yet' }}
                </p>
                @if (!request()->filled('search'))
                    <button class="btn btn-primary btn-sm mt-4 gap-2">
                        <x-heroicon-o-plus class="h-4 w-4" />
                        Add your first branch
                    </button>
                @endif
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach ($branches as $branch)
                <x-branch-card :branch="$branch" />
            @endforeach
        </div>
    @endif

</x-app-layout>
