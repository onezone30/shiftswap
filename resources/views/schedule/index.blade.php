<x-app-layout>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-base-content">Schedule</h1>
            <p class="text-sm text-base-content/50 mt-0.5">Manage shifts across all branches</p>
        </div>
        <button class="btn btn-primary btn-sm gap-2">
            <x-heroicon-o-plus class="h-4 w-4" />
            New Shift
        </button>
    </div>

    <div class="card bg-base-100 border border-base-300 shadow-sm">
        <div class="card-body items-center justify-center py-24 text-center">
            <x-heroicon-o-calendar class="h-12 w-12 text-base-content/20 mb-4" />
            <p class="text-base-content/40 text-sm">Schedule coming soon</p>
        </div>
    </div>
</x-app-layout>
