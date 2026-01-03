<div class="min-h-screen bg-light-black flex flex-col lg:flex-row">
    <div class="flex-1 flex items-center justify-center px-6 py-10 lg:py-0 lg:px-10 xl:px-20">
        <div class="w-full max-w-sm space-y-6">

            <!-- Header -->
            <div class="text-center lg:text-left">
                <h1 class="text-3xl font-bold text-white mb-1">
                    ByteBucket <span class="text-primary">.</span>
                </h1>
                <p class="text-gray-400 text-sm">Verify Your Email</p>
            </div>

            <!-- Card -->
            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 lg:p-8 space-y-6">

                <!-- Loading State -->
                @if ($loading)
                    <div class="text-center space-y-6">
                        <div class="mx-auto w-16 h-16 rounded-full bg-primary/20 flex items-center justify-center animate-pulse">
                            <svg class="w-8 h-8 text-primary animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Verifying your email...</h2>
                        <p class="text-sm text-white/70">Please wait a moment.</p>
                    </div>
                @endif

                <!-- Success State -->
                @if ($verified && !$loading)
                    <div class="text-center space-y-6">
                        <div class="mx-auto w-20 h-20 rounded-full bg-primary/20 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="space-y-3">
                            <h2 class="text-3xl font-bold text-white">Welcome Back!</h2>
                            <p class="text-lg text-white/80">Your email has been successfully verified.</p>
                            <p class="text-sm text-white/70">You're all set!</p>
                        </div>
                        <a wire:navigate href="{{ route('dashboard') }}"
                           class="inline-block w-full rounded-xl bg-primary px-6 py-3 text-base font-semibold text-white hover:bg-secondary transition-all shadow-md hover:shadow hover:scale-[1.02]">
                            Go to Dashboard
                        </a>
                    </div>
                @endif

                <!-- Invalid Token -->
                @if ($invalid && !$loading)
                    <div class="text-center space-y-6">
                        <div class="mx-auto w-20 h-20 rounded-full bg-red-500/20 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="space-y-3">
                            <h2 class="text-3xl font-bold text-white">Verification Failed</h2>
                            <p class="text-lg text-white/80">This link is invalid or has expired.</p>
                            <p class="text-sm text-white/70">We can send you a new one.</p>
                        </div>
                        <button wire:click="resendVerification"
                                wire:loading.attr="disabled"
                                class="w-full rounded-xl bg-primary px-6 py-3 text-base font-semibold text-white hover:bg-secondary transition-all shadow-md hover:shadow hover:scale-[1.02] disabled:opacity-70">
                            <span wire:loading.remove wire:target="resendVerification">Resend Verification Email</span>
                            <span wire:loading wire:target="resendVerification">Sending...</span>
                        </button>
                    </div>
                @endif

                <!-- Not Verified Yet (No Token) -->
                @if (!$loading && !$verified && !$invalid)
                    <div class="text-center space-y-6">
                        <div class="mx-auto w-20 h-20 rounded-full bg-primary/20 flex items-center justify-center">
                            <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="space-y-3">
                            <h2 class="text-3xl font-bold text-white">Verify Your Email</h2>
                            <p class="text-lg text-white/80">Your account is not verified yet.</p>
                            <p class="text-sm text-white/70">Check your inbox or request a new link below.</p>
                        </div>
                        <button wire:click="resendVerification"
                                wire:loading.attr="disabled"
                                class="w-full rounded-xl bg-primary px-6 py-3 text-base font-semibold text-white hover:bg-secondary transition-all shadow-md hover:shadow hover:scale-[1.02] disabled:opacity-70">
                            <span wire:loading.remove wire:target="resendVerification">Resend Verification Email</span>
                            <span wire:loading wire:target="resendVerification">Sending...</span>
                        </button>
                    </div>
                @endif

                <!-- Status Message -->
                @if ($statusMessage)
                    <div class="rounded-xl border border-white/20 bg-white/10 px-5 py-3 text-sm text-white/90 text-center">
                        {{ $statusMessage }}
                    </div>
                @endif

            </div>

            <!-- Footer -->
            <p class="text-center text-white/60 text-sm">
                Already verified?
                <a wire:navigate href="{{ route('login') }}" class="font-semibold text-primary hover:text-secondary hover:underline transition">
                    Log in here
                </a>
            </p>

        </div>
    </div>
</div>
