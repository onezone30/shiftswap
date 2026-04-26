<x-guest-layout>
    <div class="card bg-base-100 shadow-sm border border-base-300">
        <div class="card-body gap-5">

            {{-- Header --}}
            <div>
                <h1 class="text-2xl font-bold text-base-content">{{ __('Reset your password') }}</h1>
                <p class="text-sm text-base-content/60 mt-1">
                    {{ __('Enter your email and we\'ll send you a reset link.') }}
                </p>
            </div>

            <x-auth-session-status :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
                @csrf

                {{-- Email --}}
                <div class="form-control gap-1.5">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        placeholder="you@example.com"
                        required
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <button type="submit" class="btn btn-primary w-full mt-2">
                    {{ __('Send Reset Link') }}
                </button>
            </form>

            <p class="text-center text-sm text-base-content/60">
                {{ __('Remembered it?') }}
                <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">{{ __('Back to login') }}</a>
            </p>

        </div>
    </div>
</x-guest-layout>
