@php
$values = [
    [
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
        'color' => 'primary',
        'title' => 'Efficiency',
        'desc'  => 'We eliminate scheduling friction so your team can focus on serving customers, not coordinating calendars.',
    ],
    [
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        'color' => 'success',
        'title' => 'Reliability',
        'desc'  => 'Every schedule change goes through a structured approval process — nothing slips through informally.',
    ],
    [
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>',
        'color' => 'info',
        'title' => 'Transparency',
        'desc'  => 'Managers, employees, and admins all see the same data — no hidden changes, no silent edits.',
    ],
    [
        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>',
        'color' => 'secondary',
        'title' => 'Continuous Improvement',
        'desc'  => 'We actively collect feedback from real retail teams and ship improvements based on actual usage.',
    ],
];
@endphp

<section class="py-16 lg:py-24 bg-base-200">
    <div class="container mx-auto px-6 max-w-6xl">

        <div class="flex flex-col lg:flex-row gap-12 items-start">

            {{-- Mission --}}
            <div class="lg:w-80 shrink-0 text-center lg:text-left">
                <div class="badge badge-primary mb-4">Our Mission</div>
                <h2 class="text-3xl font-bold text-base-content mb-4">Why We Built This</h2>
                <p class="text-base-content/70 leading-relaxed">
                    To provide a <strong>secure and easy-to-use system</strong> that reduces scheduling conflicts,
                    improves communication, and supports managers in maintaining proper staffing levels —
                    starting with local retail businesses that have been left behind by enterprise-only tools.
                </p>
            </div>

            {{-- Values --}}
            <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach ($values as $value)
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 bg-{{ $value['color'] }}/10 rounded-xl flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-{{ $value['color'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                {!! $value['icon'] !!}
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-base-content mb-1">{{ $value['title'] }}</h3>
                            <p class="text-sm text-base-content/70 leading-relaxed">{{ $value['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
