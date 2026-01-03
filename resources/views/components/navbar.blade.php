<nav x-data="{ open: false }" class="bg-light-black absolute top-0 w-full backdrop-blur-xl border-b border-white/15 text-white ">
    <div class="max-w-screen-2xl mx-auto px-6">
        <div class="flex items-center justify-between h-14">

            <div class="flex items-center gap-6">

                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                    <div class="w-6.5 h-6.5 rounded-lg bg-gradient-to-br from-primary to-primary/70 flex items-center justify-center shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-lg font-semibold text-white tracking-tight">ByteBucket</span>
                </a>

                <div class="hidden md:flex items-center text-xs">
                    <a href="#" class="text-light-gray hover:text-white transition">Buckets</a>
                    <svg class="w-3.5 h-3.5 mx-2.5 text-light-gray/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-white font-medium">My Project</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative" @click.away="open = false">

                    <div class="flex items-center gap-x-3">
                        <div class="px-3 py-1 text-xs font-medium tracking-wider uppercase bg-white/5 backdrop-blur-md border border-white/10 rounded-full text-light-gray hover:text-primary hover:bg-primary/10 hover:scale-105 transition-all duration-300">
                            {{ auth()->user()->currentPlan() }}
                        </div>
                        <button
                            @click="open = !open"
                            class="w-7.5 h-7.5 rounded-full overflow-hidden ring-2 ring-white/10 hover:ring-primary/50 transition-all duration-300"
                        >
                            @if (auth()->user()->profile_photo_url ?? false)
                                <img src="{{ auth()->user()->profile_photo_url }}" class="w-full h-full object-cover" alt="User">
                            @else
                                <img src="https://i.pinimg.com/1200x/17/df/a9/17dfa916f8e4ca133dbbf0b4fbf76c3c.jpg" class="w-full h-full object-cover" alt="User">
                            @endif

                        </button>
                    </div>


                        <div
                            x-show="open"
                            x-transition
                            class="absolute right-0 mt-5 w-64 rounded-2xl bg-light-black/90 backdrop-blur-xl border border-white/10 shadow-2xl overflow-hidden z-[999]"
                        >
                        <div class="px-4 py-3 border-b border-white/5">
                            <p class="text-sm font-semibold text-white capitalize">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                            <p class="text-xs text-light-gray truncate mt-0.5">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="py-1.5">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-xs text-light-gray hover:bg-primary/10 hover:text-primary transition">
                                Profile
                            </a>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-xs text-light-gray hover:bg-primary/10 hover:text-primary transition">
                                Account Settings
                            </a>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-xs text-light-gray hover:bg-primary/10 hover:text-primary transition">
                                Billing
                            </a>

                            @if (strtolower(auth()->user()->currentPlan()) === 'free')
                                <a
                                    href="{{ route('dashboard') }}"
                                    class="group block px-4 py-2.5 mt-3 mb-2 mx-3 text-sm font-medium text-white bg-primary hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2"
                                >
                                    <svg class="w-4 h-4 text-white/80 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Upgrade to Premium
                                </a>
                            @endif
                        </div>

                        <div class="border-t border-white/5 ">

                            <button wire:click="logout"  class="w-full text-left px-4 py-2.5 text-xs text-light-gray hover:text-danger-red cursor-pointer hover:bg-danger-red/10 transition">
                                    Sign out
                            </button>

                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</nav>
