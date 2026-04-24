<section class="py-16 lg:py-24 bg-primary" id="demo">
    <div class="container mx-auto px-6 max-w-4xl text-center">

        <h2 class="text-3xl lg:text-4xl font-extrabold text-primary-content mb-4">
            Ready to Fix Your Scheduling?
        </h2>
        <p class="text-primary-content/80 text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
            Join retail businesses that have replaced Viber scheduling chaos with a system
            that actually works. Start free — no credit card required.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary btn-lg shadow-lg">
                    Start Your Free Trial
                </a>
            @endif
            <a href="mailto:contact@shiftswap.com" class="btn btn-outline border-primary-content text-primary-content hover:bg-primary-content hover:text-primary btn-lg">
                Request a Demo
            </a>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-6 text-primary-content/70 text-sm">
            <span class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                No credit card required
            </span>
            <span class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Set up in under 15 minutes
            </span>
            <span class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Referral discounts available
            </span>
        </div>

    </div>
</section>
