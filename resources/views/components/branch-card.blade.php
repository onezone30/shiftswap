@props(['branch'])

<div class="card bg-base-100 border border-base-300 shadow-sm group
            transition-all duration-200 hover:-translate-y-1 hover:shadow-lg hover:border-primary/30">

    {{-- Colored top accent bar --}}
    <div class="h-1 rounded-t-2xl bg-gradient-to-r from-primary to-secondary
                opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>

    <div class="card-body p-5 gap-4">

        {{-- Header --}}
        <div class="flex items-start justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-11 h-11 bg-primary/10 rounded-xl flex items-center justify-center shrink-0
                            group-hover:bg-primary/20 transition-colors duration-200">
                    <x-heroicon-o-building-storefront class="h-5 w-5 text-primary" />
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-base-content leading-tight truncate">{{ $branch->name }}</h3>
                    <div class="flex items-center gap-1 mt-0.5">
                        <x-heroicon-o-map-pin class="h-3 w-3 text-base-content/30 shrink-0" />
                        <p class="text-xs text-base-content/50 truncate">{{ $branch->address }}</p>
                    </div>
                </div>
            </div>

            {{-- Staff count badge --}}
            <div class="badge badge-ghost badge-sm shrink-0 gap-1">
                <x-heroicon-o-user-group class="h-3 w-3" />
                {{ $branch->users_count }}
            </div>
        </div>

        {{-- Info rows --}}
        @if ($branch->phone || $branch->email || $branch->manager)
            <div class="space-y-2 text-sm text-base-content/60">
                @if ($branch->manager)
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-user-circle class="h-3.5 w-3.5 shrink-0 text-base-content/30" />
                        <span class="truncate">{{ $branch->manager->name }}</span>
                    </div>
                @endif

                @if ($branch->phone)
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-phone class="h-3.5 w-3.5 shrink-0 text-base-content/30" />
                        <span>{{ $branch->phone }}</span>
                    </div>
                @endif

                @if ($branch->email)
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-envelope class="h-3.5 w-3.5 shrink-0 text-base-content/30" />
                        <span class="truncate">{{ $branch->email }}</span>
                    </div>
                @endif
            </div>
        @endif

        {{-- Notes --}}
        @if ($branch->notes)
            <p class="text-xs text-base-content/40 border-t border-base-200 pt-3 line-clamp-2 leading-relaxed">
                {{ $branch->notes }}
            </p>
        @endif

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-1 border-t border-base-200 pt-3 -mb-1">
            <button class="btn btn-ghost btn-xs text-base-content/40 hover:text-base-content" title="Edit">
                <x-heroicon-o-pencil-square class="h-4 w-4" />
            </button>
            <button class="btn btn-ghost btn-xs text-error/40 hover:text-error" title="Delete">
                <x-heroicon-o-trash class="h-4 w-4" />
            </button>
        </div>

    </div>
</div>
