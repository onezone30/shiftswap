<section class="py-16 lg:py-24 bg-base-100">
    <div class="container mx-auto px-6 max-w-6xl">

        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-base-content mb-3">Built for Businesses Like Yours</h2>
            <p class="text-base-content/60 text-lg max-w-xl mx-auto">
                ShiftSwap is tailored for small and medium retail businesses and service establishments
                operating on shifting schedules.
            </p>
        </div>

        {{-- Stats --}}
        <div class="stats stats-vertical lg:stats-horizontal shadow-sm border border-base-300 w-full mb-12 bg-base-100">
            <div class="stat">
                <div class="stat-figure text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="stat-title">Ideal Team Size</div>
                <div class="stat-value text-primary">5–50</div>
                <div class="stat-desc">Employees per location</div>
            </div>
            <div class="stat">
                <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div class="stat-title">Branch Support</div>
                <div class="stat-value text-secondary">Multi</div>
                <div class="stat-desc">Manage all locations in one place</div>
            </div>
            <div class="stat">
                <div class="stat-figure text-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-title">Pricing</div>
                <div class="stat-value text-success">Affordable</div>
                <div class="stat-desc">Designed for local retail budgets</div>
            </div>
        </div>

        {{-- Who it's for cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['🛒', 'Grocery Stores',   'Full-shift coverage for high-turnover retail environments.'],
                ['🏪', 'Mini-Marts',        'Compact teams, multi-shift operations, multiple cashiers.'],
                ['☕', 'Cafés & Restaurants','Service staff swaps, kitchen and floor coverage management.'],
                ['🏬', 'Retail Chains',     'Consistent scheduling across all your branch locations.'],
            ] as [$emoji, $type, $description])
                <div class="card bg-base-200 border border-base-300">
                    <div class="card-body items-center text-center py-6">
                        <span class="text-4xl mb-2">{{ $emoji }}</span>
                        <h3 class="card-title text-sm">{{ $type }}</h3>
                        <p class="text-xs text-base-content/60 leading-relaxed">{{ $description }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
