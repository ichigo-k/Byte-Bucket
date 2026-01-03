<div class="relative min-h-screen overflow-hidden bg-gray-900">
    <!-- Background Image -->
    <img
        src="https://images.pexels.com/photos/2041627/pexels-photo-2041627.jpeg"
        class="absolute inset-0 w-full h-full object-cover"
        alt="Background"
    />

    <div class="absolute inset-0 bg-gradient-to-tr from-light-black via-[30%] via-light-black/90 via-[60%] to-light-black/30"></div>

    <div class="relative z-10 flex min-h-screen items-center justify-start px-6 lg:px-20">
        <div class="max-w-sm text-white">

            <div class="mb-10 flex items-center gap-2.5 logo">
                <span class="text-xl font-semibold">ByteBucket</span>
            </div>

            <p class="mb-1.5 text-xs uppercase tracking-wider text-gray-400">Start for free</p>
            <h1 class="mb-3 text-3xl font-bold leading-tight">
                Create new account<span class="text-primary">.</span>
            </h1>
            <p class="mb-10 text-gray-400 text-sm">
                Already A Member? <a wire:navigate href="{{ route('login') }}" class="text-primary hover:underline">Log in</a>
            </p>

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-500/30 bg-red-500/10 backdrop-blur-sm px-4 py-3 text-red-300">
                    <ul class="space-y-1 text-xs">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5 h-1 w-1 rounded-full bg-red-400"></span>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="mb-6 rounded-lg border border-green-500/30 bg-green-500/10 backdrop-blur-sm px-4 py-3 text-green-300 text-xs">
                    {{ session('success') }}
                </div>
            @endif

            <form class="space-y-3.5" wire:submit="signUp">
                <div class="grid grid-cols-2 gap-3.5">
                    <input
                        type="text"
                        class="rounded-lg bg-white/10 px-4 py-3 text-white placeholder-gray-400 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary text-sm"
                        placeholder="John"
                        wire:model="firstname"
                    />

                    <input
                        type="text"
                        class="rounded-lg bg-white/10 px-4 py-3 text-white placeholder-gray-400 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary text-sm"
                        placeholder="Doe"
                        wire:model="lastname"
                    />
                </div>

                <input
                    type="email"
                    class="w-full rounded-lg bg-white/10 px-4 py-3 text-white placeholder-gray-400 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary text-sm"
                    placeholder="john.doe@anywhere.co"
                    wire:model="email"
                />

                <input
                    type="password"
                    placeholder="Password"
                    class="w-full rounded-lg bg-white/10 px-4 py-3 text-white placeholder-gray-400 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-primary text-sm"
                    wire:model="password"
                />

                <div class="flex gap-3.5 pt-3">
                    <button type="submit" class="rounded-lg bg-primary px-8 py-3 w-2/3 font-medium text-white hover:bg-secondary transition text-sm">
                        <div wire:loading.remove>
                            Create Account
                        </div>
                        <div wire:loading>
                            Loading...
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
