<x-guest-layout>
    <div class="card bg-base-100 shadow-sm border border-base-300">
        <div class="card-body gap-5">

            {{-- Header --}}
            <div>
                <h1 class="text-2xl font-bold text-base-content">Welcome back</h1>
                <p class="text-sm text-base-content/60 mt-1">Sign in to your ShiftSwap account</p>
            </div>

            <x-auth-session-status :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
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
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                {{-- Password --}}
                <div class="form-control gap-1.5">
                    <div class="flex items-center justify-between">
                        <x-input-label for="password" :value="__('Password')" />
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-primary hover:underline">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                {{-- Remember me --}}
                <label class="label cursor-pointer justify-start gap-3 p-0">
                    <input id="remember_me" type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm" />
                    <span class="label-text">Remember me</span>
                </label>

                <button type="submit" class="btn btn-primary w-full mt-2">
                    Log In
                </button>
            </form>

            {{-- Register link --}}
            @if (Route::has('register'))
                <p class="text-center text-sm text-base-content/60">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Sign up</a>
                </p>
            @endif

        </div>
    </div>
</x-guest-layout>
