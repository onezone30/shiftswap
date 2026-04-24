@php
$features = [
    [
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
        'color' => 'primary',
        'title' => 'Centralized Schedule Viewing',
        'desc'  => 'Employees log in and instantly see their assigned weekly shifts — no chasing managers for updates.',
    ],
    [
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>',
        'color' => 'secondary',
        'title' => 'Instant Shift Swaps',
        'desc'  => 'Staff can request exchanges with eligible coworkers sharing the same branch and position — digitally and instantly.',
    ],
    [
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        'color' => 'success',
        'title' => 'Managerial Control',
        'desc'  => 'Every swap requires manager approval before it takes effect — ensuring proper staffing levels at all times.',
    ],
    [
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>',
        'color' => 'info',
        'title' => 'Administrative Dashboard',
        'desc'  => 'Build schedules, assign staff, monitor floor coverage, and review all swap activity from one dashboard.',
    ],
    [
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>',
        'color' => 'warning',
        'title' => 'Real-Time Notifications',
        'desc'  => 'In-app and email alerts keep employees and managers informed at each step — request, response, and approval.',
    ],
    [
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>',
        'color' => 'neutral',
        'title' => 'Secure Access',
        'desc'  => 'Role-based logins for employees, managers, and admins keep scheduling data protected and access scoped properly.',
    ],
];
@endphp

<section class="py-16 lg:py-24 bg-base-200">
    <div class="container mx-auto px-6 max-w-6xl">

        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-base-content mb-3">Core Features</h2>
            <p class="text-base-content/60 text-lg max-w-xl mx-auto">
                Everything your team needs to run scheduling without the chaos.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($features as $feature)
                <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow border border-base-300">
                    <div class="card-body">
                        <div class="w-11 h-11 rounded-xl bg-{{ $feature['color'] }}/10 flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-{{ $feature['color'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                {!! $feature['icon'] !!}
                            </svg>
                        </div>
                        <h3 class="card-title text-base">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-base-content/70 leading-relaxed">{{ $feature['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
