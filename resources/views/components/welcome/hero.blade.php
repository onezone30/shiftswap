<section class="bg-base-200 py-16 lg:py-24">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="flex flex-col lg:flex-row items-center gap-12">

            {{-- Left: Copy --}}
            <div class="flex-1 text-center lg:text-left">
                <div class="badge badge-primary badge-outline gap-1.5 mb-5 py-3 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Built for Retail & Service Businesses
                </div>

                <h1 class="text-4xl lg:text-5xl font-extrabold text-base-content leading-tight mb-5">
                    ShiftSwap: Employee<br class="hidden lg:block"/>
                    Scheduling <span class="text-secondary">&amp;</span> Exchange
                </h1>

                <p class="text-lg text-base-content/70 leading-relaxed mb-8 max-w-xl mx-auto lg:mx-0">
                    A specialized web-based portal designed to optimize workforce management
                    for retail establishments, grocery stores, and cafés — replacing
                    informal Viber and Messenger coordination with a proper system.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            Start Your Free Trial
                        </a>
                    @endif
                    <a href="#demo" class="btn btn-outline btn-lg">
                        Request a Demo
                    </a>
                </div>
            </div>

            {{-- Right: App Mockup --}}
            <div class="flex-shrink-0 w-full max-w-sm">
                <div class="card bg-base-100 shadow-2xl border border-base-300">
                    <div class="card-body p-0">

                        {{-- Mock app bar --}}
                        <div class="bg-primary text-primary-content px-5 py-4 rounded-t-2xl flex items-center justify-between">
                            <span class="font-bold text-sm">Weekly Schedule</span>
                            <span class="badge badge-warning badge-sm font-semibold">2 Pending</span>
                        </div>

                        <div class="p-4 space-y-2.5">
                            {{-- Employee rows --}}
                            <div class="flex items-center gap-3 p-3 bg-base-200 rounded-xl">
                                <div class="avatar placeholder">
                                    <div class="bg-primary text-primary-content rounded-full w-9 text-xs font-bold">
                                        <span>MR</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold truncate">Maria Ramos</p>
                                    <p class="text-xs text-base-content/60">Mon • 8:00 AM – 4:00 PM</p>
                                </div>
                                <span class="badge badge-success badge-sm">Active</span>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-base-200 rounded-xl">
                                <div class="avatar placeholder">
                                    <div class="bg-secondary text-secondary-content rounded-full w-9 text-xs font-bold">
                                        <span>JC</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold truncate">Jose Cruz</p>
                                    <p class="text-xs text-base-content/60">Mon • 4:00 PM – 12:00 AM</p>
                                </div>
                                <span class="badge badge-success badge-sm">Active</span>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-base-200 rounded-xl opacity-60">
                                <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content rounded-full w-9 text-xs font-bold">
                                        <span>AP</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold truncate">Ana Pineda</p>
                                    <p class="text-xs text-base-content/60">Tue • 8:00 AM – 4:00 PM</p>
                                </div>
                                <span class="badge badge-warning badge-sm">Swap?</span>
                            </div>

                            {{-- Pending swap alert --}}
                            <div class="alert alert-warning p-3 rounded-xl mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold">Swap Request Pending</p>
                                    <p class="text-xs opacity-80">Ana ↔ Jose • Tuesday shift</p>
                                </div>
                                <div class="flex gap-1">
                                    <button class="btn btn-xs btn-success">✓</button>
                                    <button class="btn btn-xs btn-error">✗</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
