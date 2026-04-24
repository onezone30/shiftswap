<section class="py-16 lg:py-24 bg-base-100">
    <div class="container mx-auto px-6 max-w-6xl">

        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-base-content mb-3">Sound familiar?</h2>
            <p class="text-base-content/60 text-lg max-w-xl mx-auto">
                Most retail businesses run scheduling the same broken way. There's a better path.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- The Problem --}}
            <div class="card bg-error/5 border border-error/20">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-error/10 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                            </svg>
                        </div>
                        <h3 class="card-title text-error">The Problem</h3>
                    </div>
                    <ul class="space-y-3">
                        @foreach([
                            'Employee no-shows due to missed schedule updates',
                            'Last-minute shift conflicts with no clear resolution process',
                            'Managers stressed by constant coordination via Viber or Messenger',
                            'No accountability when swaps happen informally',
                            'Staffing gaps discovered too late to fix',
                        ] as $problem)
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-error shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span class="text-sm text-base-content/80">{{ $problem }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- The Solution --}}
            <div class="card bg-success/5 border border-success/20">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-success/10 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="card-title text-success">The ShiftSwap Solution</h3>
                    </div>
                    <ul class="space-y-3">
                        @foreach([
                            'One centralized platform everyone checks — no more scattered messages',
                            'Structured swap requests with coworker consent and manager sign-off',
                            'Managers approve or reject swaps in one click from any device',
                            'Full audit trail of who swapped what, when, and why',
                            'Real-time notifications keep everyone aligned at every step',
                        ] as $solution)
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-sm text-base-content/80">{{ $solution }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
