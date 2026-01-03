<div class="min-h-screen bg-light-black flex flex-col lg:flex-row">
    <!-- Left Side: Login Form -->
    <div class="flex-1 flex items-center justify-center px-6 py-10 lg:py-0 lg:px-10 xl:px-20">
        <div class="w-full max-w-sm space-y-4">

            <!-- Title -->
            <div class="text-center lg:text-left">
                <h1 class="text-3xl font-bold text-white mb-1">Welcome Back</h1>
                <p class="text-gray-400 text-sm">Log into your account</p>
            </div>

            <!-- Google Login Button -->
            <button class="w-full flex items-center justify-center gap-2.5 rounded-lg border border-gray-700 hover:border-gray-600 bg-light-black/50 backdrop-blur-sm px-5 py-1.5 font-medium text-gray-200 hover:bg-light-black/80 transition text-sm">
                <svg class="w-4 h-4" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Login with Google
            </button>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-700"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-3 bg-light-black text-gray-500">or Login with Email</span>
                </div>
            </div>

            <!-- Error Messages -->
            @if (session()->has('error'))
                <div class="rounded-lg border border-red-500/30 bg-red-500/10 backdrop-blur-sm px-4 py-3 text-red-300 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-lg border border-red-500/30 bg-red-500/10 backdrop-blur-sm px-4 py-3 text-red-300">
                    <ul class="space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5 h-1 w-1 rounded-full bg-red-400"></span>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Email Field -->
            <div>
                <label class="block text-xs font-medium text-gray-300 mb-1.5">Email</label>
                <input wire:model="email" type="email" placeholder="E.g. johndoe@email.com"
                       class="w-full rounded-lg border border-gray-700 bg-light-black/50 backdrop-blur-sm px-4 py-1.5 text-white placeholder-gray-500 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30 transition text-sm" />
            </div>

            <!-- Password Field -->
            <div>
                <label class="block text-xs font-medium text-gray-300 mb-1.5">Password</label>
                <div class="relative">
                    <input wire:model="password" type="password" placeholder="Enter your password"
                           class="w-full rounded-lg border border-gray-700 bg-light-black/50 backdrop-blur-sm px-4 py-1.5 pr-10 text-white placeholder-gray-500 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30 transition text-sm" />
                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember me & Forgot password -->
            <div class="flex items-center justify-between flex-wrap gap-3">
                <label class="flex items-center cursor-pointer text-sm">
                    <input type="checkbox" class="w-3.5 h-3.5 rounded border-gray-600 text-primary focus:ring-primary bg-light-black">
                    <span class="ml-2 text-gray-400">Remember Me</span>
                </label>
                <a href="#" class="text-xs font-medium text-primary hover:text-secondary hover:underline transition">
                    Forgot Password?
                </a>
            </div>

            <!-- Login Button -->
            <button wire:click="login" type="submit"
                    class="w-full rounded-lg bg-primary py-1.5 text-sm font-semibold text-white shadow-md hover:bg-secondary hover:shadow hover:scale-[1.02] transition-all duration-200">
                <div wire:loading.remove>Login</div>
                <div wire:loading>Loading...</div>
            </button>

            <!-- Footer Link -->
            <p class="text-center text-xs text-gray-400">
                Not registered yet?
                <a wire:navigate href="{{ route('register') }}" class="font-semibold text-primary hover:text-secondary inline-flex items-center gap-1 transition">
                    Create an account
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </p>

        </div>
    </div>
</div>
